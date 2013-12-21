<?php

/** You can use this file to wite your own codes 
* 	rather than writing on the original functions.php file **/

//change the layout of index.php to a custom one 
//rather than using the default configuration from Gidd Admin

//add_filter('themse1_layout_index', 'gidd_layout_index');
//function gidd_layout_index( $layout ){
//	return 'bootstrap24';
//}

//register a sidebar widget
//___sidebar('Col2');

add_action('init', 'register_slider');
function register_slider(){
   $args = ___data();

   $args->name = "sliders";
   $args->singular = "slider";
   $args->plural = "sliders";
   $args->slug = "slider";
   gidd_register_post_type($args);
}

register_static_position('logo', 'slug');
register_static_position('slogan', 'slug');
/** end */