<?php
// Videna Framework
// File: /App/configs/app.config.php
// Desc: PHPMailer config file


if ( !defined('PATH_ROOT') ) exit ('Access denied.');

/**
 * Default mail settings
 */

define('EMAIL_FROM', 'mail@domain.com');
define('NAME_FROM', 'Name');
define('MAIL_SUBJECT', 'Subject');

/**
 * Mail server settings
 */

define('SMTP_DEBUG', 0); 
define('SMTP_HOST', '');
define('SMTP_SECURE', 'SSL');
define('SMTP_PORT', 587);
define('SMTP_AUTH', true);
define('SMTP_USERNAME', '');
define('SMTP_PASSWORD', '');

/**
 * DKIM settings
 * Keys are generated here: https://tools.socketlabs.com/dkim/generator
 * Check DKIM here: https://dmarcly.com/tools/dkim-record-checker
 * Check mail here: https://www.mail-tester.com/
 */

define('DKIM_DOMAIN', 'domain.com');
define('DKIM_SELECTOR', 'selector');
define('DKIM_PRIVATE_KEY', '-----BEGIN RSA PRIVATE KEY-----
...
s o m e  p r i v a t e  k e y 
...
-----END RSA PRIVATE KEY-----');

// END mail.config