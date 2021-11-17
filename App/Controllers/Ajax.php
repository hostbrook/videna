<?php
// <Application Name>
// File: /App/Controllers/Ajax.php
// Desc: Ajax requests controller

namespace App\Controllers;

use \Videna\Core\Router;
use \Videna\Core\Config;
use \Videna\Core\View;

/**
 * This is an example.
 * Class to maintain Ajax requests  
 */

class Ajax extends \Videna\Controllers\AjaxHandler {

	
	/**
	 * This is an example.
	 * Test action - if action is missed at ajax request  
	 */
	public function actionTest(){

		// For loggined user show users name,
		// For unregistered user show name in parameter `name`:
		if ($this->user['account'] == USR_UNREG) {
			$name = Router::get('name');
		}
		else $name = $this->user['name'];

		// Put in 'txt' test phrase:
		View::set([
			'text' => 'Text test phrase: My name is ' . $name . ' and I\'m '. Router::get('age') . ' years old.'
		]);

		// Put in 'html' view '/Ajax/test':
		Router::$view = '/Ajax/test';

	}


} // END class Ajax 