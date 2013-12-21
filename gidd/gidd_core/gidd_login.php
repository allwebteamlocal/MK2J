<?php

//LOAD WP-LOGIN FILES
add_action( 'login_enqueue_scripts', 'gidd_login_template' );
function gidd_login_template(){
	
	//enqueue form style
	wp_enqueue_style('gidd-form-style', PARENTURL . 'gidd/gidd_master/form.css', '', '1', 'screen,projection' );
	
	if ( is_multisite() ){	
		$id = get_current_blog_id();	

		if ( file_exists( CHILDTP . "$id/login_$id/login_$id.css" ) ){
			wp_enqueue_style( 'gidd-login-style', CHILDTPURL . "$id/login_$id/login_$id.css", '', "$id", 'screen, projection' );
		}
		
		if ( file_exists( CHILDTP . "$id/login_$id/login_$id.js" ) ){
			wp_enqueue_script( 'gidd-login-script', CHILDTPURL . "$id/login_$id/login_$id.js", '', "$id", true );
		}
	}
	
	//alway load files from login
	if ( file_exists( CHILDTP . 'login/login.css' ) ){
		wp_enqueue_style( 'gidd-login-default-style', CHILDTPURL . 'login/login.css', '', '1', 'screen, projection' );
	}
		
	if ( file_exists( CHILDTP . 'login/login.js' ) ){
		wp_enqueue_script( 'gidd-login-default-script', CHILDTPURL . 'login/login.js', '', '1', true );
	}
	
}




/** end of gidd_login.php */