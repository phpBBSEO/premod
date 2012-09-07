<?php
/**
*
* @package phpbb_seo_testing
* @copyright (c) 2006 - 2012 www.phpbb-seo.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2
*
*/

class phpbb_seo_class_tests extends phpbb_test_case
{
	function _drop_sid_data()
	{
		// sid value to test in all base_cases
		$sids = array('thesidishere', 'TheSidisHere', 'Th3S1d1sH3r3');

		// use only & in urls, &amp; case will be added automatically
		$base_cases = array(
			array(
				'case'		=> 'http://www.example.com/path/page.ext?sid=%1$s',
				'expected'	=> 'http://www.example.com/path/page.ext',
			),
			array(
				'case'		=> 'http://www.example.com/path/page.ext?sid=%1$s&var1=val1&var2=val2',
				'expected'	=> 'http://www.example.com/path/page.ext?var1=val1&var2=val2',
			),
			array(
				'case'		=> 'http://www.example.com/path/page.ext?var1=val1&var2=val2&sid=%1$s',
				'expected'	=> 'http://www.example.com/path/page.ext?var1=val1&var2=val2',
			),
			array(
				'case'		=> 'http://www.example.com/path/page.ext?var1=val1&var2=val2&sid=%1$s&var3=val3',
				'expected'	=> 'http://www.example.com/path/page.ext?var1=val1&var2=val2&var3=val3',
			),
		);
		// generate all sub cases
		$data = array();
		foreach ($base_cases as $test) {
			extract($test);
			// test &amp; if appropriate
			$expected_amp = '';
			if (strpos($case, '&') !== false)
			{
				$expected_amp = str_replace('&', '&amp;', $expected);
			}

			// generate all sid cases
			foreach ($sids as $sid)
			{

				$_case = sprintf($case, $sid);
				$data[] = array(
					'case'		=> $_case,
					'expected'	=> $expected,
				);
				// also test &amp; if appropriate
				if ($expected_amp)
				{
					$case_amp = str_replace('&', '&amp;', $_case);
						$data[] = array(
						'case'		=> $case_amp,
						'expected'	=> $expected_amp,
					);
				}

			}
		}
		return $data;
	}
	/**
	* @dataProvider _drop_sid_data
	*/
	function test_drop_sid($case, $expected)
	{
		global $phpbb_seo;
		$this->assertEquals($expected, $phpbb_seo->drop_sid($case));
	}
}
