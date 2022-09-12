<?php

/**
 * <Application name>
 * 
 * An example of controller.
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @author HostBrook <support@hostbrook.com>
 */

namespace App\Controllers;

use \Videna\Core\Log;
use \Videna\Core\User;
use \Videna\Helpers\Mail;
use \Videna\Core\View;


class Tasks extends \Videna\Controllers\HttpController
{

    /**
     * Index action is a default action
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

        if (User::get('account') < USR_ADMIN) {
            Router::$action = 'Error';
            Router::$statusCode = 403;
            return;
        }

        $mail = new Mail(true);
        $mail->Subject = "Test email from videna";
        $mail->addAddress('email@domain.com', 'Name');

        $mail->Body = View::render('mail/header.html');
        $mail->Body .= "<p>HTML message from Videna Framework.</p>";
        $mail->Body .= View::render('mail/footer.html');

        $mail->Send();
        Log::add('Mail successfully sent');
    }


    /**
     * This is an example action for user Log Out
     * Call url: //domain.name/logout
     * @return void
     */
    public function actionLogout()
    {

        if (User::get('account') > USR_UNREG) User::logout();

        $this->actionRedirect('/');
    }
}
