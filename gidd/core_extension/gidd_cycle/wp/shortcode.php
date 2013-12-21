<?php
add_shortcode('GIDDCYCLE', 'gidd_cycle_tag_func');
function gidd_cycle_tag_func( $atts ) {
	extract(shortcode_atts(array(
		'position' => '',
		'order' => '',
		'name' => '',
		'key' => '',
		'showall' => '',
		'item_width' => '',
		'item_height' => '',
		'rotator_width' => '',
		'rotator_height' => ''
	), $atts));
	
	//set args
	$args->cycle_position = $position;
	$args->order = $order;
	$args->name = $name;
	$args->key = $key;
	$args->showall = $showall;
	$args->item_width = $item_width;
	$args->item_height = $item_height;
	$args->rotator_width = $rotator_width;
	$args->rotator_height = $rotator_height;	
		 
	return gidd_cycle_content( $args );
	
}


/** end */