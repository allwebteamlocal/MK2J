<?php
/** DEFINE NECESSARY CONSTANTS */

//gidd
define ( 'GIDDPATH', realpath ( dirname(__FILE__) ).'/' );
define ( 'GIDDURL', trailingslashit ( get_stylesheet_directory_uri() ) . 'gidd/' );

//parent
define ( 'PARENTPATH', dirname( GIDDPATH ).'/' );
define ( 'PARENTURL', trailingslashit ( get_template_directory_uri() ) );

//child
define ( 'CHILDPATH', trailingslashit( get_stylesheet_directory() ) );
define ( 'CHILDURL', trailingslashit( get_stylesheet_directory_uri() ) );


//LOAD MORE CONSTANTS
include_once( GIDDPATH . 'constant.php' );


//GLOBAL PAGE NAME
$page_name = "";


//START SESSION
add_action( 'init', 'gidd_start_session' );
function gidd_start_session(){
	if(session_id() == '') {
		session_start();
	}
}


//LOAD CORE FILES
include_once( GIDDLIB . 'gidd_helper.php' );
include_once( GIDDLIB . 'gidd_common.php' );
include_once( GIDDLIB . 'gidd_auto_column.php' );
include_once( GIDDLIB . 'gidd_admin_auto_column.php' );

//load the core features
gidd_include_file( GIDDPATH . 'gidd_registry.php' );
gidd_include_file( GIDDPATH . 'gidd_data.php' );

//use to track custom loaded applications
___registry( '___app', array() );

gidd_include_file( GIDDCORE . 'gidd_load.php' );

/** end */