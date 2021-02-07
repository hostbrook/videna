<?php
// Videna Framework
// File: /App/Libraries/Router.php
// Desc: Custom router class
//       Parcing of URI and $_POST and $_GET

namespace App\Libraries;


class CustomRouter extends \Videna\Core\Router {

	public function parse() {

		// Custom router has to return parameters array
		return parent::parse();

	}


} // END class CustomRouter