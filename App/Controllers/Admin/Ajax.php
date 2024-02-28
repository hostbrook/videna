<?php

/**
 * <Application name>
 * 
 * Ajax requests controller for admin user
 * 
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @author HostBrook <support@hostbrook.com>
 */

namespace App\Controllers\Admin;

use \Videna\Core\Router;
use \Videna\Core\User;
use \Videna\Core\Log;


class Ajax extends \Videna\Controllers\AppController
{

    /**
     * Lets execute ajax requests for admins only
     * @return void
     */
    protected function before()
    {
        parent::before();

        if (User::get('account') < USR_ADMIN) {
            Router::$action = 'Error';
            Router::$statusCode = 403;
        }
    }


    /**
     * Delete log file
     * @return void
     */
    public function actionDeleteLog()
    {
        $result = Log::delete();
    }

}
