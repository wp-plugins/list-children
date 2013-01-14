<?php
/*
Plugin Name: List Children
Author: theandystratton
Author URI: http://theandystratton.com
Version: 1.1
Description: Use a shortcode to list all child or sibling pages of the current page displayed. You can use an HTML comment (<code>&lt;!--list_children()--&gt;</code> or <code>&lt;!--list_siblings()--&gt;</code>) but it's deprecated – only remains for backwards compatibility.
*/

class Szbl_List_Children
{
	private static $instance;
	
	public static function init()
	{
		if ( is_null( self::$instance ) ) 
			self::$instance = new Szbl_List_Children();
		return self::$instance;
	}
	
	private function __construct()
	{
		// supported
		add_shortcode( 'list_children', array( $this, 'list_children' ) );
		add_shortcode( 'list_siblings', array( $this, 'list_siblings' ) );
	}
	
	public function list_children( $atts )
	{
		$params = shortcode_atts(array(
			'parent' => 0,
			'sort_column' => 'menu_order, post_title',
			'sort_order' => 'ASC',
			'depth' => 1,
			'title_li' => '',
			'include' => null,
			'exclude' => null,
			'date_format' => get_option( 'date_format' ),
			'link_before' => '',
			'link_after' => '',
			'authors' => null,
			'offset' => 0,
			'post_type' => get_post_type()
		), $atts);
		
		if ( !$params['parent'] )
			$params['parent'] = get_the_ID();
		
		$params['echo'] = false;
		
		return wp_list_pages( $params );
	}
	
	public function list_siblings( $atts )
	{	
		if ( isset( $atts['post_id'] ) && $atts['post_id'] )
			$post = get_post( (int) $atts['post_id'] );
		else
			$post = $GLOBALS['post'];
			
		if ( !isset( $atts['exclude_me'] ) || strtolower( $atts['exclude_me'] ) != 'false' )
		{
			if ( !isset( $atts['exclude'] ) )
				$atts['exclude'] = $post->ID;
			else
				$atts['exclude'] .= ',' . $post->ID;
		}
		
		$atts['parent'] = $post->post_parent;
		return $this->list_children( $atts );
	}
	
}
Szbl_List_Children::init();

/*
 * Use of the following is deprecated and will be removed in a version 2.0
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
	$content = str_replace( $comment, lc_list_children(), $content);
	$comment = '<!--list_siblings()-->';
	$content = str_replace( $comment, lc_list_siblings( 'menu_order', 'ASC', true ), $content );
	$comment = '<!--list_siblings(true)-->';
	$content = str_replace( $comment, lc_list_siblings( 'menu_order', 'ASC', true ), $content );
	$comment = '<!--list_siblings(false)-->';
	$content = str_replace( $comment, lc_list_siblings( 'menu_order', 'ASC', false ), $content );
	return $content;
}

add_filter( 'the_content', 'lc_list_pages_content' );