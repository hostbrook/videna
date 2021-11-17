<?php
// <Application Name>
// File: /App/Controllers/Page/Admin.php
// Desc: Example of Admin page

namespace App\Controllers\Page;

use \Videna\Core\Log;
use \Videna\Core\Router;
use \Videna\Core\Config;

class Admin extends \Videna\Controllers\StaticPage {


	/**
	 * This is an example.
	 * Filter before the each action
	 */
	protected function before() {

		if ($this->user['account'] < USR_ADMIN)  $this->actionError(403);
		

	}
	

	/**
	 * This is an example.
	 * Show log file
	 */
	public function actionLog() {
		
		$log = Log::read();
		$this->viewArgs['log'] = $log;

		Router::$view = '/Page/admin/log';
		//$this->actionIndex();
	}


	/**
	 * This is an example.
	 * Delete log file
	 */
	public function actionLogDelete() {
		
		$this->viewArgs['logDeleteResult'] = Log::delete();

		Router::$view = '/Page/admin/log-delete';

	}


} // END class Pages 