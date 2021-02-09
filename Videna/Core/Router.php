<?php
// Videna Framework
// File: /Videna/Core/Router.php
// Desc: Parent router class

namespace Videna\Core;

class Router {

	
	protected $params;
	protected $config;

	public function __construct($config) {

		$this->config = $config;

		$this->params = [
			'controller' => $config['default controller'],
			'action' =>  $config['default action'],
			'view' =>  $config['default controller'],
			'response' => 200
		];

		define('STRICT', true);
		define('NOT_STRICT', false);

	}


	/**
	 * Parsing the requested URI.
	 * Use custom router to extend and change the logic.
	 * 
	 * @return array $this->params Array of URI parameters
	 */ 
	public function parse() {
		
		// Check SEF URL ( $_GET['url'] )

		if ( isset($_GET['url']) ) {

			$url = rtrim($_GET['url'], '/');
			$url = strtolower($url);
			$url = str_replace( isset($this->config['url extensions']) ? $this->config['url suffixes'] : '', '', $url );

			if ( strpos($url, '.') ) {
				header("HTTP/1.0 404 Not Found");
				exit;
			}

			if ( preg_match("/[^a-z0-9\/\-_]+/", $url) or $this->injectionExists($url, STRICT) ) {
			
				$this->params[ 'action' ] =  $this->config['error action'];
				$this->params[ 'response' ] = 400;
	
				Log::add([
					'Injection Warning' => 'Checking GET[\'url\'] in router',
					'Requested URI' => htmlspecialchars( URL_ABS . $_SERVER['REQUEST_URI'] )
				]);
	
			}

			$url_arr = explode("/", $url);


			// Check if the first parameter is Lang

			if ( strlen($url_arr[0]) == 2 ) {
				$this->params['lang'] = $url_arr[0];
				unset($url_arr[0]);
			}

			if ( isset($_GET['lang']) and strlen($_GET['lang']) == 2 ) {
				$this->params['lang'] = $_GET['lang'];
			}


			// Get the Main Controller
			
			if ( !empty($url_arr) ) {

				$first_key = key($url_arr);
				$controller = ucwords( $url_arr[$first_key], "_-");
	
				if ( class_exists('\\App\\Controllers\\'.$controller) ) {

					$this->params[ 'controller' ] = $controller;
					$this->params[ 'view' ] = $controller;
					unset($url_arr[$first_key]);

				}

			}


			// if parameters still exist, check if it is a SubController

			while ( !empty($url_arr) ) {

				$first_key = key($url_arr);

				$controller = ucwords( $url_arr[$first_key], "_-");
				$controller = str_replace( ['_', '-'], '', $controller );

				if ( class_exists('\\App\\Controllers\\' . $this->params[ 'controller' ] . '\\' . $controller) ) {

					$this->params[ 'controller' ] .= '\\' . $controller;
					$this->params[ 'view' ] .= '/' . $url_arr[$first_key];
					unset($url_arr[$first_key]);

				} else break;

			}

			
			// If action already set to Error - stop script and out:
			if ( $this->params[ 'action' ] == $this->config['error action'] )	return $this->params;


			// if parameters still exist, check if the first is an Action at the existing controller

			if ( !empty($url_arr) ) {

				$first_key = key($url_arr);
				$controller =  '\\App\\Controllers\\' . $this->params[ 'controller' ];
				$controller_object = new $controller( [], [] );

				$action = ucwords( $url_arr[$first_key], "_-" );
				$action = str_replace( ['_', '-'], '', $action );
				
				if ( method_exists($controller_object, 'action'.$action) ) {
					$this->params[ 'action' ] = $action;
					unset($url_arr[$first_key]);
				}

			}


			// if parameters still exist - the rest of them put in the array $params

			if ( !empty($url_arr) ) {
				$i = 1;
				foreach ($url_arr as $param) {
					$this->params['params'][ $i ] = $param;
					$i++;
				}
			}

		}


		// Check other GET parameters (after "?")
		
		if ( !empty($_GET) ) {

			foreach ( $_GET as $key=>$value ) {

				if ($key=='url') continue;

				if ( $this->injectionExists($key, STRICT) or $this->injectionExists($value, NOT_STRICT) ) {

					$this->params[ 'action' ] =  $this->config['error action'];
					$this->params[ 'response' ] = 400;

					Log::add([ 
						'Injection Warning' => 'Checking GET[] parameters in router',
						'Requested URI' => htmlspecialchars( URL_ABS . $_SERVER['REQUEST_URI'] )
					]);
					return $this->params;

				}

				$this->params[ $key ] = $value;
			}

		}


		// Check POST-parameters
		
		if ( !empty($_POST) ) {

			foreach ( $_POST as $key=>$value ) {

				if (  $this->injectionExists($key, STRICT) or $this->injectionExists($value, NOT_STRICT) ) {

					$this->params[ 'action' ] =  $this->config['error action'];
					$this->params[ 'response' ] = 403;

					Log::add([ 
						'Injection Warning' => 'Checking POST[] parameters in router',
						'Requested URI' => htmlspecialchars( URL_ABS . $_SERVER['REQUEST_URI'] )
					]);

					return $this->params;

				}

				$this->params[ $key ] = $value;
			}

		}


		// Return result array with parameters in the request:
		return $this->params;

	}

	
	/**
	 * Check parameter for injection
	 * 
	 * @param string $param Parameter to check
	 * @param boolean $strict Set 'true' if needs more strict check
	 * @return boolean Returns 'true' if parameter contains incorrect symbols
	 */ 
	protected function injectionExists($param, $strict = true) {
		
		// strip_tags() - Remove HTML and PHP tags from a string
		$str = strip_tags($param);

		// trim() - Remove "\n\r\t\v\0" from the beginning and end of a string
		$str = trim($str, "\n\r\t\v\0");

		if ($strict) {		

			// htmlspecialchars() - Convert special characters to HTML entities
			$str = htmlspecialchars($str);

		}

		// stripslashes() - Returns a string with backslashes stripped off (\' becomes ' and so on).
		// Double backslashes (\\) are made into a single backslash (\). 
		$str = stripslashes($str);

		if ($str != $param) return true;
		return false;
	}


} // END router.class