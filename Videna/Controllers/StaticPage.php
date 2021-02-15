<?php
// Videna Framework
// File: /Videns/Controllers/StaticPage.php
// Desc: Pre-cooked Static Page controller

namespace Videna\Controllers;

use \Videna\Core\Log;
use \Videna\Core\User;

/**
 * Class to maintain Static Page requests  
 */
class StaticPage extends \Videna\Core\Controller {

	protected $viewArgs;
	protected $view = false;


	/**
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


} // END class StaticPage 