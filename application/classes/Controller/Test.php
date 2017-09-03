<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Test extends Controller {
  public function action_create()
  {
    $data = null;
    if($this->request->method() === Request::POST) {
      $data = (object)filter_var_array($_POST, FILTER_SANITIZE_STRING);
      $val_output = Model_Test::validateInitialData($data);
      if(true === $val_output) {
        $filename = uniqid();
        $test_template = new DOMDocument;
        $root = $test_template->createElement('test');
        $test_template->appendChild($root);
        $nameNode = $test_template->createElement('name', $data->name);
        $root->appendChild($nameNode);
        $categoryNode = $test_template->createElement('category', $data->category);
        $root->appendChild($categoryNode);
        $timeNode = $test_template->createElement('time',  date('H:i', mktime(0,$data->total_time)));
        $root->appendChild($timeNode);
        $minRightAnswersNode = $test_template->createElement('minrightanswers', $data->min_right_answers);
        $root->appendChild($minRightAnswersNode);
        $test_template->save(Model_Storage::STORAGE_FOLDER.$filename.'.xml');
        $session = Session::instance();
        $session->set('filename', $filename);
        $session->set('test_name', $data->name);
        $this->redirect(Route::get('configure_test')->uri());
      }
    }
    $messages = MessageHandler::getInstance()->getMessages();
    $view = new View('layout');
    $view->header = new View('header');
    $view->content = new View('test_creation_st1');
    if(null !== $data) {
        $view->content->data = $data;
    }
    $view->content->messages = $messages;
    $view->footer = new View('footer');
    $this->response->body($view->render());
  }

  public function action_configure()
  {
    $session = Session::instance();
    $filename = $session->get('filename');
    $test_name = $session->get('test_name');
    if(null === $filename || null === $test_name){
        $this->redirect(URL::site(Route::get('create_test')->uri(), true));
    }
    MessageHandler::getInstance()->registerMessage("New test created - $test_name", MessageHandler::ACCESS_ADMIN|MessageHandler::MH_MESSAGE);
    $messages = MessageHandler::getInstance()->getMessages();
    $view = new View('layout');
    $view->header = new View('header');
    $view->content = new View('test_creation_st2');
    $view->content->filename = $filename;
    $view->content->messages = $messages;
    $view->footer = new View('footer');
    $this->response->body($view->render());
  }
  
  public function action_save()
  {
    if($this->request->method() === Request::POST) {
      $data = (object)$this->request->post();
      Model_Test::parsePartialTest($data->filename);
    }
    //TODO: implement test saving
  }
} // End Test