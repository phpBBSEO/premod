<?php
/** 
*
* @package Advanced phpBB3 SEO mod Rewrite
* @version $Id: phpbb_seo_class.php 2007/08/30 13:48:48 dcz Exp $
* @copyright (c) 2006, 2007 dcz - www.phpbb-seo.com
* @license http://www.opensource.org/licenses/rpl.php RPL Public License 
*
*/
/**
* phpBB_SEO Class
* www.phpBB-SEO.com
* @package Advanced phpBB3 SEO mod Rewrite
*/
class phpbb_seo {
	var	$version = '0.4.0RC4';
	var	$modrtype = 0;
	var	$seo_paths = array();
	var	$seo_url = array();
	var	$seo_censored = array();
	var	$seo_delim = array();
	var	$seo_ext = array();
	var	$seo_static = array();
	var	$seo_url_filter = array();
	var	$get_var = array();
	var	$path = '';
	var	$start = '';
	var	$filename = '';
	var	$file = '';
	var	$url_in = '';
	var	$url = '';
	var	$page_url = '';
	var	$seo_opt = array();
	var	$seo_cache = array();
	var	$encoding = 'utf-8';
	var	$cache_config = array();
	/**
	* constuctor
	*/
	function phpbb_seo() {
		global $phpEx, $config, $user, $phpbb_root_path;
		// config
		$this->modrtype =  3; // 3 = Advanced
		$this->seo_cache = array();
		$this->cache_config = array();
		$this->seo_censored = array();
		$this->start = $this->path = '';
		// URL Settings
		// The arrays where the preformated titles are stored.
		$this->seo_url = array( 'forum' =>  array(), 'topic' =>  array(), 'user' => array() );
		// URL Filters
		$this->phpbb_filter = array( 'forum' => array('st' => 0, 'sk' => 't', 'sd' => 'd'),
			'topic' => array('st' => 0, 'sk' => 't', 'sd' => 'a', 'hilit' => ''),
		);
		// Stop files
		$this->seo_stop_files = array('posting', 'faq', 'ucp', 'search', 'swatch', 'mcp');
		// Stop vars
		$this->seo_stop_vars = array('view=', 'mark=', 'watch=');
		// reset GET var array
		$this->get_vars = array();
		// These options can be set and bypassed from the phpBB SEO settings page
		// You can safely mod the default values here.
		$this->seo_opt = array( 'url_rewrite' => false,
			'modrtype' => intval($this->modrtype),
			'rem_sid' => false, 
			'rem_hilit' => true, 
			'rem_small_words' => false,
			'virtual_folder' => false,
			'virtual_root' => false,
			'cache_layer' => true, // Forum url caching, by default
			'rem_ids' => false,
		);
		// Options that may be bypassed by the cached settings.
		$this->cache_config['dynamic_options'] = array_keys($this->seo_opt); // Do not change
		// --> No Dupe
		$this->seo_opt['no_dupe']['on'] = $this->cache_config['dynamic_options']['no_dupe']['on'] = false;
		// <-- No Dupe
		// --> Zero Dupe
		$this->seo_opt['zero_dupe'] = array( 'on' => false, // Activate or not the redirections : true / false
			'strict' => false, // strict compare, == VS strpos() : true / false
			'post_redir' => 'guest', // Redirect post urls if not valid ? : guest / all / post / off
		);
		$this->cache_config['dynamic_options']['zero_dupe'] = $this->seo_opt['zero_dupe']; // Do not change
		$this->seo_opt['zero_dupe']['do_redir'] = false; // do not change
		$this->seo_opt['zero_dupe']['bool_redir'] = true; // do not change
		$this->seo_opt['zero_dupe']['do_redir_post'] = false; // do not change
		$this->seo_opt['zero_dupe']['start'] = 0; // do not change
		// <-- Zero Dupe
		// Caching config
		$this->seo_opt['cache_folder'] = 'phpbb_seo/cache/'; // Folder where the cache file is stored
		define('SEO_CACHE_PATH', rtrim(phpbb_realpath($phpbb_root_path . $this->seo_opt['cache_folder']), '/') . '/'); // do not change
		$this->seo_opt['topic_type'] = array(); // do not change
		$this->seo_opt['topic_last_page'] = array(); // do not change
		$this->cache_config['cache_enable'] = true; // do not change
		$this->cache_config['rem_ids'] = $this->seo_opt['rem_ids']; // do not change, set up above
		$this->cache_config['files'] = array('forum' => 'phpbb_cache.' . $phpEx, 'htaccess' => '.htaccess');
		$this->cache_config['cached'] = false; // do not change
		$this->cache_config['forum'] = array(); // do not change
		$this->cache_config['topic'] = array(); // do not change
		$this->cache_config['settings'] = array(); // do not change
		// -> Cache 
		if ($this->check_cache()) {
			foreach($this->cache_config['dynamic_options'] as $optionname => $optionvalue ) {
				if (@is_array($this->cache_config['settings'][$optionname])) {
					foreach ( $this->cache_config['settings'][$optionname] as $key => $value ) {
						$this->seo_opt[$optionname][$key] = $this->cache_config['settings'][$optionname][$key];
					}
				} elseif ( @isset($this->cache_config['settings'][$optionvalue]) ) {
					$this->seo_opt[$optionvalue] = $this->cache_config['settings'][$optionvalue];
				}
			}
			$this->modrtype = @isset($this->seo_opt['modrtype']) ? $this->seo_opt['modrtype'] : $this->modrtype;
			if ( $this->modrtype > 1 ) { // Load cached URLs	
				$this->seo_url['forum'] = $this->cache_config['forum'];
			}
		}
		// Delimiters : used as separators in the .htaccess RegEx
		// can be edited, requires .htaccess update.
		$this->seo_delim = array( 'forum' => '-f', 'topic' => '-t', 'user' => '-u', 'start' => '-');
		// Default : Used as URL when format_url would return nothing or with simple URLs
		// can be edited, requires .htaccess update.
		$this->seo_static = array( 'forum' => 'forum', 'topic' => 'topic', 'post' => 'post', 'user' => 'member', 'index' => ($this->seo_opt['virtual_root'] ? 'forum' : ''), 'global_announce' => 'announces', 'leaders' => 'the-team', 'pagination' => 'page', 'gz_ext' => '.gz' );
		// URL suffixes, for the phpBB URLs
		// can be edited, requires .htaccess update.
		$this->seo_ext = array( 'forum' => '.html', 'topic' => '.html', 'post' => '.html', 'user' => '.html', 'index' => (!empty($this->seo_static['index']) ? '.html' : ''), 'global_announce' => '/', 'leaders' => '.html', 'pagination' => '.html', 'gz_ext' => '');
		// Special for lazy French
		if ( strpos($config['default_lang'], 'fr') !== false ) {
			// Vous pouvez modifier ces valeurs pour peu que vous modifiez le .htaccess en conséquence
			$this->seo_static['user'] = 'membre';
			$this->seo_static['global_announce'] = 'annonces';
			$this->seo_static['leaders'] = 'equipe';
		}
		// Some more config
		// If we use virtual folder, we need '/' at the end of the forum URLs
		if ($this->seo_opt['virtual_folder']) {
			$this->seo_ext['forum'] = $this->seo_ext['global_announce'] = '/';
		}
		// If the forum cache is not activated
		if (!$this->seo_opt['cache_layer']) {
			$this->seo_opt['rem_ids'] = false;
		}
		$this->seo_opt['topic_per_page'] = ($config['posts_per_page'] <= 0) ? 1 : $config['posts_per_page']; // do not change
		// preg_replace() pattern for format_url()
		$this->seo_opt['url_pattern'] = array('`&(amp;)?#?[a-z0-9]+;`i', '`[^a-z0-9]`i'); // Do not remove : html/xml entities & non a-z chars
		if ($this->seo_opt['rem_small_words']) {
			$this->seo_opt['url_pattern'][] = '`-[a-z0-9]{1,2}(?=-)`i'; // Startig / Ending with hyphen (thx pvchat1)
			$this->seo_opt['url_pattern'][] = '`^[a-z0-9]{1,2}-`i'; // Ending with hyphen
			$this->seo_opt['url_pattern'][] = '`-[a-z0-9]{1,2}$`i'; // Starting with hyphen
			$this->seo_opt['url_pattern'][] = '`^[a-z0-9]{1,2}$`i'; // Single word in title : z1-txx.html vs topic-txx.hmtl
		}
		$this->seo_opt['url_pattern'][] ='`[-]+`'; // Do not remove : multi hyphen reduction
		// Rewrite functions array : array('file_name' => 'function_name');
		// Allow to add options without slowing down the URL rewrite process
		$this->seo_opt['rewrite_functions'] = array( 
			'viewforum' => $this->modrtype > 1 ? ($this->seo_opt['virtual_folder'] ? 'viewforum_uadv' : 'viewforum_adv') : ($this->seo_opt['virtual_folder'] ? 'viewforum_usmpl' : 'viewforum_smpl'),
			'index' => 'index',
			'memberlist' => 'memberlist',
		);
		if ($this->modrtype == 3) {
			$this->seo_opt['rewrite_functions']['viewtopic'] = $this->seo_opt['virtual_folder'] ? 'viewtopic_uadv' : 'viewtopic_adv';
		} elseif ($this->modrtype == 2) {
			$this->seo_opt['rewrite_functions']['viewtopic'] = $this->seo_opt['virtual_folder'] ? 'viewtopic_umxd' : 'viewtopic_smpl';
		} else {
			$this->seo_opt['rewrite_functions']['viewtopic'] = $this->seo_opt['virtual_folder'] ? 'viewtopic_usmpl' : 'viewtopic_smpl';
		}
		// --> DOMAIN SETTING <-- //
		// Path Settings
		$server_protocol = ($config['server_protocol']) ? $config['server_protocol'] : (($config['cookie_secure']) ? 'https://' : 'http://');
		$server_name = trim($config['server_name'], '/') . '/';
		$server_port = (int) $config['server_port'];
		$server_port = ($server_port <> 80) ? ':' . $server_port : '';
		$script_path = trim($config['script_path'], '/');
		$script_path = (empty($script_path) ) ? '' : $script_path . '/';
		$this->seo_path['root_url'] =  $server_protocol . $server_name; 
		$this->seo_path['phpbb_urlR'] = $this->seo_path['phpbb_url'] =  $this->seo_path['root_url'] . $script_path;
		$this->seo_path['phpbb_script'] =  $script_path;
		// Array of the filenames that may require the use of a base href tag : for phpBB it only concerns two files.
		$this->seo_opt['file_hbase'] = array('viewtopic', 'viewforum');
		// virtual root option
		if ($this->seo_opt['virtual_root']) {
			$this->seo_path['phpbb_urlR'] = $this->seo_path['root_url'];
			$this->seo_opt['file_hbase'][] = 'index';
			$this->seo_opt['file_hbase'][] = 'memberlist';
		}
		// File setting
		$this->seo_req_uri();
		$parsed_url = @parse_url($this->seo_path['uri']);
		$this->seo_path['file'] = basename($parsed_url['path']);
		// Path from root to the file, including virtual folders.
		$this->seo_path['current_path'] = trim(trim(str_replace('\\', '/', $parsed_url['path']), '/'),  '.');
		$this->seo_opt['seo_base_href'] = '';
		$this->seo_opt['req_file'] = @parse_url($_SERVER['PHP_SELF']);
		$this->seo_opt['req_file'] = str_replace( '.' . $phpEx, '', basename($this->seo_opt['req_file']['path']));
		if ( ($this->seo_opt['virtual_folder'] || $this->seo_opt['virtual_root'] || ( $this->seo_ext['forum'] == '/' ) ) && in_array($this->seo_opt['req_file'], $this->seo_opt['file_hbase'])) {	
			$this->seo_opt['seo_base_href'] = '<base href="' . $this->seo_path['phpbb_url'] . '">';
		}
		return;
	}
	// --> URL rewriting functions <--
	/**
	* Prepare Titles for URL injection
	*/
	function format_url( $url, $type = 'topic' ) {
		$url = preg_replace('`\[.*\]`U','',$url);
		$url = htmlentities($url, ENT_COMPAT, $this->encoding);
		$url = preg_replace( '`&([a-z]+)(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', "\\1", $url );
		$url = preg_replace( $this->seo_opt['url_pattern'] , '-', $url);
		$url = strtolower(trim($url, '-'));
		return empty($url) ? $type : $url;
	}
	/**
	* Prepare url first part
	*/
	function set_url( $url, $id = 0, $type = 'forum' ) {
		return (!empty($this->cache_config[$type][$id])) ? $this->cache_config[$type][$id] : $this->format_url( $url, $type ) . $this->seo_delim[$type] . $id;
	}
	/**
	* Rewrite URLs.
	* Allow adding of many more cases than just the
	* regular phpBB URL rewritting without slowing up the process.
	*/
	function url_rewrite($url, $is_amp = TRUE ) {
		global $phpEx, $user;
		// stats
		$startime = $this->microtime_float();
		$url = ($is_amp) ? str_replace('&amp;', '&', $url) : $url;
		$url = str_replace('?&', '?', $url);
		$this->url = $this->url_in = $url;
		if (!empty($this->seo_cache[$url])) {
			return $this->seo_cache[$url];
		}
		if ( !$this->seo_opt['url_rewrite'] || strpos($this->url, "adm/") !== FALSE || defined('ADMIN_START') ) {
			return ($is_amp) ? str_replace('&', '&amp;', $url) : $url;
		}
		// Grabb params
		$parsed_url = parse_url($this->url);
		@parse_str($parsed_url['query'], $this->get_vars);
		$this->file = basename(@$parsed_url['path']);
		$this->filename = trim(str_replace(".$phpEx", '', $this->file));
		if ( in_array($this->filename, $this->seo_stop_files) ) {
			return ($is_amp) ? str_replace('&', '&amp;', $url) : $url;
		}
		if ( !$user->data['is_registered'] ) {
			if ( $this->seo_opt['rem_sid'] ) {
				unset($this->get_vars['sid']);
			}
			if ( $this->seo_opt['rem_hilit'] ) {
				unset($this->get_vars['hilit']);
			}
		}
		// Reset url
		$this->url = $this->file;
		if ( !empty($this->seo_opt['rewrite_functions'][$this->filename]) ) {
			$this->{$this->seo_opt['rewrite_functions'][$this->filename]}();
			// Assamble URL
			$this->url .= @$this->query_string($this->get_vars);
			$this->url = ($is_amp) ? str_replace('&', '&amp;', $this->url) : $this->url;
			$this->seo_cache[$url] = $this->path . $this->url . ((!empty($parsed_url['fragment'])) ? '#' . $parsed_url['fragment'] : '');
			return  $this->seo_cache[$url];
		} else {
			$this->seo_cache[$url] = ($is_amp) ? str_replace('&', '&amp;', $url) : $url;
			return $this->seo_cache[$url];
		}
	}
	/**
	* URL rewritting for viewtopic.php
	* With Virtual Folder Injection
	* @access private
	*/
	function viewtopic_uadv() {
		$this->filter_url($this->seo_stop_vars);
		$this->path = $this->seo_path['phpbb_urlR'];
		if ( !empty($this->get_vars['p']) ) {
			$this->url = $this->seo_static['post'] . $this->get_vars['p'] . $this->seo_ext['post'];
			unset($this->get_vars['p'], $this->get_vars['f'], $this->get_vars['t']);
			return;
		}
		if ( !empty($this->get_vars['t']) && !empty($this->get_vars['f']) && !empty($this->seo_url['topic'][$this->get_vars['t']]) && !empty($this->seo_url['forum'][$this->get_vars['f']])) {
			// Filter default params
			$this->filter_get_var($this->phpbb_filter['topic']);
			$this->seo_pagination();
			$this->url = $this->seo_url['topic'][$this->get_vars['t']] . $this->seo_delim['topic'] . $this->get_vars['t'] . $this->start . $this->seo_ext['topic'];
			if (@$this->seo_opt['topic_type'][$this->get_vars['t']] == POST_GLOBAL) {
				$this->url = $this->seo_static['global_announce'] . $this->seo_ext['global_announce'] . $this->url;
			} else {
				$this->url = $this->seo_url['forum'][$this->get_vars['f']] . $this->seo_ext['forum'] . $this->url;
			}
			unset($this->get_vars['t'], $this->get_vars['f'],$this->get_vars['p']);
			return;
		}
		$this->path = $this->seo_path['phpbb_url'];
		return;
	}
	/**
	* URL rewritting for viewtopic.php
	* With Virtual Folder Injection
	* @access private
	*/
	function viewtopic_umxd() {
		$this->filter_url($this->seo_stop_vars);
		$this->path = $this->seo_path['phpbb_urlR'];
		if ( !empty($this->get_vars['p']) ) {
			$this->url = $this->seo_static['post'] . $this->get_vars['p'] . $this->seo_ext['post'];
			unset($this->get_vars['p'], $this->get_vars['f'], $this->get_vars['t']);
			return;
		}
		if ( !empty($this->get_vars['t']) && !empty($this->get_vars['f']) && !empty($this->seo_url['forum'][$this->get_vars['f']]) ) {
			// Filter default params
			$this->filter_get_var($this->phpbb_filter['topic']);
			$this->seo_pagination();
			$this->url = $this->seo_static['topic'] . $this->get_vars['t'] . $this->start . $this->seo_ext['topic'];
			if (@$this->seo_opt['topic_type'][$this->get_vars['t']] == POST_GLOBAL) {
				$this->url = $this->seo_static['global_announce'] . $this->seo_ext['global_announce'] . $this->url;
			} else {
				$this->url = $this->seo_url['forum'][$this->get_vars['f']] . $this->seo_ext['forum'] . $this->url;
			}
			unset($this->get_vars['t'], $this->get_vars['f'],$this->get_vars['p']);
			return;
		}
		$this->path = $this->seo_path['phpbb_url'];
		return;
	}
	/**
	* URL rewritting for viewtopic.php
	* With Virtual Folder Injection
	* @access private
	*/
	function viewtopic_usmpl() {
		$this->filter_url($this->seo_stop_vars);
		$this->path = $this->seo_path['phpbb_urlR'];
		if ( !empty($this->get_vars['p']) ) {
			$this->url = $this->seo_static['post'] . $this->get_vars['p'] . $this->seo_ext['topic'];
			unset($this->get_vars['p'], $this->get_vars['f'], $this->get_vars['t']);
			return;
		}
		if ( !empty($this->get_vars['t']) && !empty($this->get_vars['f']) ) {
			// Filter default params
			$this->filter_get_var($this->phpbb_filter['topic']);
			$this->seo_pagination();
			$this->url = $this->seo_static['topic'] . $this->get_vars['t'] . $this->start . $this->seo_ext['topic'];
			if (@$this->seo_opt['topic_type'][$this->get_vars['t']] == POST_GLOBAL) {
				$this->url = $this->seo_static['global_announce'] . $this->seo_ext['global_announce'] . $this->url;
			} else {
				$this->url = $this->seo_static['forum'] . $this->get_vars['f'] . $this->seo_ext['forum'] . $this->url;
			}
			unset($this->get_vars['t'], $this->get_vars['f'],$this->get_vars['p']);
		}
		$this->path = $this->seo_path['phpbb_url'];
		return;
	}
	/**
	* URL rewritting for viewtopic.php
	* Without Virtual Folder Injection
	* @access private
	*/
	function viewtopic_adv() {
		$this->filter_url($this->seo_stop_vars);
		$this->path = $this->seo_path['phpbb_urlR'];
		if ( !empty($this->get_vars['p']) ) {
			$this->url = $this->seo_static['post'] . $this->get_vars['p'] . $this->seo_ext['post'];
			unset($this->get_vars['p'], $this->get_vars['f'], $this->get_vars['t']);
			return;
		}
		if ( !empty($this->get_vars['t']) && !empty($this->seo_url['topic'][$this->get_vars['t']]) ) {
			// Filter default params
			$this->filter_get_var($this->phpbb_filter['topic']);
			$this->seo_pagination();
			$this->url = $this->seo_url['topic'][$this->get_vars['t']] . $this->seo_delim['topic'] . $this->get_vars['t'] . $this->start . $this->seo_ext['topic'];
			unset($this->get_vars['t'], $this->get_vars['f'],$this->get_vars['p']);
			return;
		}
		$this->path = $this->seo_path['phpbb_url'];
		return;
	}
	/**
	* URL rewritting for viewtopic.php
	* Without Virtual Folder Injection
	* @access private
	*/
	function viewtopic_smpl() {
		$this->filter_url($this->seo_stop_vars);
		$this->path = $this->seo_path['phpbb_urlR'];
		if ( !empty($this->get_vars['p']) ) {
			$this->url = $this->seo_static['post'] . $this->get_vars['p'] . $this->seo_ext['topic'];
			unset($this->get_vars['p'], $this->get_vars['f'], $this->get_vars['t']);
			return;
		}
		if ( !empty($this->get_vars['t']) ) {
			// Filter default params
			$this->filter_get_var($this->phpbb_filter['topic']);
			$this->seo_pagination();
			$this->url = $this->seo_static['topic'] . $this->get_vars['t'] . $this->start . $this->seo_ext['topic'];
			unset($this->get_vars['t'], $this->get_vars['f'],$this->get_vars['p']);
		}
		$this->path = $this->seo_path['phpbb_url'];
		return;
	}
	/**
	* URL rewritting for viewforum.php
	* Without Virtual Folder Injection
	* @access private
	*/
	function viewforum_adv() {
		$this->path = $this->seo_path['phpbb_urlR'];
		$this->filter_url($this->seo_stop_vars);
		if ( !empty($this->get_vars['f']) && !empty($this->seo_url['forum'][$this->get_vars['f']]) ) {
			// Filter default params
			$this->filter_get_var($this->phpbb_filter['forum']);
			$this->seo_pagination();
			$this->url = $this->seo_url['forum'][$this->get_vars['f']] . $this->start . $this->seo_ext['forum'];
			unset($this->get_vars['f']);
			return;
		}
		$this->path = $this->seo_path['phpbb_url'];
		return;
	}
	/**
	* URL rewritting for viewforum.php
	* Without Virtual Folder Injection
	* @access private
	*/
	function viewforum_smpl() {
		$this->path = $this->seo_path['phpbb_urlR'];
		$this->filter_url($this->seo_stop_vars);
		if ( !empty($this->get_vars['f']) ) {
			// Filter default params
			$this->filter_get_var($this->phpbb_filter['forum']);
			$this->seo_pagination();
			$this->url = $this->seo_static['forum'] . $this->get_vars['f'] . $this->start . $this->seo_ext['forum'];
			unset($this->get_vars['f']);
			return;
		}
		$this->path = $this->seo_path['phpbb_url'];
		return;
	}
	/**
	* URL rewritting for viewforum.php
	* With Virtual Folder Injection
	* @access private
	*/
	function viewforum_uadv() {
		$this->path = $this->seo_path['phpbb_urlR'];
		$this->filter_url($this->seo_stop_vars);
		if ( !empty($this->get_vars['f']) && !empty($this->seo_url['forum'][$this->get_vars['f']]) ) {
			// Filter default params
			$this->filter_get_var($this->phpbb_filter['forum']);
			$this->seo_pagination_page();
			$this->url = $this->seo_url['forum'][$this->get_vars['f']] . $this->seo_ext['forum'] . $this->start;
			unset($this->get_vars['f']);
			return;
		}
		$this->path = $this->seo_path['phpbb_url'];
		return;
	}
	/**
	* URL rewritting for viewforum.php
	* With Virtual Folder Injection
	* @access private
	*/
	function viewforum_usmpl() {
		$this->path = $this->seo_path['phpbb_urlR'];
		$this->filter_url($this->seo_stop_vars);
		if ( !empty($this->get_vars['f']) ) {
			// Filter default params
			$this->filter_get_var($this->phpbb_filter['forum']);
			$this->seo_pagination_page();
			$this->url = $this->seo_static['forum'] . $this->get_vars['f'] . $this->seo_ext['forum'] . $this->start;
			unset($this->get_vars['f']);
			return;
		}
		$this->path = $this->seo_path['phpbb_url'];
		return;
	}
	/**
	* URL rewritting for profile.php
	* @access private
	*/
	function memberlist() {
		$this->path = $this->seo_path['phpbb_urlR'];
		if ( !empty($this->get_vars['u']) && @$this->get_vars['mode'] == 'viewprofile' ) {
			$this->url =  $this->seo_static['user'] . $this->get_vars['u'] . $this->seo_ext['user'];
			unset($this->get_vars['mode'], $this->get_vars['u']);
			return;
		} elseif (@$this->get_vars['mode'] == 'leaders') {
			$this->url =  $this->seo_static['leaders'] . $this->seo_ext['leaders'];
			unset($this->get_vars['mode']);
			return;
		}
		$this->path = $this->seo_path['phpbb_url'];
		return;
	}
	/**
	* URL rewritting for index.php
	* @access private
	*/
	function index() {
		$this->path = $this->seo_path['phpbb_urlR'];
		$this->url = $this->seo_static['index'] . $this->seo_ext['index'];
		return;
	}
	/**
	* Will break if a $filter pattern is foundin $url.
	* Example $filter = array("view=", "mark=");
	* @access private
	*/
	function filter_url($filter = array()) {
		foreach ($filter as $patern ) {
			if ( strpos($this->url_in, $patern) !== FALSE ) {
				unset($this->get_vars);
				$this->url = $this->url_in;
				break;
			}
		}
		return;
	}
	/**
	* Will unset all default var stored in $filter array.
	* Example $filter = array('postdays' => 0, 'topicdays' => 0, 'postorder' => 'asc');
	* @access private
	*/
	function filter_get_var($filter = array()) {
		if ( !empty($this->get_vars) ) {
			foreach ($this->get_vars as $paramkey => $paramval) {
				if ( array_key_exists($paramkey, $filter) ) {
					if ( $filter[$paramkey] ==  $this->get_vars[$paramkey] || empty( $this->get_vars[$paramkey])) {
						unset($this->get_vars[$paramkey]);
					}
				}
			}	
		}
		return;
	}
	/**
	* Will return the remaining GET vars to take care of
	* @access private
	*/
	function query_string() {
		if(empty($this->get_vars)) {
			return '';
		}
		$params = array();
		foreach($this->get_vars as $key => $value) {
			$params[] = $key . '=' . $value;
		}
		return '?' . implode('&', $params);
	}
	/**
	* Set the $start var proper
	* @access private
	*/
	function seo_pagination() {
		$this->start = $this->seo_start( @$this->get_vars['start'] );
		unset($this->get_vars['start']);
	}
	/**
	* Returns usable start param
	* -xx
	*/
	function seo_start($start) {
		return ($start > 0 ) ? $this->seo_delim['start'] . intval($start) : '';
	}
	/**
	* Set the $start var proper in virtual folder mode
	* @access private
	*/
	function seo_pagination_page() {
		$this->start = $this->seo_start_page( @$this->get_vars['start'] );
		unset($this->get_vars['start']);
	}
	/**
	* Returns usable start param
	* pagexx.html
	* Only used in virtual folder mode
	*/
	function seo_start_page($start) {
		return ($start > 0 ) ? $this->seo_static['pagination'] . intval($start) . $this->seo_ext['pagination'] : '';
	}
	/**
	* Returns the full REQUEST_URI
	*/
	function seo_req_uri() {
		if ( !empty($_SERVER['REQUEST_URI']) ) { // Apache mod_rewrite
			$this->seo_path['uri'] = ltrim($_SERVER['REQUEST_URI'], '/');
		} elseif ( !empty($_SERVER['HTTP_X_REWRITE_URL']) ) { // IIS  isapi_rewrite
			$this->seo_path['uri'] = ltrim($_SERVER['HTTP_X_REWRITE_URL'], '/');
		} else { // no mod rewrite
			$this->seo_path['uri'] =  ltrim($_SERVER['SCRIPT_NAME'], '/') . ( ( !empty($_SERVER['QUERY_STRING']) ) ? '?'.$_SERVER['QUERY_STRING'] : '' );
		}
		$this->seo_path['uri'] = $this->seo_path['root_url'] . str_replace('&amp;', '&', $this->seo_path['uri']);
		return $this->seo_path['uri'];
	}
	/**
	* seo_end() : The last touch function
	* Note : This mod is going to help your site a lot in Search Engines 
	* We request that you keep this copyright notice as specified in the licence.
	* If You really cannot put this link, you should at least provide us with one visible 
	* (can be small but visible) link on your home page or your forum Index using this code for example :
	* <a href="http://www.phpbb-seo.com/" title="Search Engine Optimization">phpBB SEO</a>
	*/
	function seo_end($return = false, $img = true) {
		global $user, $config;
		if ($img) {
			$output = '<div style="padding-top:5px" align="middle"><a href="http://www.phpbb-seo.com/" title="' . ( strpos($config['default_lang'], 'fr') !== false  ?  'Optimisation du R&eacute;f&eacute;rencement' : 'Search Engine Optimization') . '"><img src="' . $this->seo_path['phpbb_url'] . 'images/phpbb-seo.png" alt="phpBB SEO"/></a></div>';
		} else {
			$output = '<div style="padding-top:5px" align="middle"><a href="http://www.phpbb-seo.com/" title="' . ( strpos($config['default_lang'], 'fr') !== false  ?  'Optimisation du R&eacute;f&eacute;rencement' : 'Search Engine Optimization') . '">phpBB SEO</a></div>';
		}
		if ($return) {
			return $output;
		} else {
			$user->lang['TRANSLATION_INFO'] .= $output;
		}
		return;
	}
	// -> Cache functions
	/**
	* forum_id() will tell the start param by the uri and the ID from the cache.
	*/
	function get_forum_id(&$forum_id, &$start) {
		$path = str_replace($this->seo_path['phpbb_script'], '', $this->seo_path['current_path']);
		if (preg_match('`^[a-z0-9_-]+/(' . $this->seo_static['pagination'] . '([0-9]+)\\' . $this->seo_ext['pagination'] . ')?$`i', $path, $matches)) {
			if (@$matches[2] > 0) {
				$start = intval($matches[2]);
			}
			$path = preg_replace('`^([a-z0-9_-]+)/?(' . $this->seo_static['pagination'] . '[0-9]+\\' . $this->seo_ext['pagination'] . ')?$`i', '\\1', $path);
		} elseif (preg_match('`^[a-z0-9_-]+' . $this->seo_delim['start'] . '([0-9]+)(\.[a-z0-9]+)?$`i', $path, $matches)) { // all other paginated cases with or without .ext
			if ($matches[1] > 0) {
				$start = intval($matches[1]);
			}
			$path = preg_replace('`^([a-z0-9_-]+)' . $this->seo_delim['start'] . '[0-9]+(\.[a-z0-9]+)?$`i', '\\1', $path);
		} else { // un-paginated left overs, required because $this->seo_delim['start'] can be an hyphen
			$path = preg_replace('`^([a-z0-9_-]+)(\.[a-z0-9]+)?$`i', '\\1', $path);
		}
		if ($id = @array_search($path, $this->cache_config['forum']) ) {
			$forum_id = intval($id);
		}
		return 0;
	}
	/**
	* check_cache() will tell if the required file exists.
	* @access private
	*/
	function check_cache( $type = 'forum', $from_bkp = FALSE ) {
		$file = SEO_CACHE_PATH . @$this->cache_config['files'][$type];
		if( !$this->cache_config['cache_enable'] || !array_key_exists($type, $this->cache_config['files']) || !file_exists($file) ) {
			$this->cache_config['cached'] = FALSE;
			return FALSE;
		}
		include($file);
		if (is_array($this->cache_config[$type]) ) {
			$this->cache_config['cached'] = TRUE;
			return TRUE;
		} else {
			if ( !$from_bkp ) {
				// Try the current backup
				@copy($file . '.current', $file);
				$this->check_cache( $type, true );
			}
			$this->cache_config['cached'] = FALSE;
			return FALSE;
		}
	}
	// --> Gen stats
	/**
	* Returns usable microtime
	* Borrowed from php.net 
	*/
	function microtime_float() {
		return array_sum(explode(' ',microtime()));
	}
	// --> Add on Functions <--
	// --> Zero Duplicate
	/**
	* Custom HTTP 301 redirections.
	* To kill duplicates
	*/
	function seo_redirect($url, $header = '301 Moved Permanently', $code = 301, $replace = TRUE) {
		global $db;
		if (!$this->seo_opt['zero_dupe']['on']) {
			return;
		}
		garbage_collection();
		$url = str_replace('&amp;', '&', $url);
		// Make sure no linebreaks are there... to prevent http response splitting for PHP < 4.4.2
		if (strpos(urldecode($url), "\n") !== false || strpos(urldecode($url), "\r") !== false || strpos($url, ';') !== false) {
			trigger_error('Tried to redirect to potentially insecure url.', E_USER_ERROR);
		}
		$http = 'HTTP/1.1 ';
		header($http . $header, $replace, $code);
		header('Location: ' . $url);
		exit();
	}
	/**
	 * Helps out grabbing boolean vars
	 *
	*/
	function seo_cond($bool = false, $and = true, $do = 'bool') {
		static $been_here = false;
		if ( !$been_here ) {
			$this->seo_opt['zero_dupe'][$do . '_redir'] = $bool;
			$been_here = true;
		} elseif ( $and ) {
			$this->seo_opt['zero_dupe'][$do . '_redir'] = ($bool && $this->seo_opt['zero_dupe'][$do . '_redir']);
		} else {
			$this->seo_opt['zero_dupe'][$do . '_redir'] = ($bool || $this->seo_opt['zero_dupe'][$do . '_redir']);
		}
		return;
	}
	/**
	* Set the do_redir_post option right
	*/
	function set_do_redir_post() {
		global $user;
		switch ($this->seo_opt['zero_dupe']['post_redir']) {
			case 'guest':
				if (  !$user->data['is_registered'] ) {
					$this->seo_opt['zero_dupe']['do_redir_post'] = TRUE;
				}
				break;
			case 'all':
				$this->seo_opt['zero_dupe']['do_redir_post'] = TRUE;
				break;
			case 'off': // Do not redirect
				$this->seo_opt['zero_dupe']['do_redir'] = FALSE;
				$this->seo_opt['zero_dupe']['bool_redir'] = FALSE;
				$this->seo_opt['zero_dupe']['do_redir_post'] = FALSE;
				break;
			default:
				$this->seo_opt['zero_dupe']['do_redir_post'] = FALSE;
				break;	
		}
		return $this->seo_opt['zero_dupe']['do_redir_post'];
	}
	/**
	* Returns false if the uri sent does not match (fully) the 
	* attended url
	*/
	function seo_chk_dupe($uri = '', $url = '') {
		if ($this->seo_opt['zero_dupe']['do_redir']) {
			$this->seo_redirect($this->page_url);
		}
		if ($this->seo_opt['zero_dupe']['strict']) {
			return $this->seo_opt['zero_dupe']['bool_redir'] && ( ($uri != $url) ? $this->seo_redirect($this->page_url) : false );
		} else {
			return $this->seo_opt['zero_dupe']['bool_redir'] && ( (utf8_strpos( $uri, $url ) === false  ) ? $this->seo_redirect($this->page_url) : false );
		}
	}
	/**
	* check start var consistency
	* and return our best guess for $start, eg the first valid page 
	* parameter according to pagination settings being lower
	* than the one sent.
	*/
	function seo_chk_start($start = 0, $limit = 0) {
		if ($limit > 0) {
			$start = ( is_int( $start/$limit ) ) ? intval($start) : intval($start/$limit)*$limit;
		}
		if ( $start > 0  ) {
			$this->start = $this->seo_delim['start'] . intval($start);
			return $start;
		}
		$this->start = '';
		return 0;
	}
	// <-- Zero Duplicate
} // End of the phpbb_seo class 
?>
