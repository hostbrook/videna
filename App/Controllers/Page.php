<?php
// <Application name>
// File: /App/Controllers/Page.php
// Desc: Static Page controller

namespace App\Controllers;

use \Videna\Core\Log;
use \Videna\Core\User;
use \Videna\Core\Mail;

/**
 * This is an example.
 * Class to maintain Static Page requests  
 */
class Page extends \Videna\Controllers\StaticPage {

	/**
	 * Index action is a default action, keeps the route map:
	 * /<controller>/.../<controller>/<action>/<param_1>/../<param_n>
	 * - All parameters in the URL are not required
	 * - Path to the page consists of parameters <controller> and <param>
	 */
	public function actionIndex(){

	}


	/**
	 * This is an example.
	 * Action to send mail
	 */
	public function actionSendMail() {

		if ($this->user['account'] < USR_ADMIN)  $this->actionError(403);

		$mail = new Mail();
		$mail->Subject = "Test email from videna";
    $mail->addAddress('dzyanis@hotmail.com', 'Dzyanis'); 

    $mail->Body = $mail->header;
    $mail->Body .= "<p>HTML message from Videna Framework.</p>";
    $mail->Body .= $mail->footer; 
		$mail->AltBody = "Text message from Videna Framework.";  

    try {
      $mail->send();
			Log::add(['Mail successfully sent']);   
    } catch (Exception $e) {
      log::gi()->add([ 
        "Error: Can't send mail",
        "PHPMailer response: ". $mail->ErrorInfo
      ]);      
    }

	}

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

		Router::$view = '/Page/index';

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

		Router::$view = '/Page/index';

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

		Router::$view = '/Page/index';

	}


} // END class Page 