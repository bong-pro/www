<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CP_Controller
{

	public function index()
	{
		$this->document->config('ID', 102020);
		$this->document->config('page_title', 'Group');
		$this->document->view('main/nail/group');
	}

}
