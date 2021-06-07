<?php
// Videna Framework
// File: /Videna/Library/Mail.php
// Desc: Pre-cooked class to send emails via PHPMailer and PHP mail() function

namespace App\Libraries;

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;
use \Videna\Core\Log;


class Mail {
  
  public $phpmailer;
  

  public function __construct(){

    // Connect app config file
    $file_path =  'App/configs/mail.config.php';
    if ( is_file($file_path) ) {
      include_once $file_path;
    }
    else Log::add( ["FATAL ERROR" => "Mail config file '$file_path' not found"], "FATAL ERROR: Mail config file not found.");
    
    $file_path =  'App/Views/mail/header.html';
    is_file($file_path) ? $this->set([ 'header' => file_get_contents($file_path) ]) : $this->set([ 'header' => '' ]);
    $file_path =  'App/Views/mail/footer.html';
    is_file($file_path) ? $this->set([ 'footer' => file_get_contents($file_path) ]) : $this->set([ 'footer' => '' ]);

    $this->phpmailer = new PHPMailer(true);

    $this->phpmailer->isSMTP();

    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    if ( defined('SMTP_DEBUG') ) $this->phpmailer->SMTPDebug = SMTP_DEBUG;
    //Ask for HTML-friendly debug output
    //$this->mailer->Debugoutput = 'html';
    
    // DKIM settings (if applicaible):
    if ( defined('DKIM_DOMAIN') ) $this->phpmailer->DKIM_domain = DKIM_DOMAIN;
    if ( defined('DKIM_SELECTOR') ) $this->phpmailer->DKIM_selector = DKIM_SELECTOR;
    if ( defined('DKIM_DOMAIN') ) $this->phpmailer->DKIM_identity = EMAIL_FROM;
    if ( defined('DKIM_PRIVATE_KEY') ) $this->phpmailer->DKIM_private_string = DKIM_PRIVATE_KEY;
    // Path to the file with private key:
    //$mail->DKIM_private = ''; // 'path/to/your/private.key';
    //$this->phpmailer->DKIM_passphrase = ''; //leave blank if no Passphrase
    
    //Set the hostname of the mail server
    if ( defined('SMTP_HOST') ) $this->phpmailer->Host = SMTP_HOST;
    //Set the SMTP port number - likely to be 25, 465 or 587
    if ( defined('SMTP_PORT') ) $this->phpmailer->Port = SMTP_PORT;
    //Whether to use SMTP authentication
    if ( defined('SMTP_AUTH') ) $this->phpmailer->SMTPAuth = SMTP_AUTH;
    //Username to use for SMTP authentication
    if ( defined('SMTP_USERNAME') ) $this->phpmailer->Username = SMTP_USERNAME;
    //Password to use for SMTP authentication
    if ( defined('SMTP_PASSWORD') ) $this->phpmailer->Password = SMTP_PASSWORD;
    if ( defined('SMTP_SECURE') ) $this->phpmailer->SMTPSecure = SMTP_SECURE;
    
    $this->phpmailer->isHTML(true);
    $this->phpmailer->CharSet = 'UTF-8';
    $this->phpmailer->Encoding = 'base64';
    
    //Set who the message is to be sent from
    if ( defined('EMAIL_FROM') and defined('NAME_FROM') ) $this->phpmailer->setFrom(EMAIL_FROM, NAME_FROM);
    //Set the subject line
    if ( defined('MAIL_SUBJECT') ) $this->phpmailer->Subject = MAIL_SUBJECT;

  } // END __construct


  /*
  *  Another option - send mail via PHP mail fucntion
  */
  public function send( $to = NAME_FROM." <".EMAIL_FROM.">", $subject = MAIL_SUBJECT) {

    $body = $this->phpmailer->Body;
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n"; 
    $headers .= "From: ".NAME_FROM." <".EMAIL_FROM.">\r\n";
    $headers .= "X-Mailer: PHP/".phpversion();
    
    $subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
    
    if ( @mail($to, $subject, $body, $headers) ) return true;
    return false;
    
  } // END send


} // END mail.class