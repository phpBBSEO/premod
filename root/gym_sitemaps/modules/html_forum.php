<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $Id: rss_forum.php 2007/04/12 13:48:48 dcz Exp $
* @copyright (c) 2006 dcz - www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
// First basic security
if ( !defined('IN_PHPBB') ) {
	exit;
}
/**
* html_forum Class
* www.phpBB-SEO.com
* @package phpBB SEO
*/
class html_forum {
	var $url_settings = array();
	var $options = array();
	var $module_config = array();
	var $outputs = array();
	var $forum_cache = array();
	/**
	* constuctor
	*/
	function html_forum(&$gym_master) {
		global $user;
		$this->gym_master = &$gym_master;
		$this->options = &$this->gym_master->actions;
		$this->outputs = &$this->gym_master->output_data;
		$this->module_config = &$this->gym_master->rss_config;
		$this->url_settings = &$this->gym_master->url_config;
		$this->module_config = array_merge(
			// Global
			$this->module_config,
			// Other stuff required here
			array(
				'rss_first' => ( $this->gym_master->gym_config['rss_forum_first'] ) ? TRUE : FALSE,
				'rss_last' => ( $this->gym_master->gym_config['rss_forum_last']  ) ? TRUE : FALSE,
				'rss_forum_rules' => ( $this->gym_master->gym_config['rss_forum_rules']  ) ? TRUE : FALSE,
				'rss_exclude_list' => trim($this->gym_master->gym_config['rss_forum_exclude'], ','),
			)
		);
		// Set up msg outpout
		$this->module_config['rss_last'] = ($this->module_config['rss_first']) ? $this->module_config['rss_last'] : TRUE;
		// Build unauthed array
		$this->module_config['exclude_list'] = $this->gym_master->set_exclude_list($this->module_config['rss_exclude_list']);
		// Wee need to check auth here
		$this->module_config['exclude_list'] = $this->gym_master->check_forum_auth($this->module_config['exclude_list'], $this->module_config['rss_auth_guest']);
		$this->options['not_in_id_sql'] = $this->gym_master->set_not_in_list($this->module_config['exclude_list']);
		if (!$this->module_config['rss_cache_checked']) { // Then cache was not checked yet
			// We can check cache right now
			$this->gym_master->gym_output->setup_cache(); // Will exit if the cache is sent
		}
		$this->init_url_settings();
	}
	/**
	* Initialize mod rewrite to handle multiple URL standards.
	* Only one 'if' is required after this in THE loop to properly switch 
	* between the four types (none, advanced, mixed and simple).
	* @access private
	*/
	function init_url_settings() {
		global $phpbb_seo, $phpEx;
		// vars will fell like rain in the code ;)
		$this->url_settings['forum_pre'] = "viewforum.$phpEx?f=";
		$this->url_settings['topic_pre'] = "viewtopic.$phpEx?t=";
		$this->url_settings['forum_ext'] = '';
		$this->url_settings['topic_ext'] = '';
		$this->url_settings['start_delim'] = $this->url_settings['start_default'];
		$this->url_settings['html_forum_pre'] = $this->url_settings['html_default'] . '?forum=';
		$this->url_settings['html_forum_default'] = $this->url_settings['html_default'] . '?forum';
		$this->url_settings['html_forum_list'] = $this->url_settings['html_forum_pre'] . 'list';
		$this->url_settings['html_forum_ext'] = '';
		// Mod rewrite type auto detection
		$this->url_settings['modrtype'] = ($phpbb_seo->modrtype >= 0) ? intval($phpbb_seo->modrtype) : intval($this->gym_master->gym_config['html_modrtype']);
		$this->url_settings['html_forum_delim'] = !empty($phpbb_seo->seo_delim['html_forum']) ? $phpbb_seo->seo_delim['html_forum'] : '-rf';
		$this->url_settings['html_forum_static'] = !empty($phpbb_seo->seo_static['html_forum']) ? $phpbb_seo->seo_static['html_forum'] : 'forum';
		$this->url_settings['modrewrite'] = $this->gym_master->gym_config['html_modrewrite'];
		if ($this->url_settings['modrewrite']) { // Module links
			$this->url_settings['html_forum_pre'] = ($this->url_settings['modrtype'] >= 2) ? '' : $this->url_settings['html_forum_static'] . $this->url_settings['html_forum_delim'];
			$this->url_settings['html_forum_ext'] = '.xml' . $this->url_settings['gzip_ext_out'];
			$this->url_settings['html_forum_default'] = 'forum-map';
			$this->url_settings['html_forum_list'] = 'forum-list';	
		}
		if ($phpbb_seo->seo_opt['url_rewrite']) {
			if ($this->url_settings['modrtype'] >= 1) { // Simple mod rewrite, default is none (0)
				$this->url_settings['start_delim'] = $phpbb_seo->seo_delim['start'];
				$this->url_settings['forum_pre'] = $phpbb_seo->seo_static['forum'];
				$this->url_settings['topic_pre'] = $phpbb_seo->seo_static['topic'];
				$this->url_settings['forum_ext'] = $phpbb_seo->seo_ext['forum'];
				$this->url_settings['topic_ext'] = $phpbb_seo->seo_ext['topic'];
			}
			if ($this->url_settings['modrtype'] >= 2) { // +Mixed
				$this->url_settings['forum_pre'] = '';
			} 
			if ($this->url_settings['modrtype'] >= 3) { // +Advanced
				$this->url_settings['topic_pre'] = '';
			}
		} else {
			$phpbb_seo->seo_opt['virtual_folder'] = false;
		}
		return;
	}
	/**
	* rss_main() 
	* Add content to the main listing (channel list and rss feed)
	* @access private
	*/
	function html_main() {
		global $config, $db, $phpbb_seo, $user, $phpEx;
		// It's global channel list call, add static channels
		// Reset the local counting, since we are cycling through modules
		$this->outputs['url_sofar'] = 0;
		if ( $this->options['html_list'] ) { // Channel lists
			// Chan info
			$chan_source = $this->module_config['rss_url'] . $this->url_settings['rss_forum_channel'] . $this->url_settings['extra_params_delimE'] . $this->url_settings['extra_params'] . $this->url_settings['rss_forum_ext'];
			$chan_link = $phpbb_seo->seo_path['phpbb_url'];
			$item_tile = !empty($this->gym_master->gym_config['rss_forum_sitename']) ? $this->gym_master->gym_config['rss_forum_sitename'] : $config['sitename'];
			$item_desc = (!empty($this->gym_master->gym_config['rss_forum_site_desc']) ? $this->gym_master->gym_config['rss_forum_site_desc'] : $config['site_desc']) . "\n\n";
			// Forum stats
			$forum_stats = "\n\n" . '<b>' . $user->lang['STATISTICS'] . '</b> : ' . sprintf($user->lang['TOTAL_USERS_OTHER'], $config['num_users']) . ' || ';
			$forum_stats .= sprintf($user->lang['TOTAL_TOPICS_OTHER'], $config['num_topics']) . ' || ';
			$forum_stats .= sprintf($user->lang['TOTAL_POSTS_OTHER'], $config['num_posts']) . "\n";
			$forum_stats .= ($this->module_config['rss_allow_profile'] ? "\n" . sprintf($user->lang['NEWEST_USER'], $this->gym_master->username_string($config['newest_user_id'], $config['newest_username'], $config['newest_user_colour'], $this->module_config['rss_allow_profile_links']) ) : '') . "\n\n";
			$item_desc = '<h2>' . $item_tile . '</h2>' . $item_desc . $user->lang['RSS_CHAN_LIST_DESC'] . "\n\n" . $forum_stats;
			$this->gym_master->parse_item($item_tile, $item_desc, $chan_link, $chan_source, $this->outputs['last_mod_time']);
			// Grabb the forum data
			$this->list_forums();
		} else { // Main feeds
			// Grabb forums info
			$forum_data = array();
			$sql = "SELECT * 
				FROM " . FORUMS_TABLE . "
					WHERE forum_id " . $this->options['not_in_id_sql'] . "
				ORDER BY forum_last_post_id " . $this->module_config['rss_sort'];
			$result = $db->sql_query($sql);
			while ($row = $db->sql_fetchrow($result)) {
				$forum_data[$row['forum_id']] = $row;
			}
			$db->sql_freeresult($result);
			unset($row);
			// Build sql components
			$topic_forum_sql = '';
			if ($this->module_config['rss_limit_time'] > 0 ) {
				$time_limit = ($this->outputs['time'] - $this->module_config['rss_limit_time']);
				$time_limit_sql = "topic_last_post_time > $time_limit AND ";
			} else {
				$time_limit_sql = '';
			}
			// Count topics
			$sql = "SELECT COUNT(topic_id) AS topic
				FROM " . TOPICS_TABLE . "
				WHERE forum_id " . $this->options['not_in_id_sql'] . "
					AND $time_limit_sql
					topic_status <> " . ITEM_MOVED . "
					AND topic_approved = 1 AND topic_reported = 0
				ORDER BY topic_last_post_id " . $this->module_config['rss_sort'];
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$forum_data['topic_count'] = ( $row['topic'] ) ? $row['topic'] : 1;
			$db->sql_freeresult($result);
			unset($row);
			$forum_sql = !empty($this->options['not_in_id_sql']) ? 't.forum_id ' . $this->options['not_in_id_sql'] . ' AND ' : '';
			$this->list_topics($forum_sql, $forum_data);
		}
		// Add the local counting, since we are cycling through modules
		$this->outputs['url_sofar_total'] = $this->outputs['url_sofar_total'] + $this->outputs['url_sofar'];
		return;
	}
	/**
	* rss_module() will build the module's specific sub feeds,
	* @access private
	*/
	function html_module() {
		global $user, $db, $phpbb_seo, $auth, $config;
		$forum_sql = '';
		$time_limit = '';
		$forum_data['topic_count'] = 0;
		if ($this->options['module_sub'] == 'channels') { // Module channel list
			//If so check for dupes and build channel header
			$chan_source = $this->module_config['rss_url'] . $this->url_settings['rss_forum_default'] . $this->url_settings['extra_params_delimE'] . $this->url_settings['extra_params'] . $this->url_settings['rss_forum_ext'];
			// Kill dupes
			$this->gym_master->seo_kill_dupes($chan_source);

			$chan_title = $this->module_config['rss_sitename'];
			$chan_desc = '<h2>' . $this->module_config['rss_sitename'] . '</h2>' . $this->module_config['rss_site_desc'] . "\n" . $user->lang['RSS_CHAN_LIST_DESC'] . "\n\n";
				
			// Forum stats
			$site_stats = '<b>' . $user->lang['STATISTICS'] . '</b> : ' . sprintf($user->lang['TOTAL_USERS_OTHER'], $config['num_users']) . ' || ';
			$site_stats .= sprintf($user->lang['TOTAL_TOPICS_OTHER'], $config['num_topics']) . ' || ';
			$site_stats .= sprintf($user->lang['TOTAL_POSTS_OTHER'], $config['num_posts']) . "\n";

			$site_stats .= ($this->module_config['rss_allow_profile'] ? "\n" . sprintf($user->lang['NEWEST_USER'], $this->gym_master->username_string($config['newest_user_id'], $config['newest_username'], $config['newest_user_colour'], $this->module_config['rss_allow_profile_links']) ) : '') . "\n\n";
			$this->gym_master->parse_channel($chan_title, $chan_desc, $phpbb_seo->seo_path['phpbb_url'],  $this->outputs['last_mod_time'], $this->module_config['rss_image_url']);
			$this->gym_master->parse_item($chan_title, $chan_desc . $site_stats, $phpbb_seo->seo_path['phpbb_url'],  $chan_source, $this->outputs['last_mod_time']);
			$this->list_forums();
			return;
		} else { // Module feeds
			// Filter $this->options['module_sub'] var type
			$this->options['module_sub'] = intval($this->options['module_sub']);
			if ($this->options['module_sub'] > 0) { // Forum Feed
				$forum_sql = ' t.forum_id = ' . $this->options['module_sub'] . ' AND ';
				// Check forum auth and grab necessary infos			
				$sql = "SELECT * 
					FROM ". FORUMS_TABLE ." AS f
					WHERE forum_id = " . $this->options['module_sub'];
					$result = $db->sql_query($sql);
					$forum_data = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);
					if ( empty($forum_data) ) {
						$this->gym_master->gym_error(500, 'GYM_ERROR_DATA', __FILE__, __LINE__, $sql);
					}
					$forum_id = (int) $forum_data['forum_id'];
					if ( $forum_data['forum_type'] !=  FORUM_POST || in_array($forum_id, $this->module_config['exclude_list']) ) {
						$this->gym_master->gym_error(401, 'GYM_NOT_AUTH');
					}
					// This forum is allowed, so let's start
					$this->forum_cache[$forum_id]['forum_name_ok'] =  $phpbb_seo->format_url($forum_data['forum_name'], $phpbb_seo->seo_static['forum']);
					// Build the forum's RSS feed's URL
					// Do it in two steps to allow yahoo Notifications
					$forum_rss_url =   $this->module_config['rss_url'] .  ( !empty($this->url_settings['rss_forum_pre']) ? $this->url_settings['rss_forum_pre'] : $this->forum_cache[$forum_id]['forum_name_ok'] . $this->url_settings['rss_forum_delim']) .  $forum_id;
					// Build Yahoo notify URL
					// If the URL is not rewritten, we cannot use "&" and output a long list.
					if ($this->module_config['rss_yahoo_notify']) {
						if ( $this->url_settings['modrewrite'] && $this->module_config['allow_long'] && $this->module_config['yahoo_notify_long']) {
							$this->module_config['rss_yahoo_notify_url'] = $forum_rss_url . ( ($this->url_settings['modrewrite'])? '-l' : '&amp;l') . $this->url_settings['rss_forum_ext'];
						} else {
							$this->module_config['rss_yahoo_notify_url'] = $forum_rss_url . $this->url_settings['rss_forum_ext'];
						}
					}
					$forum_rss_url .= $this->url_settings['extra_params_delimE'] . $this->url_settings['extra_params'] . $this->url_settings['rss_forum_ext'];
					// Kill dupes
					$this->gym_master->seo_kill_dupes($forum_rss_url);
					// Properly set the limits
					$forum_data['topic_count'] = $this->forum_cache[$forum_id]['forum_topics'] = $forum_data['forum_topics'];
					// In case the forum called for a feed is really big, apply time limit
					if ( $this->module_config['rss_limit_time'] > 0 && $this->module_config['rss_url_limit'] < $forum_data['topic_count']) {
						$time_limit = ($this->outputs['time'] - $this->module_config['rss_limit_time']);
						// So let's count topic in this forum
						$sql = "SELECT COUNT(topic_id) AS forum_topics
							FROM " . TOPICS_TABLE . "
							WHERE forum_id = $forum_id
								AND topic_last_post_time > $time_limit
								AND topic_status <> " . ITEM_MOVED . " AND topic_approved = 1 AND topic_reported = 0
							ORDER BY topic_last_post_id " . $this->module_config['rss_sort'];
						$result = $db->sql_query($sql);
						$row = $db->sql_fetchrow($result);
						$forum_data['topic_count'] = ( $row['forum_topics'] ) ? $row['forum_topics'] : 1;
						$db->sql_freeresult($result);
						unset($row);
						// now check if we've got still enough topic to ouptut
						if ( $forum_data['topic_count'] <= $this->module_config['rss_url_limit'] ) {
							$time_limit = 0;
						}
					}
					$this->forum_cache[$forum_id]['approve'] = $auth->acl_get('m_approve', $forum_id);
					if ($this->forum_cache[$forum_id]['approve']) {
						$topics_count = $forum_data['forum_topics_real'];
						$this->forum_cache[$forum_id]['replies_key'] = 'topic_replies_real';
					} else {
						$topics_count = $forum_data['forum_topics'];
						$this->forum_cache[$forum_id]['replies_key'] = 'topic_replies';
					}
					$this->forum_cache[$forum_id]['forum_rss_url'] = $forum_rss_url;
					$chan_title = $this->forum_cache[$forum_id]['forum_name'] = $forum_data['forum_name'];
					$this->forum_cache[$forum_id]['forum_url'] = $phpbb_seo->seo_path['phpbb_urlR'] . (!empty($this->url_settings['forum_pre']) ? $this->url_settings['forum_pre'] : $phpbb_seo->set_url($forum_data['forum_name'], $forum_id, $phpbb_seo->seo_static['forum']) ) . $forum_id . $this->url_settings['forum_ext'];
					$this->forum_cache[$forum_id]['forum_url_full'] = $this->gym_master->parse_link($this->forum_cache[$forum_id]['forum_url'], $this->forum_cache[$forum_id]['forum_name']);
					// Build Chan info
					// Forum stats
					$forum_stats = '<b>' . $user->lang['STATISTICS'] . '</b> : ' . $forum_data['forum_topics'] . ' ' . (($forum_data['forum_topics'] >= 0) ? $user->lang['TOPICS'] : $user->lang['TOPIC'] );
					$forum_stats .= ' || ' . $forum_data['forum_posts'] . ' ' . (($forum_data['forum_posts'] >= 0) ? $user->lang['POSTS'] : $user->lang['POST'] );
					// Forum rules ?
					$forum_rules = ($this->module_config['rss_forum_rules'] && $forum_data['forum_rules']) ? generate_text_for_display($forum_data['forum_rules'], $forum_data['forum_rules_uid'], $forum_data['forum_rules_bitfield'], $forum_data['forum_rules_options']) : '';
					$forum_desc = generate_text_for_display($forum_data['forum_desc'], $forum_data['forum_desc_uid'], $forum_data['forum_desc_bitfield'], $forum_data['forum_desc_options']);
					// Is this item public ?
					$this->rss_config['rss_auth_msg'] = ($this->gym_master->is_forum_public($forum_id)) ? '' :  $user->lang['RSS_AUTH_THIS'];
					// Profiles
					$lastposter = '';
					if ($this->module_config['rss_allow_profile_links'] ) { 
						$lastposter = $user->lang['GYM_LAST_POST_BY'] . $this->gym_master->username_string($forum_data['forum_last_poster_id'], $forum_data['forum_last_poster_name'], $forum_data['forum_last_poster_colour'], $this->module_config['rss_allow_profile_links']) . "\n\n";
					}
					$chan_desc = '<h2>' . $chan_title . '</h2>' . $forum_desc . $forum_rules . "\n\n" . $forum_stats . "\n\n" . $lastposter;
					$chan_image = !empty($forum_data['forum_image']) ? $forum_data['forum_image'] : $this->module_config['rss_image_url'];
					$this->gym_master->parse_channel($chan_title, $chan_desc, $this->forum_cache[$forum_id]['forum_url'], $forum_data['forum_last_post_time'], $chan_image);
			} else { // module Rss
				$forum_sql = !empty($this->options['not_in_id_sql']) ? ' t.forum_id ' . $this->options['not_in_id_sql'] . ' AND ' : '';
				$chan_source = $this->module_config['rss_url'] . $this->url_settings['rss_forum_default'] . $this->url_settings['extra_params_delimE'] . $this->url_settings['extra_params'] . $this->url_settings['rss_forum_ext'];
				$this->gym_master->seo_kill_dupes($chan_source);
		
				// Forum stats
				$forum_stats = '<b>' . $user->lang['STATISTICS'] . '</b> : ' . sprintf($user->lang['TOTAL_USERS_OTHER'], $config['num_users']) . ' || ';
				$forum_stats .= sprintf($user->lang['TOTAL_TOPICS_OTHER'], $config['num_topics']) . ' || ';
				$forum_stats .= sprintf($user->lang['TOTAL_POSTS_OTHER'], $config['num_posts']) . "\n\n";

				$forum_stats .= ($this->module_config['rss_allow_profile']) ? "\n" . sprintf($user->lang['NEWEST_USER'], $this->gym_master->username_string($config['newest_user_id'], $config['newest_username'], $config['newest_user_colour'])) . "\n\n" : '';
		
				// Chan info
				$chan_title = $this->module_config['rss_sitename'];
				$chan_desc = '<h2>' . $chan_title . '</h2>' . $this->module_config['rss_site_desc'] . "\n\n";

				$forum_image = sprintf($this->gym_master->style_config['rsschan_img_tpl'], $chan_title, $this->module_config['rss_image_url'], $phpbb_seo->seo_path['phpbb_url']);
				$chan_time = gmdate('D, d M Y H:i:s \G\M\T', $this->outputs['last_mod_time']);
				$this->gym_master->parse_channel($chan_title, $chan_desc, $phpbb_seo->seo_path['phpbb_url'],  $this->outputs['last_mod_time'], $this->module_config['rss_image_url']);
				$this->gym_master->parse_item($chan_title, $chan_desc . $forum_stats, $phpbb_seo->seo_path['phpbb_url'],  $chan_source, $this->outputs['last_mod_time']);
				// Grabb forums info
				$forum_data = array();
				$sql = "SELECT * 
					FROM " . FORUMS_TABLE . "
						WHERE forum_id " . $this->options['not_in_id_sql'] . "
					ORDER BY forum_last_post_id " . $this->module_config['rss_sort'];
				$result = $db->sql_query($sql);
				while ($row = $db->sql_fetchrow($result)) {
					$forum_data[$row['forum_id']] = $row;
				}
				$db->sql_freeresult($result);
				unset($row);
				// Build sql components
				$time_limit_sql = '';
				if ($this->module_config['rss_limit_time'] > 0 ) {
					$time_limit = ($this->outputs['time'] - $this->module_config['rss_limit_time']);
					$time_limit_sql = "t.topic_last_post_time > $time_limit AND ";
				} else {
					$time_limit_sql = '';
				}
				$sql = "SELECT COUNT(topic_id) AS topic
					FROM " . TOPICS_TABLE . " AS t
					WHERE forum_id " . $this->options['not_in_id_sql'] . "
						AND $time_limit_sql
						t.topic_status <> " . ITEM_MOVED . "
						AND topic_approved = 1 AND topic_reported = 0
					ORDER BY t.topic_last_post_id " . $this->module_config['rss_sort'];
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$forum_data['topic_count'] = ( $row['topic'] ) ? $row['topic'] : 1;
				$db->sql_freeresult($result);
				unset($row);
			}
			$this->list_topics($forum_sql, $forum_data, $time_limit);
		}
		
	}
	/**
	* list_forums() builds the output for forum listing
	* From a forum and from all forums
	* @access private
	*/
	function list_forums() {
		global $db, $user, $phpbb_seo;
		$sql = "SELECT * 
			FROM " . FORUMS_TABLE . "
				WHERE forum_id " . $this->options['not_in_id_sql'] . "
			ORDER BY forum_last_post_id " . $this->module_config['rss_sort'];
		$result = $db->sql_query($sql);
		while( $forum_data = $db->sql_fetchrow($result) ) {
			$forum_id = (int) $forum_data['forum_id'];
			// Build Chan info
			$forum_stats = '<b>' . $user->lang['STATISTICS'] . '</b> : ' . $forum_data['forum_topics'] . ' ' . (($forum_data['forum_topics'] >= 0) ? $user->lang['TOPICS'] : $user->lang['TOPIC'] );
			$forum_stats .= ' || ' . $forum_data['forum_posts'] . ' ' . (($forum_data['forum_posts'] >= 0) ? $user->lang['POSTS'] : $user->lang['POST'] ) . "\n\n";
			// Forum rules ?
			$forum_rules = ($this->module_config['rss_forum_rules'] && $forum_data['forum_rules']) ? generate_text_for_display($forum_data['forum_rules'], $forum_data['forum_rules_uid'], $forum_data['forum_rules_bitfield'], $forum_data['forum_rules_options']) . "\n\n" : '';
			$forum_desc = generate_text_for_display($forum_data['forum_desc'], $forum_data['forum_desc_uid'], $forum_data['forum_desc_bitfield'], $forum_data['forum_desc_options']) ;
			$forum_desc .=  !empty($forum_desc) ? "\n\n" : '';
			// Is this item public ?
			$this->module_config['rss_auth_msg'] = ($this->gym_master->is_forum_public($forum_id)) ? '' :  $user->lang['RSS_AUTH_THIS'];
			$item_title = $forum_data['forum_name'];
			// Profiles
			$lastposter = '';
			if ($this->module_config['rss_allow_profile_links'] && !empty($forum_data['forum_last_poster_id'])) { 
				$lastposter = $user->lang['GYM_LAST_POST_BY'] . $this->gym_master->username_string($forum_data['forum_last_poster_id'], $forum_data['forum_last_poster_name'], $forum_data['forum_last_poster_colour'], $this->module_config['rss_allow_profile_links']) . "\n\n";
			}
			$item_desc = '<h2>' . $item_title . '</h2>' . $forum_desc . $forum_rules . $forum_stats . $lastposter;
			$forum_name_ok =  $phpbb_seo->format_url($forum_data['forum_name'], $phpbb_seo->seo_static['forum']);
			// Build URLs
			$forum_rss_url =   $this->module_config['rss_url'] .  (!empty($this->url_settings['rss_forum_pre']) ? $this->url_settings['rss_forum_pre'] : $forum_name_ok . $this->url_settings['rss_forum_delim'] ) . $forum_id . $this->url_settings['extra_params_delimE'] . $this->url_settings['extra_params'] . $this->url_settings['rss_forum_ext'];
			$forum_url = $phpbb_seo->seo_path['phpbb_urlR'] . (!empty($this->url_settings['forum_pre']) ? $this->url_settings['forum_pre'] : $forum_name_ok . $phpbb_seo->seo_delim['forum']) . $forum_id .  $this->url_settings['forum_ext'];
			$this->gym_master->parse_item($item_title, $item_desc, $forum_url, $forum_rss_url, $forum_data['forum_last_post_time']);
		} // End forum list loop
		$db->sql_freeresult($result);
		unset ($forum_data);
	}
	/**
	* list_topics() builds the output for topic listing
	* From a forum and from all forums
	* @access private
	*/
	function list_topics($forum_sql, $forum_data, $time_limit = 0) {
		global $config, $db, $phpbb_seo, $auth, $user;
		// Build sql components all remaining cases
		$msg_sql1 = $msg_sql2 = $msg_sql3 = '';
		$time_limit = $time_limit > 0 ? "t.topic_last_post_time > $time_limit AND " : '';
		if ( $this->options['rss_content'] ) {
			if($this->module_config['rss_last']) { // Go for last post content
				$msg_sql1 = ", p.post_id, p.enable_bbcode, p.enable_smilies, p.enable_magic_url, p.enable_sig, p.post_subject, p.post_text, p.post_attachment, p.bbcode_bitfield, p.bbcode_uid, p.post_edit_time";
				$msg_sql2 = ", " . POSTS_TABLE . " AS p ";
				$msg_sql3 = " AND p.post_id = t.topic_last_post_id AND post_approved = 1 AND post_reported = 0 ";
			}
			if($this->module_config['rss_first']) { // First post as well ?
				$msg_sql1 .= " , pF.post_id as pF.post_id, pF.enable_bbcode as enable_bbcodeF, pF.enable_smilies as enable_smiliesF, pF.enable_magic_url as enable_magic_urlF, pF.enable_sig as enable_sigF, pF.post_subject as post_subjectF, ptF.post_text as post_textF, pF.post_attachment as post_attachmentF, pF.bbcode_bitfield as bbcode_bitfieldF, pF.bbcode_uid as bbcode_uidF, pF.post_edit_time as post_edit_timeF ";
				$msg_sql2 .= ", " . POSTS_TABLE . " as pF ";
				$msg_sql3 .= " AND pF.post_id = t.topic_first_post_id AND post_approved = 1 AND post_reported = 0 ";
			}
		}
		$sql_first = "SELECT t.* $msg_sql1
			FROM " . TOPICS_TABLE . " AS t $msg_sql2
			WHERE $forum_sql $time_limit t.topic_status <> " . ITEM_MOVED . "
				AND t.topic_approved = 1 AND t.topic_reported = 0
				$msg_sql3
				ORDER BY t.topic_last_post_id " . $this->module_config['rss_sort'];
		// Absolute limit 
		$topic_sofar = 0;
		$topics = array();
		$paginated = $config['posts_per_page'];
		// Do the loop
		while( ( $topic_sofar <  $forum_data['topic_count'] ) && ($this->outputs['url_sofar'] < $this->module_config['rss_url_limit']) ) {
			$sql = $sql_first . " LIMIT $topic_sofar," . $this->module_config['rss_sql_limit'];
			$result = $db->sql_query($sql);
			while ($topic = $db->sql_fetchrow($result)) {
				// In case we are looking for more than one forum
				$forum_id = (int) $topic['forum_id'];
				// In case we are going to output forum data many times, let's build this once
				if (empty($this->forum_cache[$forum_id])) {
					// Set mod rewrite & type
					$this->forum_cache[$forum_id]['forum_name_ok'] =  $phpbb_seo->format_url($forum_data[$forum_id]['forum_name'], $phpbb_seo->seo_static['forum']) ;
					$this->forum_cache[$forum_id]['forum_rss_url'] = $this->module_config['rss_url'] .  ( !empty($this->url_settings['rss_forum_pre']) ? $this->url_settings['rss_forum_pre'] . $forum_id : $this->forum_cache[$forum_id]['forum_name_ok'] . $this->url_settings['rss_forum_delim'] .  $forum_id) . $this->url_settings['extra_params_delimE'] . $this->url_settings['extra_params'] . $this->url_settings['rss_forum_ext'];
					$this->forum_cache[$forum_id]['forum_url'] = $phpbb_seo->seo_path['phpbb_urlR'] . (!empty($this->url_settings['forum_pre']) ? $this->url_settings['forum_pre'] : $phpbb_seo->set_url($forum_data['forum_name'], $forum_id, $phpbb_seo->seo_static['forum']) ) . $forum_id . $this->url_settings['forum_ext'];
					$this->forum_cache[$forum_id]['forum_name'] = $forum_data[$forum_id]['forum_name'];
					$this->forum_cache[$forum_id]['approve'] = $auth->acl_get('m_approve', $forum_id);
					$this->forum_cache[$forum_id]['replies_key'] = ($this->forum_cache[$forum_id]['approve']) ? 'topic_replies_real' : 'topic_replies';
					$this->forum_cache[$forum_id]['forum_url_full'] = $this->gym_master->parse_link($this->forum_cache[$forum_id]['forum_url'], $this->forum_cache[$forum_id]['forum_name']);
				}
				$pages = ceil( ($topic[$this->forum_cache[$forum_id]['replies_key']] + 1) / $paginated);
				$topic['topic_title'] = censor_text($topic['topic_title']);
				$topic['topic_replies'] = $topic[$this->forum_cache[$forum_id]['replies_key']];
				$topic_stats = '<b>' . $user->lang['STATISTICS'] . '</b> : ' . ($topic['topic_replies'] + 1) . ' ' . (($topic['topic_replies'] > 1) ? $user->lang['REPLIES'] : $user->lang['POST'] );
				$topic_stats .= ' || ' . ($topic['topic_views'] + 1) . ' ' . $user->lang['VIEWS'] . "\n\n";
				$topic['topic_url'] = $phpbb_seo->seo_path['phpbb_urlR'] . (($this->url_settings['topic_pre'] !='') ? $this->url_settings['topic_pre'] . $topic['topic_id'] :  $phpbb_seo->format_url($topic['topic_title'], $phpbb_seo->seo_static['topic']) . $phpbb_seo->seo_delim['topic'] .  $topic['topic_id']);
				$has_reply = ($topic['topic_last_post_id'] > $topic['topic_first_post_id']) ? TRUE : FALSE;
				
				// Is this item public ?
				$this->module_config['rss_auth_msg'] = ($this->gym_master->is_forum_public($forum_id)) ? '' :  $user->lang['RSS_AUTH_THIS'];

				// Do we output the topic URL
				if( $has_reply && $this->module_config['rss_first']) {
					$topic['topic_urlF'] = $topic['topic_url'] . $this->url_settings['topic_ext'];
					$first_message = '';
					// With the msg content
					if ($this->options['rss_content'] && @$topic['post_idF']) {
						$first_message = $this->gym_master->prepare_for_output( $topic, 'F' );
					}
					// Profiles
					$lastposter = '';
					if ($this->module_config['rss_allow_profile_links']  && !empty($topic['topic_first_poster_id'])) { 
						$lastposter = $user->lang['GYM_LAST_POST_BY'] .$this->gym_master->username_string($topic['topic_first_poster_id'], $topic['topic_first_poster_name'], $topic['topic_first_poster_colour'], $this->module_config['rss_allow_profile_links']) . "\n\n";
					}
					$item_desc = '<h2>' .  $this->gym_master->parse_link($topic['topic_url'], $topic['topic_title']) .  '</h2><h3>' .$this->forum_cache[$forum_id]['forum_url_full'] . '</h3>'  .  $first_message. "\n" . $topic_stats . $lastposter;
					$this->gym_master->parse_item($topic['topic_title'], $item_desc, $topic['topic_urlF'],  $this->forum_cache[$forum_id]['forum_rss_url'], $topic['topic_last_post_time']);
				}
				// Do we output the last post URL
				if ( $this->module_config['rss_last'] || !$has_reply) {
					$start = ($pages > 1) ? $this->url_settings['start_delim'] . $paginated * ($pages-1) : '';
					$post_num = '';
					$item_title = $topic['topic_title'];
					$profile_key = 'first';
					$user_id_key = 'topic_poster';
					if ($has_reply ) {
						$item_title = !empty($topic['post_subject']) ? $topic['post_subject'] : $topic['topic_title'];

						$post_num = '#' . $topic['topic_last_post_id'];
						$profile_key = 'last';
						$user_id_key = 'topic_last_poster_id';
					}
					$post_num = ($has_reply) ? '#' . $topic['topic_last_post_id'] : '';
					$topic['topic_url'] .= $start . $this->url_settings['topic_ext'] . $post_num;
					// With the msg content
					$last_message = '';
					if ($this->options['rss_content'] && @$topic['post_id']) {
						$last_message = $this->gym_master->prepare_for_output( $topic );
					}
					// Profiles
					$lastposter = '';
					if ($this->module_config['rss_allow_profile_links'] && !empty($topic[$user_id_key]) ) { 
						$lastposter = $user->lang['GYM_' . strtoupper($profile_key) . '_POST_BY'] .$this->gym_master->username_string($topic[$user_id_key], $topic['topic_' . $profile_key . '_poster_name'], $topic['topic_' . $profile_key . '_poster_colour'], $this->module_config['rss_allow_profile_links']) . "\n\n";
					}
					$item_desc = '<h2>' . $this->gym_master->parse_link($topic['topic_url'], $item_title) .  '</h2><h3>' . $this->forum_cache[$forum_id]['forum_url_full'] . '</h3>' .  $last_message . "\n" . $topic_stats .  $lastposter;

					$this->gym_master->parse_item($item_title, $item_desc, $topic['topic_url'],  $this->forum_cache[$forum_id]['forum_rss_url'], $topic['topic_last_post_time']);
				}
			}// End topic loop
			// Used to separate query
			$topic_sofar = $topic_sofar + $this->module_config['rss_sql_limit'];
			$db->sql_freeresult($result);
			unset($topic);
		}// End Query limit loop
		unset($forum_data, $this->forum_cache);
	}
}
?>
