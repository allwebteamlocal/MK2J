<?php
//get login options
$menu = get_option('g57f5f5ef');

//remove admin menu items
if ( isset( $menu['g20ba7eec'] ) && ( $menu['g20ba7eec'] != "" ) ):
	add_action('admin_menu', 'gidd_remove_builtin_menu');
	add_action('admin_head', 'gidd_remove_menu_items');
	add_filter('screen_options_show_screen', 'gidd_remove_screen_options_tab');
endif;


function gidd_remove_builtin_menu(){
	global $menu;
	foreach ( $menu as $k => $v ){
		unset( $menu[$k] );
	}
}

function gidd_remove_menu_items(){
?>
	<style type="text/css">
		#adminmenuback, #adminmenuwrap, #footer, #contextual-help-link-wrap{ display: none; visibility: hidden; }
		#wpcontent, #footer{ margin-left: 20px; }	
	</style>
<?php
}

add_action('admin_head', 'gidd_hide_admin_menu_left');
function gidd_hide_admin_menu_left(){

	$menu = get_option('g57f5f5ef');
	if ( isset( $menu['g8c40e780'] ) && is_array( $menu['g8c40e780'] ) && in_array('admin.php?page=g7b193a12', $menu['g8c40e780']) ){
?>
	<style type="text/css">
		#toplevel_page_g7b193a12{ display: none; visibility: hidden; }
	</style>
<?php
	}else{
?>
	<style type="text/css">
		#toplevel_page_g7b193a12{ display: block; visibility: visible; }
	</style>
<?php	
	}

}

// Hide admin 'Screen Options' tab
function gidd_remove_screen_options_tab(){
    return false;
}

add_action( 'admin_menu', 'gidd_remove_admin_page' );
function gidd_remove_admin_page(){
		
	//get login options
	$menu = get_option('g57f5f5ef');
	
	if ( isset( $menu['g8c40e780'] ) && is_array( $menu['g8c40e780'] ) ){
		foreach ( $menu['g8c40e780'] as $page){
			remove_menu_page( "$page" );
		}
	}
	
}



/** end */