<?php


class TestServerRequirements extends SapphireTest
{
	public function testRequirements()
	{
		// Modify $_SERVER to make sure our test can pass
		// Variables SCRIPT_NAME, HTTP_HOST and SCRIPT_FILENAME are checked by InstallRequirements, but they are not
		// present when running unit tests. Populate them with some dummy values to make our way through these tests.
		$backup_SERVER = $_SERVER;
		$_SERVER['SCRIPT_NAME'] = __FILE__;
		$_SERVER['HTTP_HOST'] = 'localhost';
		$_SERVER['SCRIPT_FILENAME'] = __FILE__;
		
		$checker = new ServerRequirementsChecker();
		$errors = $checker->getErrors();
		$errors_string = print_r($errors, true);
		$this->assertEmpty($errors, "Server environment errors detected. To pass this test, the list of errors should be empty. Errors:\n$errors_string");
		
		// Undo changes to $_SERVER
		$_SERVER = $backup_SERVER;
	}
}