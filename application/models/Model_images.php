<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_images extends CP_Model
{

	/**
	 * table name
	 */
	protected $_table = 'images';

	/**
	 * primary key
	 */
	protected $primary_key = 'image_id';

	/**
	 * search fields=keyword
	 */
	protected $search_keyword_fields = array(
		'name',
	);

	/**
	 * search fields=start_end
	 */
	protected $search_start_end_field = 'created_at';

	public function list($args=array())
	{
		$defaults = array(
			'image_id'		=> '',
			'group_id'		=> '',

			'keyword'		=> '',
			'is_used'		=> '',
			'start'			=> '',
			'end'			=> '',

			'select'		=> '',
			'limit'			=> 10,
			'offset'		=> 0,
			'orderby'		=> $this->primary_key,
			'order'			=> 'DESC'
		);
		$args = cp_parse_args($args, $defaults);

		if (empty($args['select'])) {
			$args['select'] = "
				{$this->_table}.*,
				groups.group_id AS group_id,
				groups.name AS group_name
			";
		}

		$where = '1=1';

		if (!empty($args['user_id'])) {
			$where .= " AND {$this->_table}.user_id=" . $this->db->escape($args['user_id']);
		}

		if (!empty($args['group_id'])) {
			$where .= " AND {$this->_table}.group_id=" . $this->db->escape($args['group_id']);
		}

		if (!empty($args['keyword'])) {
			$where .= $this->__where_by_keyword($args['keyword']);
		}

		if (!empty($args['start']) || ! empty($args['end'])) {
			$where .= $this->__where_by_start_end($args['start'], $args['end']);
		}

		if (!empty($args['is_used'])) {
			$where .= " AND {$this->_table}.is_used=" . $this->db->escape( $args['is_used'] );
		}

		if ($args['limit'] < 1) $args['limit'] = null;

		return $this->_list(
			$args['select'],
			array(
				array(
					'table'	=> 'images_groups AS groups',
					'on'	=> "{$this->_table}.group_id=groups.group_id"
				)
			),
			$where,
			array(
				$args['orderby'] => $args['order'],
			),
			$args['limit'],
			$args['offset']
		);
	}

}
