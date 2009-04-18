<?php
/** 
*
* @package ucp
* @version $Id: ucp_groups.php,v 1.2 2006/05/01 19:45:42 grahamje Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class ucp_groups_info
{
	function module()
	{
		return array(
			'filename'	=> 'ucp_groups',
			'title'		=> 'UCP_USERGROUPS',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'membership'	=> array('title' => 'UCP_USERGROUPS_MEMBER', 'auth' => '', 'cat' => array('UCP_USERGROUPS')),
				'manage'		=> array('title' => 'UCP_USERGROUPS_MANAGE', 'auth' => '', 'cat' => array('UCP_USERGROUPS')),
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