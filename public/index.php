<?php

/**
 * Application main gate.
 * Videna Framework
 * 
 * Note: Don't change this file!
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @author HostBrook <support@hostbrook.com>
 */


// 1. Define root folder for relative paths:
chdir(dirname(__DIR__));

// 2. Define framework source path:
define('PATH_FWK', 'vendor/hostbrook/videna-fwk/src/');

// 3. Application bootstrap
require_once PATH_FWK . 'bootstrap.php';
