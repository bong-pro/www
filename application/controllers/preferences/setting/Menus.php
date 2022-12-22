<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends CP_Controller
{

	public function __construct()
	{
		parent::__construct();

		// load model
		$this->load->model('Model_menus');
	}

	public function index()
	{
		// load page
		$this->document->config('ID', 901010);
		$this->document->config('page_title', 'Menu List');
		$this->document->view('preferences/setting/menus');
	}

	public function list()
	{
		$params = array(
			'keyword'	=> $this->input->get('keyword'),
			'is_used'	=> $this->input->get('is_used'),
			'start'		=> $this->input->get('start'),
			'end'		=> $this->input->get('end'),

			'limit'		=> $this->input->get('limit'),
			'offset'	=> $this->input->get('offset'),
			'orderby'	=> $this->input->get('orderby'),
			'order'		=> $this->input->get('order'),
		);

		$args = array_filter($params, function($v) {
			return (isset($v) && !is_null($v));
		});

		$data = $this->Model_menus->menu_list($args);

		cp_api_json($data);
	}

	public function item_get($target_id='')
	{
		if (empty($target_id)) {
			return false;
		}

		$data = $this->Model_menus->_item(null, array(
			'menu_id' => $target_id,
		));

		cp_api_json($data);
	}

	public function status_put($target_id='')
	{
		$data = array(
			'is_used' => $this->input->post('is_used'),
		);

		$data['result'] = $this->Model_menus->_update(null, $data, array(
			'menu_id' => $target_id,
		));

		cp_api_json( $data );
	}

	public function item_put($target_id='')
	{
		$data = array(
			'name'				=> $this->input->post('name'),
			'parent_menu_id'	=> $this->input->post('parent_menu_id'),
			'priority'			=> $this->input->post('priority'),
			'link'				=> $this->input->post('link'),
			'is_used'			=> $this->input->post('is_used'),
		);

		try {
			$update = array_filter($data, function($v) {
				return null !== $v;
			});

			$update['link_target'] = !empty($this->input->post('link_target')) ? $this->input->post('link_target') : null;
			$update['link_class'] = !empty($this->input->post('link_class')) ? $this->input->post('link_class') : null;
			$update['before_html'] = !empty($this->input->post('before_html')) ? $this->input->post('before_html') : null;
			$update['after_html'] = !empty($this->input->post('after_html')) ? $this->input->post('after_html') : null;

			if (empty($update)) {
				throw new Exception('There is on data to register');
			}

			$data['result'] = $this->Model_menus->_update(null, $update, array(
				'menu_id' => $target_id,
			));

			$data['message'] = 'Success';
		} catch (Exception $e) {
			$data['message'] = $e->getMessage();
		}

		cp_api_json($data);
	}

	public function item_insert()
	{
		$check = $this->Model_menus->_item(null, array(
			'menu_id' => $this->input->post('menu_id'),
		));

		if (!empty($check)) {
			echo 'Overloverlapping [menu_id]';
			return false;
		}

		$data = array(
			'menu_id'			=> $this->input->post('menu_id'),
			'name'				=> $this->input->post('name'),
			'parent_menu_id'	=> $this->input->post('parent_menu_id'),
			'priority'			=> $this->input->post('priority'),
			'link'				=> $this->input->post('link'),
			'link_target'		=> $this->input->post('link_target'),
			'link_class'		=> $this->input->post('link_class'),
			'before_html'		=> $this->input->post('before_html'),
			'after_html'		=> $this->input->post('after_html'),
			'is_used'			=> $this->input->post('is_used'),
		);

		try {
			$update = array_filter($data, function($v) {
				return null !== $v;
			});

			if (empty($update)) {
				throw new Exception('There is on data to register');
			}

			$data['result'] = $this->Model_menus->_insert($update);
			$data['message'] = 'Success';
		} catch (Exception $e) {
			$data['message'] = $e->getMessage();
		}

		cp_api_json($data);
	}

}
