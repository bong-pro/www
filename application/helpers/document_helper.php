<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function doc_generate_nav($nav_data=array(), $menu_id=false, $n=null, $group_permission=array())
{
	$html = '';
	foreach ($nav_data AS $key => $item) {
		$item_class = 'nav-item';
		$link_class = 'nav-link';

		if ( $menu_id == $item['menu_id'] ) $link_class .= ' active';

		if (in_array(strtolower($item['link']), $group_permission) || $item['link'] == '#') {
			$link_class .= ' ' . $item['link_class'];
		} else {
			$link_class .= ' disabled';
		}

		$target = '';
		if ( !empty($item['link_target']) ) $target = 'target="' . html_escape($item['link_target']) . '"';

		$show_class = '';
		$child_html = '';
		if ( isset($item['_children']) && sizeof($item['_children']) > 0 ) {
			$n = $n ? (int) $n : (int) 4;
			$show_class = substr($menu_id, 0, (int) $n) == $item['menu_id'] ? ' show' : '';
			$n = substr($menu_id, 0, (int) $n) == $item['menu_id'] ? $n += 2 : $n;
				
			$name_e = html_escape($item['name']);
			$child_html .= "<ul class=\"nav-group-sub collapse{$show_class}\" data-submenu-title=\"{$name_e}\">";
			$child_html .= doc_generate_nav($item['_children'], $menu_id, $n, $group_permission);
			$child_html .= "</ul>";

			$item_class .= " nav-item-submenu";
			if ( preg_match("/<li(.*?)class=\"(.*?)active(.*?)\"(.*?)>(.*?)<\/li>/i", $child_html) ) {
				$item_class .= " nav-item-expanded nav-item-open";
			}
		}

		$item_class_e = html_escape($item_class);
		$link_class_e = html_escape($link_class);
		$html .= "<li class=\"{$item_class_e}\" data-menu-id=\"{$item['menu_id']}\">"
			. "<a href=\"{$item['link']}\" class=\"{$link_class_e}\" {$target}>"
			. "{$item['before_html']}<span>{$item['name']}</span>{$item['after_html']}"
			. "</a>{$child_html}</li>";
	}

	return $html;
}

function doc_generate_breadcrumb($menu_item, $no_display_1_depth=true)
{
	$html = '';
	if ( !empty($menu_item) && is_array($menu_item) ) {
		if ( isset($menu_item['_parent']) && sizeof($menu_item['_parent']) > 0 ) {
			$html .= doc_generate_breadcrumb($menu_item['_parent'], $no_display_1_depth);
		}

		if ( $no_display_1_depth && $menu_item['parent_menu_id'] < 1 ) return $html;

		$html .= sprintf("<a href=\"%s\" class=\"breadcrumb-item\">%s</a>" . PHP_EOL, $menu_item['link'], $menu_item['name']);
	}

	return $html;
}
