<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CP_Controller
{

	public function __construct()
	{
		parent::__construct();

		// load model
		$this->load->model('Model_users');
	}

	public function index()
	{
		$this->document->config( 'ID', 8020 );
		$this->document->config( 'page_title', 'Setting' );

		$this->document->view( 'account/setting' );
	}

	public function item_get($target_id='')
	{
		if (empty($target_id)) {
			return false;
		}

		$data = $this->Model_users->item_user_group(null, array(
			'user_id' => $target_id
		));

		cp_api_json($data);
	}

	public function password_put($target_id='')
	{
		$this->load->helper('security');

		$check_pw = do_hash($this->input->post('password_old'), 'md5');
		$check = $this->Model_users->_item(null, array(
			'user_id' => $target_id,
			'password' => $check_pw
		));

		if (empty($check)) {
			echo 'Old password does not match';
			return false;
		}

		if (strlen($this->input->post('password')) < 4 || strlen($this->input->post('password')) > 20) {
			echo 'The length of password is 4 or more and 20 or less';
			return false;
		}

		if ($this->input->post('password') !== $this->input->post('password_cp')) {
			echo 'Password and Confirm password do not match';
			return false;
		}

		$data = array(
			'password' => do_hash($this->input->post('password'), 'md5')
		);

		$data['result'] = $this->Model_users->_update(null, $data, array(
			'user_id' => $target_id,
		));

		$data['message'] = 'Success';

		cp_api_json($data);
	}

	public function item_put($target_id='')
	{
		$data = array(
			'name'      => preg_replace('/\s+/', '', strtolower($this->input->post('name'))),
			'email'     => $this->input->post('email'),
			'mobile'    => $this->input->post('mobile'),
		);

		try {
			$update = array_filter($data, function($v) {
				return null !== $v;
			});

			if (empty($update)) {
				throw new Exception('There is on data to register');
			}

			$data['result'] = $this->Model_users->_update(null, $update, array(
				'user_id' => $target_id,
			));

			$data['message'] = 'Success';
		} catch (Exception $e) {
			$data['message'] = $e->getMessage();
		}

		cp_api_json($data);
	}

}
