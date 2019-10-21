<?php

namespace Taitava\ServerRequirementsChecker;

use SilverStripe\Dev\SapphireTest;

class TestServerRequirements extends SapphireTest
{
	public function testRequirements()
	{
		$checker = new ServerRequirementsChecker;
		$this->assertEmpty($checker->getErrors(), 'Server environment errors detected. To pass this test, the list of errors should be empty.');
	}
}