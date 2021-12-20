<?php

/**
 * <Application name>
 * 
 * The example of of CRON job
 * 
 * @example  
 *   To run in OpenServer:
 *   "%progdir%\modules\php\%phpdriver%\php-win.exe" -c "%progdir%\modules\php\%phpdriver%\php.ini" -q -f "%sitedir%\videna\public\index.php" "Cron@Index" "Argument 2"
 * 
 *   To run at shared linux hosting:
 *   /usr/local/bin/php -q /home/public_html/public/index.php "Cron@Index" "Argument 2"
 *
 *   To direct run at HTTP (admin rights required):
 *   1. Add route to the registered routes list, for example:
 *      Route::add('/cronjob', 'Cron@Index');
 *   2. Log-in in your application as administrator
 *   3. use http request:
 *      https://domain.com/cronjob?arg1=null&arg2=<arg2>&arg3=<arg3>...
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
