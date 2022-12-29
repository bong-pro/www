<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends CP_Controller
{

	public function index()
	{
		$this->document->config('ID', 102020);
		$this->document->config('page_title', 'Group list');
		$this->document->view('main/nail/groups');
	}

}
