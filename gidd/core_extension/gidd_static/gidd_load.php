<?php
//Gidd Static Text
add_action('init', 'gidd_static_post_type');
function gidd_static_post_type(){	
	
	register_post_type( "gidd_static",
	array(
		'labels' => array(
			'name' => __( "Static Texts" ),
			'singular_name' => __( 'Static Text' ),
			'add_new' => __( "Add Static Text" ),
			'add_new_item' => __( "Add Static Text" ),
			'edit_item' => __( "Edit Static Text" ),
			'view_item' => __( "Read Static Text" )
		),
		'public' => true,
		'show_ui' => true,
		'exclude_from_search' => true,
		'rewrite' => array('slug' => "static", 'with_front' => false),
		'capability_type' => 'post',
		'show_in_menu' => 'g7b193a12',
		'has_archive' => false,
		'taxonomies' => array( 'static_position' ),
		'supports' => array("title", "editor", "thumbnail", "custom-fields") )
	);
	
	
	//taxonomy: position
	$labels = array(
		'name'                          => "Positions",
		'singular_name'                 => 'Position',
		'search_items'                  => "Search positions",
		'popular_items'                 => "Popular positions",
		'all_items'                     => "All positions",
		'parent_item'                   => "Parent positions",
		'edit_item'                     => "Edit position",
		'update_item'                   => "Update position",
		'add_new_item'                  => "Add position",
		'new_item_name'                 => "New position",
		'separate_items_with_commas'    => "Seperate positions with commas",
		'add_or_remove_items'           => "Add or remove position",
		'choose_from_most_used'         => "Choose from the most used positions"
		);

		$args = array(
			'label'                         => "Positions",
			'labels'                        => $labels,
			'public'                        => true,
			'hierarchical'                  => true,
			'show_ui'                       => true,
			'show_in_nav_menus'             => false,
			'rewrite'                       => array( 'slug' => "staticposition", 'with_front' => false ),
			'query_var'                     => true
		);

	register_taxonomy( "static_position", 'gidd_static', $args );
	
}


//Gidd Static Column
add_action('manage_posts_custom_column', 'manage_static_columns');
function manage_static_columns($column) {
	global $post;

	if ( !is_object( $post ) )
		return;
	
	$term = wp_get_object_terms( $post->ID, 'static_position' );
	$slug = $term[0]->slug;
	
	if ("staticcode" == $column) echo htmlspecialchars("<?php echo gidd_static_content('$slug'); ?>");
}

add_filter( 'manage_edit-gidd_static_columns', 'gidd_edit_static_columns' );
function gidd_edit_static_columns( $columns ){

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Title' ),
		'staticcode' => __( 'Template Code' ),
	);
	return $columns;	

}


//HELPER
function register_static_position( $position, $slug = "" ){
	$args = array();

	if ( $slug != "" )
		$args['slug'] = $slug;
				
	if( term_exists( $slug, 'static_position' ) )
		return;

	if ( term_exists( $position, 'static_position' ) )
		return;
	
		
	$callback = "wp_insert_term( '$position', 'static_position', '$args' );";
	$func = create_function('', $callback );
	add_action( 'init', $func );
}

function gidd_static_content( $slug ){
	global $wpdb;
	
	$sql  = "SELECT p.ID, p.post_content FROM $wpdb->posts p ";
	$sql .= "INNER JOIN $wpdb->term_relationships r ON r.object_id = p.ID ";
	$sql .= "INNER JOIN $wpdb->term_taxonomy x ON x.term_taxonomy_id = r.term_taxonomy_id ";
	$sql .= "INNER JOIN $wpdb->terms t ON t.term_id = x.term_id ";
	$sql .= "WHERE p.post_status='publish' AND p.post_type='gidd_static' ";
	$sql .= "AND x.taxonomy='static_position' AND t.slug='$slug' ";
	$sql .= "ORDER BY p.ID DESC LIMIT 0, 1";
	
	$result = $wpdb->get_results( $sql );
	
	$post = "";
	
	if ( $result ){
		$post = $result[0];	
	}
	
	//get the content
	$content  = isset( $post->post_content ) ? wp_kses_post( $post->post_content ) : "";
	$content  = apply_filters('the_content', $content);
	
	//wrap the content in a div
	$pid = isset( $post->ID ) ? $post->ID : "";
	$content  = '<div class="static-content static-'. $pid .' position-'. $slug .'">' . $content;
	$content .= '</div>';
	
	//return output
	$content = apply_filters( 'gidd_static_content', $content );
	$content = apply_filters( 'gidd_static_content_' . $pid, $content );
	return $content;

}


//add existing icon to post type, coz it moves under gidd_admin
add_action('admin_head', 'gidd_static_text_icons');
function gidd_static_text_icons(){
	global $typenow;
	if ( $typenow == "gidd_static" ){
?>
	<style type="text/css">
		.icon32-posts-gidd_static{ background: url("<?php echo trailingslashit( admin_url() ); ?>images/icons32.png?ver=20121105") no-repeat -492px -5px; }
	</style>
<?php
	}
}


/** end */