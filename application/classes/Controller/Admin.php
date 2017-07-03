<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller {
 
  public function action_entrance() {
    if($this->request->method() === Request::POST) {
      $password = $this->request->post('password');
      if(Valid::not_empty($password) && Valid::equals($password, '123456')) {
        
      }else {
        MessageHandler::getInstance()->registerMessage('Wrong password!', MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN);
      }
    }
    
    $messages = MessageHandler::getInstance()->getMessages();
    $view = new View('layout');
    $view->header = new View('header');
    $view->content = new View('admin_password');
    $view->content->messages = $messages;
    $view->footer = new View('footer');
    $this->response->body($view->render());  
  }
  
}