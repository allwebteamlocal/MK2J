<?php
//remove some widgets
add_action('widgets_init', 'remove_some_wp_widgets', 1);
function remove_some_wp_widgets(){

	$widget = get_option('gdf15305c');	
	if( isset( $widget['g4ec32818'] ) && ( $widget['g4ec32818'] != "" ) )
		unregister_widget('WP_Widget_Calendar');
	
	if( isset( $widget['g6e233da2'] ) && ( $widget['g6e233da2'] != "" ) )	
		unregister_widget('WP_Widget_Search');
	
	if( isset( $widget['g459fa5db'] ) && ( $widget['g459fa5db'] != "" ) )	
		unregister_widget('WP_Widget_Pages');
	
	if( isset( $widget['g3dcd8638'] ) && ( $widget['g3dcd8638'] != "" ) )	
		unregister_widget('WP_Widget_Recent_Comments');
	
	if( isset( $widget['g655d7f15'] ) && ( $widget['g655d7f15'] != "" ) )	
		unregister_widget('WP_Widget_Recent_Posts');
	
	if( isset( $widget['ga3bac590'] ) && ( $widget['ga3bac590'] != "" ) )	
		unregister_widget('WP_Widget_RSS');
	
	if( isset( $widget['ga23ad1dd'] ) && ( $widget['ga23ad1dd'] != "" ) )	
		unregister_widget('WP_Widget_Meta');
	
	if( isset( $widget['g826bf426'] ) && ( $widget['g826bf426'] != "" ) )	
		unregister_widget('WP_Widget_Archives');
	
	if( isset( $widget['g02fd8b19'] ) && ( $widget['g02fd8b19'] != "" ) )	
		unregister_widget('WP_Widget_Categories');
	
	if( isset( $widget['g431ce66a'] ) && ( $widget['g431ce66a'] != "" ) )
		unregister_widget('WP_Widget_Tag_Cloud');
		
}