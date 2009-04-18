<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $Id: gym_sitemaps.php 2007/04/12 13:48:48 dcz Exp $
* @copyright (c) 2006 dcz - www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
// First basic security
if ( !defined('IN_PHPBB') ) {
	exit;
}
/**
* gym_google Class
* www.phpBB-SEO.com
* @package phpBB SEO
*/
class gym_google extends gym_sitemaps {
	var	$google_config = array();
	// changefreq values, set to null to deactivate a value
	var	$freq_values = array('always' => 1, 'hourly' => 1, 'daily' => 1, 'weekly' => 1, 'monthly' => 1, 'yearly' => 1, 'never'  => 1);
	/**
	* constuctor
	*/
	function gym_google() {
		global $phpbb_seo, $phpEx, $config;
		global $db, $auth, $user;
		$this->gym_sitemaps('google');
		// init output
		$this->output_data['showstats'] = $this->gym_config['gym_showstats'] && $this->gym_config['google_showstats'];
		// Set last mod time from DB, will only be used as his for sitempaindex
		// put it into phpbb config for the dynamic property.
		$config_name = $this->actions['action_type'] . '_' . (!empty($this->actions['module_main']) ? $this->actions['module_main'] . '_' : '') . 'last_mod_time';
		if (@$config[$config_name] < $config['board_startdate']) {
			set_config($config_name, $user->time_now, 1);
		}
		$this->output_data['last_mod_time'] = intval($config[$config_name]);
		// Check the main vars
		$this->init_get_vars();
		$this->gym_init_output();
		// Setup the output
		$this->cache_config = array_merge(
			// Global
			$this->cache_config,
			// Other stuff required here
			array(
				'cache_enable' => (boolean) $this->set_module_option('cache_on', $this->override['cache']),
				'cache_auto_regen' => (boolean) $this->set_module_option('cache_auto_regen', $this->override['cache']),
				'cache_force_gzip' => (boolean) $this->set_module_option('cache_force_gzip', $this->override['cache']),
				'cache_born' => intval($this->set_module_option('cache_born')),
				'cache_max_age' => round($this->set_module_option('cache_max_age', $this->override['cache']),2) * 3600,
				'cache_file_ext' => ( $this->gym_output->gzip_config['gzip'] || $this->set_module_option('cache_force_gzip', $this->override['cache']) ) ? '.xml.gz' : '.xml',
			)
		);
		// Can you believe it, sprintf is faster than straight parsing. 
		$this->style_config	= array('Sitemap_tpl' => "\n\t" . '<url>' . "\n\t\t" . '<loc>%1$s</loc>%2$s%3$s%4$s' . "\n\t" . '</url>',
			'SitmIndex_tpl' => "\n\t" . '<sitemap>' . "\n\t\t" . '<loc>%s</loc>%s' . "\n\t" . '</sitemap>',
			'lastmod_tpl' => "\n\t\t" . '<lastmod>%s</lastmod>',
			'changefreq_tpl' => "\n\t\t" . '<changefreq>%s</changefreq>',
			'priority_tpl' => "\n\t\t" . '<priority>%.2f</priority>',
			'xslt_style' => '',
			'stats_genlist'	=> "\n" . '<!-- URL list generated in  %s s %s - %s sql - %s URLs listed -->',
			'stats_start' => "\n" . '<!--  Output started from cache after %s s - %s sql -->',
			'stats_nocache'	=> "\n" . '<!--  Output ended after %s s %s -->',
			'stats_end' => "\n" . '<!--  Output from cache ended up after %s s - %s sql -->',
		);
		// Check cache
		$this->gym_output->setup_cache(); // Will exit if the cache is sent
		$this->google_config = array(
			'google_default_priority' =>  sprintf('%.1f', $this->set_module_option('default_priority', $this->gym_config['google_override'])),
			'google_url' => $this->gym_config['google_url'],
			// module specific settings we should often need in module
			'google_modrewrite' => intval($this->set_module_option('modrewrite', $this->override['modrewrite'])),
			'google_modrtype' => intval($this->set_module_option('modrtype', $this->override['modrewrite'])),
			'google_pagination' => $this->set_module_option('pagination', $this->override['pagination']),
			'google_limitdown' => intval($this->set_module_option('limitdown', $this->override['pagination'])),
			'google_limitup'=> intval($this->set_module_option('limitup', $this->override['pagination'])),
			'google_sql_limit' => intval($this->set_module_option('sql_limit', $this->override['limit'])),
			'google_url_limit' => intval($this->set_module_option('url_limit', $this->override['limit'])),
			'google_sort' => ($this->set_module_option('sort', $this->override['sort']) === 'DESC') ? 'DESC' : 'ASC',
			'google_ping' => $this->set_module_option('ping', $this->gym_config['google_override']),
		);
		if ($this->gym_config['google_xslt']) {
			$this->style_config['xslt_style'] = "\n" . '<?xml-stylesheet type="text/xsl" href="' . $phpbb_seo->seo_path['phpbb_url'] . 'gym_sitemaps/gym_style.' . $phpEx . '?action-google,type-xsl,lang-' . $config['default_lang'] . ',theme_id-' . $config['default_style'] . '" ?>';
		}
		if ( empty($this->actions['module_main']) ) { // SitemapIndex
			$this->google_sitemapindex();
		} else { // Sitemap
			$this->google_sitemap();
		}
		if (!empty($_REQUEST['explain']) && $auth->acl_get('a_') && defined('DEBUG_EXTRA') && method_exists($db, 'sql_report'))
		{
			$db->sql_report('display');
		}
		$this->gym_output->do_output();
		return;
	}
	/**
	* GGs_sitemapindex() will build our sitemapIndex
	* Listing all available sitemaps
	* @access private
	*/
	function google_sitemapindex() {
		global $phpEx, $phpbb_seo, $db;
		$sitemapindex_url = $this->gym_config['google_url'] . ( $this->google_config['google_modrewrite'] ? 'sitemapindex.xml' . $this->url_config['gzip_ext_out'] : 'sitemap.'.$phpEx);
		$this->seo_kill_dupes($sitemapindex_url);
		$this->output_data['data'] = "<?xml version='1.0' encoding='UTF-8'?>" . $this->style_config['xslt_style'] . "\n" . '<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n\t" . 'xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9' . "\n\t" . 'http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd"' . "\n\t" . 'xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n" . '<!-- Generated by Google Yahoo MSN Sitemaps and RSS ' . $this->gym_config['gym_version'] . ' - © 2006, 2007 www.phpBB-SEO.com -->' . "\n";
		// start the modules
		$this->load_modules('sitemapindex');
		// Grabb the total
		$this->output_data['url_sofar'] = $this->output_data['url_sofar_total'];
		$this->output_data['data'] .= "\n" . '</sitemapindex>';
		return;
	}
	/**
	* GGs_sitemap() will build the actual Google sitemaps, all cases
	* @access private
	*/
	function google_sitemap() {
		global $phpEx, $phpbb_seo, $db;
		// Initialize SQL cycling : do not query for more than required
		$this->gym_config['google_sql_limit'] = ($this->gym_config['google_sql_limit'] > $this->gym_config['google_url_limit']) ? $this->gym_config['google_url_limit'] : $this->gym_config['google_sql_limit'];
		$this->output_data['data'] = "<?xml version='1.0' encoding='UTF-8'?>" . $this->style_config['xslt_style'] . "\n" . '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n\t" . 'xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9' . "\n\t" . 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"' . "\n\t" . 'xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n" . '<!-- Generated by Google Yahoo MSN Sitemaps and RSS ' . $this->gym_config['gym_version'] . ' - © 2006, 2007 www.phpBB-SEO.com -->' . "\n";
		// start the module
		$module_class = $this->actions['action_type'] . '_' . $this->actions['module_main'];
		$this->load_module($module_class, 'sitemap');
		$this->output_data['data'] .= "\n" . '</urlset>';
		return;
	}
	/**
	* parse_sitemap($url, $lastmodtime = 0)
	* adds the module sitemaps to the sitemapindex
	*/
	function parse_sitemap($url, $lastmodtime = 0) {
		global $config, $user;
		if ($lastmodtime > $config['board_startdate']) {
			$this->output_data['last_mod_time'] = $lastmodtime;
			$lastmodtime = sprintf($this->style_config['lastmod_tpl'], gmdate('Y-m-d\TH:i:s'.'+00:00', intval($lastmodtime)));
		} else {
			$lastmodtime = '';
		}
		$this->output_data['data'] .= sprintf($this->style_config['SitmIndex_tpl'], $url, $lastmodtime);
		$this->output_data['url_sofar']++;
	}
	/**
	* parse_item() adds the item info to the output
	*/
	function parse_item($url, $priority = 1.0, $changefreq = 'always', $lastmodtime = 0) {
		global $config, $user;
		$changefreq = isset($this->freq_values[$changefreq]) ? sprintf($this->style_config['changefreq_tpl'], $changefreq) : '';
		$priority = $priority <= 1 && $priority > 0 ? sprintf($this->style_config['priority_tpl'], $priority) : '';
		$lastmodtime = $lastmodtime > $config['board_startdate'] ? sprintf($this->style_config['lastmod_tpl'], gmdate('Y-m-d\TH:i:s'.'+00:00', intval($lastmodtime))) : '';
		$this->output_data['data'] .= sprintf($this->style_config['Sitemap_tpl'], $url, $lastmodtime, $changefreq, $priority);
		$this->output_data['url_sofar']++;
	}
	/**
	* get_priority() computes the priority, bases on last mod time and page number
	* Freshest items with most pages gets the highest priority
	* 42 is the answer to the most important question in the universe ;-)
	*/
	function get_priority($lastmodtime, $pages = 1) {
		global $user;
		return $user->time_now / ($user->time_now + ((($user->time_now - $lastmodtime)* 42) / $pages));
	}
	/**
	* get_changefreq() computes the changefreq, based on lastmodtime
	* 3628800 is 6 weeks
	*/
	function get_changefreq($lastmodtime) {
		global $user;
		$dt = ($user->time_now - $lastmodtime);
		return $dt > 3628800 ? 'monthly' : ($dt > 864000 ? 'weekly' : 'daily');
	}
	/**
	* parse_sitemap($url, $lastmodtime = 0)
	* adds the module sitemaps to the sitemapindex
	*/
	function google_ping($url) {
		global $config, $user;
		$se_urls = array('http://www.google.com/', 'http://www.yahoo.com/', 'http://www.live.com/');
		$not_curl= true;
		foreach ($se_urls as $se_url) {
			$request = $se_url . 'ping?sitemap=' . urlencode($url);
			if (function_exists('curl_exec')) {
				$not_curl= false;
				// Initialize the session
				$session = curl_init($request);
				// Set curl options
				curl_setopt($session, CURLOPT_HEADER, false);
				curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
				// Make the request
				$response = curl_exec($session);
				// Close the curl session
				curl_close($session);
				// Get HTTP Status code from the response
				$status_codes = array();
				preg_match('/\d\d\d/', $response, $status_code);
				$status_code = $status_codes[0];
				// Get the the response, bypassing the header
				if ($status_code != 200) {
					$not_curl= true;
				}
			} elseif ( $not_curl && function_exists('file_get_contents') ) {
				// Make the request
				if (file_get_contents($request)) {
					// Retrieve HTTP status code
					list($version,$status_code,$msg) = explode(' ',$http_response_header[0], 3);
				}
				if ($status_code != 200) {
					$this->gym_error(500, 'GYM_ERROR_PING', __FILE__, __LINE__);
				}
			} else {
				$this->gym_error(500, 'GYM_ERROR_PING', __FILE__, __LINE__);
			}
		}
		return;
	}
}
?>
