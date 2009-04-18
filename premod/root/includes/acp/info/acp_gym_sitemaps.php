<?php
/** 
*
* @package acp
* @version $Id: acp_board.php,v 1.5 2006/06/28 02:43:43 davidmj Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class acp_gym_sitemaps_info {
	function module() {
		return array(
			'filename'	=> 'gym_sitemaps',
			'title'		=> 'ACP_GYM_SITEMAPS',
			'version'	=> '2.0.B2',
			'modes'		=> array(
				'main'		=> array('title' => 'ACP_GYM_MAIN', 'auth' => 'acl_a_board', 'cat' => array('ACP_GYM_SITEMAPS')),
				'google'	=> array('title' => 'ACP_GYM_GOOGLE_MAIN', 'auth' => 'acl_a_board', 'cat' => array('ACP_GYM_SITEMAPS')),
				'rss'		=> array('title' => 'ACP_GYM_RSS_MAIN', 'auth' => 'acl_a_board', 'cat' => array('ACP_GYM_SITEMAPS')),
				//'yahoo'		=> array('title' => 'ACP_GYM_YAHOO_MAIN', 'auth' => 'acl_a_board', 'cat' => array('ACP_GYM_SITEMAPS')),
				//'html'		=> array('title' => 'ACP_GYM_HTML_MAIN', 'auth' => 'acl_a_board', 'cat' => array('ACP_GYM_SITEMAPS')),
			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}

?>
