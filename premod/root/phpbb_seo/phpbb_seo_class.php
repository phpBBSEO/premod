<?php
/** 
*
* @package Advanced phpBB3 SEO mod Rewrite
* @version $Id: phpbb_seo_class.php dcz Exp $
* @copyright (c) 2006, 2007, 2008 dcz - www.phpbb-seo.com
* @license http://www.opensource.org/licenses/rpl.php RPL Public License 
*
*/
/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}
/**
* phpBB_SEO Class
* www.phpBB-SEO.com
* @package Advanced phpBB3 SEO mod Rewrite
*/
class phpbb_seo {
	var	$version = '0.6.0';
	var	$modrtype = 0;
	var	$seo_paths = array();
	var	$seo_url = array();
	var	$seo_censored = array();
	var	$seo_delim = array();
	var	$seo_ext = array();
	var	$seo_static = array();
	var	$seo_url_filter = array();
	var	$get_vars = array();
	var	$path = '';
	var	$start = '';
	var	$filename = '';
	var	$file = '';
	var	$url_in = '';
	var	$url = '';
	var	$page_url = '';
	var	$seo_opt = array();
	var	$rewrite_method = array();
	var	$paginate_method = array();
	var	$seo_cache = array();
	var	$cache_config = array();
	var	$seo_stop_files = array();
	var	$seo_stop_vars = array();
	var	$seo_stop_dirs = array();
	var	$RegEx = array();
	var	$sftpl = array();

