<?php

//CPT: gidd cycle
add_action('init', 'gidd_cycle_post_type');
function gidd_cycle_post_type(){	
				
	register_post_type( "gidd_cycle",
	array(
		'labels' => array(
			'name' => __( "Gidd Cycle" ),
			'singular_name' => __( 'Gidd Cycle' ),
			'add_new' => __( "Add Item" ),
			'add_new_item' => __( "Add Item" ),
			'edit_item' => __( "Edit Item" ),
			'view_item' => __( "View Item" )
		),
		'public' => true,
		'show_ui' => true,
		'exclude_from_search' => true,
		'rewrite' => array('slug' => "gidd-cycle", 'with_front' => false),
		'capability_type' => 'post',
		'show_in_nav_menus' => false,
		'show_in_menu' => 'g7b193a12',
		'has_archive' => false,
		'taxonomies' => array( 'cycle_position' ),
		'supports' => array("title", "editor") )
	);
	

	//register taxonomy
	$labels = array(
		'name'                          => "Cycle Position",
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
			'rewrite'                       => array( 'slug' => "cycle-position", 'with_front' => false ),
			'query_var'                     => true
		);

	register_taxonomy( "cycle_position", 'gidd_cycle', $args );
	
}



//add existing icon to post type, coz it moves under gidd_admin
add_action('admin_head', 'gidd_cycle_text_icons');
function gidd_cycle_text_icons(){
	global $typenow;
	if ( $typenow == "gidd_cycle" ){
?>
	<style type="text/css">
		.icon32-posts-gidd_cycle{ background: url("<?php echo trailingslashit( admin_url() ); ?>images/icons32.png?ver=20121105") no-repeat -492px -5px; }
	</style>
<?php
	}
}



/** end */