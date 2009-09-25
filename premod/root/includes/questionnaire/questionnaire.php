<?php
/**
*
* @package phpBB3
* @version $Id: questionnaire.php 10131 2009-09-10 13:30:47Z acydburn $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
* This class collects data which is used to create some usage statistics.
*
* The collected data is - after authorization of the administrator - submitted
* to a central server. For privacy reasons we try to collect only data which aren't private
* or don't give any information which might help to identify the user.
*
* @author		Johannes Schlueter <johannes@php.net>
* @copyright	(c) 2007-2008 Johannes Schlueter
*/
class phpbb_questionnaire_data_collector
{
	var $providers;
	var $data = null;
	var $install_id = '';

	/**
	* Constructor.
	*
	* @param	string
	*/
	function phpbb_questionnaire_data_collector($install_id)
	{
		$this->install_id = $install_id;
		$this->providers = array();
	}

	function add_data_provider(&$provider)
	{
		$this->providers[] = &$provider;
	}

	/**
	* Get data as an array.
	*
	* @return	array	All Data
	*/
	function get_data_raw()
	{
		if (!$this->data)
		{
			$this->collect();
		}

		return $this->data;
	}

	function get_data_for_form()
	{
		return base64_encode(serialize($this->get_data_raw()));
	}

	/**
	* Collect info into the data property.
	*
	* @return	void
	*/
	function collect()
	{
		foreach (array_keys($this->providers) as $key)
		{
			$provider = &$this->providers[$key];
			$this->data[$provider->get_identifier()] = $provider->get_data();
		}
		$this->data['install_id'] = $this->install_id;
	}
}

/** interface: get_indentifier(), get_data() */

/**
* Questionnaire PHP data provider
* @package phpBB3
*/
class phpbb_questionnaire_php_data_provider
{
	function get_identifier()
	{
		return 'PHP';
	}

	/**
	* Get data about the PHP runtime setup.
	*
	* @return	array
	*/
	function get_data()
	{
		return array(
			'version'						=> PHP_VERSION,
			'sapi'							=> PHP_SAPI,
			'int_size'						=> defined('PHP_INT_SIZE') ? PHP_INT_SIZE : '',
			'safe_mode'						=> (int) @ini_get('safe_mode'),
			'open_basedir'					=> (int) @ini_get('open_basedir'),
			'memory_limit'					=> @ini_get('memory_limit'),
			'allow_url_fopen'				=> (int) @ini_get('allow_url_fopen'),
			'allow_url_include'				=> (int) @ini_get('allow_url_include'),
			'file_uploads'					=> (int) @ini_get('file_uploads'),
			'upload_max_filesize'			=> @ini_get('upload_max_filesize'),
			'post_max_size'					=> @ini_get('post_max_size'),
			'disable_functions'				=> @ini_get('disable_functions'),
			'disable_classes'				=> @ini_get('disable_classes'),
			'enable_dl'						=> (int) @ini_get('enable_dl'),
			'magic_quotes_gpc'				=> (int) @ini_get('magic_quotes_gpc'),
			'register_globals'				=> (int) @ini_get('register_globals'),
			'filter.default'				=> @ini_get('filter.default'),
			'zend.ze1_compatibility_mode'	=> (int) @ini_get('zend.ze1_compatibility_mode'),
			'unicode.semantics'				=> (int) @ini_get('unicode.semantics'),
			'zend_thread_safty'				=> (int) function_exists('zend_thread_id'),
			'extensions'					=> get_loaded_extensions(),
		);
	}
}

/**
* Questionnaire System data provider
* @package phpBB3
*/
class phpbb_questionnaire_system_data_provider
{
	function get_identifier()
	{
		return 'System';
	}

	/**
	* Get data about the general system information, like OS or IP (shortened).
	*
	* @return	array
	*/
	function get_data()
	{
		// Start discovering the IPV4 server address, if available
		$server_address = '0.0.0.0';

		if (!empty($_SERVER['SERVER_ADDR']))
		{
			$server_address = $_SERVER['SERVER_ADDR'];
		}

		// Running on IIS?
		if (!empty($_SERVER['LOCAL_ADDR']))
		{
			$server_address = $_SERVER['LOCAL_ADDR'];
		}

		$ip_address_ary = explode('.', $server_address);

		// build ip
		if (!isset($ip_address_ary[0]) || !isset($ip_address_ary[1]))
		{
			$ip_address_ary = explode('.', '0.0.0.0');
		}

		return array(
			'os'	=> PHP_OS,
			'httpd'	=> $_SERVER['SERVER_SOFTWARE'],
			// we don't want the real IP address (for privacy policy reasons) but only
			// a network address to see whether your installation is running on a private or public network.
			// IANA reserved addresses for private networks (RFC 1918) are:
			// - 10.0.0.0/8
			// - 172.16.0.0/12
			// - 192.168.0.0/16
			'ip'		=> $ip_address_ary[0] . '.' . $ip_address_ary[1] . '.XXX.YYY',
		);
	}
}

