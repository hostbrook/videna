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
'pages' => 'Страницы',
'archive' => 'Архив',
'language' => 'Язык',
'login' => 'Вход',
'logout' => 'Выход',


/**
 * Static Pages
 */

// /Page/index
  
'title /Page/index' => 'Videna - Фреймворк работает!',
'description /Page/index' => 'Videna - Фреймворк работает!',

'header' => 'Ура! Фреймворк работает!',
'lead' => 'Протестируйте возможности Ajax и Роутер',

// /Page/product

'title /Page/product' => 'Продукт',
'description /Page/product' => 'Продукт - описание!',

'product' => 'Продукт',

// /Page/product/sub-product

'title /Page/product/sub-product' => 'Под-продукт',
'description /Page/product/sub-product' => 'Под-продукт - описание!',

'sub-product' => 'Под-продукт',


); // END array