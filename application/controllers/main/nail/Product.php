<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CP_Controller
{

	public function index()
	{
		$this->document->config('ID', 102010);
		$this->document->config('page_title', 'Product');
		$this->document->view('main/nail/product');
	}

}
