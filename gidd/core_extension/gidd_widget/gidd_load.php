<?php

gidd_include_file( GIDDPATH . 'core_extension/gidd_widget/sidebar.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_widget/widget.php' );

//add term widget
gidd_include_file( GIDDPATH . 'core_extension/gidd_widget/gidd_term_widget.php' );
add_action( 'widgets_init', create_function( '', 'register_widget( "gidd_term_widget" );' ) );

/** end */