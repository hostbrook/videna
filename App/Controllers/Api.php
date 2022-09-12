<?php

/**
 * <Application name>
 * 
 * The example of Api requests controller
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @author HostBrook <support@hostbrook.com>
 */

namespace App\Controllers;

use \Videna\Core\Router;
use \Videna\Core\View;


class Api extends \Videna\Controllers\ApiController
{

    /**
     * Filter before the each action
     * @return void
     */
    protected function before()
    {
        parent::before();

        if (!is_numeric(Router::get('id')) || !is_int(intval(Router::get('id')))) {
            Router::$action = 'Error';
            Router::$statusCode = 400;
        }
    }


    /**
     * Example of GET request handler
     * @return void 
     */
    public function actionGetRequest()
    {
        // Return JSON
        View::set(['result' => [
            'id' => Router::get('id'),
            'user_name' => 'John Doe',
            'user_email' => 'email.example@domain.com'
            ]
        ]);
    }


    /**
     * Example of DELETE request handler
     * @return void 
     */
    public function actionDeleteRequest()
    {
        // Return JSON
        View::set(['result' => 'User id='.Router::get('id').' deleted']);
    }


}
