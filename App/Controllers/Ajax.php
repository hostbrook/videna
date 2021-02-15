<?php
// <Application Name>
// File: /App/Controllers/Ajax.php
// Desc: Ajax requests controller

namespace App\Controllers;

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

		if ($this->user['account'] == USR_UNREG) {
			$name = $this->router['name'];
		}
		else $name = $this->user['name'];

		$this->viewArgs['ajax']['text'] = 'Text test phrase: My name is ' . $name . ' and I\'m '. $this->router['age'] . ' years old.';
		$this->view = '/Ajax/test';

	}


} // END class Ajax 