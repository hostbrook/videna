<?php
// <Application name>
// File: /Videna/Controllers/CronJob.php
// Desc: Pre-cooked CRON job controller

namespace Videna\Controllers;

/** 
 * To run in OpenServer:
 * "%progdir%\modules\php\%phpdriver%\php-win.exe" -c "%progdir%\modules\php\%phpdriver%\php.ini" -q -f "%sitedir%\videna\videna\cron.php" "Cron\Test" "Argument 2"
 * 
 * To run at shared linux hosting:
 * /usr/local/bin/php -q /home/public_html/videna/cron.php "Cron\Test" "Argument 2"
 * 
 */
class CronJob {

	protected $config; // <- Array
	protected $argv;   // <- Array


	public function __construct($config, $argv) {
		$this->config = $config;
		$this->argv = $argv;
	}


} // END class CronJob 