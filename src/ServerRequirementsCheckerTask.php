<?php

class ServerRequirementsCheckerTask extends BuildTask
{
	
	/**
	 * Implement this method in the task subclass to
	 * execute via the TaskRunner
	 *
	 * @param HTTPRequest $request
	 * @return
	 */
	public function run($request)
	{
		$checker = new ServerRequirementsChecker;
		
		echo Director::is_cli() ? '' : '<h1>';
		$checker->showSummary();
		echo Director::is_cli() ? "\n" : '</h1>';
		
		$checker->showTable();
	}
}