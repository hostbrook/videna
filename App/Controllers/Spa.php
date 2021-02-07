<?php
// <Application name>
// File: /App/Controllers/Spa.php
// Desc: SPA controller

namespace App\Controllers;

use \Videna\Core\Log;

/**
 * This an example.
 * Class to maintain Ajax requests for SPA
 */

class Spa extends \Videna\Core\Controller {

	private $viewArgs;
	protected $view = false;

	/**
	 * This an example.
	 * Test action - if action is missed at ajax request  
	 */
	public function actionTest(){

		$this->viewArgs['ajax']['text'] = 'Text test phrase: My name is ' . $this->router['name'] . ' and I\'m '. $this->router['age'] . ' years old.';
		$this->view = '/Ajax/test';

	}

	/**
	 * This an example.
	 * Default action - if action is missed at ajax request
	 */
	public function actionIndex(){

		if ( isset($this->router['params']) ) {
			$this->view = '/'. $this->router['view'] .'/'. implode('/', $this->router['params']);
		}
		elseif ( $this->router['view'] == 'Spa' )	{
			$this->view = '/Spa/index';
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
	 * Action for output of error message
	 * 
	 * This methot is triggered if:
	 * - injection warning @Router 
	 * - redirection from action if error needs to be shown
	 */
	public function actionError(){

		$this->view = '/Spa/'. $this->config['error view'];

		if ( !is_file( PATH_VIEWS . $this->view  .'.php' ) ) {

			Log::add([ 
				'FATAL Error' => 'The Error page not found.',
				'Requested URI' => htmlspecialchars( URL_ABS . $_SERVER['REQUEST_URI'] )
			]);

			$this->viewArgs['ajax']['response'] = 404;
			$this->viewArgs['ajax']['status'] = $this->lang->langArray['title response 404'];
	
			$this->viewArgs['ajax']['text'] = 'The Error page not found in class \''.$this->router['controller'].'\'';
			$this->viewArgs['ajax']['html'] = '<p>The Error page not found in class \''.$this->router['controller'].'\'</p>';
			
		}

	}

	/**
	 * This an example.
	 * Filter before the each action
	 */
	protected function before() {

		if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) and $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
			http_response_code(403);
			die("Access denied.");
		}

		$this->viewArgs['ajax']['response'] = $this->router['response'];
		$this->viewArgs['ajax']['status'] = $this->lang->langArray['title response '.$this->router['response']];

	}

  /**
	 * This an example.
	 * Filter "after" each action
	 */
	protected function after() {

		if ( $this->view ) {

			$this->viewArgs['config'] = $this->config;
			$this->viewArgs['router'] = $this->router;
			$this->viewArgs['_'] = $this->lang->langArray;			

			$this->viewArgs['title'] = $this->getTitle();
			$this->viewArgs['ajax']['title'] = $this->viewArgs['title'];
			$this->viewArgs['description'] = $this->getDescription();
			$this->viewArgs['ajax']['description'] = $this->viewArgs['description'];
			$this->viewArgs['lang'] = $this->lang->getCode();
			$this->viewArgs['ajax']['lang'] = $this->viewArgs['lang'];

		}

		\Videna\Core\View::jsonRender($this->view, $this->viewArgs);
	
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
			$title = 'title /Spa/' . $this->config['default view'];
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
			$description = 'description /Spa/' . $this->config['default view'];
			return isset($this->lang->langArray[$description]) ? $this->lang->langArray[$description] : '';
		}	

		return 	$this->lang->langArray[ $description ];

	}

} // END class Spa 