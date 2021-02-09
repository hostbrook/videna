<?php
// Videna Framework
// File: /Videna/Core/App.php
// Desc: Application Controller class

namespace Videna\Core;


class App {
  
	private $config = [];
	private $router = [];


	public function __construct() {

		// Connect default application config file
		$path = PATH_ROOT . '/Videna/configs/app.config.def.php';
		if ( is_file($path) ) {
			$this->config = include_once $path;
		}
		else Log::add( ["FATAL ERROR" => "Application config file not found."], "FATAL ERROR: Application config file not found.");

		// Connect app config file
		$path = PATH_ROOT . '/App/configs/app.config.php';
		if ( is_file($path) ) $this->config = array_merge($this->config, include_once $path);
		
	}


	public function execute() {

		// DEFINING ROUTE PARAMETERS
		if ( isset($this->config['custom router']) and class_exists($this->config['custom router']) ) {
			$router = new $this->config['custom router']( $this->config );
		}
		else $router = new Router( $this->config );
		$this->router = $router->parse();

		// EXECUTE ACTION AT THE CONTROLLER
		$controller = 'App\\Controllers\\'.$this->router['controller'];
		
		if ( class_exists($controller) ) {

			$controller_object = new $controller( $this->config, $this->router );
			$action = $this->router['action'];
			
			if ( method_exists($controller_object, 'action'.$action) ) {

				$controller_object->$action();

			}
			else {

				Log::add([
					'Error' =>  "Method  '$action' not found in the controller '$controller'.",
					'URL' => htmlspecialchars( URL_ABS . $_SERVER['REQUEST_URI'] )
				]);

				$this->showErrorPage("Method  '$action' not found in the controller '$controller'.");

			}

		}
		else {
			// Class/Controller doesn't exist

			$this->showErrorPage("Controller '$controller' not found");

		}
		
	} // END execute()


 /**
	*  Redirect to Error Action if the requested controller (or action) does not exist.
	*  If Error Controller (or action) does not exist - stop application with a fatal error.
	*/
	private function showErrorPage() {

		if ( !isset($this->config['default controller']) or !isset($this->config['error action']) ) {
			// Error Controller or Error Action isn't defined in the App config file

			Log::add([
				'FATAL Error' =>  'Either Default Controller or Error Action isn\'t defined in the config file.',
				'URL request' => htmlspecialchars( URL_ABS . $_SERVER['REQUEST_URI'] )
			], 'FATAL Error: Either Error Controller or Error Action isn\'t defined in the config file.');

		}

		$this->router[ 'controller' ] = $this->config[ 'default controller' ];
		$this->router[ 'action' ] = $this->config[ 'error action' ];
		$this->router[ 'response' ] = 404;

		$controller = 'App\\Controllers\\'.$this->router['controller'];
	
		if ( !class_exists($controller) ) {
			// Error Controller doesn't exist in /App/Controllers/

			Log::add([
					'FATAL Error' =>  "FATAL Error: The Error Controller '$controller' defined in App config file but doesn't exist in '/App/Controllers/'",
					'URL request' => htmlspecialchars( URL_ABS . $_SERVER['REQUEST_URI'] )
			], "FATAL Error: The Error Controller '$controller' is defined in App config file but doesn't exist in '/App/Controllers/'" );

		}

		$controllerObject = new $controller( $this->config, $this->router );
		$action = $this->router['action'];
		
		if ( !method_exists($controllerObject, 'action'.$action) ) {
			// Error method doesn't exist in Error Controller

			Log::add([
				'FATAL Error' =>  "The Error method '$action' defined in App config file but not found in the defined Error controller '$controller'.",
				'URL' => htmlspecialchars( URL_ABS . $_SERVER['REQUEST_URI'] )
			], "The Error method '$action' is defined in App config file but not found in the defined Error controller '$controller'.");

		}

		// Call Error Controller -> Error Action:
		$controllerObject->$action();

	} // END showError()


	/**
	*  EXECUTE CRON JOB
	*/
	public function executeCronJob($argv) {

		if ( $argv[1] == null ) Log::add( ['Cron job Error' => 'Cron job controller name missed.'], true);

		// EXECUTE ACTION AT THE CONTROLLER
		$controller = 'App\\Controllers\\'.$argv[1];
		
		if ( class_exists($controller) ) {

			$controllerObject = new $controller( $this->config, $argv );
			$action = $this->config['default action'];
			
			if ( method_exists($controllerObject, $action) ) {
				$controllerObject->$action();
			}
			else Log::add([ 'Cron job Error' =>  "Method  '$action' not found in the controller '$controller'."], true);

		}
		else Log::add([ 'Cron job Error' =>  "Controller '$controller' not found"], true);

	}

} //END class App