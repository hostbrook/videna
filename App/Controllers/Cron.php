<?php

/**
 * <Application name>
 * 
 * The example of of CRON job
 * 
 * @example  
 *   To run in OpenServer:
 *   "%progdir%\modules\php\%phpdriver%\php-win.exe" -c "%progdir%\modules\php\%phpdriver%\php.ini" -q -f "%sitedir%\videna\public\index.php" "Cron" "Argument 2"
 * 
 *   To run at shared linux hosting:
 *   /usr/local/bin/php -q /home/public_html/public/index.php "Cron" "Argument 2"
 *
 *   To direct run at HTTP (admin rights required):
 *   https://domain.com/<cron_controller>?arg1=<cron_controller>&arg2=<arg2>...
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @author HostBrook <support@hostbrook.com>
 */

namespace App\Controllers;

use \Videna\Core\Log;
use \Videna\Core\Router;

class Cron extends \Videna\Controllers\CronJob
{

    /**
     * This an example of Cron job.
     * Index action is a default action for CRON job
     * @return void
     */
    public function actionIndex()
    {

        Log::add([
            'Test Cron Job: Passed!',
            'Controller: ' . __CLASS__,
            'argv[2]: ' . Router::$argv[2]
        ]);
    }
}
