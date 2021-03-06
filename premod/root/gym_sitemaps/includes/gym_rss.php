<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $Id$
* @copyright (c) 2006 - 2010 www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
// First basic security
if ( !defined('IN_PHPBB') ) {
	exit;
}
require($phpbb_root_path . 'gym_sitemaps/includes/gym_sitemaps.' . $phpEx);
/**
* gym_rss Class
* www.phpBB-SEO.com
* @package phpBB SEO
*/
class gym_rss extends gym_sitemaps {
	var	$rss_config = array();
	/**
	* constuctor
	*/
	function gym_rss() {
		global $phpbb_seo, $phpEx, $config, $user;
		global $db, $auth;
		$this->gym_sitemaps('rss');
		// init output
		$this->output_data['showstats'] = (boolean) ($this->gym_config['gym_showstats'] || $this->gym_config['rss_showstats']);
		// Check the main vars
		$this->init_get_vars();
		// url without IDs like forum feed url in case the phpBB SEO mod are used and set so
		// and basic parameter for url such as blabla/news/digest/long/module-rss.xml => gymrss.php?module=blabla&news&digest&long
		if ( isset($_GET['nametoid']) && !empty($_GET['nametoid']) && isset($_GET['modulename']) && !empty($_GET['modulename']) &&  empty($this->actions['module_main']) && empty($this->actions['module_sub']) ) {
			$module_name = trim(strtolower($_GET['modulename']));
			// is the module available ?
			if (in_array($module_name, $this->actions['action_modules'])) {
				$this->actions['module_main'] = $module_name;
				// Do we get an id (?module=id)
				if ($id = @array_search(trim($_GET['nametoid']), $phpbb_seo->cache_config[$module_name]) ) {
					$this->actions['module_sub'] = intval($id);
				} else { // Pass the variable to the script ?module_name=$_GET['nametoid']
					$this->actions['module_sub'] = trim(utf8_htmlspecialchars(str_replace(array("\n", "\r"), '', $_GET['nametoid'])));
				}
			}

		}
		if (empty($this->actions['action_modules'])) {
			$this->gym_error(404, '', __FILE__, __LINE__);
		}
		// Set last mod time from DB, will only be used as his for general feeds and channel lists
		// put it into phpbb config for the dynamic property.
		$config_name = $this->actions['action_type'] . '_' . (!empty($this->actions['module_main']) ? $this->actions['module_main'] . '_' : '') . 'last_mod_time';
		if (@$config[$config_name] < $config['board_startdate']) {
			set_config($config_name, $user->time_now, 1);
		}
		$this->output_data['last_mod_time'] = intval($config[$config_name]);
		// Init the output class
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
				'cache_born' => $this->output_data['last_mod_time'],
				'cache_max_age' => round($this->set_module_option('cache_max_age', $this->override['cache']),2) * 3600,
				'cache_file_ext' => ( $this->gym_output->gzip_config['gzip'] || $this->gym_config['rss_cache_force_gzip'] ) ? '.xml.gz' : '.xml',
			)
		);
		// Can you believe it, sprintf is faster than straight parsing.
		$this->style_config	= array(
			'rss_header' => '<'.'?xml version="1.0" encoding="utf-8"?'.'>%s' . "\n" . '<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/"' . "\n\t" . 'xmlns:content="http://purl.org/rss/1.0/modules/content/"' . "\n\t" . 'xmlns:atom="http://www.w3.org/2005/Atom">' . "\n" . '<!-- Generated by Google Yahoo MSN Sitemaps and RSS %s - &#169; 2006, ' . date('Y') . ' www.phpBB-SEO.com -->',
			'rss_footer' => "\n\t" . '</channel>' . "\n" . '</rss>',
			'rss_item_tpl' => "\n\t\t" . '<item>' . "\n\t\t\t" . '<title>%1$s</title>'. "\n\t\t\t" . '<link>%2$s</link>%3$s' . "\n\t\t\t" . '<description>%4$s</description>%8$s' . "\n\t\t\t" . '<source url="%5$s">%6$s</source>' . "\n\t\t\t" . '<guid isPermaLink="true">%7$s</guid>' . "\n\t\t" . '</item>',
			'rsschan_tpl' => "\n\t" . '<channel>' . "\n\t\t" . '<title>%1$s</title>' . "\n\t\t" . '<link>%2$s</link>' . "\n\t\t" . '<description>%3$s</description>%4$s' . "\n\t\t" . '%5$s' . "\n\t\t" . '<docs>http://blogs.law.harvard.edu/tech/rss</docs>' . "\n\t\t" . '<generator>Google Yahoo MSN Sitemaps and RSS ' . $this->gym_config['gym_version'] . ' - &#169; 2006, ' . date('Y') . ' www.phpBB-SEO.com</generator>%6$s' . "\n\t\t" . '<atom:link href="%7$s" rel="self" type="application/rss+xml" />%8$s',
			'rsschan_input_tpl' => "\n\t\t" . '<textInput>' . "\n\t\t\t" . '<title>%1$s</title>' . "\n\t\t\t" . '<description>%2$s</description>' . "\n\t\t\t" . '<link>%3$s</link>' . "\n\t\t\t" . '<name>%4$s</name>' . "\n\t\t" . '</textInput>' . "\n",
			'rsschan_img_tpl' => '<image>' . "\n\t\t\t" . '<title>%1$s</title>' . "\n\t\t\t" . '<url>%2$s</url>' . "\n\t\t\t" . '<link>%3$s</link>' . "\n\t\t" . '</image>',
			'chan_lastbuildate_tpl' => "\n\t\t" . '<lastBuildDate>%1$s</lastBuildDate>',
			'chan_ttl_tpl' => "\n\t\t" . '<ttl>%1$s</ttl>',
			'item_pubdate_tpl' => "\n\t\t\t" . '<pubDate>%1$s</pubDate>',
			'item_creator_tpl' => "\n\t\t\t" . '<dc:creator>%1$s</dc:creator>',
			'xslt_style' => '',
			'stats_genlist'	=> "\n" . '<!-- URL list generated in  %s s %s - %s sql - %s URLs listed -->',
			'stats_start' => "\n" . '<!--  Output started from cache after %s s - %s sql -->',
			'stats_nocache'	=> "\n" . '<!--  Output ended after %s s %s -->',
			'stats_end' => "\n" . '<!--  Output from cache ended up after %s s - %s sql -->',
		);
		$rss_limit_time = (int) $this->set_module_option('limit_time', $this->override['limit']);
		$rss_lang = trim($this->set_module_option('lang', $this->gym_config['rss_override']));
		$this->rss_config = array( 'rss_c_info' => ( !empty($this->gym_config['rss_c_info'])) ? "\n\t\t" . '<copyright>' . $this->xml_encode($this->gym_config['rss_c_info']) . '</copyright>' : '',
			'rss_xslt' => ( $this->gym_config['rss_xslt'] ) ? true : false,
			'rss_force_xslt' => ( $this->gym_config['rss_xslt'] && $this->gym_config['rss_force_xslt'] ) ? true : false,
			'rss_lang' => ( !empty($rss_lang) ) ? "\n\t\t" . '<language>' . $this->xml_encode($rss_lang) . '</language>' : '',
			'rss_url' => $phpbb_seo->sslify($this->gym_config['rss_url'], $phpbb_seo->ssl['use'], false),
			'rss_yahoo_appid' => ( !empty($this->gym_config['rss_yahoo_appid']) ) ? trim($this->gym_config['rss_yahoo_appid']) : '',
			// module specific settings we should often need in module
			// Some are used here to filter the allowed actions, will go to main default if unset in the module
			'rss_url_limit' => (int) $this->set_module_option('url_limit', $this->override['limit']),
			'rss_sql_limit' => (int) $this->set_module_option('sql_limit', $this->override['limit']),
			'rss_limit_time' => ( $rss_limit_time >= 0 ) ? $rss_limit_time*3600*24 : 0,
			'rss_modrewrite' => (int) $this->set_module_option('modrewrite', $this->override['modrewrite']),
			'rss_modrtype' => (int) $this->set_module_option('modrtype', $this->override['modrewrite']),
			'rss_sitename' => $this->set_module_option('sitename'),
			'rss_site_desc' => $this->set_module_option('site_desc'),
			'rss_logo_url' => $this->path_config['gym_img_url'] . trim($this->set_module_option('logo_url'), '/'),
			'rss_image_url' => $this->path_config['gym_img_url'] . trim($this->set_module_option('image_url'), '/'),
			'rss_sort' => $this->set_module_option('sort', $this->override['sort']),
			'rss_allow_auth' => (boolean) $this->set_module_option('allow_auth', $this->gym_config['rss_override']),
			'rss_cache_auth' => (boolean) $this->set_module_option('cache_auth', $this->gym_config['rss_override']),
			'rss_allow_content' => (boolean) $this->set_module_option('allow_content', $this->gym_config['rss_override']),
			'rss_allow_news' => (boolean) $this->set_module_option('allow_news', $this->gym_config['rss_override']),
			'rss_news_update' => round($this->set_module_option('news_update', $this->gym_config['rss_override']), 2) * 3600,
			'rss_allow_profile' => (boolean) $this->set_module_option('allow_profile', $this->gym_config['rss_override']),
			'rss_allow_profile_links' => (boolean) $this->set_module_option('allow_profile_links', $this->gym_config['rss_override']),
			'rss_sumarize' => (int) $this->set_module_option('sumarize', $this->gym_config['rss_override']),
			'rss_sumarize_method' => trim($this->set_module_option('sumarize_method', $this->gym_config['rss_override'])),
			'rss_allow_short' => (boolean) $this->set_module_option('allow_short', $this->gym_config['rss_override']),
			'rss_allow_long' => (boolean) $this->set_module_option('allow_long', $this->gym_config['rss_override']),
			'rss_allow_bbcode' => (boolean) $this->set_module_option('allow_bbcode', $this->gym_config['rss_override']),
			'rss_strip_bbcode' => trim($this->set_module_option('strip_bbcode', $this->gym_config['rss_override'])),
			'rss_allow_links' => (boolean) $this->set_module_option('allow_links', $this->gym_config['rss_override']),
			'rss_allow_emails' => (boolean) $this->set_module_option('allow_emails', $this->gym_config['rss_override']),
			'rss_allow_smilies' => (boolean) $this->set_module_option('allow_smilies', $this->gym_config['rss_override']),
			'rss_yahoo_notify' => (boolean) $this->set_module_option('yahoo_notify', $this->gym_config['rss_override']),
			'rss_nohtml' => (boolean) $this->set_module_option('nohtml', $this->gym_config['rss_override']),
			//@TODO add acp option for this ?
			'rss_display_author' => /*(boolean) $this->set_module_option('display_author', $this->gym_config['rss_override'])*/ true,
			'rss_yahoo_notify_url' => '',
			'rss_msg_filters' => array(),
			'rss_auth_msg' => '',
			'rss_do_explain' => false,
		);
		$this->rss_config['rss_auth_guest'] = ($this->rss_config['rss_allow_auth'] && $user->data['is_registered']) ? false : true;
		$this->cache_config['do_cache'] = $this->rss_config['rss_auth_guest'] ? true :  $this->rss_config['rss_cache_auth'];
		// remind for later
		$this->rss_config['rss_profile_mode'] = $this->rss_config['rss_allow_profile_links'] ? 'full' : 'no_profile';
		// Check the rss specific vars and do basic set_up for msg output
		$this->init_rss_vars();

		if (!$this->rss_config['rss_auth_guest']) {
			$this->rss_config['rss_auth_msg'] =  "\n" . ( ($this->actions['rss_channel_list'] || empty($this->actions['module_sub']) || $this->actions['module_sub'] == 'channels') ? sprintf($user->lang['RSS_AUTH_SOME_USER'], $user->data['username'] ) : sprintf($user->lang['RSS_AUTH_THIS_USER'], $user->data['username'] ) ) . "\n";
		}
		// Are we going to explain ?
		if (!empty($_REQUEST['explain']) && $auth->acl_get('a_') && defined('DEBUG_EXTRA') && method_exists($db, 'sql_report')) {
			$this->rss_config['rss_do_explain'] = true;
			$this->cache_config['do_cache'] = false;
		}
		$this->rss_output();
		if ($this->rss_config['rss_do_explain']) {
			$db->sql_report('display');
		} else {
			$this->gym_output->do_output();
		}
		return;
	}
	/**
	* init_rss_vars()
	* Set up the specific rss modules GET vars.
	* @access private
	*/
	function init_rss_vars() {
		global $user, $phpEx, $phpbb_seo;
		// Let's now check out if it's a GYM 1.x URL
		if ($this->gym_config['rss_1xredir'] && !empty($_GET['gym1x'])) {
			$this->actions['gym1x_newurl'] = '/' . (isset($_GET['m']) ? 'digest/' : '' ) . (isset($_GET['l']) ? 'long/' : (isset($_GET['s']) ? 'short/' : '' ) );
			$this->actions['gym1x_newurl'] = empty($this->actions['module_main']) ? 'rss' . $this->actions['gym1x_newurl'] . 'rss.xml' : (empty($_GET['gymtitle']) ? 'rss' .  $this->actions['gym1x_newurl'] . (!empty($this->actions['module_sub']) ? $this->actions['module_sub'] . '/' : '' ) . $this->actions['module_main'] . '.xml' : $phpbb_seo->set_url($_GET['gymtitle'], (int) $this->actions['module_sub'], 'forum') . $this->actions['gym1x_newurl'] . $this->actions['module_main'] . '.xml');
			// nothing else needed for this
			return;

		}
		$this->actions['rss_content'] = $this->actions['rss_short_list'] = $this->actions['rss_long_list'] = $this->actions['rss_channel_list'] = $this->actions['rss_news_list'] = false;
		$this->rss_config['extra_title'] = $this->url_config['extra_params_full'] = $this->url_config['extra_params'] = '';
		$this->url_config['rss_announces_path'] = $phpbb_seo->seo_static['global_announce'] . '/';
		// Channel list
		if ( ( $module_sub_chan = ($this->actions['module_sub'] === 'channels' ? true : false) ) || (isset($_GET['channels']) && empty($this->actions['module_main']) ) ) {
			$this->actions['rss_channel_list'] = true;
			$this->rss_config['extra_title'] = ' - ' . $user->lang['RSS_CHAN_LIST_TITLE'];
			if ($this->rss_config['rss_modrewrite'] || !$module_sub_chan) {
				$this->url_config['extra_params_full'] .= 'channels/';
			}
		}
		// News = first message only
		if ( isset($_GET['news']) && $this->rss_config['rss_allow_news']) {
			$this->actions['rss_news_list'] = true;
			$this->rss_config['extra_title'] .= ' - ' . $user->lang['RSS_NEWS'];
			$this->url_config['extra_params_full'] .= 'news/';
			$this->url_config['extra_params'] .= 'news/';
			if (!empty($this->rss_config['rss_news_update'])) {
				$this->cache_config['cache_max_age'] = $this->rss_config['rss_news_update'];
			}
			unset($_GET['channels']); // no channel listing
		}
		// Do we output text ?
		if ( isset($_GET['digest']) && $this->rss_config['rss_allow_content'] ) {
			$this->actions['rss_content'] = true;
			$this->rss_config['extra_title'] .= ' - ' . $user->lang['RSS_CONTENT'];
			$this->url_config['extra_params_full'] .= 'digest/';
			$this->url_config['extra_params'] .= 'digest/';
			$this->rss_config['rss_url_limit'] = intval($this->set_module_option('url_limit_msg', $this->gym_config['rss_override']));
			$this->rss_config['rss_sql_limit'] = intval($this->set_module_option('sql_limit_msg', $this->gym_config['rss_override']));
		}
		// Custom limits short
		if ( isset($_GET['short']) && $this->rss_config['rss_allow_short'] ) {
			$this->actions['rss_short_list'] = true;
			$this->rss_config['extra_title'] .= ' - ' . $user->lang['RSS_SHORT'];
			$this->url_config['extra_params_full'] .= 'short/';
			$this->url_config['extra_params'] .= 'short/';
			$this->rss_config['rss_url_limit'] = $this->actions['rss_content'] ? intval($this->rss_config['rss_url_limit']/3) : intval($this->set_module_option('url_limit_short', $this->gym_config['rss_override']));
			$this->rss_config['rss_sql_limit'] = $this->actions['rss_content'] ? intval($this->rss_config['rss_url_limit']/2) : intval($this->set_module_option('sql_limit_short', $this->gym_config['rss_override']));
		}
		// Custom limits long
		if ( isset($_GET['long']) && !$this->actions['rss_short_list'] && $this->rss_config['rss_allow_long'] ) {
			$this->actions['rss_long_list'] = true;
			$this->rss_config['extra_title'] .= ' - ' . $user->lang['RSS_LONG'];
			$this->url_config['extra_params_full'] .= 'long/';
			$this->url_config['extra_params'] .= 'long/';
			$this->rss_config['rss_url_limit'] = $this->actions['rss_content'] ? intval($this->rss_config['rss_url_limit']*3) : intval($this->set_module_option('url_limit_long', $this->gym_config['rss_override']));
			$this->rss_config['rss_sql_limit'] = $this->actions['rss_content'] ? intval($this->rss_config['rss_url_limit']*2) : intval($this->set_module_option('sql_limit_long', $this->gym_config['rss_override']));
		}
		// Adjust variable a bit
		if ($this->actions['rss_content'] ) { // requested and auth
			$this->rss_config['rss_msg_filters'] = $this->set_msg_strip($this->rss_config['rss_strip_bbcode']);
		}
		$this->url_config['extra_params_delimE'] = $this->url_config['extra_paramsE'] = '';
		$this->url_config['extra_params_delimQ'] = $this->url_config['extra_paramsQ'] = '';
		$this->url_config['rss_vpath'] = '';
		if ($this->rss_config['rss_modrewrite']) {
			$this->actions['extra_params'] = $this->url_config['extra_params'];
			$this->actions['extra_params_full'] = $this->url_config['extra_params_full'];
			$this->url_config['extra_params_delimE'] = '/';
			$this->url_config['extra_params_delimQ'] = '?';
			$this->url_config['rss_vpath'] = 'rss/'; // virtual rss path for forum RSS feed URLs etc ...
			$this->url_config['rss_default'] = 'rss.xml' . $this->url_config['gzip_ext_out'] ;
			if (!empty($this->url_config['extra_params'])) {
				$this->url_config['extra_paramsE'] = $this->url_config['extra_params'];
				$this->url_config['extra_paramsQ'] = $this->url_config['extra_params_delimQ'] . $this->url_config['extra_params'];
			}
		} else {
			$this->url_config['extra_params'] = str_replace('/', '&amp;', trim($this->url_config['extra_params'], '/'));
			$this->actions['extra_params_full'] = str_replace('/', '&amp;', trim($this->url_config['extra_params_full'], '/'));
			$this->url_config['extra_params_delimE'] = '&amp;';
			$this->url_config['extra_params_delimQ'] = '?';
			if (!empty($this->url_config['extra_params'])) {
				$this->url_config['extra_paramsE'] = $this->url_config['extra_params_delimE'] . $this->url_config['extra_params'];
				$this->url_config['extra_paramsQ'] = $this->url_config['extra_params_delimQ'] . $this->url_config['extra_params'];
			}
		}
	}
	/**
	* forum_rss_url() builds rss forum url with proper options
	* Suffixe is not added here, to properly deal with pagination
	*/
	function forum_rss_url($forum_name, $forum_id) {
		global $phpbb_seo;
		return !empty($phpbb_seo->cache_config['forum'][$forum_id]) ? $phpbb_seo->cache_config['forum'][$forum_id] : $phpbb_seo->format_url( $forum_name, 'forum' ) . $this->url_config['rss_forum_delim'] . $forum_id;
	}
	/**
	* rss_output() will build all rss output
	* @access private
	*/
	function rss_output() {
		global $phpEx, $db, $config, $phpbb_root_path, $user, $phpbb_seo;
		// Initialize SQL cycling : do not query for more than required
		$this->rss_config['rss_sql_limit'] = ($this->rss_config['rss_sql_limit'] > $this->rss_config['rss_url_limit']) ? $this->rss_config['rss_url_limit'] : $this->rss_config['rss_sql_limit'];
		// XSLT styling
		if ($this->rss_config['rss_xslt']) {
			// here we could go further and allow user style to be used, would need to parse the cache a bit,
			// but, unlike Google sitemaps, RSS feeds are decently small for that.
			$this->style_config['xslt_style'] = "\n" . '<'.'?xml-stylesheet type="text/xsl" href="' . $phpbb_seo->seo_path['phpbb_url'] . 'gym_sitemaps/gym_style.' . $phpEx . '?action-rss,type-xsl,lang-' . $config['default_lang'] . ',theme_id-' . $config['default_style'] . '" media="screen, projection" ?'.'>';
			$blanc_fix = '';
			if ($this->rss_config['rss_force_xslt']) {
				// FF 2 and IE7 only look for the first 500 chars to decide if it's rss or not
				// and impose their private styling
				for ($i=0; $i<550; $i++) {
					$blanc_fix .= ' ';
				}
				$blanc_fix = "\n" . '<!-- Some spaces ' . $blanc_fix . ' to force xlst -->';
			}
			$this->style_config['xslt_style'] .= $blanc_fix;
		}
		// Remove guid for channels
		if ($this->actions['rss_channel_list']) {
			$this->style_config['rss_item_tpl'] = str_replace("\n\t\t\t" . '<guid isPermaLink="true">%s</guid>', '', $this->style_config['rss_item_tpl']);
		}
		// custom url transition message
		if (!empty($this->actions['gym1x_newurl'])) {
			$chan_title = $user->lang['RSS_1XREDIR'] . ' - ' . $this->gym_config['rss_sitename'];
			$chan_desc = $user->lang['RSS_1XREDIR_MSG'] . ' : ' . $this->parse_link($this->actions['gym1x_newurl']) . "\n" . $this->gym_config['rss_site_desc'];
			$rss_new_url = $this->rss_config['rss_url'] . $this->actions['gym1x_newurl'];
			$this->output_data['data'] = sprintf($this->style_config['rss_header'], $this->style_config['xslt_style'], $this->gym_config['gym_version'] );
			$this->parse_channel($chan_title, $chan_desc, $rss_new_url, $this->output_data['last_mod_time'], $this->rss_config['rss_image_url'], $rss_new_url);
			$this->parse_item($chan_title, $chan_desc, $rss_new_url, $rss_new_url, '', $this->output_data['last_mod_time']);
			$this->output_data['data'] .= $this->style_config['rss_footer'];
			return;
		}
		// module action
		if (in_array($this->actions['module_main'], $this->actions['action_modules'])) { // List item from the module
			$module_class = $this->actions['action_type'] . '_' . $this->actions['module_main'];
			$this->load_module($module_class, 'rss_module');
			if ( empty($this->output_data['url_sofar']) ) {
				$this->gym_error(404, 'GYM_TOO_FEW_ITEMS', __FILE__, __LINE__);
			}
			$this->output_data['data'] = sprintf($this->style_config['rss_header'], $this->style_config['xslt_style'], $this->gym_config['gym_version'] ) . $this->output_data['data'] . $this->style_config['rss_footer'];
		} else { // Add items from installed modules
			$site_title = $this->gym_config['rss_sitename'];
			$site_desc = $this->gym_config['rss_site_desc'] . "\n";
			if ($this->actions['rss_channel_list']) {
				$chan_source = $this->rss_config['rss_url'] . $this->url_config['rss_vpath'] . (($this->rss_config['rss_modrewrite']) ? (!empty($this->url_config['extra_params']) ? $this->url_config['extra_params'] : '') : $this->url_config['rss_default'] . $this->url_config['extra_params_delimQ'] . $this->actions['extra_params_full']);
				$site_title_full = $site_title . $this->rss_config['extra_title'];
				$site_desc .= $user->lang['RSS_CHAN_LIST_DESC'] . "\n";
			} else {
				$chan_source = $this->rss_config['rss_url'] . $this->url_config['rss_vpath'] . (($this->rss_config['rss_modrewrite']) ? (!empty($this->url_config['extra_params']) ? $this->url_config['extra_params'] : '') . $this->url_config['rss_default'] : $this->url_config['rss_default'] . $this->url_config['extra_paramsQ']);
				$site_title_full = $site_title . $this->rss_config['extra_title'];
			}
			$this->seo_kill_dupes($chan_source);
			$this->parse_channel($site_title_full, $site_desc, $this->rss_config['rss_url'], $this->output_data['last_mod_time'], $this->rss_config['rss_image_url'], $chan_source);
			// Since we are going to cycle through modules, we need to ajust URL limit and counting a bit
			// URL limit, we take the last xx items from each feed
			// where xx is the URL limit divided by the number of feeds
			$this->rss_config['rss_url_limit'] = !empty($this->actions['action_modules']) ? intval($this->rss_config['rss_url_limit'] / count($this->actions['action_modules'])) : 0;
			if ( empty($this->rss_config['rss_url_limit']) ) {
				$this->gym_error(404, 'GYM_TOO_FEW_ITEMS', __FILE__, __LINE__);
			}
			// start the modules
			// We are working on all available modules
			$this->load_modules('rss_main');
			$this->output_data['url_sofar'] = $this->output_data['url_sofar_total'];
			if ( empty($this->output_data['url_sofar']) ) {
				$this->gym_error(404, 'GYM_TOO_FEW_ITEMS', __FILE__, __LINE__);
			}
			$this->output_data['data'] = sprintf($this->style_config['rss_header'], $this->style_config['xslt_style'], $this->gym_config['gym_version'] ) . $this->output_data['data'] . $this->style_config['rss_footer'];
		}
		if ( $this->rss_config['rss_yahoo_notify'] && ($this->output_data['time'] >= ($this->cache_config['cache_born'] + $this->cache_config['cache_max_age'])) ) {
			$this->rss_yahoo_notify();
		}
		return;
	}
	/**
	* parse_channel() adds the channel info to the output
	*/
	function parse_channel($chan_title, $chan_desc, $chan_link, $lastBuildDate = 0, $chan_image = '', $chan_source = '') {
		global $config, $user;
		// Misc SQL Explain
		global $auth;
		if ( !empty($chan_source) && $auth->acl_get('a_') && defined('DEBUG_EXTRA')) {
			if (!empty($_REQUEST['explain'])) {
				return;
			}
			if (empty($user->lang['GYM_SQLEXPLAIN_MSG'])) {
				$user->add_lang('gym_sitemaps/gym_common');
			}
			$report_url =  $chan_source . (strpos($chan_source, '?') !== false ? '&amp;' : '?') . 'explain=1';
			$this->actions['sql_report_msg'] = "\n<i style=\"color:#CC0000\">" . sprintf($user->lang['GYM_SQLEXPLAIN_MSG'], $this->parse_link($report_url , $user->lang['GYM_SQLEXPLAIN'])) . '</i>';
		}
		$lastBuildDate = intval($lastBuildDate);
		if ( $lastBuildDate > $config['board_startdate']) {
			$this->output_data['last_mod_time'] = $lastBuildDate;
			if (( $this->cache_config['cache_max_age'] + $lastBuildDate) <= $this->output_data['time']) {
				$ttl_time = (int) ($this->cache_config['cache_max_age'] / 60);
			} else {
				$ttl_time = ( $this->cache_config['cache_max_age'] + $lastBuildDate) - $this->output_data['time'];
			}
			$ttl = sprintf($this->style_config['chan_ttl_tpl'], intval( ( $ttl_time / 60)) );
			$lastBuildDate = sprintf($this->style_config['chan_lastbuildate_tpl'], gmdate('D, d M Y H:i:s \G\M\T', intval($lastBuildDate)));
		} else {
			$lastBuildDate = '';
			$ttl = '';
		}
		$chan_image = !empty($chan_image) ? sprintf($this->style_config['rsschan_img_tpl'], $this->xml_encode($chan_title), $chan_image, $chan_link) : '';
		$input = !empty($chan_source) ? sprintf($this->style_config['rsschan_input_tpl'], $this->xml_encode($user->lang['RSS_2_LINK'] . ' : ' . $chan_title), $this->xml_encode($chan_desc . $user->lang['RSS_2_LINK']), $chan_source, 'gym_sitemaps') :  '';

		$this->output_data['data'] .= sprintf($this->style_config['rsschan_tpl'], $this->xml_encode($chan_title), $chan_link, $this->xml_encode($chan_desc . $this->rss_config['rss_auth_msg'] . $this->actions['sql_report_msg']), $lastBuildDate, $chan_image, $ttl, $chan_source, $input);
	}
	/**
	* parse_item() adds the item info to the output
	*/
	function parse_item($item_title, $item_desc, $item_link, $item_source, $item_source_title = '', $pubDate = 0, $author = false) {
		global $config;
		$pubDate = $pubDate > $config['board_startdate'] ? sprintf($this->style_config['item_pubdate_tpl'], gmdate('D, d M Y H:i:s \G\M\T', intval($pubDate))) : '';
		$item_desc = $this->rss_config['rss_nohtml'] ? strip_tags($item_desc) : $item_desc;
		$item_source_title = !empty($item_source_title) ? $item_source_title : $item_title;
		$author = $author ? sprintf($this->style_config['item_creator_tpl'], $this->xml_encode($author)) : '';
		$this->output_data['data'] .= sprintf($this->style_config['rss_item_tpl'], $this->xml_encode($item_title), $item_link, $pubDate, $this->xml_encode($item_desc . $this->rss_config['rss_auth_msg']), $item_source, $this->xml_encode($item_source_title), $item_link, $author);
		$this->output_data['url_sofar']++;
	}
	/**
	* prepare_for_output($topic, $key = '')
	* will put together BBcodes and smilies before the output
	* @param array $topic
	* @access private
	*/
	function prepare_for_output($topic, $key = '') {
		global $config, $user, $phpbb_seo;
		static $bbcode;
		static $patterns;
		static $replaces;
		$bbcode_uid = $topic['bbcode_uid' . $key];
		$bitfield = $topic['bbcode_bitfield' . $key];
		$message_title = !empty($topic['post_subject' . $key]) ? $topic['post_subject' . $key] : $topic['topic_title'];
		$message_title = censor_text($message_title);
		$message = '<b>' . $message_title . '</b>' . "\n\n" . $topic['post_text' . $key];
		if (!isset($patterns)) {
			if ( !empty($this->rss_config['rss_msg_filters']['pattern']) ) {
				$patterns = $this->rss_config['rss_msg_filters']['pattern'];
				$replaces = $this->rss_config['rss_msg_filters']['replace'];
			} else {
				$patterns = $replaces = array();
			}
		}
		if (!empty($patterns)) {
			$message = preg_replace($patterns, $replaces, $message);
		}
		if ($this->rss_config['rss_sumarize'] > 0 ) {
			$message = $this->summarize( $message, $this->rss_config['rss_sumarize'], $this->rss_config['rss_sumarize_method'] );
			// Clean broken tag at the end of the message
			$message = preg_replace('`\<[^\<\>]*$`i', ' ...', $message);
			// Close broken bbcode tags requiring it
			$this->close_bbcode_tags($message, $bbcode_uid);
		}
		$message = censor_text($message);
		if (!$this->rss_config['rss_nohtml']) {
			if ($bitfield && $this->rss_config['rss_allow_bbcode']) {
				if (!class_exists('bbcode'/*, false */)) {
					global $phpbb_root_path, $phpEx;
					require($phpbb_root_path . 'includes/bbcode.' . $phpEx);
				}
				if (empty($bbcode)) {
					$bbcode = new bbcode($bitfield);
				} else {
					$bbcode->bbcode($bitfield);
				}
				if ( !$this->rss_config['rss_allow_links'] ) {
					$message = preg_replace("`\[/?url(=.*)?\]`i", "", $message);
				}
				$bbcode->bbcode_second_pass($message, $bbcode_uid);
			}
			// Parse smilies
			$message = $this->smiley_text($message, !($this->rss_config['rss_allow_smilies'] && $topic['enable_smilies' . $key]));
			if ($this->rss_config['rss_sumarize'] > 0 ) {
				// last clean up
				static $_find = array('`\<\!--[^\<\>]+--\>`Ui', '`\[\/?[^\]\[]*\]`Ui');
				$message = preg_replace($_find, '', $message);
				$message .= "\n\n" . '<a href="' . $topic['topic_url' . $key] . '"><b>' . $user->lang['RSS_MORE'] . ' ...</b></a>'. "\n\n";
			}
		} else {
			$message = strip_tags(preg_replace('`\[\/?[^\]\[]*\]`Ui', '', $message));
		}
		return "\n" . $message;
	}
	/**
	* close_bbcode_tags(&$message, $uid, $bbcodelist)
	* will tend to do it nicely ;-)
	* Will close the bbcode tags requiring it in the list (quote|b|u|i|color|*|list)
	* Beware, bo not reduce $bbcodelist without knowing what you are doing
	*/
	function close_bbcode_tags(&$message, $uid, $bbcodelist = 'quote|b|u|i|color|*|list') {
		$open_lists = $close_lists = array();
		$bbcodelist = str_replace('|*', '|\*', $bbcodelist);
		$open_count = preg_match_all('`\[(' . $bbcodelist . ')(\=([a-z0-9]{1}))?[^\]\[]*\:' . $uid . '\]`i', $message, $open_matches);
		$close_count = preg_match_all('`\[/(' . $bbcodelist . ')(\:([a-z]{1}))?[^\]\[]*\:' . $uid . '\]`i', $message, $close_matches);
		if ($open_count == $close_count) { // No need to go further
			return;
		}
		if (!empty($open_matches[1])) {
			$open_list = array_count_values($open_matches[1]);
			$close_list = !empty($close_matches[1]) ? array_count_values($close_matches[1]) : array();
			$list_to_close = array();
			if (isset($open_list['list'])) {
				foreach ($open_matches[1] as $k => $v) {
					if ($v == 'list') {
						$open_lists[] = !empty($open_matches[3][$k]) ? 'o' : 'u';
					}
				}
				if (!empty($close_matches[1])) {
					foreach ($close_matches[1] as $k => $v) {
						if ($v == 'list') {
							$close_lists[] = !empty($close_matches[3][$k]) ? 'o' : 'u';
						}
					}
				}
				$list_to_close = array_reverse(array_diff_assoc($open_lists, $close_lists));
			}
			unset($open_list['*'], $open_list['list']);
			foreach ($open_list as $bbcode => $total) {
				if (empty($close_list[$bbcode]) || $close_list[$bbcode] < $total) {
					// close the tags
					$diff = empty($close_list[$bbcode]) ? $total : $total - $close_list[$bbcode];
					$message .= str_repeat("[/$bbcode:$uid]", $diff);
				}
			}
			// Close the lists if required
			foreach ($list_to_close as $ltype) {
				$message .= "[/*:m:$uid][/list:$ltype:$uid]";
			}
		}
		return;
	}
	/**
	* set_msg_strip($bbcode_list) will build up the unauthed bbcode list
	* $bbcode_list = 'code:0,img:1,quote';
	* $bbcode_list = 'all';
	* 1 means the bbcode and it's content will be striped.
	* all means all bbcodes.
	* $returned_list = array('patern' => $matching_patterns, 'replace' => $replace_patterns);
	* @access private
	*/
	function set_msg_strip($bbcode_list) {
		$patterns = $replaces = array();
		// Now the bbcodes
		if (!$this->rss_config['rss_allow_bbcode'] || preg_match('`all\:?([0-1]*)`i', $bbcode_list, $matches)) {
			if ( (@$matches[1] != 1 ) ) {
				$patterns[] = '`\[\/?[a-z0-9\*\+\-]+(?:=(?:&quot;.*&quot;|[^\]]*))?(?::[a-z])?(\:[0-9a-z]{5,})\]`i';
				$replaces[] = '';
			} else {
				$patterns[] = '`\[([a-z0-9\*\+\-]+)((=|:)[^\:\]]*)?\:[0-9a-z]{5,}\].*\[/(?1)(:?[^\:\]]*)?\:[0-9a-z]{5,}\]`Usi';
				$replaces[] = "{ \\1 }";
			}
			$patterns[] = '`<[^>]*>(.*<[^>]*>)?`Usi'; // All html
			$replaces[] = '';
		} else {
			// Take care about links & emails
			if ( !$this->rss_config['rss_allow_links'] ) {
				if ( !$this->rss_config['rss_allow_emails'] ) { // Saves couple RegEx
					$email_find = '[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*[a-z]+';
					$email_replace = 'str_replace(array("@", "."), array("  AT  ", " DOT "),"\\1")';
					$email_option = 'e';
				} else {
					$email_find = '.*?';
					$email_replace = "\\1";
					$email_option = '';
				}
				$patterns[] = '`<!\-\- ([lmw]+) \-\-><a (?:class="[\w-]+" )?href="(.*?)">.*?</a><!\-\- \1 \-\->`i';
				$replaces[] = "\\2";
				$patterns[] = '`\[/?url[^\]\[]*\]`i';
				$replaces[] = '';
				$patterns[] = '`<!\-\- e \-\-><a href="mailto:(' . $email_find . ')">.*?</a><!\-\- e \-\->`i' . $email_option;
				$replaces[] = $email_replace;
			}
			if ( !$this->rss_config['rss_allow_emails'] && $this->rss_config['rss_allow_links'] ) {
				$patterns[] = '`<!\-\- e \-\-><a href="mailto:([a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*[a-z]+)">.*?</a><!\-\- e \-\->`ei';
				$replaces[] = 'str_replace(array("@", "."), array("  AT  ", " DOT "),"\\1")';
			}
			$exclude_list =  ( empty($bbcode_list) ? array() : explode(',', $bbcode_list) );
			$RegEx_unset = $RegEx_remove = '';
			foreach ($exclude_list as $key => $value ) { // Group the RegEx
				$value = trim($value);
				if (preg_match("`[a-z0-9]+(\:([0-1]*))?`i", $value, $matches) ) {
					$values = (strpos($value, ':') !== false) ?  explode(':', $value) : array($value);
					if ( (@$matches[2] != 1 ) ) {
						$RegEx_unset .= (!empty($RegEx_unset) ? '|' : '' ) . $values[0];
					} else {
						$RegEx_remove .= (!empty($RegEx_remove) ? '|' : '' ) . $values[0];
					}
				}
			}
			if (!empty($RegEx_remove) ) {
				$patterns[] =  '`\[(' . $RegEx_remove . ')((=|:)[^\:\]]*)?\:[0-9a-z]{5,}\].*\[/(?1)(:?[^\:\]]*)?\:[0-9a-z]{5,}\]`Usi';
				$replaces[] = "{ \\1 }";
			}
			if (!empty($RegEx_unset) ) {
				$patterns[] =  '`\[/?(' . $RegEx_unset . ')(?:=(?:&quot;.*&quot;|[^\]]*))?(?::[a-z])?(\:[0-9a-z]{5,})\]`i';
				$replaces[] = '';
			}
		}
		return  array('pattern' => $patterns, 'replace' => $replaces);
	}
	/**
	* Some text formating functions for text output
	* un_htmlspecialchars()
	* @access private
	*/
	function un_htmlspecialchars($text) {
		return preg_replace(array('#&gt;#', '#&lt;#', '#&quot;#', '#&amp;#'), array('>', '<', '"', '&'), $text);
	}
	/**
	* Summarize method selector
	* @access private
	*/
	function summarize($string, $limit, $method = 'lines') {
		switch ($method) {
			case 'words':
				return $this->word_limit($string, $limit);
				break;
			case 'chars':
				return $this->char_limit($string, $limit);
				break;
			case 'lines':
			default:
				return $this->line_limit($string, $limit);
				break;
		}
	}
	/**
	* Cut the text by lines
	* @access private
	*/
	function line_limit($string, $limit = 10, $ellipsis = ' ...') {
		return count($lines = preg_split("`[\n\r]+`", ltrim($string), $limit + 1)) > $limit ? rtrim(utf8_substr($string, 0, utf8_strlen($string) - utf8_strlen(end($lines)))) . $ellipsis : $string;
	}
	/**
	* Cut the text according to the number of words.
	* Borrowed from www.php.net http://www.php.net/preg_replace
	* @access private
	*/
	function word_limit($string, $limit = 50, $ellipsis = ' ...') {
		return count($words = preg_split('`\s+`', ltrim($string), $limit + 1)) > $limit ? rtrim(utf8_substr($string, 0, utf8_strlen($string) - utf8_strlen(end($words)))) . $ellipsis : $string;
	}
	/**
	* Cut the text according to the number of characters.
	* Borrowed from www.php.net http://www.php.net/preg_replace
	* @access private
	*/
	function char_limit($string, $limit = 100, $ellipsis = ' ...') {
		return utf8_strlen($fragment = utf8_substr($string, 0, $limit + 1 - utf8_strlen($ellipsis))) < utf8_strlen($string) + 1 ? preg_replace('`\s*\S*$`', '', $fragment) . $ellipsis : $string;
	}

	// --> Yahoo! Notification functions <--
	/**
	* rss_yahoo_notify($url) will handle yahoo notification of new content
	* @access private
	*/
	function rss_yahoo_notify($url = '') {
		global $user, $config, $phpbb_seo;
		$url = !empty($url) ? str_replace('&amp;', '&', $url) : (!empty($this->url_config['rss_yahoo_notify_url']) ? $this->url_config['rss_yahoo_notify_url'] : '');
		$url = trim($url);
		if (empty($url) || !$this->rss_config['rss_yahoo_notify'] || empty($this->rss_config['yahoo_appid'])) {
			return;
		}
		// No more than 200 pings a day!
		if (@$config['gym_pinged_today'] > 200) {
			// @TODO add logs about this ?
			return;
		}
		$skip = array('://localhost', '://127.0.0.1', '://192.168.', '://169.254.');
		foreach ($skip as $_skip) {
			if (utf8_strpos($url, $_skip) !== false) {
				// @TODO add logs about this ?
				return;
			}
		}
		// If ssl is not forced, always ping with http urls
		$url = $phpbb_seo->sslify($url, $phpbb_seo->ssl['forced']);
		$not_curl= true;
		$timout = 3;
		// The Yahoo! Web Services request
		// Based on the Yahoo! developper hints : http://developer.yahoo.com/php/
		$request = "http://search.yahooapis.com/SiteExplorerService/V1/updateNotification?appid=" . urlencode($this->rss_config['yahoo_appid']) . '&url=' . urlencode($url);
		if (function_exists('curl_exec')) {
			$not_curl= false;
			// Initialize the session
			$session = curl_init($request);
			// Set curl options
			curl_setopt($session, CURLOPT_HEADER, false);
			curl_setopt($session, CURLOPT_USERAGENT, 'GYM Sitemaps &amp; RSS / www.phpBB-SEO.com');
			curl_setopt($session, CURLOPT_TIMEOUT, $timout);
			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
			// Make the request
			$response = curl_exec($session);
			// Close the curl session
			curl_close($session);
			// Get HTTP Status code from the response
			$status_codes = array();
			preg_match('/\d\d\d/', $response, $status_code);
			$status_code = $status_codes[0];
			// Get the XML from the response, bypassing the header
			if (!($xml = strstr($response, '<?xml'))) {
				$xml = null;
				$not_curl= true;
			}
		} else if ( $not_curl && function_exists('file_get_contents') ) {
			ini_set('user_agent','GYM Sitemaps &amp; RSS / www.phpBB-SEO.com');
			ini_set('default_socket_timeout', $timout);
			// Make the request
			if ($xml = file_get_contents($request)) {
				// Retrieve HTTP status code
				list($version,$status_code,$msg) = explode(' ',$http_response_header[0], 3);
			} else {
			//	$user->lang['RSS_YAHOO_NO_METHOD'] = sprintf($user->lang['RSS_YAHOO_NO_METHOD'], $request, $xml);
				$this->gym_error(503, 'RSS_YAHOO_NO_METHOD',  __FILE__, __LINE__);
			}
		}
		// Check the XML return message
		// Do it this way here in case curl actually returned no header
		// but did get the proper answer.
		if (!strpos($xml, 'success')) {
			// Check the HTTP Status code
			switch( $status_code ) {
				case 200: // Success
					set_config('gym_pinged_today', @$config['gym_pinged_today'] + 1, 1);
					break;
				case 503:
					$this->gym_error(500, 'RSS_YAHOO_503', __FILE__, __LINE__);
					break;
				case 403:
					$this->gym_error(500, 'RSS_YAHOO_403', __FILE__, __LINE__);
					break;
				case 400:
				//	$user->lang['RSS_YAHOO_400_MSG'] = sprintf($user->lang['RSS_YAHOO_400_MSG'], $request, $xml);
					$this->gym_error(500,'RSS_YAHOO_400',  __FILE__, __LINE__);
					break;
				default:
				//	$user->lang['RSS_YAHOO_ERROR_MSG'] = sprintf($user->lang['RSS_YAHOO_400_MSG'], $status_code, $request, $xml);
					$this->gym_error(500, 'RSS_YAHOO_500', __FILE__, __LINE__);
			}
		}
		return;
	}
}
?>