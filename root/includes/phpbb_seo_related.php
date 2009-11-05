<?php
/**
*
* @package phpBB SEO Related topics
* @version $Id$
* @copyright (c) 2006 - 2009 www.phpbb-seo.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB')) {
	exit;
}
/**
* seo_related Class
* www.phpBB-SEO.com
* @package phpBB SEO Related topics
*/
class seo_related {
	var $fulltext = true;
	var $limit = 5;
	var $allforums = false;
	var $myisam = true;
	var $check_ignore = true;
	/**
	* constructor
	*/
	function seo_related() {
		global $db, $config;
		if ($db->sql_layer != 'mysql4' && $db->sql_layer != 'mysqli') {
			$this->fulltext = false;
		} else {
			if (!isset($config['seo_related_myisam'])) {
				// check engine type
				$result = $db->sql_query('SHOW TABLE STATUS LIKE \'' . TOPICS_TABLE . '\'');
				$info = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);
				$engine = '';
				if (isset($info['Engine'])) {
					$engine = $info['Engine'];
				} else if (isset($info['Type'])) {
					$engine = $info['Type'];
				}
				set_config('seo_related_myisam', ($engine == 'MyISAM') ? 1 : 0);
			}
			$this->fulltext = $config['seo_related_myisam'] ? $this->fulltext : false;
		}
		$this->limit = !empty($config['seo_related_limit']) ? max(0, (int) $config['seo_related_limit']) : $this->limit;
		$this->allforums = !empty($config['seo_related_allforums']) ? true : $this->allforums;
		$this->check_ignore = !empty($config['seo_related_check_ignore']) ? true : $this->check_ignore;
	}
	/**
	* get related list
	*/
	function get($topic_data, $forum_id = false) {
		global $db, $auth, $cache, $template, $user, $phpEx, $phpbb_root_path, $topic_tracking_info, $phpbb_seo;
		$related_result = false;
		$enable_icons = 0;
		$this->allforums = !$forum_id ? true : $this->allforums;
		$sql = $this->build_query($topic_data, $forum_id);
		if ($sql && ($result = $db->sql_query_limit($sql, $this->limit))) {
			// Grab icons
			$icons = $cache->obtain_icons();
			$attachement_icon = $user->img('icon_topic_attach', $user->lang['TOTAL_ATTACHMENTS']);
			$s_attachement = $auth->acl_get('u_download');
			while($row = $db->sql_fetchrow($result)) {
				$related_forum_id = (int) $row['forum_id'];
				$related_topic_id = (int) $row['topic_id'];
				$enable_icons = max($enable_icons, $row['enable_icons']);
				if ($auth->acl_get('f_list', $related_forum_id)) {
					$row['topic_title'] = censor_text($row['topic_title']);
					// www.phpBB-SEO.com SEO TOOLKIT BEGIN
					if (!empty($phpbb_seo->seo_opt['url_rewrite'])) {
						$phpbb_seo->set_url($row['forum_name'], $related_forum_id, $phpbb_seo->seo_static['forum']);
						$phpbb_seo->prepare_iurl($row, 'topic', $row['topic_type'] == POST_GLOBAL ? $phpbb_seo->seo_static['global_announce'] : $phpbb_seo->seo_url['forum'][$related_forum_id]);
					}
					// www.phpBB-SEO.com SEO TOOLKIT END
					// Replies
					$replies = ($auth->acl_get('m_approve', $related_forum_id)) ? $row['topic_replies_real'] : $row['topic_replies'];
					$unread_topic = (isset($topic_tracking_info[$related_topic_id]) && $row['topic_last_post_time'] > $topic_tracking_info[$related_topic_id]) ? true : false;
					$view_topic_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=$related_forum_id&amp;t=$related_topic_id");
					$topic_unapproved = (!$row['topic_approved'] && $auth->acl_get('m_approve', $related_forum_id)) ? true : false;
					$u_mcp_queue = ($topic_unapproved) ? append_sid("{$phpbb_root_path}mcp.$phpEx", "i=queue&amp;mode=approve_details&amp;t=$related_topic_id", true, $user->session_id) : '';
					// Get folder img, topic status/type related information
					$folder_img = $folder_alt = $topic_type = '';
					topic_status($row, $replies, $unread_topic, $folder_img, $folder_alt, $topic_type);
					// www.phpBB-SEO.com SEO TOOLKIT BEGIN -> no dupe
					if (!empty($phpbb_seo->seo_opt['no_dupe']['on'])) {
						if (($replies + 1) > $phpbb_seo->seo_opt['topic_per_page']) {
							$phpbb_seo->seo_opt['topic_last_page'][$related_topic_id] = floor($replies / $phpbb_seo->seo_opt['topic_per_page']) * $phpbb_seo->seo_opt['topic_per_page'];
						}
					}
					// www.phpBB-SEO.com SEO TOOLKIT END -> no dupe
					$template->assign_block_vars('related', array(
						'TOPIC_TITLE' => $row['topic_title'],
						'U_TOPIC' => $view_topic_url,
						'U_FORUM' => $this->allforums ? append_sid("{$phpbb_root_path}viewforum.$phpEx", "f=$related_forum_id") : '',
						'FORUM' => $row['forum_name'],
						'PAGINATION' => topic_generate_pagination($replies, $view_topic_url),
						'REPLIES' => $replies,
						'VIEWS' => $row['topic_views'],
						'FIRST_POST_TIME' => $user->format_date($row['topic_time']),
						'LAST_POST_TIME' => $user->format_date($row['topic_last_post_time']),
						'TOPIC_AUTHOR_FULL' =>  get_username_string('full', $row['topic_poster'], $row['topic_first_poster_name'], $row['topic_first_poster_colour']),
						'LAST_POST_AUTHOR_FULL' =>  get_username_string('full', $row['topic_last_poster_id'], $row['topic_last_poster_name'], $row['topic_last_poster_colour']),
						// www.phpBB-SEO.com SEO TOOLKIT BEGIN -> no dupe
						'U_LAST_POST' => !empty($phpbb_seo->seo_opt['no_dupe']['on']) ? append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=$related_forum_id&amp;t=$related_topic_id&amp;start=" . @intval($phpbb_seo->seo_opt['topic_last_page'][$related_topic_id])) . '#p' . $row['topic_last_post_id'] : append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=$related_forum_id&amp;t=$related_topic_id&amp;p=" . $row['topic_last_post_id']) . '#p' . $row['topic_last_post_id'],
						// www.phpBB-SEO.com SEO TOOLKIT END -> no dupe
						'TOPIC_FOLDER_IMG_SRC'	=> $user->img($folder_img, $folder_alt, false, '', 'src'),
						'TOPIC_FOLDER_IMG'	=> $user->img($folder_img, $folder_alt, false),
						'TOPIC_ICON_IMG' => (!empty($icons[$row['icon_id']])) ? $icons[$row['icon_id']]['img'] : '',
						'ATTACH_ICON_IMG' => ($row['topic_attachment'] && $s_attachement) ? $attachement_icon : '',
						'S_TOPIC_REPORTED' => (!empty($row['topic_reported']) && $auth->acl_get('m_report', $related_forum_id)) ? true : false,
						'S_UNREAD_TOPIC' => $unread_topic,
						'S_POST_ANNOUNCE' => ($row['topic_type'] == POST_ANNOUNCE) ? true : false,
						'S_POST_GLOBAL' => ($row['topic_type'] == POST_GLOBAL) ? true : false,
						'S_POST_STICKY' => ($row['topic_type'] == POST_STICKY) ? true : false,
						'S_TOPIC_LOCKED' => ($row['topic_status'] == ITEM_LOCKED) ? true : false,
						'S_TOPIC_UNAPPROVED' => $topic_unapproved,
						'U_MCP_REPORT' => append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=reports&amp;mode=reports&amp;f=' . $related_forum_id . '&amp;t=' . $related_topic_id, true, $user->session_id),
						'U_MCP_QUEUE' => $u_mcp_queue,
					));
					$related_result = true;
				}
			}
			$db->sql_freeresult($result);
		}
		if ($related_result) {
			$template->assign_vars(array(
				'S_RELATED_RESULTS' => $related_result,
				'LAST_POST_IMG' => $user->img('icon_topic_latest', 'VIEW_LATEST_POST'),
				'NEWEST_POST_IMG' => $user->img('icon_topic_newest', 'VIEW_NEWEST_POST'),
				'UNAPPROVED_IMG' => $user->img('icon_topic_unapproved', 'TOPIC_UNAPPROVED'),
				'REPORTED_IMG' => $user->img('icon_topic_reported', 'TOPIC_REPORTED'),
				'GOTO_PAGE_IMG' => $user->img('icon_post_target', 'GOTO_PAGE'),
				'S_TOPIC_ICONS' => $enable_icons,
			));
		}
	}
	/**
	* build_query
	*/
	function build_query($topic_data, $forum_id = false) {
		global $db;
		if (!($match = $this->prepare_match($topic_data['topic_title']))) {
			return false;
		}
		if (!$forum_id || $this->allforums) {
			global $auth;
			// Do not include those forums the user is not having read access to...
			$related_read_ary = $auth->acl_getf('f_read', true);
			$related_forum_ids = array();
			foreach ($related_read_ary as $_forum_id => $null) {
				$related_forum_ids[$_forum_id] = (int) $_forum_id;
			}
			$forum_sql = sizeof($related_forum_ids) ? $db->sql_in_set('t.forum_id', $related_forum_ids, false, true) . ' AND ' : '';
		} else {
			$forum_sql = ' t.forum_id = ' . (int) $forum_id . ' AND ';
		}
		$sql_array = array(
			'SELECT' => 't.*, f.forum_name, f.enable_icons',
			'FROM' => array(
				TOPICS_TABLE => 't',
				FORUMS_TABLE => 'f'
			),
			'WHERE' => "$forum_sql f.forum_id = t.forum_id",
		);
		if ($this->fulltext) {
			$sql_array['SELECT'] .= ", MATCH (t.topic_title) AGAINST ('" . $db->sql_escape($match) . "') relevancy";
			$sql_array['WHERE'] .= " AND MATCH (t.topic_title) AGAINST ('" . $db->sql_escape($match) . "')";
			$sql_array['ORDER_BY'] = 'relevancy DESC';
		} else {
			$sql_like = $this->buil_sql_like($match);
			if (!$sql_like) {
				return false;
			}
			$sql_array['WHERE'] .= " AND t.topic_title $sql_like";
			$sql_array['ORDER_BY'] = 't.topic_id DESC';
		}
		$sql_array['WHERE'] .= " AND t.topic_status <> " . ITEM_MOVED . "
			AND t.topic_id <> " . (int) $topic_data['topic_id'];
		return $db->sql_build_query('SELECT', $sql_array);
	}
	/**
	* prepare_match
	*/
	function prepare_match($text, $min_lenght = 3, $max_lenght = 14) {
		static $stop_words = array();
		$return = '';
		$text = utf8_strtolower(trim(preg_replace('`[\s]+`', ' ', $text)));
		$text = explode(' ', $text);
		if (!empty($text) && $this->check_ignore) {
			if (empty($stop_words)) {
				global $phpbb_root_path, $user, $phpEx;
				$words = array();
				if (file_exists("{$user->lang_path}{$user->lang_name}/search_ignore_words.$phpEx")){
					// include the file containing ignore words
					include("{$user->lang_path}{$user->lang_name}/search_ignore_words.$phpEx");
				}
				$stop_words = & $words;
			}
			$text = array_diff($text, $stop_words);
		}
		if (!empty($text)) {
			foreach ($text as $word) {
				$word = trim($word);
				if ( utf8_strlen($word) >= $min_lenght && utf8_strlen($word) <= $max_lenght) {
					$return .= " $word";
				}
			}
		}
		return $return;
	}
	/**
	* buil_sql_like
	*/
	function buil_sql_like($text, $min_lenght = 3, $limit = 3) {
		global $db;
		$sql_like = '';
		$i = 0;
		$text = str_replace(array('_', '%'), array("\_", "\%"), $text);
		$text = str_replace(array(chr(0) . "\_", chr(0) . "\%"), array('_', '%'), $text);
		$text = explode(' ', preg_replace('`[\s]+`', ' ', $text));
		if ( !empty($text) ) {
			foreach ($text as $word) {
				$word = $db->sql_escape(trim($word));
				$sql_like .= empty($sql_like) ? " LIKE '%$word%'" : " OR  '%$word%'";
				$i++;
				if ($i >= $limit) {
					return $sql_like;
				}
			}
		}
		return $sql_like;
	}
}
?>