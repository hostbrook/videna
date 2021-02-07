<?php
// Videna Framework
// File: /App/configs/srv.config.php
// Desc: Server config file


if ( !defined('PATH_ROOT') ) exit ('Access denied.');

// Server settings:
ini_set('display_errors', 1);
define('HTP_PROTOCOL', 'https');
define('HOST_NAME', 'domain.com');

// URLs, used in html to include images, scripts, etc.
define('URL_ABS', HTP_PROTOCOL.'://'.HOST_NAME);
define('URL_REL', '//'.HOST_NAME);


/**
 * Database settings
 */

define('USE_DB', false);

// Local Host settings:
define('DB_NAME', 'videna');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');

// END srv.config