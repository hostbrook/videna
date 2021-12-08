<?php

/**
 * <Application name>
 * 
 * Registered routes are here
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @author HostBrook <support@hostbrook.com>
 */

use \Videna\Core\Route;

// SEF URLs

Route::view('/', 'Page/index')->name('home');
Route::view('/{lang}/', 'Page/index')->where(['lang' => 'ru|en'])->name('home');

Route::view('/login', 'Page/login')->name('login');
Route::view('/{lang}/login', 'Page/login')->where(['lang' => 'ru|en'])->name('login');

Route::add('/dashboard', 'Page\Dashboard@Index')->name('dashboard');
Route::add('/{lang}/dashboard', 'Page\Dashboard@Index')->where(['lang' => 'ru|en'])->name('dashboard');

Route::add('/logout', 'Page@Logout')->name('logout');
Route::add('/{lang}/logout', 'Page@Logout')->where(['lang' => 'ru|en'])->name('logout');


// AJAX requests

Route::add('/social-login', 'Ajax@SocialLogin');
Route::add('/check-account', 'Ajax@CheckAccount');
Route::add('/delete-account', 'Ajax@DeleteAccount');
