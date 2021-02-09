<?php
// Videna Framework
// File: /Videna/fwk.config.php
// Desc: Framework main config file


if ( !defined('PATH_ROOT') ) exit ('Access denied.');

// PHP config settings:
ini_set('error_reporting', E_ALL);
ini_set('session.cookie_lifetime', 0);
ini_set('session.use_strict_mode', 1);
ini_set('display_errors', 1);

date_default_timezone_set('America/Edmonton'); 

// Project paths, used in PHP scripts to include files
define('PATH_VIEWS', PATH_ROOT . '/App/Views');

// Logs/Debug/Error files
define('PATH_APP_LOG', PATH_ROOT . '/logs/videna.log');
define('PATH_PHP_LOG', PATH_ROOT . '/error_log');
define('PATH_SRV_LOG', PATH_ROOT . '/logs/error.php');

// Account types 0..255
define('USR_UNREG', 0);
define('USR_REG', 100);
define('USR_ADMIN', 200);

// Token lenght for user identifications
define('TOKEN_LENGTH', 20); // 20 symbols

// END fwk.config