<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CP_Controller
{

	public function index()
	{
		$this->document->config('ID', 103010);
		$this->document->config('page_title', 'Product list');
		$this->document->view('main/eyelash/products');
	}

}
