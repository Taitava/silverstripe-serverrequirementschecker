<?php

namespace Taitava\ServerRequirementsChecker;

use SilverStripe\Dev\Install\DatabaseAdapterRegistry;
use SilverStripe\Dev\Install\InstallConfig;
use SilverStripe\Dev\Install\InstallRequirements;

class ServerRequirementsChecker
{
	/**
	 * @var InstallRequirements
	 */
	private $result;
	
	private $errors = [];
	
	public function __construct($enable_database_checks = true)
	{
		$this->check_server_requirements($enable_database_checks);
	}
	
	/**
	 * The content of this method is mostly copied from framework/src/Dev/Install/install5.php . A lot of stuff has been
	 * left out and just a few modifications are made.
	 *
	 * The result can be read from $this->result .
	 *
	 * @param bool $enable_database_checks This can usually be true, but can be turned off for example when running unit tests without a database connection.
	 */
	private function check_server_requirements($enable_database_checks = true)
	{
		if ($this->result) return; // Do not rerun the tests
		
		$originalIni = []; // install5.php would record some original php.ini values to this array before modifying the ini values, but we don't need to do this the same way as install5.php would do because we will not modify any php.ini values (= we are not installing, we are just testing the environment).
		$request = []; // install5.php would use $_REQUEST, but as we are not altering any configuration values and are thus not using any forms, we will just use an empty array instead and stick to the db config we already have.
		
		if ($enable_database_checks)
		{
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
		}
		
		// Check requirements
		$req = new InstallRequirements;
		$this->errors = $req->check($originalIni);
		
		if ($enable_database_checks && $databaseConfig)
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
	
	public function getErrors()
	{
		return $this->errors;
	}
}