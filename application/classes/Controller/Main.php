<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller {

	public function action_index()
	{
		$tests = array();
		$storage = Model_Storage::getInstance();
		$tests = $storage->getTests();
		$view = new View('layout');
		$view->header = new View('header');
		$view->content = new View('front');
		$view->content->tests = $tests;
		$view->footer = new View('footer');
		$this->response->body($view->render());
	}

} // End Main
