<?php

if ( !defined('PATH_ROOT') ) exit ("Access denied.");

return array(

/**
 * Server responses codes and statuses
 */

'title response 200' => '200 OK',
'title response 400' => 'Ошибка 400 - Неверный запрос',
'title response 401' => 'Ошибка 401 - Пользователь не авторизован',
'title response 403' => 'Ошибка 403 - Запрещено',
'title response 404' => 'Ошибка 404 - Страница не найдена',
'title response 500' => 'Ошибка 500 - Внутренняя ошибка сервера',
'description error 400' => 'Запрос не может быть обработан из-за синтаксической ошибки.',
'description error 401' => 'Для доступа к запрашиваемому ресурсу требуется аутентификация.',
'description error 403' => 'Сервер отказывает в выполнении вашего запроса.',
'description error 404' => 'Запрашиваемая страница не найдена на сервере.',
'description error 500' => 'Запрос не может быть обработан из-за внутренней ошибки сервера.',


/**
 * Top Menu
 */

'home' => 'Главная',
'news' => 'Новости',
'archive' => 'Архив',
'language' => 'Язык',
'search' => 'Поиск',


/**
 * Static Pages
 */

// /Pages/index
  
'title /Pages/index' => 'Bootstrap 4 Базовый шаблон',
'description /Pages/index' => 'В комплекте с предопределенными путями к файлам и отзывчивой навигацией!',

'header' => 'Bootstrap 4 Базовый шаблон',
'lead' => 'Используйте этот шаблон как способ быстро начать любой новый проект.',

// /Pages/product-one

'title /Pages/product-one' => 'Продукт One',
'description /Pages/product-one' => 'Продукт One описание!',

'product' => 'Продукт',

// /Pages/product-one/sub-product-one

'title /Pages/product-one/sub-product-one' => 'Под-продукт One',
'description /Pages/product-one/sub-product-one' => 'Под-продукт One описание!',

'sub-product' => 'Под-продукт',

// /Spa/product-one

'title /Spa/product-one' => 'Продукт SPA',
'description /Spa/product-one' => 'Продукт SPA описание!',

// /Spa/product-one/sub-product-one

'title /Spa/product-one/sub-product-one' => 'Под-продукт SPA',
'description /Spa/product-one/sub-product-one' => 'Под-продукт SPA описание!',


); // END array