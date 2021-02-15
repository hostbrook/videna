<?php
// Videna Framework
// File: /Videna/Controllers/AjaxHandler.php
// Desc: Pre-cooked Ajax requests controller

namespace Videna\Controllers;

/**
 * Class to maintain Ajax requests  
 */

class AjaxHandler extends \Videna\Core\Controller {

	private $viewArgs;
	protected $view = false;


	/**
	 * Default action - if action is missed at ajax request
	 */
	public function actionIndex(){

		$this->viewArgs['ajax']['response'] = 404;
		$this->viewArgs['ajax']['status'] = $this->lang->langArray['title response 404'];

		$this->viewArgs['ajax']['text'] = 'Action/Method not found in class \''.$this->router['controller'].'\'';
		$this->viewArgs['ajax']['html'] = '<p>Action/Method not found in class \''.$this->router['controller'].'\'</p>';

	}


	/**
	 * Action for output of error message
	 * 
	 * This methot is triggered if:
	 * - injection warning @Router 
	 * - redirection from action if error needs to be shown
	 */
	public function actionError(){

		$this->viewArgs['ajax']['response'] = $this->router['response'];
		$this->viewArgs['ajax']['status'] = $this->lang->langArray['title response '.$this->router['response']];

		$description = 'description response '.$this->router['response'];
		$this->viewArgs['ajax']['text'] = isset($this->lang->langArray[$description]) ? $this->lang->langArray[$description] : 'Unknown error is occurred.';
		$this->viewArgs['ajax']['html'] = '<p>'.isset($this->lang->langArray[$description]) ? $this->lang->langArray[$description] : 'Unknown error is occurred.'.'</p>';

	}

	/**
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
	 * Filter "after" each action
	 */
	protected function after() {

		if ( $this->view ) {

			//$this->viewArgs['config'] = $this->config;
			//$this->viewArgs['router'] = $this->router;
			$this->viewArgs['_'] = $this->lang->langArray;			
			$this->viewArgs['lang'] = $this->lang->getCode();

		}

		\Videna\Core\View::jsonRender($this->view, $this->viewArgs);
	
	}

} // END class AjaxHandler 