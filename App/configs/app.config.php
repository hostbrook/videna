<?php

/**
 * <Application name>
 * 
 * Application config file
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @author HostBrook <support@hostbrook.com>
 */


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

    // Google Identity Service (GIS) settings 
    'google' => [
        'client_id'     => '478936046715-jtejjvl2nefkng5l4ja97qruhm7sfunq.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect_uri'  => 'https://videna.hostbrook.com'
    ],

    // Facebook API settings
    'facebook' => [
        'appId'     => '1282007215635462',
        'appVersion' => 'v15.0'
    ],
);