/**
* Questionnaire phpBB data provider
* @package phpBB3
*/
class phpbb_questionnaire_phpbb_data_provider
{
	var $config;
	var $unique_id;

	/**
	* Constructor.
	*
	* @param	array	$config
	*/
	function phpbb_questionnaire_phpbb_data_provider($config)
	{
		// generate a unique id if necessary
		if (empty($config['questionnaire_unique_id']))
		{
			$this->unique_id = unique_id();
			set_config('questionnaire_unique_id', $this->unique_id);
		}
		else
		{
			$this->unique_id = $config['questionnaire_unique_id'];
		}

		$this->config = $config;
	}

	/**
	* Returns a string identifier for this data provider
	*
	* @return	string	"phpBB"
	*/
	function get_identifier()
	{
		return 'phpBB';
	}

	/**
	* Get data about this phpBB installation.
	*
	* @return	array	Relevant anonymous config options
	*/
	function get_data()
	{
		global $phpbb_root_path, $phpEx;
		include("{$phpbb_root_path}config.$phpEx");

		// Only send certain config vars
		$config_vars = array(
			'active_sessions' => true,
			'allow_attachments' => true,
			'allow_autologin' => true,
			'allow_avatar' => true,
			'allow_avatar_local' => true,
			'allow_avatar_remote' => true,
			'allow_avatar_upload' => true,
			'allow_bbcode' => true,
			'allow_birthdays' => true,
			'allow_bookmarks' => true,
			'allow_emailreuse' => true,
			'allow_forum_notify' => true,
			'allow_mass_pm' => true,
			'allow_name_chars' => true,
			'allow_namechange' => true,
			'allow_nocensors' => true,
			'allow_pm_attach' => true,
			'allow_pm_report' => true,
			'allow_post_flash' => true,
			'allow_post_links' => true,
			'allow_privmsg' => true,
			'allow_quick_reply' => true,
			'allow_sig' => true,
			'allow_sig_bbcode' => true,
			'allow_sig_flash' => true,
			'allow_sig_img' => true,
			'allow_sig_links' => true,
			'allow_sig_pm' => true,
			'allow_sig_smilies' => true,
			'allow_smilies' => true,
			'allow_topic_notify' => true,
			'attachment_quota' => true,
			'auth_bbcode_pm' => true,
			'auth_flash_pm' => true,
			'auth_img_pm' => true,
			'auth_method' => true,
			'auth_smilies_pm' => true,
			'avatar_filesize' => true,
			'avatar_max_height' => true,
			'avatar_max_width' => true,
			'avatar_min_height' => true,
			'avatar_min_width' => true,
			'board_dst' => true,
			'board_email_form' => true,
			'board_hide_emails' => true,
			'board_timezone' => true,
			'browser_check' => true,
			'bump_interval' => true,
			'bump_type' => true,
			'cache_gc' => true,
			'captcha_plugin' => true,
			'captcha_gd' => true,
			'captcha_gd_foreground_noise' => true,
			'captcha_gd_x_grid' => true,
			'captcha_gd_y_grid' => true,
			'captcha_gd_wave' => true,
			'captcha_gd_3d_noise' => true,
			'captcha_gd_fonts' => true,
			'confirm_refresh' => true,
			'check_attachment_content' => true,
			'check_dnsbl' => true,
			'chg_passforce' => true,
			'cookie_secure' => true,
			'coppa_enable' => true,
			'database_gc' => true,
			'dbms_version' => true,
			'default_dateformat' => true,
			'display_last_edited' => true,
			'display_order' => true,
			'edit_time' => true,
			'email_check_mx' => true,
			'email_enable' => true,
			'email_function_name' => true,
			'email_package_size' => true,
			'enable_confirm' => true,
			'enable_pm_icons' => true,
			'enable_post_confirm' => true,
			'feed_enable' => true,
			'feed_limit' => true,
			'feed_overall_forums' => true,
			'feed_overall_forums_limit' => true,
			'feed_overall_topics' => true,
			'feed_overall_topics_limit' => true,
			'feed_forum' => true,
			'feed_topic' => true,
			'feed_item_statistics' => true,
			'flood_interval' => true,
			'force_server_vars' => true,
			'form_token_lifetime' => true,
			'form_token_mintime' => true,
			'form_token_sid_guests' => true,
			'forward_pm' => true,
			'forwarded_for_check' => true,
			'full_folder_action' => true,
			'fulltext_native_common_thres' => true,
			'fulltext_native_load_upd' => true,
			'fulltext_native_max_chars' => true,
			'fulltext_native_min_chars' => true,
			'gzip_compress' => true,
			'hot_threshold' => true,
			'img_create_thumbnail' => true,
			'img_display_inlined' => true,
			'img_imagick' => true,
			'img_link_height' => true,
			'img_link_width' => true,
			'img_max_height' => true,
			'img_max_thumb_width' => true,
			'img_max_width' => true,
			'img_min_thumb_filesize' => true,
			'ip_check' => true,
			'jab_enable' => true,
			'jab_package_size' => true,
			'jab_use_ssl' => true,
			'limit_load' => true,
			'limit_search_load' => true,
			'load_anon_lastread' => true,
			'load_birthdays' => true,
			'load_cpf_memberlist' => true,
			'load_cpf_viewprofile' => true,
			'load_cpf_viewtopic' => true,
			'load_db_lastread' => true,
			'load_db_track' => true,
			'load_jumpbox' => true,
			'load_moderators' => true,
			'load_online' => true,
			'load_online_guests' => true,
			'load_online_time' => true,
			'load_onlinetrack' => true,
			'load_search' => true,
			'load_tplcompile' => true,
			'load_user_activity' => true,
			'max_attachments' => true,
			'max_attachments_pm' => true,
			'max_autologin_time' => true,
			'max_filesize' => true,
			'max_filesize_pm' => true,
			'max_login_attempts' => true,
			'max_name_chars' => true,
			'max_num_search_keywords' => true,
			'max_pass_chars' => true,
			'max_poll_options' => true,
			'max_post_chars' => true,
			'max_post_font_size' => true,
			'max_post_img_height' => true,
			'max_post_img_width' => true,
			'max_post_smilies' => true,
			'max_post_urls' => true,
			'max_quote_depth' => true,
			'max_reg_attempts' => true,
			'max_sig_chars' => true,
			'max_sig_font_size' => true,
			'max_sig_img_height' => true,
			'max_sig_img_width' => true,
			'max_sig_smilies' => true,
			'max_sig_urls' => true,
			'min_name_chars' => true,
			'min_pass_chars' => true,
			'min_post_chars' => true,
			'min_search_author_chars' => true,
			'mime_triggers' => true,
			'new_member_post_limit' => true,
			'new_member_group_default' => true,
			'override_user_style' => true,
			'pass_complex' => true,
			'pm_edit_time' => true,
			'pm_max_boxes' => true,
			'pm_max_msgs' => true,
			'pm_max_recipients' => true,
			'posts_per_page' => true,
			'print_pm' => true,
			'queue_interval' => true,
			'require_activation' => true,
			'referer_validation' => true,
			'search_block_size' => true,
			'search_gc' => true,
			'search_interval' => true,
			'search_anonymous_interval' => true,
			'search_type' => true,
			'search_store_results' => true,
			'secure_allow_deny' => true,
			'secure_allow_empty_referer' => true,
			'secure_downloads' => true,
			'session_gc' => true,
			'session_length' => true,
			'smtp_auth_method' => true,
			'smtp_delivery' => true,
			'topics_per_page' => true,
			'tpl_allow_php' => true,
			'version' => true,
			'warnings_expire_days' => true,
			'warnings_gc' => true,

			'num_files' => true,
			'num_posts' => true,
			'num_topics' => true,
			'num_users' => true,
			'record_online_users' => true,
		);

		$result = array();
		foreach ($config_vars as $name => $void)
		{
			if (isset($this->config[$name]))
			{
				$result['config_' . $name] = $this->config[$name];
			}
		}

		$result['dbms'] = $dbms;
		$result['acm_type'] = $acm_type;
		$result['load_extensions'] = $load_extensions;
		$result['user_agent'] = 'Unknown';

		// Try to get user agent vendor and version
		$match = array();
		$user_agent = (!empty($_SERVER['HTTP_USER_AGENT'])) ? (string) $_SERVER['HTTP_USER_AGENT'] : '';
		$agents = array('firefox', 'msie', 'opera', 'chrome', 'safari', 'mozilla', 'seamonkey', 'konqueror', 'netscape', 'gecko', 'navigator', 'mosaic', 'lynx', 'amaya', 'omniweb', 'avant', 'camino', 'flock', 'aol');

		// We check here 1 by 1 because some strings occur after others (for example Mozilla [...] Firefox/)
		foreach ($agents as $agent)
		{
			if (preg_match('#(' . $agent . ')[/ ]?([0-9.]*)#i', $user_agent, $match))
			{
				$result['user_agent'] = $match[1] . ' ' . $match[2];
				break;
			}
		}

		return $result;
	}
}
// www.phpBB-SEO.com SEO TOOLKIT BEGIN
/**
* Questionnaire phpBB_SEO data provider
* @package phpBB3
*/
class phpbb_questionnaire_phpbb_seo_data_provider
{
	var $config = array();
	var $gym_config = array();
	/**
	* Constructor.
	*
	* @param	array	$config
	*/
	function phpbb_questionnaire_phpbb_data_provider($config)
	{
		$this->config = $config;
	}
	/**
	* Returns a string identifier for this data provider
	*
	* @return	string	"phpBB_SEO"
	*/
	function get_identifier()
	{
		return 'phpBB_SEO';
	}

