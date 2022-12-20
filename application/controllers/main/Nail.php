<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nail extends CP_Controller
{

	public function index()
	{
		$this->document->config('ID', 1020);
		$this->document->config('page_title', 'Nail');
		$this->document->view('main/nail');
	}

}
