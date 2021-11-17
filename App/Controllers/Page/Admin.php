<?php

/**
 * <Application name>
 * 
 * The example of Admin page
 * 
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @author HostBrook <support@hostbrook.com>
 */

namespace App\Controllers\Page;

use \Videna\Core\Log;
use \Videna\Core\Router;
use \Videna\Core\Config;

class Admin extends \Videna\Controllers\StaticPage
{

    /**
     * This is an example.
     * Filter before the each action
     * @return void
     */
    protected function before()
    {

        if ($this->user['account'] < USR_ADMIN)  $this->actionError(403);
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

        Router::$view = '/Page/admin/log';
        //$this->actionIndex();
    }


    /**
     * This is an example.
     * Delete log file
     * @return void
     */
    public function actionLogDelete()
    {

        $this->viewArgs['logDeleteResult'] = Log::delete();

        Router::$view = '/Page/admin/log-delete';
    }
}
