<?php

/**
 * <Application name>
 * 
 * The example of default page controller maintain Static Page requests.
 * 
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @author HostBrook <support@hostbrook.com>
 */

namespace App\Controllers;

use \Videna\Core\Log;
use \Videna\Core\User;
use \Videna\Helpers\Mail;
use \Videna\Core\View;
use \Videna\Core\Router;


class Page extends \Videna\Controllers\StaticPage
{

    /**
     * Index action is a default action, keeps the route map:
     * /<controller>/.../<controller>/<action>/<param_1>/../<param_n>
     * - All parameters in the URL are not required
     * - Path to the page consists of parameters <controller> and <param>
     * 
     * @return void
     */
    public function actionIndex()
    {
    }


    /**
     * This is an example action to send mails
     * @return void
     */
    public function actionSendMail()
    {

        if ($this->user['account'] < USR_ADMIN) $this->actionError(403);

        $mail = new Mail(true);
        $mail->Subject = "Test email from videna";
        $mail->addAddress('email@domain.com', 'Name');

        $mail->Body = View::include('mail/header.php');
        $mail->Body .= "<p>HTML message from Videna Framework.</p>";
        $mail->Body .= View::include('mail/footer.php');

        $mail->send();
        Log::add(['Mail successfully sent']);
    }

    /**
     * This is an example action for user Log In
     * Call url: //domain.name/login
     * @return void
     */
    public function actionLogin()
    {

        if ($this->user['account'] == USR_UNREG) {
            // Try user login by 'User::login(user_id)' where `user_id` is user ID in Database `users`.
            // It returns 'false' if login unsuccessful or returns new user account data if successful.
            // At this example assume the user with ID=2 is admin.
            $this->user = User::login(2);
        }

        Router::$view = '/Page/index';
    }


    /**
     * This is an example action for user Log Out
     * Call url: //domain.name/logout
     * @return void
     */
    public function actionLogout()
    {

        if ($this->user['account'] > USR_UNREG) {
            // Try user logout by 'User::logout()'
            // It returns 'false' if logout unsuccessful
            // Or returns new user account if logout successful
            $this->user = User::logout();
        }

        Router::$view = '/Page/index';
    }


    /**
     * This is an example action to add new user into Database
     * Call url: //domain.name/add-user
     * @return void
     */
    public function actionAddUser()
    {

        \Videna\Models\Users::addUser([
            'name' => 'John',
            'lastname' => 'Malkovich',
            "email" => 'email@domain.com',
            'token' => User::getToken()
        ]);

        Router::$view = '/Page/index';
    }
}
