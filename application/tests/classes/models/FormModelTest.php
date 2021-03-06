<?php defined('SYSPATH') or die('No direct script access allowed.');

/**
 * Unit tests for the form model
 *
 * PHP version 5
 * LICENSE: This source file is subject to GPLv3 license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/gpl.html
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi - http://source.ushahididev.com
 * @subpackage Unit Tests
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License Version 3 (GPLv3)
 */

class FormModelTest extends Unittest_TestCase {
	/**
	 * Provider for test_validate_valid
	 *
	 * @access public
	 * @return array
	 */
	public function provider_validate_valid()
	{
		return array(
			array(
				// Valid form data
				array(
					'name' => 'Test Name',
					'type' => 'report',
					'description' => 'Test Report Description',
				)
			),
			array(
				// Valid form data
				array(
					'name' => 'Test Comment',
					'type' => 'comment',
					'description' => 'Test Comment Description',
				)
			)
		);
	}

	/**
	 * Provider for test_validate_invalid
	 *
	 * @access public
	 * @return array
	 */
	public function provider_validate_invalid()
	{
		return array(
			array(
				// Invalid form data set 1 - No Data
				array()
			),
			array(
				// Invalid form data set 2 - Missing Name
				array(
					'type' => 'report',
					'description' => 'Test Report Description',
				)
			),
			array(
				// Invalid form data set 3 - Missing Form Type
				array(
					'name' => 'Test Name',
					'description' => 'Test Report Description',
				)
			),
			array(
				// Invalid form data set 4 - Invalid type
				array(
					'name' => 'Test Name',
					'type' => 'unknown',
					'description' => 'Test Report Description',
				)
			)
		);
	}
	
	/**
	 * Test Validate Valid Entries
	 *
	 * @dataProvider provider_validate_valid
	 * @return void
	 */
	public function test_validate_valid($set)
	{	
		$form = ORM::factory('Form');
		$form->values($set);

		$is_valid = TRUE;
		try
		{
			$form->check();
		}
		catch (Exception $e)
		{
			$is_valid = FALSE;
		}
		$this->assertTrue($is_valid);
	}

	/**
	 * Test Validate Invalid Entries
	 *
	 * @dataProvider provider_validate_invalid
	 * @return void
	 */
	public function test_validate_invalid($set)
	{	
		$form = ORM::factory('Form');
		$form->values($set);

		$is_valid = FALSE;
		try
		{
			$form->check();
		}
		catch (Exception $e)
		{
			$is_valid = TRUE;
		}
		$this->assertTrue($is_valid);
	}
}