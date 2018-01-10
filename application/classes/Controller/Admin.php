<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller {

  private $tests;

  public function action_entrance() {
    if($this->request->method() === Request::POST) {
      $password = $this->request->post('password');
      $secure_config = Kohana::$config->load('secure');
      $stored_password_hash = $secure_config->get('admin_password_hash');
      if(Valid::not_empty($password) && Valid::equals(sha1($password), $stored_password_hash)) {
        Session::instance()->set('logged_in', 'logged');
        $this->redirect(URL::site(Route::get('admin_main')->uri()));
      }else {
        MessageHandler::getInstance()->registerMessage(__('Wrong password!'), MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN);
      }
    }
    if(Session::instance()->get('logged_in') == true) {
    	$this->redirect(URL::site(Route::get('admin_main')->uri()));
    }

    $messages = MessageHandler::getInstance()->getMessages();
    $view = new View('layout');
    $view->header = new View('header');
    $view->content = new View('admin_password');
    $view->content->messages = $messages;
    $view->footer = new View('footer');
    $this->response->body($view->render());
  }

    public function action_logout() {
    	$is_logged = Session::instance()->get('logged_in');
    	if(null !== $is_logged && 'logged' === $is_logged) {
    		Session::instance()->destroy();
    		$this->redirect(URL::base());
    	}
    }

  public function action_main() {
    $storage = Model_Storage::getInstance();
    $this->tests = $storage->getAllAvailableTests();
    $tests = array();
    if(null !== $this->tests && count($this->tests) > 0) {
      $tests = $this->tests;
    }
    $messages = MessageHandler::getInstance()->getMessages();
    $view = new View('layout');
    $view->header = new View('header');
    $view->content = new View('admin_main');
    $view->content->messages = $messages;
    $view->content->tests = $tests;
    $view->footer = new View('footer');
    $this->response->body($view->render());
  }


}