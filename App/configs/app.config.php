<?php

/**
 * <Application name>
 * 
 * Application config file
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @author HostBrook <support@hostbrook.com>
 */


// PHP config settings:
ini_set('error_reporting', E_ALL);
ini_set('session.cookie_lifetime', 0);
ini_set('session.use_strict_mode', 1);
ini_set('display_errors', 1);


// Server settings
date_default_timezone_set('America/Edmonton');


/*-------------------------------------------------------
    Section: Custom Application constants
-------------------------------------------------------*/


return array(

    /*-------------------------------------------------------
	  Section: Default Application settings are commented.
	-------------------------------------------------------*/
    // Uncomment to override:

    //'error view' => 'error.php',

    //'default language' => 'en',
    'supported languages' => ['en', 'ru'],

    //'default controller' => 'Videna\\Controllers\\HttpController',
    //'default api controller' => 'Videna\\Controllers\\ApiController',
    
    //'user token expires' => 0, // Valid until browser closed
    //'csrf token expires' => 0, // Valid until browser clos


    /*-------------------------------------------------------
	  Section: Custom Application settings
	-------------------------------------------------------*/

    'app version' => '3.1',
);
