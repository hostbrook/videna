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

class Dashboard extends \Videna\Controllers\WebPage
{

    /**
     * Index action is a default action
     */
    public function actionIndex()
    {
        View::$show = 'admin/dashboard.php';
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
            Router::$response = 403;
        }
    }


    /**
     * This is an example.
     * Show log file
     * @return void
     */
    public function actionLog()
    {

        $log = Log::read();
        $this->viewArgs['log'] = $log;

        View::$show = '/admin/log.php';
    }


    /**
     * This is an example.
     * Delete log file
     * @return void
     */
    public function actionLogDelete()
    {

        $this->viewArgs['logDeleteResult'] = Log::delete();

        View::$show = '/admin/log-delete.php';
    }
}
