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

	public function item_get($target_id='')
	{
		if (empty($target_id)) {
			return false;
		}

		$this->load->model('Model_users');
		$data = $this->Model_users->item_user_group(null, array(
			'user_id' => $target_id
		));

		cp_api_json($data);
	}

}
