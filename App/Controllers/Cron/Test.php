<?php
// <Application name>
// File: /App/Controllers/Cron/Test.php
// Desc: Example of CRON job

namespace App\Controllers\Cron;

use \Videna\Core\Log;

/**
 * This is an example of CRON job
 * 
 * To run in OpenServer:
 * "%progdir%\modules\php\%phpdriver%\php-win.exe" -c "%progdir%\modules\php\%phpdriver%\php.ini" -q -f "%sitedir%\videna\videna\cron.php" "Cron\Test" "Argument 2"
 * 
 * To run at shared linux hosting:
 * /usr/local/bin/php -q /home/public_html/videna/cron.php "Cron\Test" "Argument 2"
 *
 */
class Test extends \Videna\Controllers\CronJob {

	/**
	 * This an example.
	 * Index action is a default action for CRON job
	 */
	public function Index(){

		Log::add(['Test Cron\Test Job' => 'Passed!', 'argv[2]' => $this->argv[2]]);

	}

} // END class Test 