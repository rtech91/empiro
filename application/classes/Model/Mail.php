<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model specified to handle with mail system to send mail messages
 */
class Model_Mail extends Model {
  
  const EMAIL_TO = 'in0mad91@gmail.com';
  
  const EMAIL_CATEGORY = array(
    'OPT_QUESTIONS' => 'Запитання до команди',
    'OPT_PROPOSALS' => 'Пропозиції'
  );
  
  public static function sendContactMail($data) {
    $message  = $data->contact_name.'<br>';
    $message .= $data->contact_email.'<br><br>';
    $message .= $data->contact_message;
    
    $headers = "Content-type: text/html; charset=UTF-8\r\n";
    
    //TODO: add checking for email successfull sending
    // and messaging user about it
    mail(self::EMAIL_TO, self::EMAIL_CATEGORY[$data->contact_category], $message, $headers);
  }
  
} // End Model_Mail