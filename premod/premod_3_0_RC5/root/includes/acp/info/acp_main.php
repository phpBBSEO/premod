<?php
/** 
*
* @package acp
* @version $Id: acp_main.php,v 1.3 2006/05/05 18:28:58 grahamje Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class acp_main_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_main',
			'title'		=> 'ACP_INDEX',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'main'		=> array('title' => 'ACP_INDEX', 'auth' => '', 'cat' => array('ACP_CAT_GENERAL')),
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