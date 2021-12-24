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

Route::add('/dashboard', 'Admin\Dashboard@Index')->name('dashboard');
Route::add('/{lang}/dashboard', 'Admin\Dashboard@Index')->where(['lang' => 'ru|en'])->name('dashboard');

Route::add('/logout', 'Tasks@Logout')->name('logout');
Route::add('/{lang}/logout', 'Tasks@Logout')->where(['lang' => 'ru|en'])->name('logout');

// AJAX requests

Route::add('/ajax/social-login', 'Ajax@SocialLogin');
Route::add('/ajax/check-account', 'Ajax@CheckAccount');
Route::add('/ajax/delete-account', 'Ajax@DeleteAccount');
Route::add('/ajax/get-privacy-policy', 'Ajax@GetPrivacyPolicy');

// Run Cron job via HTTP

Route::add('/cronjob', 'Cron@Index');
