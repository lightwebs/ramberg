<?php 

class Walker_Nav_Primary extends Walker_Nav_Menu 
{
	function start_lvl( &$output, $depth = 0, $args = array() ) // ul
	{
		$indent = str_repeat("\t", $depth);
		$sub_menu = ($depth > 0) ? ' sub-menu' : '';
		$output .= "\n$indent <ul class='dropdown-menu$sub_menu depth_$depth'>";
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 )  // li a 
	{
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		$li_attributes = $class_name = $value = '';

		$classes = empty($item->classes) ? array() : (array) $item->classes;

		$classes[] = ($args->walker->has_children) ? 'dropdown' : '';
		$classes[] = ($item->current || $item->current_item_ancestor) ? ' active' : '';
		$classes[] = 'menu-item-'.$item->ID;
		$classes[] = 'nav-item';

		if($depth && $args->walker->has_children) {
			$classes[] = 'dropdown-submenu';
		}

		$class_name = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_name = ' class="'.esc_attr($class_name).'"';

		$id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
		$id = strlen($id) ? ' id="'.esc_attr($id).'"' : '';

		$output .= $indent . '<li' . $id . $value . $class_name . $li_attributes . '>';

		$attributes = !empty($item->attr_title) ? ' title="'.esc_attr($item->attr_title).'"' : '';
		$attributes .= !empty($item->target) ? ' target="'.esc_attr($item->target).'"' : '';
		$attributes .= !empty($item->xfn) ? ' rel="'.esc_attr($item->xfn).'"' : '';
		$attributes .= !empty($item->url) ? ' href="'.esc_attr($item->url).'"' : '';


		$attributes .= ($args->walker->has_children) ? ' class="dropdown-toggle nav-link"' : '';

		$item_output = $args->before;
		$item_output .= '<a'.$attributes.' class="nav-link">';
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= ($depth == 0 && $args->walker->has_children) ? '</a>' : '</a>';
		$item_output .= ( ($depth == 0 || $depth == 1 ) && $args->walker->has_children) ? '<span class="submenu-opener"></span>' : '';
		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

	}


	/*function end_el() // closing li a
	{

	}

	function end_lvl() // closing ul
	{

	}*/

}