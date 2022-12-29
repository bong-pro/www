<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CP_Controller
{

	public function index()
	{
		$this->document->config('ID', 103090);
		$this->document->config('page_title', 'Setting');
		$this->document->view('main/eyelash/setting');
	}

}
