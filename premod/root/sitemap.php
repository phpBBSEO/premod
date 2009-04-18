<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $Id: sitemap.php 2007/04/12 13:48:48 dcz Exp $
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
//$user->setup('gym_sitemaps/gym_sitemaps');
$user->setup();
// Start the process
require_once($phpbb_root_path . 'gym_sitemaps/includes/gym_sitemaps.' . $phpEx);
require_once($phpbb_root_path . 'gym_sitemaps/includes/gym_google.' . $phpEx);
$gym_google  = new gym_google();
exit;
?>

