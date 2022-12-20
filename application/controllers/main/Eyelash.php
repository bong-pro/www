<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eyelash extends CP_Controller
{

	public function index()
	{
		$this->document->config('ID', 1030);
		$this->document->config('page_title', 'Eyelash');
		$this->document->view('main/eyelash');
	}

}
