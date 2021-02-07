<?php
// Videna Framework
// File: /Videna/bootstrap.php
// Desc: Front controller

namespace Videna\Core;

// 1. Define main constants:
define('PATH_ROOT', dirname(__DIR__));

// 2.1. Connect the framework configuration files
$path = PATH_ROOT . '/Videna/fwk.config.php';
is_file($path) ? require_once $path : die('FATAL ERROR: Can\'t find framework config file');

// 2.2. Connect the server configuration files
$path = PATH_CONFIGS. '/srv.config.php'; 
is_file($path) ? require_once $path : die('FATAL ERROR: Can\'t find server config file');

// 3. Composer AutoLoad
require_once '../vendor/autoload.php';

// 4. Catch errors and put them in log file:
set_error_handler('Videna\Core\Error::errorHandler');
set_exception_handler('Videna\Core\Error::exceptionHandler');

// 5. Execute Application Controller
$app = new App();
$app->execute();


// END Bootstrap