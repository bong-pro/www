<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CP_Controller
{

	public function __construct()
	{
		parent::__construct();

		// load model
		$this->load->model('Model_images');
		$this->load->model('Model_images_groups');
	}

	public function index()
	{
		$this->document->config('ID', 102010);
		$this->document->config('page_title', 'Product list');
		$this->document->view('main/nail/products', array(
			'groups' => $this->Model_images_groups->list(array('is_used' => 'Y'))
		));
	}

	public function list()
	{
		$params = array(
			'image_id'		=> $this->input->get('image_id'),
			'group_id'		=> $this->input->get('group_id'),

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

		$data = $this->Model_images->list($args);

		cp_api_json($data);
	}

}
