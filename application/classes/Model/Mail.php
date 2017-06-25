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
    
    try
    {
      if(!mail(self::EMAIL_TO, self::EMAIL_CATEGORY[$data->contact_category], $message, $headers))
      {
        throw new Exception_MailSendingError('Cannot send email. Please, contact administrator.', 500);
      }
      MessageHandler::getInstance()->registerMessage('Email was successfully been sent.', MessageHandler::MH_MESSAGE | MessageHandler::ACCESS_USER);
    }catch(Exception_MailSendingError $e) {
      MessageHandler::getInstance()->registerMessage($e->getMessage(), MessageHandler::MH_ERROR | MessageHandler::ACCESS_USER);
    }
  }
  
} // End Model_Mail