<?php

/**
 * <Application name>
 * 
 * The example of Dashboard page
 * 
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @author HostBrook <support@hostbrook.com>
 */

namespace App\Controllers\Admin;

use \Videna\Core\Log;
use \Videna\Core\User;
use \Videna\Core\View;
use \Videna\Core\Router;

class Dashboard extends \Videna\Controllers\HttpController
{

    /**
     * Index action is a default action
     */
    public function actionIndex()
    {
        View::setPath('admin/dashboard.php');
    }


    /**
     * This is an example.
     * Filter before the each action
     * @return void
     */
    protected function before()
    {
        parent::before();

        if (User::get('account') < USR_REG) {
            Router::$action = 'Error';
            Router::$statusCode = 403;
        }
    }


    /**
     * Show log file
     * @return void
     */
    public function actionShowLog()
    {

        if (User::get('account') < USR_ADMIN) {
            Router::$action = 'Error';
            Router::$statusCode = 403;
        }

        View::set(['log' => Log::read()]);

        View::setPath('admin/show-log.php');
    }

}
