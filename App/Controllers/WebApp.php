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
use \Videna\Models\DB;


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
     * - if exist - login user
     * - if doesn't exist - add user
     * @return void 
     */
    public function actionCheckAccountFB($createAccount = false)
    {
        if ( Router::get('accessToken') != null) {
            // Access tokecn has been receved from Facebook

            // Prepare and send GET request to FB to get user profile data:
            $params = array(
                'access_token' => Router::get('accessToken'),
                'fields' => 'first_name,last_name,email'
            );    
            $userInfo = json_decode(file_get_contents('https://graph.facebook.com/me' . '?' . urldecode(http_build_query($params))), true);

            // Check if all required data has been received frim FB:
            if (isset($userInfo['id']) && 
                isset($userInfo['first_name']) && 
                isset($userInfo['last_name'])  && 
                isset($userInfo['email'])) {

                // Check if Facebook ID is linked with any user in DB:
                $user = Users::get(['facebook_id' => $userInfo['id']], 1);
                if ($user !== false) {
                    // User with Facebook ID exists in DB. Login the user:
                    User::login($user['id']);
                    View::set(['result' => 'user logined']);
                }
                else {
                    // Check if Facebook email is linked with any user in DB:
                    $user = Users::get(['email' => $userInfo['email']], 1);
                    if ($user !== false) {
                        // User with Facebook email exists in DB. Add Facebook ID and login the user:
                        $users = DB::update(
                            'UPDATE users SET facebook_id = :facebook_id WHERE id = :id',
                            ['id' => $user['id'], 'facebook_id' => $userInfo['id']]
                        );
                        User::login($user['id']);
                        View::set(['result' => 'user logined']);
                    }
                    else {
                        // User doesn't exist in DB. If flag 'createAccount' - add user to DB
                        if ($createAccount) {
                            // Create new account
                            $userID = Users::add([
                                'name' => $userInfo['first_name'],
                                'last_name' => $userInfo['last_name'],
                                'email' => $userInfo['email'],
                                'lang' => Lang::$code,
                                'account' => USR_REG,
                                'facebook_id' => $userInfo['id']
                            ]);

                            // Login new user
                            User::login($userID);

                            View::set(['result' => 'user logined']);
                        }
                        else {
                            View::set([
                                'result' => 'user not exist',
                                'first_name' => $userInfo['first_name'],
                                'email' => $userInfo['email']
                            ]);
                        }
                       
                    }                    
                }                
            }
            else {
                // User data from Facebook wasn't provided or incomplete
                View::set(['result' => 'Error occurs during the getting user data from Facebook']);
            }
        }
        else {
            // Access tokecn has NOT been receved from Facebook
            View::set(['result' => 'FP Access Token doesn\'t exist']);
        }
        
    }


    public function actionCreateAccount()
    {
        self::actionCheckAccountFB(true);
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
