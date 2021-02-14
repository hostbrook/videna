<?php
// <Application name>
// File: /App/Controllers/Page.php
// Desc: Static Page controller

namespace App\Controllers;

use \Videna\Core\Log;
use \Videna\Core\User;

/**
 * This an example.
 * Class to maintain Static Page requests  
 */
class Page extends \Videna\Core\Controller {

	protected $viewArgs;
	protected $view = false;


	/**
	 * This an example.
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
	 * This an example.
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
	 * This an example.
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

	/**
	 * This an example.
	 * Index action is a default action, keeps the route map:
	 * /<controller>/.../<controller>/<action>/<param_1>/../<param_n>
	 * - All parameters in the URL are not required
	 * - Path to the page consists of parameters <controller> and <param>
	 */
	public function actionIndex(){

		if ( isset($this->router['params']) ) {
			$this->view = '/'. $this->router['view'] .'/'. implode('/', $this->router['params']);
		}
		elseif ( $this->router['view'] ==  $this->config['default controller'] )	{
			$this->view = '/' .$this->config['default controller']. '/' .$this->config['default view'];
		}
		else $this->view = '/'. $this->router['view'];

	}


	/**
	 * This an example.
	 * Action for output of error page
	 * 
	 * This methot is triggered if:
	 * - injection warning @Router 
	 * - Requested Class or Method not found in App class
	 * - redirection from action if error needs to be shown
	 */
	public function actionError(){

		$this->view = '/' .$this->config['default controller']. '/'. $this->config['error view'];

		// Check if Error view file exists.
		if ( !is_file( PATH_VIEWS . $this->view  .'.php' ) ) {

			Log::add([ 
				'FATAL Error' => 'The Error page not found.',
				'Requested URI' => htmlspecialchars( URL_ABS . $_SERVER['REQUEST_URI'] ),
				'FATAL Error: The Error page not found.'
			]);
			
		}

	}


	/**
	 * This an example.
	 * Filter before the each action
	 */
	protected function before() {

	}


  /**
	 * This an example.
	 * Filter "after" each action
	 */
	protected function after() {


		// Check if view file exists. If not -show 404 page.
		if ( !is_file( PATH_VIEWS . $this->view  .'.php' ) ) {

			$this->router['action'] =  $this->config['error action'];
			$this->router['response'] = 404;
			
			$this->actionError();

		}

		$this->viewArgs['_'] = $this->lang->langArray;
		$this->viewArgs['user'] = $this->user;

		$this->viewArgs['title'] = $this->getTitle();
		$this->viewArgs['description'] = $this->getDescription();		
		$this->viewArgs['lang'] = $this->lang->getCode();
		
		\Videna\Core\View::render($this->view, $this->viewArgs);
	
	}


	/**
	 * This an example.
	 * Get title (for the <title> tag) from language file
	 */
	protected function getTitle() {
		
		if ( $this->router['action'] == 'error' ) {
			$title = 'title response ' . $this->router['response'];
			return isset($this->lang->langArray[$title]) ? $this->lang->langArray[$title] : 'Unknown';
		}

		$title = 'title ' . $this->view;	
		if ( !isset($this->lang->langArray[$title]) ) {
			$title = 'title /' .$this->config['default controller']. '/' . $this->config['default view'];
			return isset($this->lang->langArray[$title]) ? $this->lang->langArray[$title] : '';
		}

		return $this->lang->langArray[ $title ];

	}


	/**
	 * This an example.
	 * Get description (for the <description> tag) from language file
	 */ 
	protected function getDescription() {

		if ( $this->router['action'] == 'error' ) {
			$description = 'description response ' . $this->router['response'];
			return isset($this->lang->langArray[$description]) ? $this->lang->langArray[$description] : 'Unknown error is occurred.';
		}
		
		$description = 'description ' . $this->view;	
		if ( !isset($this->lang->langArray[$description]) ) {
			$description = 'description /' .$this->config['default controller']. '/' . $this->config['default view'];
			return isset($this->lang->langArray[$description]) ? $this->lang->langArray[$description] : '';
		}	

		return 	$this->lang->langArray[ $description ];

	}


} // END class Page 