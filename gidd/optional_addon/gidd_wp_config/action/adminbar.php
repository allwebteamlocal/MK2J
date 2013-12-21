<?php
//get login options
$adminbar = get_option('g77643453');


//disable wp admin bar
if ( isset( $adminbar['ge7f2ce92'] ) && ( $adminbar['ge7f2ce92'] != "" ) ):
	
	show_admin_bar( false );
	add_action( 'admin_print_scripts-profile.php', 'hide_admin_bar_prefs' );
	add_action( 'admin_head', 'gidd_hide_admin_bar' );
	
	wp_deregister_script('admin-bar');
	wp_deregister_style('admin-bar');
	remove_action('wp_footer','wp_admin_bar_render',1000);
	
endif;


//remove toolbar option from profile
function hide_admin_bar_prefs() {
?>
<style type="text/css">
    .show-admin-bar { display: none; }
</style>
<?php
}


function gidd_hide_admin_bar(){
?>
<style type="text/css">
	#wpadminbar{ display: none; visiblity: hidden; }
	html.wp-toolbar{ padding-top: 0; }
</style>
<?php
}


add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
function remove_admin_bar_links() {
    global $wp_admin_bar;
	$adminbar = get_option('g77643453');
	
	if ( isset( $adminbar['g97f98326'] ) && ( $adminbar['g97f98326'] != "" ) )
		$wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
    
	if ( isset( $adminbar['g6b21fb79'] ) && ( $adminbar['g6b21fb79'] != "" ) )
		$wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
    
	if ( isset( $adminbar['gf98a19e1'] ) && ( $adminbar['gf98a19e1'] != "" ) )
		$wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
    
	if ( isset( $adminbar['g9e9cf322'] ) && ( $adminbar['g9e9cf322'] != "" ) )
		$wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
    
	if ( isset( $adminbar['gb76e892b'] ) && ( $adminbar['gb76e892b'] != "" ) )
		$wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
    
	if ( isset( $adminbar['gc8d7677e'] ) && ( $adminbar['gc8d7677e'] != "" ) )
		$wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
    
	if ( isset( $adminbar['g44c5d532'] ) && ( $adminbar['g44c5d532'] != "" ) )
		$wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
    
	if ( isset( $adminbar['g59fc2e1e'] ) && ( $adminbar['g59fc2e1e'] != "" ) )
		$wp_admin_bar->remove_menu('view-site');        // Remove the view site link
    
	if ( isset( $adminbar['gfb91e24f'] ) && ( $adminbar['gfb91e24f'] != "" ) )
		$wp_admin_bar->remove_menu('updates');          // Remove the updates link
    
	if ( isset( $adminbar['g153d7a58'] ) && ( $adminbar['g153d7a58'] != "" ) )
		$wp_admin_bar->remove_menu('comments');         // Remove the comments link
    
	if ( isset( $adminbar['g2d522e31'] ) && ( $adminbar['g2d522e31'] != "" ) )
		$wp_admin_bar->remove_menu('new-content');      // Remove the content link
    
	if ( isset( $adminbar['gfa05f934'] ) && ( $adminbar['gfa05f934'] != "" ) )
		$wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
    
	if ( isset( $adminbar['ge77df7b5'] ) && ( $adminbar['ge77df7b5'] != "" ) )
		$wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
}




/** End of login.php */