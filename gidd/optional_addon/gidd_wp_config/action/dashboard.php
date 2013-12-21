<?php
//get login options
$dashboard = get_option('gd87f47b4');

//remove all default metaboxes
if ( isset( $dashboard['ge658b424'] ) && ( $dashboard['ge658b424'] != "" ) ):
	add_action('admin_menu', 'disable_default_dashboard_widgets');
endif;

function disable_default_dashboard_widgets() {
	remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');

	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');
	remove_meta_box('feedwordpress_dashboard', 'dashboard', 'core');
}


//remove dashboard widgets one by one
add_action('admin_menu', 'gidd_remove_dashboard_widgets');
function gidd_remove_dashboard_widgets() {
	
	$dashboard = get_option('gd87f47b4');	
	if ( isset( $dashboard['g3770cd60'] ) && ( $dashboard['g3770cd60'] ) )
		remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	
	if ( isset( $dashboard['g0e4e02bd'] ) && ( $dashboard['g0e4e02bd'] ) )	
		remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
		
	if ( isset( $dashboard['gb1264411'] ) && ( $dashboard['gb1264411'] ) )	
		remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	
	if ( isset( $dashboard['gab2e26dd'] ) && ( $dashboard['gab2e26dd'] ) )
		remove_meta_box('dashboard_plugins', 'dashboard', 'core');

	if ( isset( $dashboard['gc71f25e5'] ) && ( $dashboard['gc71f25e5'] ) )
		remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	
	if ( isset( $dashboard['g5a6c68c7'] ) && ( $dashboard['g5a6c68c7'] ) )
		remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	
	if ( isset( $dashboard['ga9a96ec0'] ) && ( $dashboard['ga9a96ec0'] ) )
		remove_meta_box('dashboard_primary', 'dashboard', 'core');
	
	if ( isset( $dashboard['g025de599'] ) && ( $dashboard['g025de599'] ) )
		remove_meta_box('dashboard_secondary', 'dashboard', 'core');
	
	if ( isset( $dashboard['g802b8dc4'] ) && ( $dashboard['g802b8dc4'] ) )
		remove_meta_box('feedwordpress_dashboard', 'dashboard', 'core');
		
}

/** end */