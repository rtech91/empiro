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
	
	public function action_contacts()
	{
		if($this->request->method() === Request::POST) {
			$data = (object)filter_var_array($_POST, FILTER_SANITIZE_STRING);
			// additionally remove dangerous symbols from email value
			$data->contact_email = filter_var($data->contact_email, FILTER_SANITIZE_EMAIL);
			//TODO: add reaction handling for exception situations,
			// such as empty input text or wrong message category
			Model_Mail::sendContactMail($data);
		}
		
		$view = new View('layout');
		$view->header = new View('header');
		$view->content = new View('contact');
		$view->footer = new View('footer');
		$this->response->body($view->render());
	}

} // End Main
