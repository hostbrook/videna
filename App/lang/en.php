<?php

if ( !defined('PATH_ROOT') ) exit ("Access denied.");

return array(

/**
 * Server responses codes and statuses
 */

'title response 200' => '200 OK',
'title response 400' => 'Error 400: Bad Request',
'title response 401' => 'Error 401: Unauthorized',
'title response 403' => 'Error 403: Forbidden',
'title response 404' => 'Error 404: Not Found',
'title response 500' => 'Error 500: Internal Server Error',
'description response 400' => 'The request cannot be fulfilled due to bad syntax.',
'description response 401' => 'Authentication credentials were missing or incorrect.',
'description response 403' => 'The request is understood, but it has been refused or access is not allowed.',
'description response 404' => 'The URI requested is invalid or the resource requested does not exists.',
'description response 500' => 'This is a generic error-message, given when an unexpected condition was encountered and no more specific message is suitable.',


/**
 * Top Menu
 */

'home' => 'Home',
'news' => 'News',
'archive' => 'Archive',
'language' => 'Language',
'search' => 'Search',


/**
 * Static Pages
 */

// /Pages/index

'title /Pages/index' => 'Bootstrap 4 Starter Template',
'description /Pages/index' => 'Complete with pre-defined file paths and responsive navigation!',

'header' => 'Bootstrap starter template',
'lead' => 'Use this document as a way to quickly start any new project.',

// /Pages/product-one

'title /Pages/product-one' => 'Product One',
'description /Pages/product-one' => 'Product One description!',

'product' => 'Product',

// /Pages/product-one/sub-product-one

'title /Pages/product-one/sub-product-one' => 'Sub Product One',
'description /Pages/product-one/sub-product-one' => 'Sub Product One description!',

'sub-product' => 'Sub Product',

// /Spa/index

'title /Spa/index' => 'Bootstrap 4 Starter Template',
'description /Spa/index' => 'Complete with pre-defined file paths and responsive navigation!',

// /Spa/product-one

'title /Spa/product-one' => 'Product SPA',
'description /Spa/product-one' => 'Product SPA description!',

'product' => 'Product',

// /Spa/product-one/sub-product-one

'title /Spa/product-one/sub-product-one' => 'Sub Product SPA',
'description /Spa/product-one/sub-product-one' => 'Sub Product SPA description!',

); // END array