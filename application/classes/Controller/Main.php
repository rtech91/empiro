<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller {

	public function action_index()
	{
		try{
			$storage = new Model_Storage();
			$tests = $storage->check_folder();
		}catch(StorageAccessException $e) {
			echo 'Cannot read folder with tests!';
			$tests->array();
			exit(0);
		}
		
		$view = new View('front');
		$view->tests = $tests;
		$this->response->body($view->render());
	}

} // End Main
