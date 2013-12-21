<?php

//REGISTER GIDD ADMIN MENU
$ga	= ___page( 'Gidd Admin' );
___registry( 'gidd_admin', $ga );

//load optional addon
$addon = get_option( 'g5e1a928b' );

//SEO
if ( isset( $addon['g952d9bb5'] ) && ( $addon['g952d9bb5'] != "" ) )
	gidd_include_file( GIDDPATH . 'optional_addon/gidd_seo/gidd_load.php' );

//WP Config
if ( isset( $addon['g0776eb65'] ) && ( $addon['g0776eb65'] != "" ) )
	gidd_include_file( GIDDPATH . 'optional_addon/gidd_wp_config/gidd_load.php' );

//Gidd Download
if ( isset( $addon['g1f27f3d7'] ) && ( $addon['g1f27f3d7'] != "" ) )
	gidd_include_file( GIDDPATH . 'optional_addon/gidd_download/gidd_load.php' );



//custom functions.php from gidd theme
gidd_include_file( CHILDTHEME . 'functions.php' );

//custom functions.php from gidd template
gidd_include_file( CHILDTP . 'functions.php' );

//load customizer
gidd_include_file( CHILDPATH . 'gidd_customizer/gidd_load.php' );
if ( function_exists( '___customize' ) )
	add_action('customize_register', '___customize');


	
//load admin css & js if exists
add_action( 'admin_head', 'gidd_admin_head' );
function gidd_admin_head(){

	$css = CHILDTP . 'admin/admin.css';
	$js = CHILDTP . 'admin/admin.js';
	
	if ( file_exists( $css ) )
		wp_enqueue_style( 'gidd-admin', CHILDTPURL . 'admin/admin.css', '', '1' );
	
	if ( file_exists( $js ) )
		wp_enqueue_script( 'gidd-admin', CHILDTPURL . 'admin/admin.js', array('jquery'), '1'  );
				
}


//fav icon for admin
add_action('admin_head', 'gidd_admin_fav_icon');
function gidd_admin_fav_icon(){
	$option = get_option('g9239ee2c');
	$fav_url = isset( $option['gb0c1b6ee'] ) ? $option['gb0c1b6ee'] : "";	
	if ( $fav_url != "" )
	echo '<link rel="shortcut icon" href="'. esc_url( apply_filters('gidd_fav_icon', $fav_url) ) .'" />';
}


//tag for custom post type
add_filter('request', 'gidd_tag_post_type');
function gidd_tag_post_type($request) {
    if ( isset($request['tag']) && !isset($request['post_type']) )
    $request['post_type'] = 'any';
    return $request;
}


//enqueue scripts to head
add_action('wp_enqueue_scripts', 'gidd_template_enqueue_scripts');
function gidd_template_enqueue_scripts(){

	//Add custom script & style		
	$option = get_option('ga797e309');
	$fontawesome = isset( $option['g6ac73f09'] ) ? $option['g6ac73f09'] : "";
	$genericons = isset( $option['gdd0948ef'] ) ? $option['gdd0948ef'] : "";
	
	___fontawesome( $fontawesome ); #gidd_wp_helper.php
	___genericons( $genericons );		
	
}

/** end */