<?php
// Videna Framework
// File: /App/configs/app.config.php
// Desc: PHPMailer config file


/**
 * Default mail settings
 */

define('DEF_EMAIL_FROM', 'mail@domain.com');
define('DEF_NAME_FROM', 'Name Lastname');


return array(
	
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	'SMTPDebug' => 0,

	// Mail server settings
	'Host' => 'domain.com',
	'Port' => 587,
	'SMTPAuth' => true,
	'Username' => DEF_EMAIL_FROM,
	'Password' => '',
	'SMTPSecure' => 'SSL',

  // DKIM settings
  // Keys are generated here: https://tools.socketlabs.com/dkim/generator
  // Check DKIM here: https://dmarcly.com/tools/dkim-record-checker
  // Check mail here: https://www.mail-tester.com/
	'DKIM_domain' => 'domain.com',
	'DKIM_selector' => 'selector',
	'DKIM_identity' => DEF_EMAIL_FROM,
	//'DKIM_private' => 'path/to/your/private.key',
	'DKIM_private_string' => '-----BEGIN RSA PRIVATE KEY-----
... s o m e   p r i v a t e  k e y ...
-----END RSA PRIVATE KEY-----'

);