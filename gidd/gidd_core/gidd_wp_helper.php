<?php

/*** SHOW LOGO ***/
function ___logo() {
?>
	<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	</a>
<?php
}

/*** SHOW PRIMARY MENU ***/
function ___menu( $location = "primary" ) {
	wp_nav_menu( array(
		'container' => false,
		'theme_location' => $location,
		'menu_class' => 'menu',
	));
}

//auto load style & script for each page name
function ___script( $tp = "" ){
	
	$name = ___name();	
		
	$tpurl  = ___registry( 'current_tpurl' );
	$tppath = ___registry( 'current_tppath' );
	
	___clear( 'current_tpurl' );
	___clear( 'current_tppath' );

	
	//css
	if ( file_exists( $tppath . $name . '.css' ) ):
		
		if ( $tp == "admin" )
			echo '<link href="'. $tpurl . $name .'.css' .'" rel="stylesheet" media="screen, projection" />';
		else
			wp_enqueue_style( $name.'-style', $tpurl . $name .'.css', "", "1", "screen, projection" );
		
	else:
		if ( file_exists( CHILDTP . $name . '/' . $name . '.css' ) ){
						
			if ( $tp == "admin"  )
				echo '<link href="'. CHILDTPURL . $name . '/'. $name .'.css' .'" rel="stylesheet" media="screen, projection" />';
			else
				wp_enqueue_style( $name.'-style', CHILDTPURL . $name . '/'. $name .'.css', "", "1", "screen, projection" );
				
		}
					
		
	endif;
	
	//js
	if ( file_exists( $tppath . $name . '.js' ) ):
	
		if ( $tp == "admin" )
			echo '<script type="text/javascript" src="'. $tpurl . $name .'.js' .'"></script>';
		else
			wp_enqueue_script( $name.'-script', $tpurl . $name .'.js', array("jquery"), "1" );
			
	else:
		if ( file_exists( CHILDTP . $name . '/' . $name . '.js' ) ){
			
			if ( $tp == "admin" )
				echo '<script type="text/javascript" src="'. CHILDTPURL . $name . '/'. $name .'.js' .'"></script>';
			else
				wp_enqueue_script( $name.'-script', CHILDTPURL . $name . '/'. $name .'.js', array("jquery"), "1" );
		}
	endif;
				
	
}


//add bootstrap scripts
function ___bootstrap( $layout = "" ){
	if ( $layout == 'bootstrap12' ){
		wp_enqueue_style( 'bootstrap', CHILDURL . GIDDNAME . '/core_extension/gidd_layout/bootstrap/css/bootstrap12.min.css', '', '3.0.0', 'screen,projection' );
		wp_enqueue_script( 'bootstrap-min', CHILDURL . GIDDNAME . '/core_extension/gidd_layout/bootstrap/js/bootstrap12.min.js', array('jquery'), '3.0.0', true );
	}elseif( $layout == 'bootstrap16' ){
		wp_enqueue_style( 'bootstrap', CHILDURL . GIDDNAME . '/core_extension/gidd_layout/bootstrap/css/bootstrap16.min.css', '', '3.0.0', 'screen,projection' );
		wp_enqueue_script( 'bootstrap-min', CHILDURL . GIDDNAME . '/core_extension/gidd_layout/bootstrap/js/bootstrap16.min.js', array('jquery'), '3.0.0', true );
	}elseif( $layout == 'bootstrap24' ){
		wp_enqueue_style( 'bootstrap', CHILDURL . GIDDNAME . '/core_extension/gidd_layout/bootstrap/css/bootstrap24.min.css', '', '3.0.0', 'screen,projection' );
		wp_enqueue_script( 'bootstrap-min', CHILDURL . GIDDNAME . '/core_extension/gidd_layout/bootstrap/js/bootstrap24.min.js', array('jquery'), '3.0.0', true );
	}		
}

function ___admin_bootstrap( $option = "" ){
	
	if( $option != "" ){
	
		$css 	= '<link href="'. CHILDURL . GIDDNAME . '/core_extension/gidd_layout/bootstrap/css/bootstrap'. $option .'.min.css' .'" rel="stylesheet" media="screen, projection"></script>';
		$script = '<script src="'. CHILDURL . GIDDNAME . '/core_extension/gidd_layout/bootstrap/js/bootstrap'. $option .'.min.js' .'" type="text/javascript"></script>';
		
		echo $css;
		echo $script;
		
	}
}


//add font-awesome
function ___fontawesome( $option = "", $tp = "" ){
		
	if ( $option != "" ):
		
		if ( $tp == "admin" )
			echo '<link href="'. CHILDURL . GIDDNAME . '/core_extension/gidd_layout/fontawesome/css/font-awesome.min.css"' . '" rel="stylesheet" media="screen, projection" />';
		else
			wp_enqueue_style( 'font-awesome', CHILDURL . GIDDNAME . '/core_extension/gidd_layout/fontawesome/css/font-awesome.min.css', '', '3.0.2', 'screen,projection' );
	
	endif;
}

//add genericicons
function ___genericons( $option = "", $tp = "" ){
		
	if ( $option != "" ):	
		
		if ( $tp == "admin" )
			echo '<link href="'. CHILDURL . GIDDNAME . '/core_extension/gidd_layout/genericons/genericons.css' . '" rel="stylesheet" media="screen, projection" />';
		else
			wp_enqueue_style( 'genericons', CHILDURL . GIDDNAME . '/core_extension/gidd_layout/genericons/genericons.css', '', '2.9', 'screen,projection' );
	
	endif;
}

//load bpopup.js
function ___bpopup( $footer = false ){
	wp_enqueue_script( 'bpopup', GIDDURL . 'gidd_master/js/jquery.bpopup.min.js', array('jquery'), '0.9.4', $footer );
}

/** end */