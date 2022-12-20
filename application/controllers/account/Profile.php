<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profile extends CP_Controller
{

	public function index()
	{
		$this->document->config( 'ID', 8010 );
		$this->document->config( 'page_title', 'Profile' );

		$this->document->view( 'account/profile' );
	}

}
