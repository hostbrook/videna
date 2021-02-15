<?php
// <Application name>
// File: /App/Controllers/Page.php
// Desc: Static Page controller

namespace App\Controllers;

use \Videna\Core\Log;
use \Videna\Core\User;

/**
 * This is an example.
 * Class to maintain Static Page requests  
 */
class Page extends \Videna\Controllers\StaticPage {



	/**
	 * This is an example.
	 * Action for user Log In
	 * Call url: //domain.name/login
	 */
	public function actionLogin(){

		if ($this->user['account'] == USR_UNREG) {
			// Try user login by 'User::login(user_id)' where `user_id` is user ID in Database `users`.
			// It returns 'false' if login unsuccessful or returns new user account data if successful.
			// At this example assume the user with ID=2 is admin.
			$this->user = User::login(2);
		}

		$this->view = '/Page/index';

	}


	/**
	 * This is an example.
	 * Action for user Log Out
	 * Call url: //domain.name/logout
	 */
	public function actionLogout(){

		if ($this->user['account'] > USR_UNREG) {
			// Try user logout by 'User::logout()'
			// It returns 'false' if logout unsuccessful
			// Or returns new user account if logout successful
			$this->user = User::logout();
		}

		$this->view = '/Page/index';

	}


	/**
	 * This is an example.
	 * Action to add new user into Database
	 * Call url: //domain.name/add-user
	 */
	public function actionAddUser(){

		\App\Models\Users::addUser([
			'name' => 'John',
			'lastname' => 'Malkovich', 
			"email" => 'email@domain.com',
			'token' => User::getToken()
			]);

		$this->view = '/Page/index';

	}


} // END class Page 