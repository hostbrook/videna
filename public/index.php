<?php
/**
 * Videna Framework
 * File: /public/index.php
 * Desc: Application main gate.
 * Note: Don't change this file!
 */


// 1. Define root folder for relative paths:
chdir(dirname(__DIR__));

// 2. Define framework source path:
define('PATH_FWK', 'vendor/hostbrook/videna-fwk/src/');

// 3. Application bootstrap
require_once PATH_FWK . 'bootstrap.php';