	/**
	* Get data about the PHP runtime setup.
	*
	* @return	array
	*/
	function get_data()
	{
		global $phpbb_root_path, $phpEx, $phpbb_seo;
		include("{$phpbb_root_path}gym_sitemaps/includes/gym_common.$phpEx");
		// Only send certain config vars
		$gym_config_vars = array();
		obtain_gym_config('main', $this->gym_config);
		// is GYM Installed
		if (!empty($this->gym_config)) {
			// main config
			$gym_config_vars = array(
				'gym_version' => true,
				'gym_cache' => true,
				'gym_cache_max_age' => true,
				'gym_modrewrite' => true,
				'gym_gzip' => true,
				'gym_url_limit' => true,
				'gym_sql_limit' => true,
				'gym_pagination' => true,
				'gym_limitdown' => true,
				'gym_limitup' => true,
				'gym_sort' => true,
				'gym_xslt' => true,
				'gym_load_phpbb_css' => true,
				'gym_threshold' => true,
				'gym_cache_auto_regen' =>true,
				'gym_override' => true,
				'gym_override_cache' => true,
				'gym_override_modrewrite' => true,
				'gym_override_gzip' => true,
				'gym_override_limit' => true,
				'gym_override_sort' => true,
				'gym_override_pagination' => true,
			);
			// Google sitemaps
			if (!empty($this->gym_config['google_main_installed'])) {
				$gym_config_vars = array_merge($gym_config_vars , array(
					'google_main_installed' => true,
					'google_ping' => true,
					'google_cache' => true,
					'google_cache_max_age' => true,
					'google_modrewrite' => true,
					'google_gzip' => true,
					'google_url_limit' => true,
					'google_sql_limit' => true,
					'google_pagination' => true,
					'google_limitdown' => true,
					'google_limitup' => true,
					'google_sort' => true,
					'google_xslt' => true,
					'google_load_phpbb_css' => true,
					'google_threshold' => true,
					'google_cache_auto_regen' =>true,
					'google_override' => true,
					'google_override_cache' => true,
					'google_override_modrewrite' => true,
					'google_override_gzip' => true,
					'google_override_limit' => true,
					'google_override_sort' => true,
					'google_override_pagination' => true,
				));
				// forum module
				if (!empty($this->gym_config['google_forum_installed'])) {
					$gym_config_vars = array_merge($gym_config_vars , array(
						'google_forum_installed' => true,
						'google_forum_ping' => true,
						'google_forum_cache' => true,
						'google_forum_cache_max_age' => true,
						'google_forum_modrewrite' => true,
						'google_forum_gzip' => true,
						'google_forum_url_limit' => true,
						'google_forum_sql_limit' => true,
						'google_forum_pagination' => true,
						'google_forum_limitdown' => true,
						'google_forum_limitup' => true,
						'google_forum_sort' => true,
						'google_forum_xslt' => true,
						'google_forum_load_phpbb_css' => true,
					));
				}
				// TXT module
				if (!empty($this->gym_config['google_txt_installed'])) {
					$gym_config_vars = array_merge($gym_config_vars , array(
						'google_txt_installed' => true,
						'google_txt_randomize' => true,
						'google_txt_unique' => true,
						'google_txt_check_robots' => true,
						'google_txt_force_lastmod' => true,
						'google_txt_ping' => true,
						'google_txt_cache' => true,
						'google_txt_cache_max_age' => true,
						'google_txt_modrewrite' => true,
						'google_txt_gzip' => true,
						'google_txt_url_limit' => true,
					));
				}
				// XML module
				if (!empty($this->gym_config['google_xml_installed'])) {
					$gym_config_vars = array_merge($gym_config_vars , array(
						'google_xml_installed' => true,
						'google_xml_randomize' => true,
						'google_xml_unique' => true,
						'google_xml_check_robots' => true,
						'google_xml_force_lastmod' => true,
						'google_xml_ping' => true,
						'google_xml_cache' => true,
						'google_xml_cache_max_age' => true,
						'google_xml_modrewrite' => true,
						'google_xml_gzip' => true,
						'google_xml_url_limit' => true,
						'google_xml_force_limit' => true,
					));
				}
			}
			// RSS feeds
			if (!empty($this->gym_config['rss_main_installed'])) {
				$gym_config_vars = array_merge($gym_config_vars , array(
					'rss_main_installed' => true,
					'rss_cache' => true,
					'rss_cache_max_age' => true,
					'rss_modrewrite' => true,
					'rss_gzip' => true,
					'rss_url_limit' => true,
					'rss_sql_limit' => true,
					'rss_pagination' => true,
					'rss_limitdown' => true,
					'rss_limitup' => true,
					'rss_sort' => true,
					'rss_xslt' => true,
					'rss_load_phpbb_css' => true,
					'rss_cache_auto_regen' =>true,
					'rss_override' => true,
					'rss_override_cache' => true,
					'rss_override_modrewrite' => true,
					'rss_override_gzip' => true,
					'rss_override_limit' => true,
					'rss_override_sort' => true,
					'rss_override_pagination' => true,
				));
				// forum module
				if (!empty($this->gym_config['rss_forum_installed'])) {
					$gym_config_vars = array_merge($gym_config_vars , array(
						'rss_forum_installed' => true,
						'rss_forum_ping' => true,
						'rss_forum_cache' => true,
						'rss_forum_cache_max_age' => true,
						'rss_forum_modrewrite' => true,
						'rss_forum_gzip' => true,
						'rss_forum_url_limit' => true,
						'rss_forum_sql_limit' => true,
						'rss_forum_pagination' => true,
						'rss_forum_limitdown' => true,
						'rss_forum_limitup' => true,
						'rss_forum_sort' => true,
						'rss_forum_xslt' => true,
						'rss_force_xslt' => true,
						'rss_forum_load_phpbb_css' => true,
					));
				}
			}
			// HTML module
			if (!empty($this->gym_config['html_main_installed'])) {
				$gym_config_vars = array_merge($gym_config_vars , array(
					'html_main_installed' => true,
					'html_cache' => true,
					'html_cache_max_age' => true,
					'html_modrewrite' => true,
					'html_gzip' => true,
					'html_url_limit' => true,
					'html_sql_limit' => true,
					'html_pagination' => true,
					'html_limitdown' => true,
					'html_limitup' => true,
					'html_sort' => true,
					'html_xslt' => true,
					'html_load_phpbb_css' => true,
					'html_cache_auto_regen' =>true,
					'html_override' => true,
					'html_override_cache' => true,
					'html_override_modrewrite' => true,
					'html_override_gzip' => true,
					'html_override_limit' => true,
					'html_override_sort' => true,
					'html_override_pagination' => true,
				));
				// forum module
				if (!empty($this->gym_config['html_forum_installed'])) {
					$gym_config_vars = array_merge($gym_config_vars , array(
						'html_forum_installed' => true,
						'html_forum_ping' => true,
						'html_forum_cache' => true,
						'html_forum_cache_max_age' => true,
						'html_forum_modrewrite' => true,
						'html_forum_gzip' => true,
						'html_forum_url_limit' => true,
						'html_forum_sql_limit' => true,
						'html_forum_pagination' => true,
						'html_forum_limitdown' => true,
						'html_forum_limitup' => true,
						'html_forum_sort' => true,
						'html_forum_xslt' => true,
						'html_force_xslt' => true,
						'html_forum_load_phpbb_css' => true,
					));
				}
			}
		}
		// mod rewrite
	}
}
// www.phpBB-SEO.com SEO TOOLKIT END
?>