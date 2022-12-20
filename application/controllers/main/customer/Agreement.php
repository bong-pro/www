<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agreement extends CP_Controller
{

	public function index()
	{
		$this->document->config('ID', 109010);
		$this->document->config('page_title', 'Agreement');
		$this->document->view('main/customer/agreement');
	}

}
