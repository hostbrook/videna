<?php

/**
 * <Application name>
 * 
 * Add routes into the registered routes list
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @author HostBrook <support@hostbrook.com>
 */

use \Videna\Core\Route;

// SEF URLs

Route::view('/', 'index.php')->name('home');
Route::view('/{lang}/', 'index.php')->where(['lang' => 'ru|en'])->name('home');

Route::view('/login', 'login.php')->name('login');
Route::view('/{lang}/login', 'login.php')->where(['lang' => 'ru|en'])->name('login');

Route::get('/dashboard', 'Admin\Dashboard@Index')->name('dashboard');
Route::get('/{lang}/dashboard', 'Admin\Dashboard@Index')->where(['lang' => 'ru|en'])->name('dashboard');

Route::get('/show-log', 'Admin\Dashboard@ShowLog')->name('show-log');

Route::get('/logout', 'Tasks@Logout')->name('logout');
Route::get('/{lang}/logout', 'Tasks@Logout')->where(['lang' => 'ru|en'])->name('logout');


// APP requests

Route::get('/webapp/privacy-policy', 'WebApp@PrivacyPolicy');
Route::post('/webapp/facebook-account', 'WebApp@FacebookAccount');
Route::post('/webapp/google-account', 'WebApp@GoogleAccount');
Route::post('/webapp/create-account', 'WebApp@CreateAccount');
Route::delete('/webapp/delete-account', 'WebApp@DeleteAccount');
Route::delete('/admin/ajax/delete-log', 'Admin\Ajax@DeleteLog');
Route::get('/admin/ajax/update-log', 'Admin\Ajax@UpdateLog');

// API requests
Route::get('/api/users/{id}', 'Api@GetRequest');
Route::delete('/api/users/{id}', 'Api@DeleteRequest')->where(['id' => '[0-9]*']);


// Run Cron job via HTTP

Route::get('/cronjob', 'Cron@Index');
