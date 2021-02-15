<?php
// <Application name>
// File: /App/CustomRouter.php
// Desc: Custom router class
//       Parcing of URI and $_POST and $_GET

namespace App\Libraries;

/**
 * Custom router.
 * Input parameters are: $_POST and $_GET
 * @return array parsed parameters. Mandatory parameters in array:
 * [
 *  	'controller' => $config['default controller'],
 *		'action' =>  $config['default action'],
 *		'view' =>  $config['default controller'],
 *		'response' => 200
 *	]
 */
class CustomRouter extends \Videna\Core\Router {

	public function parse() {

		// return parent::parse();

	}


} // END class CustomRouter