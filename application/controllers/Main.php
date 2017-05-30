<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->model('storage');
		$this->storage->check_folder();
		$this->load->view('front');
	}
}
