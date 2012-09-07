<?php
/**
*
* @package testing
* @copyright (c) 2008 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
global $phpbb_root_path_from_test;
require_once dirname(__FILE__) . '/base.php';

require_once dirname(__FILE__) . $phpbb_root_path_from_test . 'includes/functions.php';
require_once dirname(__FILE__) . $phpbb_root_path_from_test . 'includes/session.php';

class phpbb_security_redirect_test extends phpbb_security_test_base
{
	public static function provider()
	{
		global $_phpbb_uri;
		// array(Input -> redirect(), expected triggered error (else false), expected returned result url (else false))
		return array(
			array('data://x', false, 'http://localhost/' . rtrim($_phpbb_uri,  '/')),
			array('bad://localhost/' . $_phpbb_uri . 'index.php', 'Tried to redirect to potentially insecure url.', false),
			array('http://www.otherdomain.com/somescript.php', false, 'http://localhost/' . rtrim($_phpbb_uri,  '/')),
			array("http://localhost/' . $_phpbb_uri . 'memberlist.php\n\rConnection: close", 'Tried to redirect to potentially insecure url.', false),
			array('javascript:test', false, 'http://localhost/' . $_phpbb_uri . '../../javascript:test'),
			array('http://localhost/' . $_phpbb_uri . 'index.php;url=', 'Tried to redirect to potentially insecure url.', false),
		);
	}

	protected function setUp()
	{
		parent::setUp();

		$GLOBALS['config'] = array(
			'force_server_vars'	=> '0',
		);
	}

	/**
	* @dataProvider provider
	*/
	public function test_redirect($test, $expected_error, $expected_result)
	{
		global $user;

		if ($expected_error !== false)
		{
			$this->setExpectedTriggerError(E_USER_ERROR, $expected_error);
		}

		$result = redirect($test, true);

		// only verify result if we did not expect an error
		if ($expected_error === false)
		{
			$this->assertEquals($expected_result, $result);
		}
	}
}

