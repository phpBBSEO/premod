<?php
/**
*
* @package phpbb_seo_testing
* @copyright (c) 2006 - 2012 www.phpbb-seo.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2
*
*/
define('IN_PHPBB', true);

require_once $phpbb_root_path . 'includes/startup.php';
require_once $phpbb_root_path . 'includes/constants.php';
require_once $phpbb_root_path . 'includes/functions.php';
require_once $phpbb_root_path . 'includes/utf/utf_tools.php';

if (empty($phpbb_seo))
{
	if (!class_exists('phpbb_seo'))
	{
		require($phpbb_root_path . 'phpbb_seo/phpbb_seo_class.'.$phpEx);
	}

	$phpbb_seo = new phpbb_seo();

	@define('PHPBB_USE_BOARD_URL_PATH', true);
}

if (empty($seo_meta))
{
	if (!class_exists('seo_meta'))
	{
		require($phpbb_root_path . 'phpbb_seo/phpbb_seo_meta.'.$phpEx);
	}

	$seo_meta = new seo_meta();
}