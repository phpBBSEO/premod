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
class acp_phpbb_seo_info {
	function module() {
		return array(
			'filename'	=> 'phpbb_seo',
			'title'		=> 'ACP_CAT_PHPBB_SEO',
			'version'	=> '0.4.0RC2',
			'modes'		=> array(
				'settings'		=> array('title' => 'ACP_PHPBB_SEO_CLASS', 'auth' => 'acl_a_board', 'cat' => array('ACP_MOD_REWRITE')),
				'forum_url'		=> array('title' => 'ACP_FORUM_URL', 'auth' => 'acl_a_board', 'cat' => array('ACP_MOD_REWRITE')),
				'htaccess'		=> array('title' => 'ACP_HTACCESS', 'auth' => 'acl_a_board', 'cat' => array('ACP_MOD_REWRITE'))),
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
