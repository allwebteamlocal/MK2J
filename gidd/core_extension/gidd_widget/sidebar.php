<?php

//callback for ___sidebar
function gidd_register_sidebar( $name, $desc = "", $tag = "li", $title_wrap = "h3" ){

	register_sidebar( array(
	
		'name' => __( $name, 'gidd' ),
		'id' => ___id( $name ),
		'description' => __( $desc, 'gidd' ),
		'before_widget' => '<' . $tag . ' id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</'. $tag .'>',
		'before_title' => '<'. $title_wrap .' class="widget-title">',
		'after_title' => '</'. $title_wrap .'>',
		
	) );

}

//register sidebar
function ___sidebar( $name, $desc = "", $tag = "li", $title_wrap = "h3"  ){
		
	$func = "gidd_register_sidebar( '$name', '$desc', '$tag', '$title_wrap' );";
	$widget = create_function( '', $func );
	add_action('widgets_init', $widget );
	
}


/** end */