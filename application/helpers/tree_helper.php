<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function doc_generate_tree_json($tree_data=array(), $url_data=array(), $selected_data='')
{

	$json = '';
	foreach ($tree_data AS $key => $item) {
		$child_json = '';

		if (gettype($key) == 'string') {
			$url = implode('', $url_data);

			array_push($url_data, $key);
			$child_json .= "{title:'{$key}', key:'{$url}', folder:true, expanded:true, children:[";
			$child_json .= doc_generate_tree_json($item, $url_data, $selected_data);
			$child_json .= "]},";

			if (!empty($url_data)) array_pop($url_data);
		} else if ($item !== 'Dashboard.php' && $item !== 'Auth.php' && $item !== 'index.html') {
			$title_name = str_replace('.php', '', $item);
			$url = '/' . implode('', $url_data) . strtolower($title_name);

			$selected = '';
			if (!empty($selected_data)) {
				$permission = explode(',', str_replace('"', '', strtolower($selected_data)));
				$selected = in_array($url, $permission) ? ", selected:true" : ", selected:false";
			}

			array_push($url_data, str_replace('.php', '', $item));
			$child_json .= "{title:'{$title_name}', key:'{$url}', expanded:true{$selected}},";
			if (!empty($url_data)) array_pop($url_data);
		}
		$json .= $child_json;
	}
	return $json;

}
