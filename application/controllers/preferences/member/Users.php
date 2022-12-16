<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CP_Controller
{

	public function __construct()
	{
		parent::__construct();

		// load model
		$this->load->model('Model_users');
		$this->load->model('Model_groups');
	}

	public function index()
	{
		// load page
		$this->document->config('ID', 90902010);
		$this->document->config('page_title', 'User list');
		$this->document->view('preferences/member/users', array(
			'groups' => $this->Model_groups->list(array('is_used' => 'Y'))
		));
	}

	public function list()
	{
		$params = array(
			'keyword'		=> $this->input->get('keyword'),
			'is_used'		=> $this->input->get('is_used'),
			'start'			=> $this->input->get('start'),
			'end'			=> $this->input->get('end'),

			'limit'			=> $this->input->get('limit'),
			'offset'		=> $this->input->get('offset'),
			'orderby'		=> $this->input->get('orderby'),
			'order'			=> $this->input->get('order'),
		);

		$args = array_filter($params, function($v) {
			return (isset($v) && !is_null($v));
		});

		$data = $this->Model_users->list($args);

		cp_api_json($data);
	}

	public function item_get($target_id='')
	{
		if (empty($target_id)) {
			return false;
		}

		$data = $this->Model_users->_item(null, array(
			'user_id' => $target_id,
		));

		cp_api_json($data);
	}

	public function item_delete($target_id='')
	{
		if (!empty($target_id)) {
			$data = $this->Model_users->_delete($target_id, null);
		}

		cp_api_json($data);
	}

	public function selected_delete()
	{
		if (!empty($this->input->post())) {
			$data = $this->Model_users->_selected_delete($this->input->post());
		}

		cp_api_json($data);
	}

	public function status_put($target_id='')
	{
		$data = array(
			'is_used' => $this->input->post('is_used'),
		);

		$data['result'] = $this->Model_users->_update(null, $data, array(
			'user_id' => $target_id,
		));
		
		cp_api_json($data);
	}

	public function password_put($target_id='')
	{
		if (empty($this->input->post('password'))) {
			echo 'No value';
			return false;
		}

		$this->load->helper('security');

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
		if (empty($this->input->post('name'))) return false;
		if (empty($this->input->post('email'))) return false;
		if (empty($this->input->post('mobile'))) return false;
		if (empty($this->input->post('is_used'))) return false;

		$data = array(
			'name'			=> preg_replace('/\s+/', '', strtolower($this->input->post('name'))),
			'email'			=> $this->input->post('email'),
			'mobile'		=> $this->input->post('mobile'),
			'is_used'		=> $this->input->post('is_used')
		);

		try {
			$update = array_filter($data, function($v) {
				return null !== $v;
			});

			if (empty($update)) {
				throw new Exception('There is on data to register');
			}

			$update['group_id'] = !empty($this->input->post('group_id')) ? $this->input->post('group_id') : null;

			$data['result'] = $this->Model_users->_update(null, $update, array(
				'user_id' => $target_id,
			));

			$data['message'] = 'Success';
		} catch (Exception $e) {
			$data['message'] = $e->getMessage();
		}

		cp_api_json($data);
	}

	public function item_insert()
	{
		if (empty($this->input->post('login'))) return false;
		if (empty($this->input->post('name'))) return false;
		if (empty($this->input->post('email'))) return false;
		if (empty($this->input->post('mobile'))) return false;

		$this->load->library('form_validation');
		$this->load->helper('security');

		$this->form_validation->set_rules('login', 'Login ID', 'trim|required|alphanumunder|min_length[3]|max_length[30]|is_unique[users.login]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('name', 'User name', 'trim|required|min_length[3]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('email', 'User email', 'trim|required|valid_email|min_length[8]|max_length[50]');
		$this->form_validation->set_rules('mobile', 'User mobile', 'trim|required|numeric|min_length[10]|max_length[30]');

		if ($this->form_validation->run() === true) {
			$login		= $this->input->post('login') ? preg_replace('/\s+/', '', strtolower($this->input->post('login'))) : '';
			$password	= $this->input->post('password') ? do_hash($this->input->post('password'), 'md5') : '';
			$name		= $this->input->post('name') ? preg_replace('/\s+/', '', strtolower($this->input->post('name'))) : '';

			$data = array(
				'login'			=> $login,
				'password'		=> $password,
				'name'			=> $name,
				'email'			=> $this->input->post('email'),
				'mobile'		=> $this->input->post('mobile'),
				'group_id'		=> $this->input->post('group_id')
			);

			try {
				$update = array_filter($data, function($v) {
					return null !== $v && '' !== $v;
				});

				if (empty($update)) {
					throw new Exception('There is on data to register');
				} else {
					$data['result']		= $this->Model_users->_insert($update);
					$data['message']	= 'Success';
				}
			} catch (Exception $e) {
				$data['message'] = $e->getMessage();
			}
		} else {
			return false;
		}

		cp_api_json($data);
	}

}
