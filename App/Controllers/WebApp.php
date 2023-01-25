<?php

/**
 * <Application name>
 * 
 * The example of Web Application requests controller
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @author HostBrook <support@hostbrook.com>
 */

namespace App\Controllers;

use \Videna\Core\Router;
use \Videna\Models\Users;
use \Videna\Core\User;
use \Videna\Core\View;
use \Videna\Core\Lang;
use \Videna\Core\Log;


class WebApp extends \Videna\Controllers\AppController
{

    /**
     * Show privacy policy
     * @return void 
     */
    public function actionPrivacyPolicy()
    {
        View::set([
            'html' => View::render('/webapp/privacy-policy.php')
        ]);
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
     * Check if user exists in Database
     * @return void 
     */
    public function actionCheckAccountFB()
    {

        if ( Router::get('accessToken') != null) {
            $params = array(
                'access_token' => Router::get('accessToken'),
                'fields' => 'first_name,last_name,email,picture'

            );
    
            $userInfo = json_decode(file_get_contents('https://graph.facebook.com/me' . '?' . urldecode(http_build_query($params))), true);
            if (isset($userInfo['id'])) {
                
                Log::info([
                    'id: ' . $userInfo['id'],
                    'first_name: ' . (isset($userInfo['first_name']) ? $userInfo['first_name'] : 'none'),
                    'last_name: ' . (isset($userInfo['last_name']) ? $userInfo['last_name'] : 'none'),
                    'email: ' . (isset($userInfo['email']) ? $userInfo['email'] : 'none')
                ]);

                $user = Users::get(['facebook_id' => $userInfo['id']], 1);
                if ($user !== false) {
                    User::login($user['id']);
                    View::set([
                        'result' => 'user logined'
                    ]);
                }
                else {
                    View::set([
                        'result' => 'user not exist'
                    ]);
                }                
            }
            else {
                Log::info('error getting user data');
                View::set([
                    'result' => 'fetch error'
                ]);
            }
        }
        
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
                'lang' => Lang::$code,
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
