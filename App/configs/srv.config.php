<?php
// Videna Framework
// File: /App/configs/srv.config.php
// Desc: Server config file


if ( !defined('PATH_ROOT') ) exit ('Access denied.');

/**
 * Server settings
 */

if ( isset($_SERVER['REMOTE_ADDR']) and $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
  // LocalHost settings:
  ini_set('display_errors', 1);
  define('HTP_PROTOCOL', 'https');
  define('HOST_NAME', $_SERVER['SERVER_NAME']);
} 
else {
  // Production settings:
  ini_set('display_errors', 0);
  define('HTP_PROTOCOL', 'https');  
  define('HOST_NAME', 'domain.com');
}


/**
 * Database settings
 */

define('USE_DB', true);

define('DB_NAME', 'videna');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');

// END srv.config