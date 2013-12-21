<?php

$update = get_option( 'gfb91e24f' );

// Hides all upgrade notices
if( isset( $update['g0dd1916a'] ) && ( $update['g0dd1916a'] != "" ) ){
	add_action('admin_menu','hide_admin_notices');
}
function hide_admin_notices() {
    remove_action( 'admin_notices', 'update_nag', 3 );
}


// Remove the 'Updates' menu item from the admin interface
if( isset( $update['g2cdbfa6c'] ) && ( $update['g2cdbfa6c'] != "" ) ){
	add_action('admin_menu', 'remove_menus', 102);
}
function remove_menus() {
	global $submenu;
	remove_submenu_page ( 'index.php', 'update-core.php' );
}


// Disable core updates
if( isset( $update['ge385eb35'] ) && ( $update['ge385eb35'] != "" ) ){
	add_filter( 'pre_site_transient_update_core', create_function( "$a", "return null;" ) );
	remove_action( 'load-update-core.php', 'wp_update_core' );
}



// Disable theme updates
if( isset ( $update['g6501e5d5'] ) && ( $update['g6501e5d5'] != "" ) ){
	remove_action( 'load-update-core.php', 'wp_update_themes' );
	add_filter( 'pre_site_transient_update_themes', create_function( "$a", "return null;" ) );
}
// Disable plugin updates
if( isset ( $update['g2b71eeea'] ) && ( $update['g2b71eeea'] != "" ) ){
	remove_action( 'load-update-core.php', 'wp_update_plugins' );
	add_filter( 'pre_site_transient_update_plugins', create_function( "$a", "return null;" ) );
}
/*	add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
	add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );

	# 2.8 to 3.0:
	remove_action( 'wp_version_check', 'wp_version_check' );
	remove_action( 'admin_init', '_maybe_update_core' );
	add_filter( 'pre_transient_update_core', create_function( '$a', "return null;" ) );

	# 3.0:
	add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );*/
/** End of update.php */