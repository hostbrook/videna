<?php

/**
 * <Application name>
 * 
 * Application Environment
 * Overrides the default application "environment".
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @author HostBrook <support@hostbrook.com>
 */


/**
 * Local host environment
 */


// PHP config settings:
ini_set('error_reporting', E_ALL);
ini_set('session.cookie_lifetime', 0);
ini_set('session.use_strict_mode', 1);
ini_set('display_errors', 1);


/**
 * Server settings
 */

date_default_timezone_set('America/Edmonton');
define('HTP_PROTOCOL', 'https');
define('HOST_NAME', $_SERVER['SERVER_NAME']);


/**
 * Application settings
 */

define('APP_DEBUG', true);


/**
 * Database settings
 */

define('USE_DB', false);

define('DB_NAME', 'videna');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');
