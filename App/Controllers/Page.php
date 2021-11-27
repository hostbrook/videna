<?php

/**
 * <Application name>
 * 
 * The example of default page controller maintain Static Page requests.
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
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
        Log::add('Mail successfully sent');
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

        $this->redirect('/');
    }
}
