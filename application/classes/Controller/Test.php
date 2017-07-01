<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Test extends Controller {
    public function action_create()
	{
        $data = null;
        if($this->request->method() === Request::POST) {
            $data = (object)filter_var_array($_POST, FILTER_SANITIZE_STRING);
            Model_Test::validateInitialData($data);
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
		$view = new View('layout');
		$view->header = new View('header');
		$view->content = new View('test_creation_st2');
		$view->footer = new View('footer');
		$this->response->body($view->render());
	}
} // End Test