<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $id: sitemap.php - 895 11-26-2008 11:16:36 - 2.0.RC2 dcz $
* @copyright (c) 2006 - 2008 www.phpbb-seo.com
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

$user->setup('gym_sitemaps/gym_common');
// Start the process
require_once($phpbb_root_path . 'gym_sitemaps/includes/gym_google.' . $phpEx);

$gym_google  = new gym_google();
exit;
?>