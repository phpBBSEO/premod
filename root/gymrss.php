<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $Id: rss.php 2007/04/12 13:48:48 dcz Exp $
* @copyright (c) 2006 dcz - www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
define('IN_PHPBB', true);
$phpEx = substr(strrchr(__FILE__, '.'), 1);
$phpbb_root_path = './';
include($phpbb_root_path . 'common.' . $phpEx);
// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup(array('gym_sitemaps/gym_common', 'common'));
// Start the process
require($phpbb_root_path . 'gym_sitemaps/includes/gym_rss.' . $phpEx);

$gym_google  = new gym_rss();
exit;
?>
