<?php
// <Application name>
// File: /App/Controllers/Cron/Test.php
// Desc: Example of CRON job executing

namespace App\Controllers\Cron;

use \Videna\Core\Log;

/**
 * This an example of CRON job
 * 
 * To run in OpenServer:
 * "%progdir%\modules\php\%phpdriver%\php-win.exe" -c "%progdir%\modules\php\%phpdriver%\php.ini" -q -f "%sitedir%\videna\videna\cron.php" "Cron\Test" "Argument 2"
 */
class Test {

	protected $config; // <- Array
	protected $argv; // <- Array

	public function __construct($config, $argv) {
		$this->config = $config;
		$this->argv = $argv;
	}

	/**
	 * This an example.
	 * Index action is a default action for CRON job
	 */
	public function Index(){

		Log::add(['Test Cron\Test Job' => 'Passed!', 'argv[2]' => $this->argv[2]]);

	}

} // END class Test 