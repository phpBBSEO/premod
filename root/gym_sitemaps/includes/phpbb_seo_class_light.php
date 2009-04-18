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
* phpBB_SEO Class lite
* For Compatibility with the phpBB SEO mod rewrites
* www.phpBB-SEO.com
* @package phpBB SEO
*/
// 

class phpbb_seo {
	var	$seo_url = array();
	var	$seo_delim = array();
	var	$seo_path = array();
	var	$seo_opt = array();
	var	$seo_cache = array();
	var	$seo_ext = array();
	var	$seo_static = array();
	var	$modrtype = -1;
	var	$encoding = 'UTF-8';
	/**
	* constuctor
	*/
	function phpbb_seo() {
		global $config, $phpEx;
		$this->seo_cache = array();
		$this->seo_censored = array();
		$this->start = $this->path = '';
		// URL Settings
		// The arrays where the preformated titles are stored.
		$this->seo_url = array( 'forum' =>  array(), 'topic' =>  array(), 'user' => array(),  'usermsg' => array(), 'username' => array(), 'group' => array() );
		// Delimiters : used as separators in the .htaccess RegEx
		// can be edited, requires .htaccess update.
		$this->seo_delim = array( 'forum' => '-f', 'topic' => '-t', 'user' => '-u', 'usermsg' => '-m', 'group' => '-g', 'start' => '-');
		// Default : Used as URL when format_url would return nothing or with simple URLs
		// can be edited, requires .htaccess update.
		$this->seo_static = array( 'forum' => 'forum', 'topic' => 'topic', 'post' => 'post', 'user' => 'member', 'group' => 'group', 'index' => '', 'global_announce' => 'announces', 'leaders' => 'the-team', 'usermsg' => 'messages', 'pagination' => 'page', 'gz_ext' => '.gz' );
		// URL suffixes, for the phpBB URLs
		// can be edited, requires .htaccess update.
		$this->seo_ext = array( 'forum' => '.html', 'topic' => '.html', 'post' => '.html', 'user' => '.html', 'usermsg' => '.html', 'group' => '.html',  'index' => '', 'global_announce' => '/', 'leaders' => '.html', 'pagination' => '.html', 'gz_ext' => '');
		$this->seo_opt['url_pattern'] = array('`&(amp;)?#?[a-z0-9]+;`i', '`[^a-z0-9]`i'); // Do not remove : html/xml entities & non a-z chars
		/*if ($this->seo_opt['rem_small_words']) {
			$this->seo_opt['url_pattern'][] = '`-[a-z0-9]{1,2}(?=-)`i'; // Startig / Ending with hyphen (thx pvchat1)
			$this->seo_opt['url_pattern'][] = '`^[a-z0-9]{1,2}-`i'; // Ending with hyphen
			$this->seo_opt['url_pattern'][] = '`-[a-z0-9]{1,2}$`i'; // Starting with hyphen
			$this->seo_opt['url_pattern'][] = '`^[a-z0-9]{1,2}$`i'; // Single word in title : z1-txx.html vs topic-txx.hmtl
		}*/
		$this->seo_opt['url_pattern'][] ='`[-]+`'; // Do not remove : multi hyphen reduction
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
		// File setting
		$this->seo_req_uri();
		$parsed_url = @parse_url($this->seo_path['uri']);
		$this->seo_path['file'] = basename($parsed_url['path']);
		// Path from root to the file, including virtual folders.
		$this->seo_path['current_path'] = trim(trim(str_replace('\\', '/', $parsed_url['path']), '/'),  '.');
		$this->seo_opt['seo_base_href'] = '';
		$this->seo_opt['req_file'] = @parse_url($_SERVER['PHP_SELF']);
		$this->seo_opt['req_file'] = str_replace( '.' . $phpEx, '', basename($this->seo_opt['req_file']['path']));
		return;
	}
	// --> Gen stats 
	/**
	* Returns microtime
	* Borrowed from php.net
	*/
	function microtime_float() {
		return array_sum(explode(' ', microtime()));
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
	* Prepare url first part and checks cache
	*/
	function set_url( $url, $id = 0, $type = 'forum' ) {
		return $this->format_url( $url, $type ) . $this->seo_delim[$type] . $id;
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
}
?>
