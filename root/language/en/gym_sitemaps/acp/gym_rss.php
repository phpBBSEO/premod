<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $id: gym_rss.php - 11039 11-20-2008 14:38:27 - 2.0.RC1 dcz $
* @copyright (c) 2006 - 2008 www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
/**
*
* gym_rss [English]
*
*/
/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}
// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
$lang = array_merge($lang, array(
	'RSS_MAIN' => 'RSS Feeds Settings',
	'RSS_MAIN_EXPLAIN' => 'These are the main setting for the RSS feeds module.<br/>They can be applied to all the RSS modules depending on your RSS override settings.',
	// Reset settings
	'RSS_ALL_RESET' => 'ALL RSS modules',
	// Limits
	'RSS_LIMIT_GEN' => 'Main limits',
	'RSS_LIMIT_SPEC' => 'RSS limits',
	'RSS_URL_LIMIT_LONG' => 'Long Feeds limit',
	'RSS_URL_LIMIT_LONG_EXPLAIN' => 'Number of items displayed in a Long feed without content, requires Allow Long Feeds option activated.',
	'RSS_SQL_LIMIT_LONG' => 'Long SQL cycle',
	'RSS_SQL_LIMIT_LONG_EXPLAIN' => 'Number of items queried at a time for a long feed without content.',
	'RSS_URL_LIMIT_SHORT' => 'Short Feeds limit',
	'RSS_URL_LIMIT_SHORT_EXPLAIN' => 'Number of items displayed on a Short feed without content, requires Allow Short Feeds option activated.',
	'RSS_SQL_LIMIT_SHORT' => 'Short SQL cycle',
	'RSS_SQL_LIMIT_SHORT_EXPLAIN' => 'Number of items queried at a time for a Short feed without content.',
	'RSS_URL_LIMIT_MSG' => 'Default limit with content',
	'RSS_URL_LIMIT_MSG_EXPLAIN' => 'Number of items displayed by default in feeds with content, requires Allow Item Content option activated.',
	'RSS_SQL_LIMIT_MSG' => 'SQL cycle with content',
	'RSS_SQL_LIMIT_MSG_EXPLAIN' => 'Number of items queried at a time for a feed with content.',
	// Basic settings
	'RSS_SETTINGS' => 'Basic settings',
	'RSS_C_INFO' => 'Copyright information',
	'RSS_C_INFO_EXPLAIN' => 'The Copyright information to show in the copyright tag of the RSS feeds. Default is the phpBB site name.',
	'RSS_SITENAME' => 'Site name',
	'RSS_SITENAME_EXPLAIN' => 'The Site name to show in the RSS feeds. Default is the phpBB site name.',
	'RSS_SITE_DESC' => 'Site description',
	'RSS_SITE_DESC_EXPLAIN' => 'The Site description to show in the RSS feeds. Default is the phpBB site description.',
	'RSS_LOGO_URL' => 'Site logo',
	'RSS_LOGO_URL_EXPLAIN' => 'The image file to use as the site logo in the RSS feeds, in the gym_sitemaps/images/ directory.',
	'RSS_IMAGE_URL' => 'RSS logo',
	'RSS_IMAGE_URL_EXPLAIN' => 'The image file to use as the RSS logo in the RSS feeds, in the gym_sitemaps/images/ directory.',
	'RSS_LANG' => 'RSS Language',
	'RSS_LANG_EXPLAIN' => 'The language to declare as the main language in the rss feeds. Default is the phpBB default language.',
	'RSS_URL' => 'RSS feed URL',
	'RSS_URL_EXPLAIN' => 'Enter the full URL to your gymrss.php file, eg http://www.example.com/eventual_dir/ if gymrss.php is installed in http://www.example.com/eventual_dir/.<br/>This option is useful when phpBB is not installed in the domain’s root and you would like put the gymrss.php file in the root level.',
	// Auth settings
	'RSS_AUTH_SETTINGS' => 'Authorization settings',
	'RSS_ALLOW_AUTH' => 'Authorizations',
	'RSS_ALLOW_AUTH_EXPLAIN' => 'Activate the authorization for RSS feeds. If activated, logged in users will be able to browse private feeds and to view items from private forums in general feeds if they have the proper authorization.',
	'RSS_CACHE_AUTH' => 'Cache private feeds',
	'RSS_CACHE_AUTH_EXPLAIN' => 'You can disable cache for non public feeds when allowed.<br/> Caching private feeds will increase the number of file cached;  it should not be a problem, but you can decide to only cache public feeds here.',
	'RSS_NEWS_UPDATE' => 'News Feeds update',
	'RSS_NEWS_UPDATE_EXPLAIN' => 'When news feeds are activated, you can here set a custom time to live in hours for all the news feeds. Use 0 or leave blank to deactivate and use the regular update duration instead.',
	'RSS_ALLOW_NEWS' => 'Allow News Feeds',
	'RSS_ALLOW_NEWS_EXPLAIN' => 'So called news feeds is a custom mod that will keep the first item listed without considering subsequent replies. It’s an additional feed that will not interfere with the others. It’s useful if you, for example, want to submit your forum feeds to Google news.',
	'RSS_ALLOW_SHORT' => 'Allow Short Feeds',
	'RSS_ALLOW_SHORT_EXPLAIN' => 'Allow or not the use of Short RSS feeds.',
	'RSS_ALLOW_LONG' => 'Allow Long Feeds',
	'RSS_ALLOW_LONG_EXPLAIN' => 'Allow or not the use of Long RSS feeds.',
	// Notifications
	'RSS_NOTIFY' => 'Notifications',
	'RSS_YAHOO_NOTIFY' => 'Yahoo Notifications',
	'RSS_YAHOO_NOTIFY_EXPLAIN' => 'Activate the Yahoo! Notifications for RSS feeds.<br/> This does not concern the general feeds (RSS.xml).<br/>Each time a feed’s cache is updated, a notification will be sent to Yahoo!<br/><u>NOTE :</u>You MUST enter your Yahoo! AppID below for the notification to be sent.',
	'RSS_YAHOO_APPID' => 'Yahoo! AppID',
	'RSS_YAHOO_APPID_EXPLAIN' => 'Enter your Yahoo! AppID. If you don’t have one yet, please visit <a href="http://api.search.yahoo.com/webservices/register_application">this page</a>.<br/><u>NOTE :</u>You will have to register for a Yahoo! account before you can obtain a Yahoo! AppID.',
	// Styling
	'RSS_STYLE' => 'Rss Style',
	'RSS_XSLT' => 'XSLT Styling',
	'RSS_XSLT_EXPLAIN' => 'The RSS feeds can be styled using <a href="http://www.w3schools.com/xsl/xsl_transformation.asp">XSL-Transform</a> Style Sheet.',
	'RSS_FORCE_XSLT' => 'Force Styling',
	'RSS_FORCE_XSLT_EXPLAIN' => 'Isn’t this a bit stupid, we need to trick browsers to allow xlst usage. We do it by adding some space chars at the beginning of the xml code.<br/>FF 2 and IE7 only look for the first 500 chars to decide it’s rss or not and impose their private handling',
	'RSS_LOAD_PHPBB_CSS' => 'Load phpBB CSS',
	'RSS_LOAD_PHPBB_CSS_EXPLAIN' => 'The GYM sitemap module fully uses the phpBB3 powerful templating system. The XSL stylesheets used to build the html output is compatible with phpBB3 styling.<btr/>With this option, you can decide to apply the phpBB CSS on the XSL stylesheet instead of the default one. This way, all your theme personalisations such as background and font color or even images will be used in the RSS styled ouptut.<br/>This will only have effect after you will have cleared the RSS cache in the "Maintenance" menu.<br/>If the RSS style file are not present in the current style, the default style (always available, based on prosilver) will be used.<br/>Do not try to use prosilver templates with another style, the CSS most likely won’t match.',
	// Content
	'RSS_CONTENT' => 'Content settings',
	'RSS_CONTENT_EXPLAIN' => 'Here you can set up various content filtering / formating options. <br/>They can be applied to all the RSS modules depending on your RSS override settings.',
	'RSS_ALLOW_CONTENT' => 'Allow Item Content',
	'RSS_ALLOW_CONTENT_EXPLAIN' => 'You may choose here to allow the message content to be fully or partially displayed in the RSS feeds. <br/><u>NOTE :</u> This option means a bit more work for the server. Limits with content output should be set smaller than the ones without it.',
	'RSS_SUMARIZE' => 'Digest Items',
	'RSS_SUMARIZE_EXPLAIN' => 'You can summarize the message content put in the feeds.<br/> The limit sets the maximum amount of sentences, words or characters, according to the method selected below. Enter 0 to output all of it.',
	'RSS_SUMARIZE_METHOD' => 'Digest Method',
	'RSS_SUMARIZE_METHOD_EXPLAIN' => 'You can select between three different methods to limit the message content in feeds.<br/> By number of lines, by number of words and by number of characters. BBcode tags and words won’t be broken.',
	'RSS_ALLOW_PROFILE' => 'Show Profiles',
	'RSS_ALLOW_PROFILE_EXPLAIN' => 'Item author name can be added to the RSS feeds if desired.',
	'RSS_ALLOW_PROFILE_LINKS' => 'Profile link',
	'RSS_ALLOW_PROFILE_LINKS_EXPLAIN' => 'If author name is included in the output, you can decide to link it or not to the corresponding phpBB profile page.',
	'RSS_ALLOW_BBCODE' => 'Allow BBcodes',
	'RSS_ALLOW_BBCODE_EXPLAIN' => 'You may choose here to either parse and output or omit the bbcode.',
	'RSS_STRIP_BBCODE' => 'Strip BBcodes',
	'RSS_STRIP_BBCODE_EXPLAIN' => 'You can here set up a list of bbcodes to exclude from parsing.<br/>The format is simple : <br/><ul><li> <u>Comma separated list of bbcodes :</u> Delete bbcode tags, keep the content. <br/><u>Example :</u> <b>img,b,quote</b> <br/> In this example img, bold and quote bbcode won’t be parsed, the bbcode tags themselves will be deleted and the content inside the bbcode tags kept.</li><li> <u>Comma separated list of bbcodes with colon option :</u> Delete bbcode tags and decide about their content. <br/><u>Example :</u> <b>img:1,b:0,quote,code:1</b> <br/> In this example, img bbcode and the img link will be deleted, bold won’t be processed, but the bold-ed text will be kept, quote won’t be parsed, but their content will be kept, code bbcode and their content will be deleted from the output.</ul>The filter will work even if bbcode is empty. Handy to delete code tags content and img links from output for example.<br/>The filtering occurs before summarizing.<br/> The Magic parameter "all" (can be all:0 or all:1 to strip bbcode tags content as well) will take care of all at once.',
	'RSS_ALLOW_LINKS' => 'Allow active links',
	'RSS_ALLOW_LINKS_EXPLAIN' => 'You may choose here to either activate or not links used in items content.<br/> If desactivated, links and emails will be included in the content but won’t be clickable.',
	'RSS_ALLOW_EMAILS' => 'Allow Emails',
	'RSS_ALLOW_EMAILS_EXPLAIN' => 'You chose here to output "email AT domain DOT com" instead of "email@domain.com" in the items content.',
	'RSS_ALLOW_SMILIES' => 'Allow Smilies',
	'RSS_ALLOW_SMILIES_EXPLAIN' => 'You may choose here to either parse or ignore the smilies in content.',
	// Old URL handling
	'RSS_1XREDIR' => 'Handle GYM 1x rewriten URL',
	'RSS_1XREDIR_EXPLAIN' => 'Activate the GYM 1x rewriten URLs detection. The module will display a custom feed providing with the new URL of the requested feed.<br/><u>Note :</u><br/>This option requires the compatibility rewriterules as explained in the install file.',
));
?>