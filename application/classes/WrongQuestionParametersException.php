<?php defined('SYSPATH') or die('No direct script access.');

class WrongQuestionParametersException extends Kohana_Exception {
	
	public function __construct() {
		parent::__construct();
	}
	
} // End WrongQuestionParametersException