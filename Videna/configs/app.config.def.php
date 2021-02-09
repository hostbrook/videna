<?php
// Videna Framework
// File: /Videna/configs/app.def.config.php
// Desc: Default Application's config file

if ( !defined('PATH_ROOT') ) return null;

/**
 * Default Application constants
 */

// URLs, used to include images, scripts, etc.
define('URL_ABS', HTP_PROTOCOL.'://'.HOST_NAME);
define('URL_REL', '//'.HOST_NAME);


return array(

/**
 * Default Application settings.
 */

'default controller' => 'Page',
'default action' => 'Index',
'default view' => 'index',

'error action' => 'error',
'error view' => 'error',

'custom router' => '\\App\\Libraries\\CustomRouter',
'url suffixes' => ['.htm', '.html'],

'default language' => 'en',
'supported languages' => [ 'en' ],


); // END app.config