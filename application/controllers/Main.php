<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array();
		$data['content'] = $this->load->view('main', [], TRUE);
		$this->render($data);
	}

}
