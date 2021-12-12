<?php

/**
 * <Application name>
 * 
 * The example of language file
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @author HostBrook <support@hostbrook.com>
 */

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
    'docs' => 'Документация',
    'language' => 'Язык',
    'login' => 'Вход',
    'logout' => 'Выход',
    'dashboard' => 'Панель управления',


    /**
     * Web Pages
     */

    // Default meta

    'title default' => 'Videna - PHP MVC Микро-фреймворк',
    'description default' => 'Videna - PHP MVC Микро-фреймворк',


    // View: /index

    'title index' => 'Videna - PHP MVC Микро-фреймворк',
    'description index' => 'Videna - PHP MVC Микро-фреймворк',

    'header' => 'Быстрый, Простой, Лёгкий.',
    'lead' => 'PHP MVC Микро-фреймворк Videna разработан для небольших проектов на виртуальных хостингах.',
    'get started' => 'С чего начать',


    // View: /login

    'title login' => 'Вход - Videna',


    // View: /admin/dashboard

    'title admin/dashboard' => 'Панель управления - Videna',
    'description admin/dashboard' => 'Панель управления - Videna',

);
