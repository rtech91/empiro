<?php defined('SYSPATH') or die('No direct script access.');

class StorageAccessException extends Kohana_Exception {
	
	public function __construct() {
		parent::__construct();
	}
	
} // End StorageAccessException