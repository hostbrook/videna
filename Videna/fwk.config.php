<?php
// Videna Framework
// File: /Videna/fwk.config.php
// Desc: Framework main config file


if ( !defined('PATH_ROOT') ) exit ('Access denied.');

// PHP config settings:
ini_set('error_reporting', E_ALL);
ini_set('session.cookie_lifetime', 0);
ini_set('session.use_strict_mode', 1);

date_default_timezone_set('America/Edmonton'); 

// Project paths, used in PHP scripts to include files
define('PATH_CONFIGS', PATH_ROOT . '/App/configs');
define('PATH_VIEWS', PATH_ROOT . '/App/Views');

/*
define('PATH_BACKUP', 'backup');
define('PATH_TMP', 'tmp');
define('PSTX_BKP', '_bkp.zip');
define('PSTX_UPD', '_fwk_upd.zip');
*/

// Service system files

define('PATH_APP_LOG', PATH_ROOT . '/logs/videna.log');
define('PATH_PHP_LOG', PATH_ROOT . '/error_log');
define('PATH_SRV_LOG', PATH_ROOT . '/logs/error.php');
/*
define('PATH_FWK_INI', PATH_PROJECT_ROOT . '/framework/framework.ini');
define('PATH_FWK_DOC', PATH_PROJECT_ROOT . '/framework/readme.md');
define('PATH_SUPERADMIN_INI', PATH_PROJECT_ROOT . '/' . PATH_APP_CONFIGS . '/superadmin.ini');
*/

// Account types 0..255
define('USR_UNREG', 0);
define('USR_REG', 100);
define('USR_ADMIN', 200);
define('USR_SA', 255);

define('SESSION_LIFE_TIME', 300); // 5 min.
define('SESSION_ID_LIFE_TIME', 30); // 30 sec.
define('AJAX_RESPONSE_TIME', 15000); // 12 sec. max.
define('NOTIFY_TIME', 3000); // 3 sec. duration
define('TOKEN_LENGTH', 20); // 20 symbols

define('COLOR_PRIMARY', '#1e87f0'); // blue
define('COLOR_SUCCESS', '#32d296'); // green
define('COLOR_WARNING', '#faa05a'); // orange
define('COLOR_DANGER', '#f0506e');  // red

// END fwk.config
