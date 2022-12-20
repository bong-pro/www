<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart extends CP_Controller
{

	public function index()
	{
		$this->document->config('ID', 109020);
		$this->document->config('page_title', 'Chart');
		$this->document->view('main/customer/chart');
	}

}
