<?php
// Videna Framework
// File: /App/configs/app.config.php
// Desc: Application config file

if ( !defined('PATH_ROOT') ) return null;


return array(

// OPTIONS REQUIRED BY FRAMEWORK

'default controller' => 'Pages',
'default action' => 'Index',
'default view' => 'index',

'error action' => 'error',
'error view' => 'error',

//'custom router' => '\\App\\Libraries\\CustomRouter',
//'url suffixes' => ['.htm', '.html'],

'default language' => 'en',
'supported languages' => [ 'en', 'ru' ],


// OPTIONS REQUIRED BY APPLICATION

// ... add your options here ...


); // END app.config