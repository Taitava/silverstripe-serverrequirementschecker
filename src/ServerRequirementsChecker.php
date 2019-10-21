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
		
		$originalIni = []; // install5.php would record some original php.ini values to this array before modifying the ini values, but we don't need to do this the same way as install5.php would do because we will not modify any php.ini values (= we are not installing, we are just testing the environment).
		$request = []; // install5.php would use $_REQUEST, but as we are not altering any configuration values and are thus not using any forms, we will just use an empty array instead and stick to the db config we already have.
		
		// Discover which databases are available
		DatabaseAdapterRegistry::autodiscover();
		
		// Determine which external database modules are USABLE
		$databaseClasses = DatabaseAdapterRegistry::get_adapters();
		foreach ($databaseClasses as $class => $details)
		{
			$helper = DatabaseAdapterRegistry::getDatabaseConfigurationHelper($class);
			$databaseClasses[$class]['hasModule'] = !empty($helper);
		}
		
		$config = new InstallConfig;
		$databaseConfig = $config->getDatabaseConfig($request, $databaseClasses, true);
		
		// Check requirements
		$req = new InstallRequirements;
		$req->check($originalIni);
		
		if ($databaseConfig)
		{
			$req->checkDatabase($databaseConfig);
		}
		
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