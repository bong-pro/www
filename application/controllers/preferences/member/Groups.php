<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends CP_Controller
{

	public function __construct()
	{
		parent::__construct();

		// load model
		$this->load->model( 'Model_groups' );

		// load helper
		$this->load->helper('directory');
		$this->load->helper('tree');
	}

	public function index()
	{
		$tree_data = directory_map('../application/controllers');
		$tree = doc_generate_tree_json($tree_data, array(), null);

		// load page
		$this->document->config('ID', 90902020);
		$this->document->config('page_title', 'Group list');
		$this->document->view('preferences/member/groups', array(
			'tree' => $tree,
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

		$data = $this->Model_groups->list($args);

		cp_api_json($data);
	}

	public function item_get($target_id='')
	{
		if (empty($target_id)) {
			return false;
		}

		$data = $this->Model_groups->_item(null, array(
			'group_id' => $target_id,
		));

		$select = !empty($data['permission']) ? $data['permission'] : null;

		$tree_data = directory_map('../application/controllers');
		$tree = doc_generate_tree_json($tree_data, array(), $select);
		$data['tree'] = $tree;

		cp_api_json($data);
	}

	public function item_delete($target_id='')
	{
		if (!empty($target_id)) {
			$data = $this->Model_groups->_delete($target_id, null);
		}

		cp_api_json($data);
	}

	public function selected_delete()
	{
		if (!empty($this->input->post())) {
			$data = $this->Model_groups->_selected_delete($this->input->post());
		}

		cp_api_json($data);
	}

	public function status_put($target_id='')
	{
		$data = array(
			'is_used' => $this->input->post( 'is_used' ),
		);

		$data['result'] = $this->Model_groups->_update(null, $update, array(
			'group_id' => $target_id,
		));

		cp_api_json($data);
	}

	public function item_put($target_id='')
	{
		if (empty($this->input->post('name'))) return false;

		$tree_count = count($this->input->post());
		$tree_data = array();

		for ($i=0; $i<$tree_count; $i++) {
			if ($this->input->post($i)) {
				if (substr($this->input->post($i), 0, 1) === '/') {
					array_push($tree_data, $this->input->post($i));
				}
			}
		}

		$data = array(
			'name'		=> $this->input->post('name'),
			'is_used'	=> $this->input->post('is_used'),
		);

		try {
			$update = array_filter($data, function($v) {
				return null !== $v;
			});

			$tree_count > 0 ? $update['permission'] = '"' . implode( '","', $tree_data ) . '"' : $update['permission'] = null;

			if (empty($update)) {
				throw new Exception('There is on data to register');
			}

			$data['result'] = $this->Model_groups->_update(null, $update, array(
				'group_id' => $target_id,
			));

			$data['message'] = 'Success';
		} catch (Exception $e) {
			$data['message'] = $e->getMessage();
		}

		cp_api_json($data);
	}

	public function item_insert()
	{
		if (empty($this->input->post('name'))) {
			return false;
		} else {
			$check = $this->Model_groups->_item( null, array(
				'name' => $this->input->post('name'),
			));
			if (!empty($check)) {
				echo 'There are duplicate values';
				return false;
			}
		}

		$tree_count = count($this->input->post());
		$tree_data = array();

		for ($i=0; $i<$tree_count; $i++) {
			if ($this->input->post($i)) {
				if (substr($this->input->post($i), 0, 1) === '/') {
					array_push($tree_data, $this->input->post($i));
				}
			}
		}

		$data = array(
			'name'			=> $this->input->post('name'),
			'permission'	=> '"' . implode('","', $tree_data) . '"',
			'is_used'		=> $this->input->post('is_used'),
		);

		try {
			$update = array_filter($data, function($v) {
				return null !== $v;
			});

			if (empty($update)) {
				throw new Exception('There is on data to register');
			} else {
				$data['result']		= $this->Model_groups->_insert($update);
				$data['message']	= 'Success';
			}
		} catch (Exception $e) {
			$data['message'] = $e->getMessage();
		}

		cp_api_json($data);
	}

}
