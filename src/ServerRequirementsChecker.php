<?php

class ServerRequirementsChecker
{
	/**
	 * @var InstallRequirements
	 */
	private $result;
	
	public function __construct()
	{
		$this->check_server_requirements();
	}
	
	/**
	 * The content of this method is mostly copied from framework/src/Dev/Install/install5.php . A lot of stuff has been
	 * left out and just a few modifications are made.
	 *
	 * The result can be read from $this->result .
	 */
	private function check_server_requirements()
	{
		if ($this->result) return; // Do not rerun the tests
		
		// No database checks are done in the SS3 version of this module as it would be complicated and not even necessary, as we can assume that we have a working database connection if we can use the application.
		
		// Check requirements
		$req = new InstallRequirements;
		$req->check();
		
		// Return
		$this->result = $req;
	}
	
	public function showTable()
	{
		$this->result->showTable();
	}
	
	public function showSummary()
	{
		if ($this->result->hasErrors())
		{
			echo 'REQUIREMENTS FAILED';
		}
		elseif ($this->result->hasWarnings())
		{
			echo 'REQUIREMENTS HAVE WARNINGS';
		}
		else
		{
			echo 'ALL REQUIREMENTS PASSED';
		}
	}
}