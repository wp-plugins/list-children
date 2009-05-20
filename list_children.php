<?php
/*
Plugin Name: List Children
Plugin Author: Andy Stratton
Plugin URI: http://theandystratton.com
Author URI: http://theandystratton@gmail.com
Version: 1.0
Description: Use an HTML comment (<code>&lt;!--list_children()--&gt;</code> or <code>&lt;!--list_siblings()--&gt;</code>) in post content to call wp_list_pages for sub-pages/siblings of the current page.
*/

function lc_list_children( $sort_column = 'menu_order', $sort_order = 'ASC' ) {
	return wp_list_pages('echo=0&title_li=&child_of=' . get_the_ID() . "&sort_column=$sort_column&sort_order=$sort_order&depth=1");
}

function lc_list_siblings( $sort_column = 'menu_order', $sort_order = 'ASC', $exclude = true ) {
	global $post;
	$parent = $post->post_parent;
	if ( $exclude ) {
		$exclude = '&exclude=' . get_the_ID();
	}
	else {
		$exclude = '';
	}
	return wp_list_pages('echo=0&title_li=&child_of=' . $parent . "&sort_column=$sort_column&sort_order=$sort_order&depth=1" . $exclude);
}

function lc_list_pages_content( $content ) {
	$comment = '<!--list_children()-->';
	$content = str_replace($comment, lc_list_children(), $content);
	$comment = '<!--list_siblings()-->';
	$content = str_replace($comment, lc_list_siblings('menu_order', 'ASC', true), $content);
	$comment = '<!--list_siblings(true)-->';
	$content = str_replace($comment, lc_list_siblings('menu_order', 'ASC', true), $content);
	$comment = '<!--list_siblings(false)-->';
	$content = str_replace($comment, lc_list_siblings('menu_order', 'ASC', false), $content);
	return $content;
}

add_filter('the_content', 'lc_list_pages_content');