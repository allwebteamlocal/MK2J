<?php
define('GIDD_CYCLE_PATH', GIDDPATH . 'core_extension/gidd_cycle/');
define('GIDD_CYCLE_URL', GIDDURL . 'core_extension/gidd_cycle/');

// ADD SCRIPTS TO HEAD
add_action('wp_head', 'gidd_cycle_script');
function gidd_cycle_script(){	
?>
<style type="text/css">.giddcycle-wrap-cycle .giddcycle-item{ display: none; } .giddcycle-wrap-cycle .giddcycle-first-item{ display: block; } .giddcycle-widget-all .giddcycle-item{ display: block; }</style>
<?php
}

// INCLUDE CYCLE HELPER
include_once( GIDD_CYCLE_PATH . 'gidd_cycle_helper.php' );

// SET UP THE BACKEND
include_once( GIDD_CYCLE_PATH . 'wp/posttype.php' );
include_once( GIDD_CYCLE_PATH . 'wp/metabox.php' );

// INCLUDE SHORTCODE
include_once( GIDD_CYCLE_PATH . 'wp/shortcode.php' );

// INCLUDE WIDGETS
include_once( GIDD_CYCLE_PATH . 'wp/widget.php' );
add_action( 'widgets_init', create_function( '', 'register_widget( "gidd_cycle_widget" );' ) );



/** end */