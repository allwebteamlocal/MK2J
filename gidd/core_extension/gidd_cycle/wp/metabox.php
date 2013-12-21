<?php

//add_action( 'admin_enqueue_scripts', 'gidd_cycle_meta_script' );
function gidd_cycle_meta_script( $hook_suffix ){

	global $typenow;
	if ( $typenow == "gidd_cycle" ){
	
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-datepicker' );	
		wp_enqueue_style(  'jquery-ui-style', trailingslashit(get_stylesheet_directory_uri()) . 'gidd/core_extension/jquery_ui_style/overcast/jquery-ui.custom.css' );
		wp_enqueue_script( 'jquery-gidd-datepicker', trailingslashit(get_stylesheet_directory_uri()) . 'gidd/gidd_master/js/datepicker.js', '', 1 );
	
	}
		

}


add_action( 'add_meta_boxes', 'gidd_cycle_metabox' );
add_action( 'save_post', 'gidd_cycle_save_metabox' );

/* Adds a box to the main column on the Post and Page edit screens */
function gidd_cycle_metabox() {   
	add_meta_box( 'gidd_cycle_metabox', __( 'Expiry Date', 'giddcycle' ), 'gidd_cycle_inner_box', 'gidd_cycle' );   
}

function gidd_cycle_inner_box( $post ){

	wp_nonce_field( plugin_basename( __FILE__ ), 'gidd_cycle_metabox' );
	$value = get_post_meta( $post->ID, 'giddcycle_meta_expiry', true );
	
	echo '<p>';
	
	echo '<label for="gdcycle_meta_expiry" style="display: block;">';
	   _e("Date Expire", 'giddcycle' );
	echo '</label> ';
	echo '<input type="text" id="meta_expiry" class="gd-datepicker" name="giddcycle_meta_expiry" value="'.esc_attr($value).'" size="50" />';
	echo '<span style="color: #666;"> format: YYYY-MM-DD (example: 2013-04-15)</span>';
	
	echo '</p>';
	echo '<div class="clear"></div>';
}

function gidd_cycle_save_metabox( $post_id ){

	// First we need to check if the current user is authorised to do this action. 
	if ( isset( $_POST['post_type'] ) && ( 'page' == $_POST['post_type'] ) ) {
		if ( ! current_user_can( 'edit_page', $post_id ) )
			return;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;
	}
	
	// Secondly we need to check if the user intended to change this value.
	if ( ! isset( $_POST['gidd_cycle_metabox'] ) || ! wp_verify_nonce( $_POST['gidd_cycle_metabox'], plugin_basename( __FILE__ ) ) )
      return;
	  
	// Thirdly we can save the value to the database

	//if saving in a custom table, get post_ID
	$post_ID = $_POST['post_ID'];
	//sanitize user input
	$mydata = sanitize_text_field( $_POST['giddcycle_meta_expiry'] );

	// save 
	update_post_meta($post_ID, 'giddcycle_meta_expiry', $mydata);

}

/** end */