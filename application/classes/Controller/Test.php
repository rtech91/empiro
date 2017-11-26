<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Test extends Controller {

  /**
   * Create basic template of test
   */
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
        $allowToReanswerNode = $test_template->createElement('allowtoreanswer', 'false');
        $root->appendChild($allowToReanswerNode);
        $allowToReanswerNode = $test_template->createElement('allowtaskreviews', 'false');
        $root->appendChild($allowToReanswerNode);
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

  /**
   * Configure created test with filling necessary params
   */
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
  
  public function action_register()
  {
    $test_id = $this->request->param('test_id');
    if(!empty($test_id) && is_numeric($test_id)) {
      $session = Session::instance();
      $session->set('test_id', $test_id);
    }
    else {
      $this->redirect(URL::base());
    }
    $data = null;
    if($this->request->method() === Request::POST) {
      if(isset($_POST["op"]) && $_POST["op"] === "pass_st1_form") {
        $data = (object)$this->request->post();
        $val_output = Model_Test::validateRegisterData($data);
        if(true === $val_output) {
          $session = Session::instance();
          $session->set('surname', $data->surname);
          $session->set('name', $data->name);
          $session->set('midname', $data->midname);
          $this->redirect(URL::site(Route::get('pass_test_st2')->uri(), true));
        }
      }
    }
    $messages = MessageHandler::getInstance()->getMessages();
    $groups = Model_Group::getAll();
    $view = new View('layout');
    $view->header = new View('header');
    $view->content = new View('test_pass_st1');
    $view->content->messages = $messages;
    $view->content->groups = $groups;
    $view->footer = new View('footer');
    $this->response->body($view->render());
  }

  public function action_questions()
  {
    
  }

  /**
   * Save full test into test storage
   */
  public function action_save()
  {
    if($this->request->method() === Request::POST) {
      $data = (object)$this->request->post();
      Model_Test::saveFullTest($data);
      $this->redirect(URL::base());
    }
  }
} // End Test