<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller {

	public function action_index()
	{	
		$view = new View('front');
		
		try{
			$storage = new Model_Storage();
			$tests = $storage->check_folder();
		}catch(StorageAccessException $e) {
			echo 'Cannot read folder with tests!';
		}catch(WrongQuestionParametersException $e) {
			echo 'Question parameters are wrong or do not exist!';
		}catch(WrongTestParametersException $e) {
			echo 'Test parameters are wrong or do not exist!';
		}finally {
			if(!isset($tests) || empty($tests)) {
				$tests = array();
			}
			$view->tests = $tests;
		}

		$this->response->body($view->render());
	}

} // End Main
