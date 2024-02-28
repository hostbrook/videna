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
use \Videna\Core\Config;
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
     * Check if user with Google ID exists in Database
     * - if exists - login user
     * - if doesn't exist - add user (if permission given)
     * @return void 
     */
    public function actionGoogleAccount($createAccount = false)
    {
        $params = array(
            'client_id'     => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect_uri'  => env('GOOGLE_REDIRECT_URI'),
            'grant_type'    => 'authorization_code'
        );

        if ($createAccount == false) {
            // By Javascript we got a CODE from GIS. 
            // Now, using CODE we have to get an access token
            $params['code'] = Router::get('code');

            $url = 'https://accounts.google.com/o/oauth2/token';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($curl);
            curl_close($curl);

            $tokenInfo = json_decode($result, true);

            if (isset($tokenInfo['access_token'])) {
                $accessToken = $tokenInfo['access_token'];
            }
            else {
                View::set(['result' => 'Can not get access token from GIS']);
                return;
            }

        }
        else $accessToken = Router::get('accessToken');

        // Using access token we can get info about the user
        $params['access_token'] = $accessToken;
        $userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params))), true);

        // Check if all required data has been received frim FB:
        if (isset($userInfo['id']) && 
            isset($userInfo['given_name']) && 
            isset($userInfo['family_name'])  && 
            isset($userInfo['email'])) {

            // Check if Google ID is linked with any user in DB:
            $user = Users::get(['google_id' => $userInfo['id']], 1);
            if ($user !== false) {
                // User with Google ID exists in DB. Login the user:
                User::login($user['id']);
                View::set(['result' => 'user logined']);
            }
            else {
                // Check if Google email is linked with any user in DB:
                $user = Users::get(['email' => $userInfo['email']], 1);
                if ($user !== false) {
                    // User with Google email exists in DB. Add Google ID and login the user:
                    $users = DB::update(
                        'UPDATE users SET google_id = :google_id WHERE id = :id',
                        ['id' => $user['id'], 'google_id' => $userInfo['id']]
                    );
                    User::login($user['id']);
                    View::set(['result' => 'user logined']);
                }
                else {
                    // User doesn't exist in DB. If flag 'createAccount' - add user to DB
                    
                    if ($createAccount) {
                        // Create new account
                        $userID = Users::add([
                            'name' => $userInfo['given_name'],
                            'last_name' => $userInfo['family_name'],
                            'email' => $userInfo['email'],
                            'lang' => Lang::$code,
                            'account' => USR_REG,
                            'google_id' => $userInfo['id']
                        ]);

                        // Login new user
                        User::login($userID);

                        View::set(['result' => 'user logined']);
                    }
                    else {
                        View::set([
                            'result' => 'user not exist',
                            'first_name' => $userInfo['given_name'],
                            'email' => $userInfo['email'],
                            'accessToken' => $accessToken
                        ]);
                    }                
                }                    
            }
        }
        else {
            // User data from GIS wasn't provided or incomplete
            View::set(['result' => 'Error occurs during the getting user data from GIS']);
        }
    }

    /**
     * Check if user with FB ID exists in Database
     * - if exists - login user
     * - if doesn't exist - add user (if permission given)
     * @return void 
     */
    public function actionFacebookAccount($createAccount = false)
    {
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


    /**
     * Create account by user permission
     * @return void 
     */
    public function actionCreateAccount()
    {

        if ( Router::get('network') == null || Router::get('accessToken') == null) {
            Router::$action = 'Error';
            Router::$statusCode = 403;
            return;
        }

        switch (Router::get('network')) {
            case 'facebook':
                self::actionFacebookAccount(true);
                break;
            case 'google':
                self::actionGoogleAccount(true);
                break;
            default:
                Router::$action = 'Error';
                Router::$statusCode = 403;
        }        
        
    }


    /**
     * Delete account of the existing user
     * @return void 
     */
    public function actionDeleteAccount()
    {
        $userID = User::get('id');
        User::logout($userID);
        Users::del(['id' => $userID]);
    }
}
