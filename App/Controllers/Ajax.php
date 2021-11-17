<?php

/**
 * <Application name>
 * 
 * The example of Ajax requests controller
 * 
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @author HostBrook <support@hostbrook.com>
 */

namespace App\Controllers;

use \Videna\Core\Router;
use \Videna\Core\Config;
use \Videna\Core\View;


class Ajax extends \Videna\Controllers\AjaxHandler
{


    /**
     * This is an example.
     * Test action - if action is missed at ajax request 
     * @return void 
     */
    public function actionTest()
    {

        // For loggined user show users name,
        // For unregistered user show name in parameter `name`:
        if ($this->user['account'] == USR_UNREG) {
            $name = Router::get('name');
        } else $name = $this->user['name'];

        // Put in 'txt' test phrase:
        View::set([
            'text' => 'Text test phrase: My name is ' . $name . ' and I\'m ' . Router::get('age') . ' years old.'
        ]);

        // Put in 'html' view '/Ajax/test':
        Router::$view = '/Ajax/test';
    }
}
