<?php

/**
 * <Application name>
 * 
 * PHPMailer config file
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @author HostBrook <support@hostbrook.com>
 */


/*-------------------------------------------------------
    Section: PHPMailer properties 
-------------------------------------------------------*/
return array(

    'CharSet' => 'UTF-8',
    'Encoding' => 'base64',

    // DKIM settings (overrided in .env)
    // Keys are generated here: https://tools.socketlabs.com/dkim/generator
    // Check DKIM here: https://dmarcly.com/tools/dkim-record-checker
    // Check mail here: https://www.mail-tester.com/
    /*
    'DKIM_private_string' => 
'-----BEGIN RSA PRIVATE KEY-----
... s o m e   p r i v a t e  k e y ...
-----END RSA PRIVATE KEY-----'
*/
);
