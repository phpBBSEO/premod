<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $Id: gym_sitemaps.php 2008
* @copyright (c) 2007, 2008 www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
// First basic security
if ( !defined('IN_PHPBB') ) {
	exit;
}
global $table_prefix;
// Table
define('GYM_CONFIG_TABLE', $table_prefix . 'gym_config');
// Overrides (must be numbers, and OVERRIDE_GLOBAL > OVERRIDE_OTYPE > OVERRIDE_MODULE > 0)
define('OVERRIDE_GLOBAL', 3);
define('OVERRIDE_OTYPE', 2);
define('OVERRIDE_MODULE', 1);

// Some set up
$_action_types = array('google' => 'google', 'rss' => 'rss', /*'html' => 'html', 'yahoo' => 'yahoo'*/);
if (defined('ADMIN_START') || defined('IN_INSTALL')) {
	$_action_types['main'] = 'main';
}
$_override_types = array('cache', 'gzip', 'modrewrite', 'limit', 'pagination', 'sort');

/**
* obtain_gym_config ($mode, &$cfg_array).
* Get the required config datas
*/
function obtain_gym_config($mode, &$cfg_array) {
	global $db, $cache;
	$sql_config = '';
	$cache_file = '_gym_config';
	$mode = empty($mode) ? 'main' : $mode;
	if ($mode != 'main') {
		$sql_config = 	"WHERE config_type = 'main' OR config_type = '" . $db->sql_escape($mode). "'";
		$cache_file .= '_' . $mode;
	} else {
		$cache_file .= '_main';
	}
	if (($cfg_array = $cache->get($cache_file)) === false) {
		$sql = "SELECT *
			FROM " . GYM_CONFIG_TABLE . "
			$sql_config";
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result)) {
			$cfg_array[$row['config_name']] = $row['config_value'];
		}
		$db->sql_freeresult($result);
		$cache->put($cache_file, $cfg_array);
	}
	return;
}
/**
* set_gym_config($config_name, $config_value, $mode, &$cfg_array)
* Set gym_config value. Creates missing config entry if needed.
*/
function set_gym_config($config_name, $config_value, $mode, &$cfg_array) {
	global $db, $_action_types;
	$sql = 'UPDATE ' . GYM_CONFIG_TABLE . "
		SET config_value = '" . $db->sql_escape($config_value) . "'
		WHERE config_name = '" . $db->sql_escape($config_name) . "'";
	$db->sql_query($sql);
	if (!$db->sql_affectedrows() && !isset($cfg_array[$config_name])) {
		if (!in_array($mode, $_action_types) ) {
			trigger_error('GYM_ERROR_MODULE_TYPE', E_USER_ERROR);
		}
		$sql = 'INSERT INTO ' . GYM_CONFIG_TABLE . ' ';
		$sql .= $db->sql_build_array('INSERT', array(
			'config_name'	=> (string) $config_name,
			'config_value'	=> (string) $config_value,
			'config_type'	=> (string) $mode,
			)
		);
		$db->sql_query($sql);
	}
	$cfg_array[$config_name] = $config_value;
	return;
}
/**
* rem_gym_config($config_name, &$cfg_array)
* Delete rem_gym_config value.
*/
function rem_gym_config($config_name, &$cfg_array) {
	global $db;
	$sql = 'DELETE FROM ' . GYM_CONFIG_TABLE . "
		WHERE config_name = '" . $db->sql_escape($config_name) . "'";
	$db->sql_query($sql);
	unset($cfg_array[$config_name]);
	return;
}
/**
* obtain_gym_links().
* Builds the rss and sitemaps links
*/
function obtain_gym_links() {
	global $phpbb_root_path, $gym_links, $template, $cache, $config, $phpEx, $user, $phpbb_seo;
	$gym_config = array();
	$cache_file = '_gym_links_' . $user->data['user_lang'];
	if (empty($config['gym_installed'])) {
		return;
	}
	if (($links = $cache->get($cache_file)) === false) {
		$gym_link_tpl = '<a href="%1$s" title="%3$s"><img src="' . generate_board_url() . '/gym_sitemaps/images/%2$s" alt="%3$s"/>&nbsp;%3$s</a>';
		obtain_gym_config('main', $gym_config);
		$user->add_lang('gym_sitemaps/gym_common');
		// Google sitemaps
		$override_google_mod_rewrite = get_override('google', 'modrewrite', $gym_config);
		$google_mod_rewrite = (boolean) get_gym_option('google', '', 'modrewrite', $override_google_mod_rewrite, $gym_config);
		$override_google_gzip = get_override('google', 'gzip', $gym_config);
		$google_gzip = (boolean) get_gym_option('google', '', 'gzip', $override_google_gzip, $gym_config);
		$google_gzip_ext = ($google_gzip || $config['gzip_compress']) ? (get_gym_option('google', '', 'gzip_ext', $override_google_gzip, $gym_config) ? '.gz' : '') : '';
		$sitemap_url = $gym_config['google_url'] . ($google_mod_rewrite ? 'sitemapindex.xml' . $google_gzip_ext : "sitemap.$phpEx");
		// RSS
		$override_rss_mod_rewrite = get_override('rss', 'modrewrite', $gym_config);
		$rss_mod_rewrite = (boolean) get_gym_option('rss', '', 'modrewrite', $override_rss_mod_rewrite, $gym_config);
		$override_rss_gzip = get_override('rss', 'gzip', $gym_config);
		$rss_gzip = (boolean) get_gym_option('rss', '', 'gzip', $override_rss_gzip, $gym_config);
		$rss_gzip_ext = ($rss_gzip || $config['gzip_compress']) ? (get_gym_option('rss', '', 'gzip_ext', $override_rss_gzip, $gym_config) ? '.gz' : '') : '';
		$rss_url = $gym_config['rss_url'] . ($rss_mod_rewrite ? 'rss/rss.xml' . $rss_gzip_ext : "gymrss.$phpEx");
		$rss_chan_url = $gym_config['rss_url'] . ($rss_mod_rewrite ? 'rss/' : "gymrss.$phpEx?channels");
		$links = array();
		$links['main'] = array( 'GYM_LINKS' => true,
			'GYM_GOOGLE_TITLE' => $user->lang['GOOGLE_SITEMAPINDEX'], 
			'GYM_GOOGLE_URL' => $sitemap_url, 
			'GYM_GOOGLE_LINK' => sprintf($gym_link_tpl, $sitemap_url, 'sitemap-icon.gif', $user->lang['GOOGLE_SITEMAPINDEX']),
			'GYM_RSS_TITLE' => $user->lang['RSS_FEED'], 
			'GYM_RSS_URL' => $rss_url, 
			'GYM_RSS_LINK' => sprintf($gym_link_tpl, $rss_url, 'feed-icon.png', $user->lang['RSS_FEED']),
			'GYM_RSS_CHAN_TITLE' => $user->lang['RSS_CHAN_LIST_TITLE'], 
			'GYM_RSS_CHAN_URL' => $rss_chan_url, 
			'GYM_RSS_CHAN_LINK' => sprintf($gym_link_tpl, $rss_chan_url, 'feed-icon.png', $user->lang['RSS_CHAN_LIST_TITLE']), 
		);
		$links['alternate'] = array( 
			array( 'TITLE' => $user->lang['RSS_FEED'], 
				'URL' => $rss_url ),
			array( 'TITLE' => $user->lang['RSS_CHAN_LIST_TITLE'], 
				'URL' => $rss_chan_url ),
		);
		/*if (!empty($gym_config['google_forum_installed'])) {
			$override_mod_rewrite = get_override('google', 'modrewrite', $gym_config);
			$mod_rewrite = (boolean) get_gym_option('google', 'forum', 'modrewrite', $override_mod_rewrite, $gym_config);
			$override_gzip = get_override('google', 'gzip', $gym_config);
			$gzip = (boolean) get_gym_option('google', 'forum', 'gzip', $override_gzip, $gym_config);
			$gzip_ext = ($gzip || $config['gzip_compress'])? (get_gym_option('google', 'forum', 'gzip_ext', $override_gzip, $gym_config) ? '.gz' : '') : '';
			$sitemap_url_tpl = $gym_config['google_url'] . ($mod_rewrite ? '%2$s.xml' . $gzip_ext : 'sitemap.' . $phpEx . '?forum=%1$s');
			$links['GOOGLE']['FORUM'] = array( 'TITLE' => $user->lang['GOOGLE_SITEMAP'], 
				'URLTPL' => '', 
				'GZIPEXT' => (($gym_config['google_gzip'] || $config['gzip_compress']) && $gym_config['google_gzip_ext']) ? '.gz' : '', 
				'LINK' => sprintf($gym_link_tpl, $sitemap_url, 'sitemap-icon.gif', $user->lang['GOOGLE_SITEMAP']),
			);
		}
		$links['RSS']['FORUM'] = array( 'TITLE' => $rss_title, 
			'URL' => $rss_url, 
			'LINK' => sprintf($gym_link_tpl, $rss_url, 'feed-icon.png', $rss_title), 
		);*/
		$cache->put($cache_file, $links);
	}
	$template->assign_vars($links['main']);
	foreach ($links['alternate'] as $alternate) {
		$template->assign_block_vars('gym_rsslinks', $alternate);
	}
}
/**
* get_override($mode, $key, $gym_config)
*
*/
function get_override($mode, $key, $gym_config) {
	return $gym_config['gym_override_' . $key] != OVERRIDE_GLOBAL ? ($gym_config[$mode . '_override_' . $key] != OVERRIDE_GLOBAL ? $gym_config[$mode . '_override_' . $key] : $gym_config['gym_override_' . $key] ) : OVERRIDE_GLOBAL;
}
/**
* get_gym_option($mode, $type, $gym_config)
* Same effect as gym_sitemaps::set_module_option()
* For faster use outside the class, it will assume the option is set at the main level
*/
function get_gym_option($mode, $module, $key, $override, $gym_config) {
	return ($override == OVERRIDE_MODULE && @isset($gym_config[$mode . '_' . $module . '_' . $key])) ? $gym_config[$mode . '_' . $module . '_' . $key] : ( ($override != OVERRIDE_GLOBAL && @isset($gym_config[$mode . '_' . $key])) ? $gym_config[$mode . '_' . $key] : $gym_config['gym_' . $key]);
}
/**
* numeric_entify_utf8() 
* borrowed from php.net : http://www.php.net/utf8_decode
*/
function numeric_entify_utf8($utf8_string) {
	$out = "";
	$ns = strlen ($utf8_string);
	for ($nn = 0; $nn < $ns; $nn ++) {
		$ch = $utf8_string[$nn];
		$ii = ord ($ch);
		if ($ii < 128) { //1 7 0bbbbbbb (127)
			$out .= $ch;
		} elseif ($ii >> 5 == 6) { //2 11 110bbbbb 10bbbbbb (2047)
			$b1 = ($ii & 31);
			$nn ++;
			$ch = $utf8_string[$nn];
			$ii = ord ($ch);
			$b2 = ($ii & 63);
			$ii = ($b1 * 64) + $b2;
			$ent = sprintf ("&#%d;", $ii);
			$out .= $ent;
		} elseif ($ii >> 4 == 14) { //3 16 1110bbbb 10bbbbbb 10bbbbbb
			$b1 = ($ii & 31);
			$nn ++;
			$ch = $utf8_string[$nn];
			$ii = ord ($ch);
			$b2 = ($ii & 63);
			$nn ++;
			$ch = $utf8_string[$nn];
			$ii = ord ($ch);
			$b3 = ($ii & 63);
			$ii = ((($b1 * 64) + $b2) * 64) + $b3;
			$ent = sprintf ("&#%d;", $ii);
			$out .= $ent;
		} elseif ($ii >> 3 == 30) { //4 21 11110bbb 10bbbbbb 10bbbbbb 10bbbbbb
			$b1 = ($ii & 31);
			$nn ++;
			$ch = $utf8_string[$nn];
			$ii = ord ($ch);
			$b2 = ($ii & 63);
			$nn ++;
			$ch = $utf8_string[$nn];
			$ii = ord ($ch);
			$b3 = ($ii & 63);
			$nn ++;
			$ch = $utf8_string[$nn];
			$ii = ord ($ch);
			$b4 = ($ii & 63);
			$ii = ((((($b1 * 64) + $b2) * 64) + $b3) * 64) + $b4;
			$ent = sprintf ("&#%d;", $ii);
			$out .= $ent;
		}
	}
	return $out;
}
?>
