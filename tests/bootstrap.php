<?php
/**
*
* @package testing
* @copyright (c) 2008 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

define('IN_PHPBB', true);
$phpbb_root_path = 'premod/root/';
// uri to phpBB
$_phpbb_uri = 'premod/root/';

$phpEx = 'php';
require_once $phpbb_root_path . 'includes/startup.php';

$table_prefix = 'phpbb_';
require_once $phpbb_root_path . 'includes/constants.php';
require_once $phpbb_root_path . 'includes/functions.php';
require_once $phpbb_root_path . 'includes/utf/utf_tools.php';

require_once 'test_framework/phpbb_test_case_helpers.php';
require_once 'test_framework/phpbb_test_case.php';
require_once 'test_framework/phpbb_database_test_case.php';
require_once 'test_framework/phpbb_database_test_connection_manager.php';

if (version_compare(PHP_VERSION, '5.3.0-dev', '>='))
{
	require_once 'test_framework/phpbb_functional_test_case.php';
}

if (empty($phpbb_seo))
{
	if (!class_exists('phpbb_seo'))
	{
		require($phpbb_root_path . 'phpbb_seo/phpbb_seo_class.' . $phpEx);
	}

	$phpbb_seo = new phpbb_seo();

	@define('PHPBB_USE_BOARD_URL_PATH', true);
}

if (empty($seo_meta))
{
	if (!class_exists('seo_meta'))
	{
		require($phpbb_root_path . 'phpbb_seo/phpbb_seo_meta.' . $phpEx);
	}

	$seo_meta = new seo_meta();
}
