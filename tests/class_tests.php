<?php
/**
*
* @package phpbb_seo_testing
* @copyright (c) 2006 - 2012 www.phpbb-seo.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2
*
*/

class class_tests extends PHPUnit_Framework_TestCase
{
	function _drop_sid_data()
	{
		// use only & in urls, &amp; case will be added automatically
		// in test_drop_sid

		return array(
			array(
				'case'		=> 'http://www.example.com/path/page.ext?sid=thesidishere',
				'expected'	=> 'http://www.example.com/path/page.ext',
			),
			array(
				'case'		=> 'http://www.example.com/path/page.ext?sid=thesidishere&var1=val1&var2=val2',
				'expected'	=> 'http://www.example.com/path/page.ext?var1=val1&var2=val2',
			),
			array(
				'case'		=> 'http://www.example.com/path/page.ext?var1=val1&var2=val2&sid=thesidishere',
				'expected'	=> 'http://www.example.com/path/page.ext?var1=val1&var2=val2',
			),
			array(
				'case'		=> 'http://www.example.com/path/page.ext?var1=val1&var2=val2&sid=thesidishere&var3=val3',
				'expected'	=> 'http://www.example.com/path/page.ext?var1=val1&var2=val2&var3=val3',
			),
		);
	}

	/**
	* @dataProvider _drop_sid_data
	*/
	function test_drop_sid($case, $expected)
	{
		global $phpbb_seo;

		$this->assertEquals($expected, $phpbb_seo->drop_sid($case));

		// also test &amp; if appropriate
		if (strpos($case, '&') !== false)
		{
			$case_amp = str_replace('&', '&amp;', $case);
			$expected_amp = str_replace('&', '&amp;', $expected);

			$this->assertEquals($expected_amp, $phpbb_seo->drop_sid($case_amp));
		}
	}
}