	/**
	* constuctor
	*/
	function phpbb_seo() {
		global $phpEx, $config, $phpbb_root_path;
		// config
		$this->modrtype =  3; // 3 = Advanced
		$this->seo_cache = array();
		$this->cache_config = array();
		$this->seo_censored = array();
		$this->start = $this->path = '';
		// URL Settings
		// The arrays where the preformated titles are stored.
		$this->seo_url = array( 'forum' =>  array(), 'topic' =>  array(), 'user' => array(), 'username' => array(), 'group' => array(), 'file' => array() );
		// URL Filters
		$this->phpbb_filter = array( 'forum' => array('st' => 0, 'sk' => 't', 'sd' => 'd'),
			'topic' => array('st' => 0, 'sk' => 't', 'sd' => 'a', 'hilit' => ''),
			'search' => array('st' => 0, 'sk' => 't', 'sd' => 'd', 'ch' => ''),
		);
		// Stop files
		$this->seo_stop_files = array('posting' => 1, 'faq' => 1, 'ucp' => 1, 'swatch' => 1, 'mcp' => 1);
		// Stop vars
		$this->seo_stop_vars = array('view=', 'mark=', 'watch=', 'hash=');
		// Stop dirs
		$this->seo_stop_dirs = array($phpbb_root_path . 'adm/' => false,);
		// reset GET var array
		$this->get_vars = array();
		// Delimiters : used as separators in the .htaccess RegEx
		// can be edited, requires .htaccess update.
		$this->seo_delim = array( 'forum' => '-f', 'topic' => '-t', 'user' => '-u', 'group' => '-g', 'start' => '-', 'sr' => '-', 'file' => '/');
		// Default : Used in URL when format_url would return nothing or with simple URLs
		// can be edited, requires .htaccess update.
		$this->seo_static = array( 'forum' => 'forum', 'topic' => 'topic', 'post' => 'post', 'user' => 'member', 'group' => 'group', 'index' => '', 'global_announce' => 'announces', 'leaders' => 'the-team', 'atopic' => 'active-topics', 'utopic' => 'unanswered', 'npost' => 'newposts', 'pagination' => 'page', 'gz_ext' => '.gz' );
		// phpBB files must be treated a bit differently
		$this->seo_static['file'] = array(ATTACHMENT_CATEGORY_NONE => 'file', ATTACHMENT_CATEGORY_IMAGE => 'image', ATTACHMENT_CATEGORY_WM => 'wm', ATTACHMENT_CATEGORY_RM => 'rm',  ATTACHMENT_CATEGORY_THUMB => 'image', ATTACHMENT_CATEGORY_FLASH => 'flash', ATTACHMENT_CATEGORY_QUICKTIME => 'qt');
		$this->seo_static['file_index'] = 'resources';
		$this->seo_static['thumb'] = 'thumb';
		// URL suffixes, for the phpBB URLs
		// can be edited, requires .htaccess update.
		$this->seo_ext = array( 'forum' => '.html', 'topic' => '.html', 'post' => '.html', 'user' => '.html', 'group' => '.html',  'index' => '', 'global_announce' => '/', 'leaders' => '.html', 'atopic' => '.html', 'utopic' => '.html', 'npost' => '.html', 'pagination' => '.html', 'gz_ext' => '');
		// These options can be set and bypassed from the phpBB SEO settings page
		// You can safely mod the default values here.
		$this->seo_opt = array( 'url_rewrite' => false,
			'modrtype' => intval($this->modrtype),
			'sql_rewrite' => false,
			'profile_inj' => false,
			'profile_vfolder' => false,
			'profile_noids' => false,
			'rewrite_usermsg' => false,
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
		// copyright notice, do not change
		$this->cache_config['dynamic_options']['copyrights'] = $this->seo_opt['copyrights'] = array('img' => true,
			'txt' => '',
			'title' => '',
		);
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
		$this->seo_opt['zero_dupe']['go_redir'] = true; // do not change
		$this->seo_opt['zero_dupe']['do_redir_post'] = false; // do not change
		$this->seo_opt['zero_dupe']['start'] = 0; // do not change
		$this->seo_opt['zero_dupe']['redir_def'] = array(); // do not change
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
					$this->seo_opt[$optionname] = array_merge($this->seo_opt[$optionname], $this->cache_config['settings'][$optionname]);
				} elseif ( @isset($this->cache_config['settings'][$optionvalue]) ) {
					$this->seo_opt[$optionvalue] = $this->cache_config['settings'][$optionvalue];
				}
			}
			$this->modrtype = @isset($this->seo_opt['modrtype']) ? $this->seo_opt['modrtype'] : $this->modrtype;
			if ( $this->modrtype > 1 ) { // Load cached URLs	
				$this->seo_url['forum'] = $this->cache_config['forum'];
			}
		}
		// Special for lazy French
		if ( strpos($config['default_lang'], 'fr') !== false ) {
			// Vous pouvez modifier ces valeurs pour peu que vous modifiez le .htaccess en conséquence
			$this->seo_static['user'] = 'membre';
			$this->seo_static['group'] = 'groupe';
			$this->seo_static['global_announce'] = 'annonces';
			$this->seo_static['leaders'] = 'equipe';
			$this->seo_static['atopic'] = 'sujets-actifs';
			$this->seo_static['utopic'] = 'sans-reponses';
			$this->seo_static['npost'] = 'nouveaux-messages';
			$this->seo_static['file_index'] = 'ressources';
		}
		// Some more config
		// For profiles and user messages pages, if we do not inject, we do not get rid of ids
		$this->seo_opt['profile_noids'] = $this->seo_opt['profile_inj'] ? $this->seo_opt['profile_noids'] : false;
		// If profile noids ...
		if ($this->seo_opt['profile_noids']) {
			$this->seo_ext['user'] = '/';
		}
		// Profile ans user messages virtual folder
		if ($this->seo_opt['profile_vfolder']) {
			$this->seo_ext['user'] = '/';
		}
		$this->seo_delim['sr'] = $this->seo_ext['user'] == '/' ? '/' : $this->seo_delim['sr'];
		// If we use virtual folder, we need '/' at the end of the forum URLs
		if ($this->seo_opt['virtual_folder']) {
			$this->seo_ext['forum'] = $this->seo_ext['global_announce'] = '/';
		}
		// If the forum cache is not activated
		if (!$this->seo_opt['cache_layer']) {
			$this->seo_opt['rem_ids'] = false;
		}
		// In case url rewriting is deactivated
		if (!$this->seo_opt['url_rewrite']) {
			$phpbb_seo->seo_opt['sql_rewrite'] = false;
			$this->seo_opt['zero_dupe']['on'] = false;
		}
		$this->seo_opt['topic_per_page'] = ($config['posts_per_page'] <= 0) ? 1 : $config['posts_per_page']; // do not change
		// Rewrite functions array : array( 'path' => array('file_name' => 'function_name'));
		// Warning, this way of doing things is path aware, this implies path to be properly sent to append_sid()
		// Allow to add options without slowing down the URL rewriting process
		$this->rewrite_method[$phpbb_root_path] = array(
			'viewtopic' => 'viewtopic_uadv',
			'viewforum' => 'viewforum_adv',
			'index' => 'index',
			'memberlist' => $this->seo_opt['profile_inj'] ? 'memberlist_adv' : 'memberlist_smpl',
			'search' => $this->seo_opt['rewrite_usermsg'] ? ($this->seo_opt['profile_inj'] ? 'search_adv' : 'search_smpl') : '',
		);
		$this->rewrite_method[$phpbb_root_path . 'download/']['file'] = 'phpbb_files';
		$this->paginate_method = array( 
			// Now the pagination /pagexx.html vs -xx.html
			'topic' => $this->seo_ext['topic'] === '/' ? 'rewrite_pagination_page' : 'rewrite_pagination',
			'forum' => $this->seo_ext['forum'] === '/' ? 'rewrite_pagination_page' : 'rewrite_pagination',
			'group' => $this->seo_ext['group'] === '/' ? 'rewrite_pagination_page' : 'rewrite_pagination',
			'user' => $this->seo_ext['user'] === '/' ? 'rewrite_pagination_page' : 'rewrite_pagination',
			'atopic' => $this->seo_ext['atopic'] === '/' ? 'rewrite_pagination_page' : 'rewrite_pagination',
			'utopic' => $this->seo_ext['utopic'] === '/' ? 'rewrite_pagination_page' : 'rewrite_pagination',
			'npost' => $this->seo_ext['npost'] === '/' ? 'rewrite_pagination_page' : 'rewrite_pagination',
		);
		$this->RegEx = array(
			'topic' => array(
				'check' => '`^' . ($this->seo_opt['virtual_folder'] ? '%1$s/' : '') . '(' . $this->seo_static['topic'] . '|[a-z0-9_-]+' . $this->seo_delim['topic'] . ')$`i',
				//'match' => '`^((([a-z0-9_-]+)(' . $this->seo_delim['forum'] . '([0-9]+))?/)?(' . $this->seo_static['topic'] . '|.+))(' . $this->seo_delim['topic'] . ')([0-9]+)$`i',
				//'match' => '`^((([a-z0-9_-]+)(' . $this->seo_delim['forum'] . '([0-9]+))?/)?(?(?=' . $this->seo_static['topic'] . ')' . $this->seo_static['topic'] . '|.+' . $this->seo_delim['topic'] . '))([0-9]+)$`i',
				//'match' => '`^((([a-z0-9_-]+)(' . $this->seo_delim['forum'] . '([0-9]+))?/)?(' . $this->seo_static['topic'] . '(?!=' . $this->seo_delim['topic'] . '[0-9]+)|.+(?=' . $this->seo_delim['topic'] . '[0-9]+)))(' . $this->seo_delim['topic'] . ')?([0-9]+)$`i',
				'match' => '`^((([a-z0-9_-]+)(' . $this->seo_delim['forum'] . '([0-9]+))?/)?(' . $this->seo_static['topic'] . '(?!=' . $this->seo_delim['topic'] . ')|.+(?=' . $this->seo_delim['topic'] . '))(' . $this->seo_delim['topic'] . ')?)([0-9]+)$`i',
				'parent' => 2,
				'parent_id' => 5,
				'title' => 6,
				'id' => 8,
				'url' => 1,

			),
			'forum' => array(
				'check' => $this->modrtype >= 2 ? '`^[a-z0-9_-]+(' . $this->seo_delim['forum'] . '[0-9]+)?$`i' : '`^' . $this->seo_static['forum'] . '[0-9]+$`i',
				'match' => '`^((' . $this->seo_static['forum'] . '|.+)(' . $this->seo_delim['forum'] . '([0-9]+))?)$`i',
				'title' => '\2',
				'id' => '\4',
			),
		);
		// preg_replace() pattern for format_url()
		$this->RegEx['url_find'] = array('`&([a-z]+)(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '`&(amp;|#)?[a-z0-9]+;`i', '`[^a-z0-9]`i'); // Do not remove : deaccentuation, html/xml entities & non a-z chars
		$this->RegEx['url_replace'] = array('\1', '-', '-');
		if ($this->seo_opt['rem_small_words']) {
			$this->RegEx['url_find'][] = '`(^|-)[a-z0-9]{1,2}(?=-|$)`i';
			$this->RegEx['url_replace'][] = '-';
		}
		$this->RegEx['url_find'][] ='`[-]+`'; // Do not remove : multi hyphen reduction
		$this->RegEx['url_replace'][] = '-';
		// $1 parent : string/
		// $2 title / url : topic-title / forum-url-fxx
		// $3 id
		$this->sftpl = array(
			'topic' => ($this->seo_opt['virtual_folder'] ? '%1$s/' : '') . '%2$s' . $this->seo_delim['topic'] . '%3$s',
			'topic_smpl' => ($this->seo_opt['virtual_folder'] ? '%1$s/' : '') . $this->seo_static['topic'] . '%3$s',
			'forum' => $this->modrtype >= 2 ? '%2$s' : $this->seo_static['forum'] . '%3$s',
		);
		// --> DOMAIN SETTING <-- //
		// Path Settings, only rely on DB
		$server_protocol = ($config['server_protocol']) ? $config['server_protocol'] : (($config['cookie_secure']) ? 'https://' : 'http://');
		$server_name = trim($config['server_name'], '/') . '/';
		$server_port = (int) $config['server_port'];
		$server_port = ($server_port <> 80) ? ':' . $server_port : '';
		$script_path = trim($config['script_path'], '/');
		$script_path = (empty($script_path) ) ? '' : $script_path . '/';
		$this->seo_path['root_url'] =  $server_protocol . $server_name . $server_port;
		$this->seo_path['phpbb_urlR'] = $this->seo_path['phpbb_url'] =  $this->seo_path['root_url'] . $script_path;
		$this->seo_path['phpbb_script'] =  $script_path;
		$this->seo_path['phpbb_filesR'] = $this->seo_path['phpbb_url'] . $this->seo_static['file_index'] . $this->seo_delim['file'];
		$this->seo_path['phpbb_files'] = $this->seo_path['phpbb_url'] . 'download/';
		// Array of the filenames that may require the use of a base href tag.
		$this->seo_opt['file_hbase'] = array('viewtopic' => $this->seo_path['phpbb_url'], 'viewforum' => $this->seo_path['phpbb_url'], 'memberlist' => $this->seo_path['phpbb_url'], 'search' => $this->seo_path['phpbb_url']);
		// virtual root option
		if ($this->seo_opt['virtual_root']) {
			$this->seo_path['phpbb_urlR'] = $this->seo_path['root_url'];
			$this->seo_opt['file_hbase']['index'] = $this->seo_path['phpbb_url'];
			$this->seo_static['index'] = empty($this->seo_static['index']) ? 'forum' : $this->seo_static['index'];
		}
		$this->seo_ext['index'] = empty($this->seo_static['index']) ? '' : ( empty($this->seo_ext['index']) ? '.html' : $this->seo_ext['index']);
		// File setting
		$this->seo_req_uri();
		$this->seo_opt['seo_base_href'] = $this->seo_opt['req_file'] = $this->seo_opt['req_self'] = '';
		if ($script_name = (!empty($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : getenv('PHP_SELF')) {
			// From sessions.php
			// Replace backslashes and doubled slashes (could happen on some proxy setups)
			$this->seo_opt['req_self'] = str_replace(array('\\', '//'), '/', $script_name);
			// basenamed page name (for example: index)
			$this->seo_opt['req_file'] = urlencode(htmlspecialchars(str_replace('.' . $phpEx, '', basename($this->seo_opt['req_self']))));
		}
		if ( $this->seo_opt['url_rewrite'] && !defined('ADMIN_START') && isset($this->seo_opt['file_hbase'][$this->seo_opt['req_file']])) {	
			$this->seo_opt['seo_base_href'] = '<base href="' . $this->seo_opt['file_hbase'][$this->seo_opt['req_file']] . '"/>';
		}
		return;
	}
	// --> URL rewriting functions <--
	/**
	* format_url( $url, $type = 'topic' )
	* Prepare Titles for URL injection
	*/
	function format_url( $url, $type = 'topic' ) {
		$url = preg_replace('`\[.*\]`U','',$url);
		$url = htmlentities($url, ENT_COMPAT, 'utf-8');
		$url = preg_replace( $this->RegEx['url_find'] , $this->RegEx['url_replace'], $url);
		$url = strtolower(trim($url, '-'));
		return empty($url) ? $type : $url;
	}
	/**
	* set_url( $url, $id = 0, $type = 'forum' )
	* Prepare url first part and checks cache
	*/
	function set_url( $url, $id = 0, $type = 'forum',  $parent = '') {
		if ( empty($this->seo_url[$type][$id]) ) {
			return ( $this->seo_url[$type][$id] = !empty($this->cache_config[$type][$id]) ? $this->cache_config[$type][$id] : sprintf($this->sftpl[$type], $parent, $this->format_url($url, $this->seo_static[$type]) . $this->seo_delim[$type] . $id, $id) );
		}
		return $this->seo_url[$type][$id];
	}
	/**
	* prepare_url( $type, $title, $id, $parent = '', $smpl = false )
	* Prepare url first part
	*/
	function prepare_url( $type, $title, $id, $parent = '', $smpl = false ) {
		return empty($this->seo_url[$type][$id]) ? ($this->seo_url[$type][$id] = sprintf($this->sftpl[$type . ($smpl ? '_smpl' : '')], $parent, !$smpl ? $this->format_url($title, $this->seo_static[$type]) : '', $id)) : $this->seo_url[$type][$id];
	}
	/**
	* set_title( $type, $title, $id, $parent = '' )
	* Set title for url injection
	*/
	function set_title( $type, $title, $id, $parent = '' ) {
		return empty($this->seo_url[$type][$id]) ? ($this->seo_url[$type][$id] = ($parent ? $parent . '/' : '') . $this->format_url($title, $this->seo_static[$type])) : $this->seo_url[$type][$id];
	}
	/**
	* get_url_info($type, $url, $info = 'title')
	* Get info from url (title, id, parent etc ...)
	*/
	function get_url_info($type, $url, $info = 'title') {
		$url = trim($url, '/ ');
		if (preg_match($this->RegEx[$type]['match'], $url, $matches)) {
			return !empty($matches[$this->RegEx[$type][$info]]) ? $matches[$this->RegEx[$type][$info]] : '';
		}
		return '';
	}
	/**
	* check_url( $type, $url, $parent = '')
	* Validate a prepared url
	*/
	function check_url( $type, $url, $parent = '') {
		if (empty($url)) {
			return false;
		}
		$parent = !empty($parent) ? (string) $parent : '[a-z0-9/_-]+';
		return !empty($this->RegEx[$type]['check']) ? preg_match(sprintf($this->RegEx[$type]['check'], $parent), $url) : false;
	}
	/**
	* prepare_iurl( $data, $type, $parent = '' )
	* Prepare url first part (not for forums) with SQL based URL rewriting
	*/
	function prepare_iurl( $data, $type, $parent = '' ) {
		$id = max(0, (int) $data[$type . '_id']);
		if ( empty($this->seo_url[$type][$id]) ) {
			if (!empty($data[$type . '_url'])) {
				return ($this->seo_url[$type][$id] = $data[$type . '_url'] . $id);
			} else {
				return ($this->seo_url[$type][$id] = sprintf($this->sftpl[$type . ($this->modrtype > 2 ? '' : '_smpl')], $parent, $this->modrtype > 2 ? $this->format_url($data[$type . '_title'], $this->seo_static[$type]) : '', $id));
			}
		}
		return $this->seo_url[$type][$id];
	}
	/**
	* drop_sid( $url )
	* drop the sid's in url
	*/
	function drop_sid( $url ) {
		return (strpos($url, 'sid=') !== false) ? trim(preg_replace(array('`&(amp;)?sid=[a-z0-9]*(&amp;|&)?`', '`(\?)sid=[a-z0-9]*`'), array('\2', '\1'), $url), '?') : $url;
	}
	/**
	* set_user_url( $username, $user_id = 0 )
	* Prepare profile url
	*/
	function set_user_url( $username, $user_id = 0 ) {
		if (empty($this->seo_url['user'][$user_id])) {
			$this->seo_url['username'][$username] = $user_id;
			if ( $this->seo_opt['profile_inj'] ) {
				if ( $this->seo_opt['profile_noids'] ) {
					$this->seo_url['user'][$user_id] = $this->seo_static['user'] . '/' . $this->seo_url_encode($username);
				} else {
					$this->seo_url['user'][$user_id] = $this->format_url($username,  $this->seo_delim['user']) . $this->seo_delim['user'] . $user_id;
				}
			}
		}
	}
	/**
	* seo_url_encode( $url )
	* custom urlencoding
	*/
	function seo_url_encode( $url ) {
		// can be faster to return $url directly if you do not allow more chars than 
		// [a-zA-Z0-9_\.-] in your usernames
		// return $url;
		// Here we hanlde the "&", "/", "+" and "#" case proper ( http://www.php.net/urlencode => http://issues.apache.org/bugzilla/show_bug.cgi?id=34602 )
		static $find = array('&', '/', '#', '+');
		static $replace = array('%26', '%2F', '%23', '%2b');
		return rawurlencode(str_replace( $find, $replace, utf8_normalize_nfc(htmlspecialchars_decode(str_replace('&amp;amp;', '%26', rawurldecode($url))))));
	}
	/**
	* url_rewrite($url, $params = false, $is_amp = true, $session_id = false)
	* builds and Rewrite URLs.
	* Allow adding of many more cases than just the
	* regular phpBB URL rewritting without slowing down the process.
	* Mimics append_sid with some shortcuts related to how url are rewritten
	*/
	function url_rewrite($url, $params = false, $is_amp = true, $session_id = false) {
		global $phpEx, $user, $_SID, $_EXTRA_URL, $phpbb_root_path;
		$qs = $anchor = '';
		$this->get_vars = array();
		$amp_delim = ($is_amp) ? '&amp;' : '&';
		if (strpos($url, '#') !== false) {
			list($url, $anchor) = explode('#', $url, 2);
			$anchor = '#' . $anchor;
		}
		@list($this->path, $qs) = explode('?', $url, 2);
		if (is_array($params)) {
			if (!empty($params['#'])) {
				$anchor = '#' . $params['#'];
				unset($params['#']);
			}
			$qs .= ($qs ? $amp_delim : '') . $this->query_string($params, $amp_delim, '');
		} elseif ($params) {
			if (strpos($params, '#') !== false) {
				list($params, $anchor) = explode('#', $params, 2);
				$anchor = '#' . $anchor;
			}
			$qs .= ($qs ? $amp_delim : '') . $params;
		}
		// Appending custom url parameter?
		if (!empty($_EXTRA_URL)) {
			$qs .= ($qs ? $amp_delim : '') . implode($amp_delim, $_EXTRA_URL);
		}
		// Sid ?
		if ($session_id) {
			$qs .= ($qs ? $amp_delim : '') . "sid=$session_id";
		} elseif (!empty($_SID)) {
			$qs .= ($qs ? $amp_delim : '') . "sid=$_SID";
		}
		// Build vanilla URL
		if (preg_match("`\.[a-z0-9]+$`i", $this->path) ) {
			$this->file = basename($this->path);
			$this->path = ltrim(str_replace($this->file, '', $this->path), '/');
		} else {
			$this->file = '';
			$this->path = ltrim($this->path, '/');
		}
		$this->url_in = $this->file . ($qs ? '?' . $qs : '');
		$url = $this->path . $this->url_in . $anchor;
		if (isset($this->seo_cache[$url])) {
			return $this->seo_cache[$url];
		}
		if ( !$this->seo_opt['url_rewrite'] || defined('ADMIN_START') || isset($this->seo_stop_dirs[$this->path]) ) {
			return ($this->seo_cache[$url] = $url);
		}	
		$this->filename = trim(str_replace(".$phpEx", '', $this->file));
		if ( isset($this->seo_stop_files[$this->filename]) ) {
			return ($this->seo_cache[$url] = $url);
		}
		// parse_str is here bypassed because it uses magic quotes 
		// parse_str(str_replace('&amp;', '&', $qs), $this->get_vars);
		// Won't deal with arrays, same as append_sid
		$pairs = explode('&', str_replace('&amp;', '&', $qs));
		foreach($pairs as $pair) {
			@list($name, $value) = explode('=', $pair, 2);
			if ($value !== null) {
				$this->get_vars[$name] = urldecode($value);
			}
		}
		if (empty($user->data['is_registered'])) {
			if ( $this->seo_opt['rem_sid'] ) {
				unset($this->get_vars['sid']);
			}
			if ( $this->seo_opt['rem_hilit'] ) {
				unset($this->get_vars['hilit']);
			}
		}
		$this->url = $this->file;
		if ( !empty($this->rewrite_method[$this->path][$this->filename]) ) {
			$this->{$this->rewrite_method[$this->path][$this->filename]}();
			return ($this->seo_cache[$url] = $this->path . $this->url . $this->query_string($this->get_vars, $amp_delim, '?') . $anchor);
		} else {
			return ($this->seo_cache[$url] = $url);
		}
	}
	/**
	* URL rewritting for viewtopic.php
	* With Virtual Folder Injection
	* @access private
	*/
	function viewtopic_uadv() {
		global $phpbb_root_path;
		$this->filter_url($this->seo_stop_vars);
		$this->path = $this->seo_path['phpbb_urlR'];
		if ( !empty($this->get_vars['p']) ) {
			$this->url = $this->seo_static['post'] . $this->get_vars['p'] . $this->seo_ext['post'];
			unset($this->get_vars['p'], $this->get_vars['f'], $this->get_vars['t'], $this->get_vars['start']);
			return;
		}
		if ( isset($this->get_vars['t']) && !empty($this->seo_url['topic'][$this->get_vars['t']]) ) {
			// Filter default params
			$this->filter_get_var($this->phpbb_filter['topic']);
			$this->{$this->paginate_method['topic']}($this->seo_ext['topic']);
			$this->url = $this->seo_url['topic'][$this->get_vars['t']] . $this->start;
			unset($this->get_vars['t'], $this->get_vars['f'], $this->get_vars['p']);
			return;
		} else if (!empty($this->get_vars['t'])) {
			// Filter default params
			$this->filter_get_var($this->phpbb_filter['topic']);
			$this->{$this->paginate_method['topic']}($this->seo_ext['topic']);
			$this->url = $this->seo_static['topic'] . $this->get_vars['t'] . $this->start;
			unset($this->get_vars['t'], $this->get_vars['f'], $this->get_vars['p']);
			return;
		}
		$this->path = $this->seo_path['phpbb_url'];
		return;
	}
	/**
	* URL rewritting for viewforum.php
	* @access private
	*/
	function viewforum_adv() {
		global $phpbb_root_path;
		$this->path = $this->seo_path['phpbb_urlR'];
		$this->filter_url($this->seo_stop_vars);
		if ( isset($this->get_vars['f']) && !empty($this->seo_url['forum'][$this->get_vars['f']]) ) {
			// Filter default params
			$this->filter_get_var($this->phpbb_filter['forum']);
			$this->{$this->paginate_method['forum']}($this->seo_ext['forum']);
			$this->url = $this->seo_url['forum'][$this->get_vars['f']] . $this->start;
			unset($this->get_vars['f']);
			return;
		} else if (!empty($this->get_vars['f'])) {
			// Filter default params
			$this->filter_get_var($this->phpbb_filter['forum']);
			$this->{$this->paginate_method['forum']}($this->seo_ext['forum']);
			$this->url = $this->seo_static['forum'] . $this->get_vars['f'] . $this->start;
			unset($this->get_vars['f']);
			return;
		}
		$this->path = $this->seo_path['phpbb_url'];
		return;
	}
	/**
	* URL rewritting for memberlist.php
	* with nicknames and group name injection
	* @access private
	*/
	function memberlist_adv() {
		global $phpbb_root_path;
		$this->path = $this->seo_path['phpbb_urlR'];
		if ( @$this->get_vars['mode'] === 'viewprofile' && !@empty($this->seo_url['user'][$this->get_vars['u']]) ) {
			$this->url = $this->seo_url['user'][$this->get_vars['u']] . $this->seo_ext['user'];
			unset($this->get_vars['mode'], $this->get_vars['u']);
			return;
		} elseif ( @$this->get_vars['mode'] === 'group' && !@empty($this->seo_url['group'][$this->get_vars['g']]) ) {
			$this->{$this->paginate_method['group']}($this->seo_ext['group']);
			$this->url =  $this->seo_url['group'][$this->get_vars['g']] . $this->seo_delim['group'] . $this->get_vars['g'] . $this->start;
			unset($this->get_vars['mode'], $this->get_vars['g']);
			return;
		} elseif (@$this->get_vars['mode'] === 'leaders') {
			$this->url =  $this->seo_static['leaders'] . $this->seo_ext['leaders'];
			unset($this->get_vars['mode']);
			return;
		}
		$this->path = $this->seo_path['phpbb_url'];
		return;
	}
	/**
	* URL rewritting for search.php
	* @access private
	*/
	function search_adv() {
		global $phpbb_root_path;
		$this->path = $this->seo_path['phpbb_urlR'];
		$user_id = !empty($this->get_vars['author_id']) ? $this->get_vars['author_id'] : ( isset($this->seo_url['username'][rawurldecode(@$this->get_vars['author'])]) ? $this->seo_url['username'][rawurldecode($this->get_vars['author'])] : 0);
		if ( $user_id && isset($this->seo_url['user'][$user_id]) ) {
			// Filter default params
			$this->filter_get_var($this->phpbb_filter['search']);
			$this->{$this->paginate_method['user']}($this->seo_ext['user']);
			$sr = (@$this->get_vars['sr'] == 'topics' ) ? 'topics' : 'posts';
			$this->url = $this->seo_url['user'][$user_id] . $this->seo_delim['sr'] . $sr . $this->start;
			unset($this->get_vars['author_id'], $this->get_vars['author'], $this->get_vars['sr']);
			return;
		} elseif ( $this->seo_opt['profile_noids'] && !empty($this->get_vars['author']) ) {
			// Filter default params
			$this->filter_get_var($this->phpbb_filter['search']);
			$this->rewrite_pagination_page();
			$sr = (@$this->get_vars['sr'] == 'topics' ) ? '/topics' : '/posts';
			$this->url = $this->seo_static['user'] . '/' . $this->seo_url_encode($this->get_vars['author']) . $sr . $this->start;
			unset($this->get_vars['author'], $this->get_vars['author_id'], $this->get_vars['sr']);
			return;
		} elseif (!empty($this->get_vars['search_id'])) {
			switch ($this->get_vars['search_id']) {
				case 'active_topics':
					$this->filter_get_var($this->phpbb_filter['search']);
					$this->{$this->paginate_method['atopic']}($this->seo_ext['atopic']);
					$this->url = $this->seo_static['atopic'] . $this->start;
					unset($this->get_vars['search_id'], $this->get_vars['sr']);
					if (@$this->get_vars['st'] == 7) {
						unset($this->get_vars['st']);
					}
					return;
				case 'unanswered':
					$this->filter_get_var($this->phpbb_filter['search']);
					$this->{$this->paginate_method['utopic']}($this->seo_ext['utopic']);
					$this->url = $this->seo_static['utopic'] . $this->start;
					unset($this->get_vars['search_id']);
					if (@$this->get_vars['sr'] == 'topics') {
						unset($this->get_vars['sr']);
					}
					return;
				case 'egosearch':
					global $user;
					$this->set_user_url($user->data['username'], $user->data['user_id']);
					$this->url = $this->seo_url['user'][$user->data['user_id']] . $this->seo_delim['sr'] . 'topics' . $this->seo_ext['user'];
					unset($this->get_vars['search_id']);
					return;
				case 'newposts':
					$this->filter_get_var($this->phpbb_filter['search']);
					$this->{$this->paginate_method['npost']}($this->seo_ext['npost']);
					$this->url = $this->seo_static['npost'] . $this->start;
					unset($this->get_vars['search_id']);
					if (@$this->get_vars['sr'] == 'topics') {
						unset($this->get_vars['sr']);
					}
					return;
			}
		}
		$this->path = $this->seo_path['phpbb_url'];
		return;
	}
	/**
	* URL rewritting for download/file.php
	* @access private
	*/
	function phpbb_files() {
		$this->filter_url($this->seo_stop_vars);
		$this->path = $this->seo_path['phpbb_filesR'];
		if (isset($this->get_vars['id']) && !empty($this->seo_url['file'][$this->get_vars['id']])) {
			$this->url = $this->seo_url['file'][$this->get_vars['id']];
			if (!empty($this->get_vars['t'])) {
				$this->url .= $this->seo_delim['file'] . $this->seo_static['thumb'];
			} /*else if (@$this->get_vars['mode'] == 'view') {
				$this->url .= $this->seo_delim['file'] . 'view';
			}*/
			$this->url .= $this->seo_delim['file'] . $this->get_vars['id'];
			unset($this->get_vars['id'], $this->get_vars['t'], $this->get_vars['mode']);
			return;
		}
		$this->path = $this->seo_path['phpbb_files'];
		return;
	} 
	/**
	* URL rewritting for index.php
	* @access private
	*/
	function index() {
		$this->path = $this->seo_path['phpbb_urlR'];
		if ($this->filter_url($this->seo_stop_vars)) {
			$this->url = $this->seo_static['index'] . $this->seo_ext['index'];
			return;
		}
		$this->path = $this->seo_path['phpbb_url'];
		return;
	}
	/**
	* Will break if a $filter pattern is foundin $url.
	* Example $filter = array("view=", "mark=");
	* @access private
	*/
	function filter_url($filter = array()) {
		foreach ($filter as $patern ) {
			if ( strpos($this->url_in, $patern) !== false ) {
				$this->get_vars = array();
				$this->url = $this->url_in;
				return false;
			}
		}
		return true;
	}
	/**
	* Will unset all default var stored in $filter array.
	* Example $filter = array('st' => 0, 'sk' => 't', 'sd' => 'a', 'hilit' => '');
	* @access private
	*/
	function filter_get_var($filter = array()) {
		if ( !empty($this->get_vars) ) {
			foreach ($this->get_vars as $paramkey => $paramval) {
				if ( isset($filter[$paramkey]) ) {
					if ( $filter[$paramkey] ==  $this->get_vars[$paramkey] || !isset($this->get_vars[$paramkey])) {
						unset($this->get_vars[$paramkey]);
					}
				}
			}	
		}
		return;
	}
	/**
	* Appends the GET vars in the query string
	* @access public
	*/
	function query_string($get_vars = array(), $amp_delim = '&amp;', $url_delim = '?') {
		if(empty($get_vars)) {
			return '';
		}
		$params = array();
		foreach($get_vars as $key => $value) {
			if ($value !== null) {
				$params[$key] = $key . '=' . $value;
			}
		}
		return $url_delim . implode($amp_delim , $params);
	}
	/**
	* rewrite pagination, simple
	* -xx.html
	*/
	function rewrite_pagination($suffix) {
		$this->start = $this->seo_start( @$this->get_vars['start'] ) . $suffix;
		unset($this->get_vars['start']);
	}
	/**
	* rewrite pagination, virtual folder
	* /pagexx.html
	*/
	function rewrite_pagination_page() {
		$this->start = '/' . $this->seo_start_page( @$this->get_vars['start'] );
		unset($this->get_vars['start']);
	}
	/**
	* Returns usable start param
	* -xx
	*/
	function seo_start($start) {
		return ($start >= 1 ) ? $this->seo_delim['start'] . (int) $start : '';
	}
	/**
	* Returns usable start param
	* pagexx.html
	* Only used in virtual folder mode
	*/
	function seo_start_page($start) {
		return ($start >=1 ) ? $this->seo_static['pagination'] . (int) $start . $this->seo_ext['pagination'] : '';
	}
	/**
	* Returns the full REQUEST_URI
	*/
	function seo_req_uri() {
		if ( !empty($_SERVER['HTTP_X_REWRITE_URL']) ) { // IIS  isapi_rewrite
			$this->seo_path['uri'] = ltrim($_SERVER['HTTP_X_REWRITE_URL'], '/');
		} elseif ( !empty($_SERVER['REQUEST_URI']) ) { // Apache mod_rewrite
			$this->seo_path['uri'] = ltrim($_SERVER['REQUEST_URI'], '/');
		} else { // no mod rewrite
			$this->seo_path['uri'] =  ltrim($_SERVER['SCRIPT_NAME'], '/') . ( ( !empty($_SERVER['QUERY_STRING']) ) ? '?'.$_SERVER['QUERY_STRING'] : '' );
		}
		$this->seo_path['uri'] = str_replace( '%26', '&', rawurldecode($this->seo_path['uri']));
		// workaround for FF default iso encoding
		if (!$this->is_utf8($this->seo_path['uri'])) {
			$this->seo_path['uri'] = utf8_normalize_nfc(utf8_recode($this->seo_path['uri'], 'iso-8859-1'));
		}
		$this->seo_path['uri'] = $this->seo_path['root_url'] . $this->seo_path['uri'];
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
	function seo_end($return = false) {
		global $user, $config;
		if (empty($this->seo_opt['copyrights']['title'])) {
			$this->seo_opt['copyrights']['title'] = strpos($config['default_lang'], 'fr') !== false  ?  'Optimisation du R&eacute;f&eacute;rencement' : 'Search Engine Optimization';
		}
		if (empty($this->seo_opt['copyrights']['txt'])) {
			$this->seo_opt['copyrights']['txt'] = 'phpBB SEO';
		}
		if ($this->seo_opt['copyrights']['img']) {
			$output = '<br /><a href="http://www.phpbb-seo.com/" title="' . $this->seo_opt['copyrights']['title'] . '"><img src="' . $this->seo_path['phpbb_url'] . 'images/phpbb-seo.png" alt="' . $this->seo_opt['copyrights']['txt'] . '"/></a>';
		} else {
			$output = '<br /><a href="http://www.phpbb-seo.com/" title="' . $this->seo_opt['copyrights']['title'] . '">' . $this->seo_opt['copyrights']['txt'] . '</a>';
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
	* forum_id(&$forum_id, $forum_uri = '') 
	* will tell the forum id from the uri or the forum_uri GET var by checking the cache.
	*/
	function get_forum_id(&$forum_id, $forum_uri = '') {
		if (empty($forum_uri)) {
			$forum_uri = request_var('forum_uri', '');
			unset($_GET['forum_uri'], $_REQUEST['forum_uri']);
		}
		if (empty($forum_uri)) {
			return 0;
		}
		if ($id = @array_search($forum_uri, $this->cache_config['forum']) ) {
			$forum_id = max(0, (int) $id);
		} elseif ( $id = $this->get_url_info('forum', $forum_uri, 'id')) {
			$forum_id = max(0, (int) $id);
		}
		return $forum_id;
	}
	/**
	* check_cache() will tell if the required file exists.
	* @access private
	*/
	function check_cache( $type = 'forum', $from_bkp = false ) {
		$file = SEO_CACHE_PATH . @$this->cache_config['files'][$type];
		if( !$this->cache_config['cache_enable'] || !isset($this->cache_config['files'][$type]) || !file_exists($file) ) {
			$this->cache_config['cached'] = false;
			return false;
		}
		include($file);
		if (is_array($this->cache_config[$type]) ) {
			$this->cache_config['cached'] = true;
			return true;
		} else {
			if ( !$from_bkp ) {
				// Try the current backup
				@copy($file . '.current', $file);
				$this->check_cache( $type, true );
			}
			$this->cache_config['cached'] = false;
			return false;
		}
	}
	/**
	* is_utf8($string)
	* Borrowed from php.net : http://www.php.net/mb_detect_encoding (detectUTF8)
	*/
	function is_utf8($string) {
		// non-overlong 2-byte|excluding overlongs|straight 3-byte|excluding surrogates|planes 1-3|planes 4-15|plane 16
		return preg_match('%(?:[\xC2-\xDF][\x80-\xBF]|\xE0[\xA0-\xBF][\x80-\xBF]|[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}|\xED[\x80-\x9F][\x80-\xBF] |\xF0[\x90-\xBF][\x80-\xBF]{2}|[\xF1-\xF3][\x80-\xBF]{3}|\xF4[\x80-\x8F][\x80-\xBF]{2})+%xs', $string);
	}
	// --> Add on Functions <--
	// --> Gen stats
	/**
	* Returns usable microtime
	* Borrowed from php.net
	*/
	function microtime_float() {
		return array_sum(explode(' ',microtime()));
	}
	// --> Zero Duplicate
	/**
	* Custom HTTP 301 redirections.
	* To kill duplicates
	*/
	function seo_redirect($url, $header = '301 Moved Permanently', $code = 301, $replace = TRUE) {
		global $db;
		if (!$this->seo_opt['zero_dupe']['on'] || @headers_sent()) {
			return false;
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
		exit_handler();
	}
	/**
	* Set the do_redir_post option right
	*/
	function set_do_redir_post() {
		global $user;
		switch ($this->seo_opt['zero_dupe']['post_redir']) {
			case 'guest':
				if ( empty($user->data['is_registered']) ) {
					$this->seo_opt['zero_dupe']['do_redir_post'] = true;
				}
				break;
			case 'all':
				$this->seo_opt['zero_dupe']['do_redir_post'] = true;
				break;
			case 'off': // Do not redirect
				$this->seo_opt['zero_dupe']['do_redir'] = false;
				$this->seo_opt['zero_dupe']['go_redir'] = false;
				$this->seo_opt['zero_dupe']['do_redir_post'] = false;
				break;
			default:
				$this->seo_opt['zero_dupe']['do_redir_post'] = false;
				break;	
		}
		return $this->seo_opt['zero_dupe']['do_redir_post'];
	}
	/**
	* Redirects if the uri sent does not match (fully) the 
	* attended url
	*/
	function seo_chk_dupe($url = '', $uri = '', $path = '') {
		global $auth, $user, $_SID, $phpbb_root_path, $config;
		static $global_defs;
		if (empty($this->seo_opt['req_file']) || (!$this->seo_opt['rewrite_usermsg'] && $this->seo_opt['req_file'] == 'search') ) {
			return false;
		}
		if (!empty($_REQUEST['explain']) && (boolean) ($auth->acl_get('a_') && defined('DEBUG_EXTRA'))) {
			if ($_REQUEST['explain'] == 1) {
				return true;
			}
		}
		$path = empty($path) ? $phpbb_root_path : $path;
		$uri = !empty($uri) ? $uri : $this->seo_path['uri'];
		$reg = !empty($user->data['is_registered']) ? true : false;
		if (empty($url)) {;
			$url = $this->expected_url($path);
		} else {
			$url = str_replace('&amp;', '&', append_sid($url, false, true, 0));
		}
		$url = $this->drop_sid($url);
		if (!empty($_GET['sid']) && !empty($_SID) && ($reg || !$this->seo_opt['rem_sid']) ) {
			if ($_GET['sid'] == $user->session_id) {
				$url .=  (utf8_strpos( $url, '?' ) !== false ? '&' : '?') . 'sid=' . $user->session_id;
			}
		}
		$url = str_replace( '%26', '&', urldecode($url));
		if ($this->seo_opt['zero_dupe']['do_redir']) {
			$this->seo_redirect($url);
		} elseif ($this->seo_opt['zero_dupe']['strict']) {
			return $this->seo_opt['zero_dupe']['go_redir'] && ( ($uri != $url) ? $this->seo_redirect($url) : false );
		} else {
			return $this->seo_opt['zero_dupe']['go_redir'] && ( (utf8_strpos( $uri, $url ) === false) ? $this->seo_redirect($url) : false );
		}
	}
	/**
	* expected_url($path = '')
	* build expected url
	*/
	function expected_url($path = '') {
		global $phpbb_root_path, $phpEx;
		$path = empty($path) ? $phpbb_root_path : $path;
		$params = array();
		foreach ($this->seo_opt['zero_dupe']['redir_def'] as $get => $def) {
			if ((isset($_GET[$get]) && $def['keep']) || !empty($def['force'])) {
				$params[$get] = $def['val'];
			}
		}
		$this->page_url = append_sid($path . $this->seo_opt['req_file'] . ".$phpEx", $params, false, 0);
		return $this->page_url;
	}
	/**
	* set_cond($bool, $type = 'bool_redir', $or = true)
	* Helps out grabbing boolean vars
	*/
	function set_cond($bool, $type = 'do_redir', $or = true) {
		if ( $or ) {
			$this->seo_opt['zero_dupe'][$type] = (boolean) ($bool || $this->seo_opt['zero_dupe'][$type]);
		} else {
			$this->seo_opt['zero_dupe'][$type] = (boolean) ($bool && $this->seo_opt['zero_dupe'][$type]);
		}
		return;
	}
	/**
	* check start var consistency
	* and return our best guess for $start, eg the first valid page 
	* parameter according to pagination settings being lower
	* than the one sent.
	*/
	function seo_chk_start($start = 0, $limit = 0) {
		if ($limit > 0) {
			$start = is_int($start/$limit) ? $start : intval($start/$limit)*$limit;
		}
		if ( $start >= 1 ) {
			$this->start = $this->seo_delim['start'] . (int) $start;
			return (int) $start;
		}
		$this->start = '';
		return 0;
	}
	// <-- Zero Duplicate
} // End of the phpbb_seo class 
?>
