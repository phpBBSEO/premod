<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $id: google_xml.php - 10551 11-20-2008 11:43:24 - 2.0.RC1 dcz $
* @copyright (c) 2006 - 2008 www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
// First basic security
if ( !defined('IN_PHPBB') ) {
	exit;
}
/**
* google_xml Class
* www.phpBB-SEO.com
* @package phpBB SEO
*/
class google_xml {
	var $url_settings = array();
	var $options = array();
	var $module_config = array();
	var $outputs = array();
	var $xml_files = array();
	/**
	* constuctor
	*/
	function google_xml(&$gym_master) {
		$this->gym_master = &$gym_master;
		$this->options = &$this->gym_master->actions;
		$this->outputs = &$this->gym_master->output_data;
		$this->url_settings = &$this->gym_master->url_config;
		$this->module_config = array_merge(
			// Global
			$this->gym_master->google_config,
			// Other stuff required here
			array(
				'google_sources' => $this->gym_master->path_config['gym_path'] . 'sources/',
				'google_randomize' => (boolean) $this->gym_master->gym_config['google_xml_randomize'],
				'google_unique' => (boolean) $this->gym_master->gym_config['google_xml_unique'],
				'google_check_robots' => (boolean) $this->gym_master->gym_config['google_xml_check_robots'],
				'google_force_limit' => (boolean) $this->gym_master->gym_config['google_xml_force_limit'],
				'google_force_lastmod' => (boolean) $this->gym_master->gym_config['google_xml_force_lastmod'],
			)
		);
		$this->module_config['xml_parse'] = (boolean) ($this->module_config['google_randomize'] || $this->module_config['google_unique'] || $this->module_config['google_force_limit'] || $this->module_config['google_force_lastmod']|| $this->module_config['google_check_robots']);
		// List available files
		$this->get_source_list();
		// Init url settngs
		$this->init_url_settings();
	}
	/**
	* Initialize mod rewrite to handle multiple URL standards.
	* Only one 'if' is required after this in THE loop to properly switch 
	* between the four types (none, advanced, mixed and simple).
	* @access private
	*/
	function init_url_settings() {
		global $phpbb_seo;
		// vars will fell like rain in the code ;)
		$this->url_settings['google_xml_pre'] = $this->url_settings['google_default'] . '?xml=';
		$this->url_settings['google_xml_ext'] = '';

		$this->url_settings['google_xml_delim'] = !empty($phpbb_seo->seo_delim['google_xml']) ? $phpbb_seo->seo_delim['google_xml'] : '-';
		$this->url_settings['google_xml_static'] = !empty($phpbb_seo->seo_static['google_xml']) ? $phpbb_seo->seo_static['google_xml'] : 'xml';
		$this->url_settings['modrewrite'] = $this->module_config['google_modrewrite'];
		if ($this->url_settings['modrewrite']) { // Module links
			$this->url_settings['google_xml_pre'] = 'xml' . $this->url_settings['google_xml_delim'];
			$this->url_settings['google_xml_ext'] = '.xml' . $this->url_settings['gzip_ext_out'];
		}
		return;
	}
	/**
	* sitemap, builds the sitemap
	* @access private
	*/
	function sitemap() {
		global $cache, $phpEx, $config, $user;
		if (!empty($this->xml_files[$this->options['module_sub']])) {
			// Check robots.txt ?
			if ($this->module_config['google_check_robots']) {
				$this->gym_master->obtain_robots_disallows();
			}
			$sitemap_xml_url = $this->module_config['google_url'] . $this->url_settings['google_xml_pre'] . $this->options['module_sub'] . $this->url_settings['google_xml_ext'];
			$this->gym_master->seo_kill_dupes($sitemap_xml_url);
			$xml_file = $this->xml_files[$this->options['module_sub']];
			// Grab data
			if (strpos('http://', $xml_file) !== false) {
				ini_set('user_agent','GYM Sitemaps &amp; RSS / www.phpBB-SEO.com');
				// You may want to use a higher value for the timout in case you use slow external sitemaps
				ini_set('default_socket_timeout', 5);
			}
			if ($xml_data = @file_get_contents($xml_file)) {
				if (!empty($http_response_header)) {
					$last_mod = get_date_from_header($http_response_header);
				} else {
					$last_mod = (int) @filemtime($xml_file);
				}
				$this->outputs['last_mod_time'] = $last_mod > $config['board_startdate'] ? $last_mod : ($user->time_now - rand(500, 10000));
				if (($url_tag_pos = utf8_strpos($xml_data, '<url>')) === false) {
					// this basic test failed
					// @TODO add loggs about this ?
					$this->gym_master->gym_error(404, '', __FILE__, __LINE__);
				}
				if (!$this->module_config['xml_parse']) {
					// use our hown headers
					$xml_data = str_replace('</urlset>', '', $xml_data );
					// Add to the output variable
					$this->outputs['data'] .= substr($xml_data, $url_tag_pos);
					// free memory
					unset($xml_data);
					// No link count here
					$this->outputs['url_sofar'] = 'n/a';
				} else {
					$xml_data = $this->xml2array($xml_data);
					if (!empty($xml_data['urlset'][0]['url']) && is_array($xml_data['urlset'][0]['url'])) {
						$xml_data = & $xml_data['urlset'][0]['url'];
						// Randomize ?
						if ($this->module_config['google_randomize']) {
							shuffle($xml_data);
						}
						// Limit ?
						if ($this->module_config['google_url_limit'] > 0) {
							$xml_data = array_slice($xml_data, 0, $this->module_config['google_url_limit']);
						}
						// Check unique  ?
						if ($this->module_config['google_unique']) {
							array_unique($xml_data);
						}
						// Force last mod  ?
						$last_mod = $this->module_config['google_force_lastmod'] ? $this->outputs['last_mod_time'] : 0;
						// Parse URLs
						$dt = 3600*4;
						foreach ($xml_data as $key => $data) {
							$loc = trim($data['loc']);
							if (empty($loc)) {
								continue;
							}
							if ($this->module_config['google_check_robots'] && $this->gym_master->is_robots_disallowed($loc)) {
								continue;
							}
							if ($this->module_config['google_force_lastmod']) {
								$_last_mod = $last_mod - $dt - rand(3600, 3600*24*7);
								$priority = $this->gym_master->get_priority($_last_mod);
								$changefreq = $this->gym_master->get_changefreq($_last_mod);
								$_last_mod = gmdate('Y-m-d\TH:i:s'.'+00:00', $_last_mod);
							} else {
								$_last_mod = !empty($data['lastmod']) ? $data['lastmod'] : 0;
								$priority = !empty($data['priority']) ? trim($data['priority']) : 0;
								$changefreq = !empty($data['changefreq']) ? trim($data['changefreq']) : 0;
							}
							$this->parse_item($loc, $priority, $changefreq, $_last_mod);
							unset($xml_data[$key]);
							$dt += rand(3600, 3600*12);
						}
					} else {
						// Clear the cache to make sure the guilty url is not shown in the sitemapIndex
						$cache->remove_file($cache->cache_dir . "data_gym_config_google_xml.$phpEx");
						$this->gym_master->gym_error(500, '', __FILE__, __LINE__);
					}
					
				}	
			} else {
				// Clear the cache to make sure the guilty url is not shown in the sitemapIndex
				$cache->remove_file($cache->cache_dir . "data_gym_config_google_xml.$phpEx");
				$this->gym_master->gym_error(404, '', __FILE__, __LINE__);
			}
		} else {
			$this->gym_master->gym_error(404, '', __FILE__, __LINE__);
		}
		return;
	}
	/**
	* sitemapindex, builds the sitemapindex
	* @access private
	*/
	function sitemapindex() {
		global $config, $user;
		// It's global list call, add module sitemaps
		// Reset the local counting, since we are cycling through modules
		$this->outputs['url_sofar'] = 0;
		foreach ($this->xml_files as $xml_action => $source) {
			$sitemap_xml_url = $this->module_config['google_url'] . $this->url_settings['google_xml_pre'] . $xml_action . $this->url_settings['google_xml_ext'];
			$last_mod = (int) @filemtime($xml_file);
			$last_mod = $last_mod > $config['board_startdate'] ? $last_mod : ($user->time_now - rand(500, 10000));
			$this->gym_master->parse_sitemap($sitemap_xml_url, $last_mod);
		}
		// Add the local counting, since we are cycling through modules
		$this->outputs['url_sofar_total'] = $this->outputs['url_sofar_total'] + $this->outputs['url_sofar'];
		return;
	}
	/**
	* get_source_list, builds the available sitemap list
	* @access private
	*/
	function get_source_list() {
		global $cache, $phpEx;
		if (($this->xml_files = $cache->get('_gym_config_google_xml')) === false) {
			$this->xml_files = array();
			// Check the eventual external url config
			if (file_exists($this->module_config['google_sources'] . "xml_google_external.$phpEx")) {
				include($this->module_config['google_sources'] . "xml_google_external.$phpEx");
				// Duplicated keys will be overriden bellow
				$this->xml_files = array_merge($this->xml_files, $external_setup);
			}
			$RegEx = '`^google_([a-z0-9_-]+)\.xml$`i';
			$xml_dir = @opendir( $this->module_config['google_sources'] );
			while( ($xml_file = @readdir($xml_dir)) !== false ) {
				if(preg_match($RegEx, $xml_file, $matches)) {
					if (!empty($matches[1])) {
						$this->xml_files[$matches[1]] = $this->module_config['google_sources'] . 'google_' . $matches[1] . '.xml';
					}
				}
			}
			@closedir($xml_dir);
			$cache->put('_gym_config_google_xml', $this->xml_files);
		}
		return;
	}
	/**
	* parse_item() adds the item info to the output
	*/
	function parse_item($url, $priority = 1.0, $changefreq = 'always', $lastmodtime = 0) {
		global $config, $user;
		$changefreq = isset($this->gym_master->freq_values[$changefreq]) ? sprintf($this->gym_master->style_config['changefreq_tpl'], $changefreq) : '';
		$priority = $priority <= 1 && $priority > 0 ? sprintf($this->gym_master->style_config['priority_tpl'], $priority) : '';
		$lastmodtime = $lastmodtime > $config['board_startdate'] ? sprintf($this->gym_master->style_config['lastmod_tpl'], $lastmodtime) : '';
		$this->gym_master->output_data['data'] .= sprintf($this->gym_master->style_config['Sitemap_tpl'], $url, $lastmodtime, $changefreq, $priority);
		$this->gym_master->output_data['url_sofar']++;
	}
	/**
	* xml2array, builds an array of xml tags
	* @access private
	* borrowed from php.net http://complet1.free.fr/bd_php5/docphp/ref.xml.php.htm#54625
	*/
	function xml2array($text) {
		$reg_exp = '`<(\w+)[^>]*>(.*?)</\\1>`s';
		preg_match_all($reg_exp, $text, $match);
		foreach ($match[1] as $key=>$val) {
			if ( preg_match($reg_exp, $match[2][$key]) ) {
				$array[$val][] = $this->xml2array($match[2][$key]);
			} else {
				$array[$val] = $match[2][$key];
			}
		}
		return $array;
	}
}
?>