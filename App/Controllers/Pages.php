<?php
// <Application name>
// File: /App/Controllers/Home.php
// Desc: Static pages controller

namespace App\Controllers;

use \Videna\Core\Log;
use \Videna\Core\User;

/**
 * This an example.
 * Class to maintain Static Pages requests  
 */
class Pages extends \Videna\Core\Controller {

	protected $viewArgs;
	protected $view = false;


	public function actionLogin(){

		if ($this->user['account'] == USR_UNREG) {
			User::login(2);
			$this->user = User::detect();	
		}

		$this->view = '/Pages/index';

	}


	public function actionLogout(){

		if ($this->user['account'] > USR_UNREG) {
			User::logout();
			$this->user = User::detect();	
		}

		$this->view = '/Pages/index';

	}


	public function actionAdd(){

		\App\Models\Users::addUser([
			'name' => 'John',
			'lastname' => 'Malkovich', 
			"email" => 'email@domain.com',
			'token' => User::getToken()
			]);

		$this->view = '/Pages/index';

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
		elseif ( $this->router['view'] == 'Pages' )	{
			$this->view = '/Pages/index';
		}
		else $this->view = '/'. $this->router['view'];

		if ( !is_file( PATH_VIEWS . $this->view  .'.php' ) ) {

			$this->router['action'] =  $this->config['error action'];
			$this->router['response'] = 404;
			
			$this->actionError();

		}

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

		$this->view = '/Pages/'. $this->config['error view'];

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

		//$this->viewArgs['config'] = $this->config;
		//$this->viewArgs['router'] = $this->router;
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
			$title = 'title /Pages/' . $this->config['default view'];
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
			$description = 'description /Pages/' . $this->config['default view'];
			return isset($this->lang->langArray[$description]) ? $this->lang->langArray[$description] : '';
		}	

		return 	$this->lang->langArray[ $description ];

	}


} // END class Pages 