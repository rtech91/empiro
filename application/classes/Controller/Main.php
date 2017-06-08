<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller {

	public function action_index()
	{
		$tests = array();
		$storage = Model_Storage::getInstance();
		$tests = $storage->getTests();
		$view = new View('front');
		$view->tests = $tests;
		$this->response->body($view->render());
	}

} // End Main
