<?php
/**
*
* @package Ultimate SEO URL phpBB SEO
* @version $Id$
* @copyright (c) 2006 - 2009 www.phpbb-seo.com
* @license http://www.opensource.org/licenses/rpl1.5.txt Reciprocal Public License 1.5
*
*/
// Some config
$phpbb_url = 'http://www.example.com/phpBB/';
// nothing to change bellow
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

$forum_id = !empty($_GET['f']) ? max(0, intval($_GET['f'])) : 0;
$topic_id = !empty($_GET['t']) ? max(0, intval($_GET['t'])) : 0;
$post_id = !empty($_GET['p']) ? max(0, intval($_GET['p'])) : 0;
$start = !empty($_GET['start']) ? max(0, intval($_GET['start'])) : 0;
$_start = $start ? "&start=$start" : '';
$url = '';
if ($post_id) {
	$url = "viewtopic.$phpEx?p=$post_id";
} else if ($topic_id) {
	$_forum_bit = $forum_id ? "f=$forum_id&" : '';
	$url = "viewtopic.$phpEx?{$_forum_bit}t=$topic_id{$_start}";
} else if ($forum_id) {
	$url = "viewforum.$phpEx?f=$forum_id{$_start}";
}
// Will redirect to forum index in case no url was built
$url = $phpbb_url . $url;
header('HTTP/1.1 301 Moved Permanently', false, 301);
header('Location: ' . $url);
exit();
?>
