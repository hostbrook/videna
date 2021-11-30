<?php

/**
 * <Application name>
 * 
 * The example of Ajax requests controller
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @author HostBrook <support@hostbrook.com>
 */

namespace App\Controllers;

use \Videna\Core\Router;
use \Videna\Models\Users;
use \Videna\Core\User;
use \Videna\Core\View;


class Ajax extends \Videna\Controllers\AjaxHandler
{

    /**
     * This is an example action.
     * Example action - if action is missed at ajax request 
     * @return void 
     */
    public function actionExample()
    {

        // Put in 'txt' test phrase:
        View::set([
            'text' => 'Text test phrase: user account: ' . User::get('account') . ', user language: ' . View::get('lang')
        ]);

        // Put in 'html' the view '/Ajax/test.php':
        Router::$view = '/Ajax/test';
    }


    /**
     * Check if user exists in Database
     * @return void 
     */
    public function actionCheckAccount()
    {
        $result = Users::get(['email' => Router::get('email')], 1);
        if ($result !== false) $result = true;

        // Put in 'email_exists' the result: `true` if user already exists in DB
        View::set([
            'email_exists' => $result
        ]);
    }


    /**
     * Login the existing user by email or
     * create a new account and login new user if doesn't exist
     * 
     * @return void 
     */
    public function actionSocialLogin()
    {
        $user = Users::get(['email' => Router::get('email')], 1);
        if (!$user) {

            // Create new account
            $userID = Users::add([
                'name' => Router::get('name'),
                'last_name' => Router::get('last_name'),
                'email' => Router::get('email'),
                'lang' => View::get('lang'),
                'account' => USR_REG
            ]);

            // Login new user
            User::login($userID);
        }
        // Login user if it already exists in DB:
        else  User::login($user['id']);
    }


    /**
     * Delete account of the existing user
     * 
     * @return void 
     */
    public function actionDeleteAccount()
    {
        $userID = User::get('id');
        User::logout($userID);
        Users::del(['id' => $userID]);
    }
}
