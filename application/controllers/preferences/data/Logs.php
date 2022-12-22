<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CP_Controller
{

	public function __construct()
	{
		parent::__construct();

		// load model
		$this->load->model('Model_logs');
	}

	public function index()
	{
		$logs = $this->Model_logs->logs();
		$log_data = '';

		if ($logs['list']) {
			foreach ( $logs['list'] as $item ) {
				$user_ip = $item['user_ip'];
				$user_id = $item['user_id'];
				$contents = $item['contents'];
				$created_at = $item['created_at'];

				$log_data .= "
	{
		\"created_at\" : \"{$created_at}\",
		\"ip\" : \"{$user_ip}\",
		\"user_id\" : \"{$user_id}\",
		\"contents\" : \"{$contents}\"
	},";
			}
			$log_data = substr($log_data, 0, -1);
			$log_data = "[{$log_data}
]";
		} else {
			$log_data .= "
[
	{
		\"data\" : \"none\"
	}
]
		";
		}

		$this->document->config('ID', 903010);
		$this->document->config('page_title', 'Log data');
		$this->document->view('preferences/data/logs', array(
			'logs' => $log_data,
		));
	}

	public function data_download()
	{
		$this->load->helper('download');

		$logs = $this->Model_logs->logs();

		$data = print_r($logs['list'], true);
		$name = 'log_' . date('Ymdhis') . '.txt';

		force_download($name, $data);
	}

	public function data_delete()
	{
		$this->Model_logs->empty_table();

		$data['message'] = 'Delete completed.';

		cp_api_json( $data );
	}

}
