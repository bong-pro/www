<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_menus extends CP_Model
{

	/**
	 * table name
	 */
	protected $_table = 'menus';

	/**
	 * primary key
	 */
	protected $primary_key = 'menu_id';

	/**
	 * search fields=keyword
	 */
	protected $search_keyword_fields = array(
		'menu_id',
		'parent_menu_id',
		'name',
		'link',
	);

	/**
	 * 메뉴 아이템 반환
	 * @param number $parent_sid
	 * @return array()
	 */
	public function list($parent_menu_id=0)
	{
		/**
		 * 페이지 그룹 권한
		 **/
		if (uri_string() !== '') {
			$uri_top		= '/';
			$uri_group		= $uri_top . uri_string();
			$uri_dashboard	= '/dashboard';
			$uri_sub		= '-';
			$group_power	= null;

			if (!empty($this->user->item('group_id'))) {
				$this->db->select('permission');
				$this->db->from('groups');
				$this->db->where('group_id', $this->user->item('group_id'));
				$this->db->limit(1);

				$query = $this->db->get();
				$group = $query->row_array();

				if (!empty($group['permission'])){
					$permission = explode(',', str_replace('"', '', $group['permission']));

					for ($i=0; $i<count($permission); $i++) {
						if ($uri_group == $permission[$i] || $uri_group == $uri_top || $uri_group == $uri_dashboard || strpos($uri_group, $uri_sub)) {
							$group_power = true;
							break;
						} else {
							$group_power = false;
						}
					}
				} else {
					$group_power = $uri_group == $uri_top || $uri_group == $uri_dashboard ? true : false;
				}
			} else {
				$group_power = $uri_group == $uri_top || $uri_group == $uri_dashboard || strpos($uri_group, $uri_sub) ? true : false;
			}
			$message = $group_power == false ? "<script>alert('The page is not authorized');history.go(-1)</script>" : '';
			echo $message;
		}

		$cache_name= strtolower( __CLASS__ . '-' . __FUNCTION__ );
		$cache_time = cp_config_item( 'cache_lifetime', 60 * 60 );

		if (FALSE === ($data = $this->cache->get($cache_name))) {
			$data = $this->_recursive_list($parent_menu_id);
			$this->cache->save($cache_name, $data, $cache_time);
		}

		return $data;
	}

	private function _recursive_list($parent_menu_id=0)
	{
		$data = $this->_list(
			null,
			null,
			array(
				'parent_menu_id'    => $parent_menu_id,
				'is_used'           => 'Y'
			),
			array(
				'priority'          => 'DESC',
				$this->primary_key  => 'ASC',
			)
		);

		$r = array();
		if ($data['total_rows'] > 0) {
			foreach ($data['list'] as $item) {
				$item['_children'] = $this->_recursive_list($item['menu_id']);
				$r[] = $item;
			}
		}

		return $r;
	}

	public function item($menu_id=-1)
	{
		$data = $this->_item($menu_id);

		if (false !== $data && $data['parent_menu_id'] > 0) {
			$data['_parent'] = $this->item($data['parent_menu_id']);
		}

		return $data;
	}

	public function menu_list($args=array())
	{
		$defaults = array(
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
			";
		}

		$where = '1=1';

		if (!empty($args['keyword'])) {
			$where .= $this->__where_by_keyword($args['keyword']);
		}

		if (!empty($args['is_used'])) {
			$where .= " AND {$this->_table}.is_used=" . $this->db->escape($args['is_used']);
		}

		if ($args['limit'] < 1) {
			$args['limit'] = null;
		}

		return $this->_list(
			$args['select'],
			null,
			$where,
			array(
				$args['orderby'] => $args['order'],
			),
			$args['limit'],
			$args['offset']
		);
	}

}
