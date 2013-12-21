<?php

/*** THEME CONFIG ***/
add_action('after_setup_theme', 'gidd_after_theme_setup');
function gidd_after_theme_setup(){

	/* This theme uses post thumbnails */
	if ( function_exists( 'add_theme_support' ) )
		add_theme_support( 'post-thumbnails' );

	/* This theme supports WordPress 3 menu */
	if ( function_exists( 'add_theme_support' ) )
		add_theme_support( 'menus' );

	/* Add default posts and comments RSS feed links to head */
	if ( function_exists( 'add_theme_support' ) )
		add_theme_support( 'automatic-feed-links' );
	
	/* Register Nav Menu */
	$menu = array(
		'primary' => __( 'Primary Menu', 'gidd' ),
		'secondary' => __( 'Secondary Menu', 'gidd' ),
	);
	
	$menu = apply_filters( 'gidd_nav_menu', $menu );		
	register_nav_menus( $menu );

	
	/* Add editor style */
	$option = get_option('ga797e309');
	if ( !isset( $option['gb68502cf'] ) || ( $option['gb68502cf'] == "" ) ){
		add_editor_style('gidd/gidd_master/editor.css');
	}
	
}

//remove the generator
add_filter('the_generator', 'gidd_remove_version');
function gidd_remove_version() {
	return '';
}

$option = get_option('g9239ee2c');
if ( isset( $option['g2c0bd59e'] ) && ( $option['g2c0bd59e'] != "" ) ){
	add_filter('admin_footer_text', 'gidd_admin_footer');
	add_filter( 'update_footer', 'gidd_footer_version', '1234');
}

function gidd_admin_footer(){  
    echo '<span id="gidd-footer"></span>';  
}

function gidd_footer_version(){
	return ' ';
}


/*** ADD HOME LINK TO THE NAV ***/
$home_link_option = get_option('g9239ee2c');
$is_home_link_checked = isset( $home_link_option['g680acce0'] ) ? $home_link_option['g680acce0'] : "";
if ( $is_home_link_checked ){
	add_filter( 'wp_nav_menu_items', 'add_home_link', 10, 2 );
	add_filter( 'wp_page_menu_args', 'gidd_page_menu_args' );
}

function add_home_link( $menuItems, $args ) { 
	$home = "Home";
	if( 'primary' == strtolower($args->theme_location) ) {
		if ( is_front_page() )
			$class = 'class="current_page_item"';
		else
			$class = '';
 
		$homeMenuItem = '<li ' . $class . '>' .
						$args->before .
						'<a href="' . home_url() . '" title="'. $home .'">' .
							$args->link_before .
							$home .
							$args->link_after .
						'</a>' .
						$args->after .
						'</li>';
 
		$menuItems = $homeMenuItem . $menuItems;
		return $menuItems;
	}else{
		return $menuItems;
	}
}

function gidd_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}


//excerpt
add_filter('excerpt_length', 'gidd_excerpt_length');
function gidd_excerpt_length($length) {
	
	$option = get_option('gdc7f77b4');
	$limit = isset( $option['ge745be1e'] ) ? $option['ge745be1e'] : "";
	
	if( $limit != "" )
		$length = intval( $limit );
	
	return $length;
}

add_filter('excerpt_more', 'gidd_excerpt_more');
function gidd_excerpt_more( $more ) {    
	
	$more = ' ...';
	
	$option = get_option('gdc7f77b4');
	$end = isset( $option['g2d9e7505'] ) ? $option['g2d9e7505'] : "";
	
	if( $end != "" )
		$more = $end;
	
	return $more;
}


/* end */