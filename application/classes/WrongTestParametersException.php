<?php defined('SYSPATH') or die('No direct script access.');

class WrongTestParametersException extends Kohana_Exception {

	protected $message;

    public function __construct($message) {
		parent::__construct();
		$this->message = $message;
	}

} // End WrongTestParametersException