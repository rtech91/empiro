<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Test extends Controller {
    public function action_create()
	{
		$view = new View('layout');
		$view->header = new View('header');
		$view->content = new View('test_creation_st1');
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