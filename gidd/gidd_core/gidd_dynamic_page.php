<?php
function gidd_wp_template( $t ) {
    global $wp_query;
    if ( $wp_query->is_404 ) {
        $wp_query->is_404 = false;
        //$wp_query->is_archive = true;
    }
    header( "HTTP/1.1 200 OK" );
    return $t;
}

function get_gidd_theme( $template ){

	$name = "";
	$built_name = str_replace( '-', '_', basename( $template, '.php' ) );
	$built_dir = CHILDTHEME . $built_name . '/';
	
	//include template file
	if ( is_home() ){
		if ( file_exists( $built_dir . $built_name . '.php' ) ){				
			$name = ___name( $built_name );
		}			
	}
	
	//front-page
	if ( is_front_page() ){
		if ( file_exists( $built_dir . $built_name . '.php' ) ){				
			$name = ___name( $built_name );
		}			
	}
	
	//404
	if ( is_404() ){		
		if ( file_exists( $built_dir . $built_name . '.php' ) ){			
			$name = ___name( $built_name );
		}			
	}
	
	//search
	if ( is_search() ){		
		if ( file_exists( $built_dir . $built_name . '.php' ) ){			
			$name = ___name( $built_name );					
		}			
	}
	
	//taxonomy
	if ( is_tax() ){		
		if ( file_exists( $built_dir . $built_name . '.php' ) ){		
			$name = ___name( $built_name );					
		}			
	}
	
	//attachment
	if ( is_attachment() ){		
		if ( file_exists( $built_dir . $built_name . '.php' ) ){	
			$name = ___name( $built_name );	
		}			
	}
	
	//single
	if ( is_single() ){		
		if ( file_exists( $built_dir . $built_name . '.php' ) ){	
			$name = ___name( $built_name );
		}			
	}
	
	//page
	if ( is_page() ){		
		if ( file_exists( $built_dir . $built_name . '.php' ) ){
			$name = ___name( $built_name );
		}			
	}
	
	//category
	if ( is_category() ){		
		if ( file_exists( $built_dir . $built_name . '.php' ) ){	
			$name = ___name( $built_name );
		}			
	}
	
	//tag
	if ( is_tag() ){
		if ( file_exists( $built_dir . $built_name . '.php' ) ){	
			$name = ___name( $built_name );
		}			
	}
	
	//author
	if ( is_author() ){
		if ( file_exists( $built_dir . $built_name . '.php' ) ){	
			$name = ___name( $built_name );	
		}
	}
	
	//date
	if ( is_date() ){
		if ( file_exists( $built_dir . $built_name . '.php' ) ){	
			$name = ___name( $built_name );	
		}
	}
	
	//archive
	if ( is_archive() ){		
		if ( file_exists( $built_dir . $built_name . '.php' ) ){				
			$name = ___name( $built_name );	
		}
	}
	
	return $name;

}

add_filter( 'template_include', 'gidd_template_include', 1, 1 ); 
// @param $template - Full path to the normal template file. 
function gidd_template_include( $template ){
 
	$url = gidd_current_url();
	
	//support for query string
	if ( $_GET ) //check if the current url has query string
		$url = preg_replace( '/\?.*/', '', $url );	

	//get paths from custom app
	$paths 	= ___registry('___app');	
	$paths[ 'CHILDTP' ]	= CHILDTP;
	
	//clear ___app from registry
	//___clear( '___app' );
	
	//get base path
	$base = parse_url( $url, PHP_URL_PATH );
	$base = str_replace( "-", "_", $base );
	$base = apply_filters( 'gidd_url_path', $base );
		
	//get last segment
	$last = get_last_segment( trailingslashit( $base ) );
	$last = str_replace( "-", "_", $last );
	
	foreach( $paths as $tpurl => $tppath ){

		//ALLOW CUSTOM FILE PATH RATHER THAN DEFAULT LOCATION
		$app_template = "";
		$app_template = apply_filters('gidd_application_template', $app_template);
		if ( file_exists( $tppath . $app_template . '.php' ) ):
	
			___name( $app_template );
			
			//from gidd_helper.php, include action hook files based on the name
			gidd_get_template( $url, $tppath, $tpurl, $base, $app_template );
			
			//automatically add hook for custom template
			if ( function_exists( '___html_' . ___name() ) ){
				add_action( '___html_' . ___name(), '___html_' . ___name() );
			}else{
				if ( function_exists( '___html_default' ) ){
					add_action( '___html_default', '___html_default' );
				}
			}			
			
			return gidd_wp_template ( $tppath . $app_template . ".php" );
			
		endif;
			
		
		//GET CUSTOM PAGE
		if ( gidd_dir_exists( $last, $tppath ) ){
			
			//set the page name
			___name( $last );
		
			//from gidd_helper.php, include action hook files based on the name
			gidd_get_template( $url, $tppath, $tpurl, $base );
			
			
			//automatically add hook for custom template
			if ( function_exists( '___html_' . ___name() ) ){
				add_action( '___html_' . ___name(), '___html_' . ___name() );
			}else{
				if ( function_exists( '___html_default' ) ){
					add_action( '___html_default', '___html_default' );
				}
			}			
			
			return gidd_wp_template ( GIDDPATH . "core_extension/gidd_layout/gidd_php.php" );		
		}			
	}
	
	/** run gidd_theme if it exists */
	if ( gidd_dir_exists( 'gidd_theme', CHILDPATH ) ):

		$name = get_gidd_theme( $template );		
		if ( $name != "" ){
		
			___name( $name );
			
			$childtheme = gidd_include_file( CHILDTHEME . 'default/default.php' );
			if ( !$childtheme )
				gidd_include_file( DEFAULTPATH . 'default.php' );
				
			gidd_include_file( CHILDTHEME . $name . '/' . $name . '.php' );						
			
			//auto create a callback function for including column file
			gidd_auto_column( $name, CHILDTHEME . $name, CHILDTHEMEURL . $name, 'gidd_theme' );
			
			//automatically add hook for custom template
			if ( function_exists( '___html_' . $name ) )
				add_action( '___html_' . $name, '___html_' . $name );
			
			return gidd_wp_template ( GIDDPATH . "core_extension/gidd_layout/gidd_php.php" );
		}
	
	endif;
	
	//set a flag to show that WP template is being return
	___registry( "GIDDWPTP", true );
	return $template; 
}

//Prevent WordPress from Auto-Redirect Custom URL
add_filter( 'redirect_canonical', 'gidd_redirect_canonical', 1, 2 );
function gidd_redirect_canonical( $redirect_url, $requested_url ){
	
	$url = gidd_current_url();
  	//support for query string
	if ( $_GET )
		$url = preg_replace('/\?.*/', '', $url );	   
	
	if ( parse_url( $requested_url, PHP_URL_QUERY ) )
		$requested_url = preg_replace( '/\?.*/', '', $requested_url );	
		
	if ( trailingslashit( $requested_url ) == trailingslashit( $url ) )
		return false;
	
	return $redirect_url;
}

/* End of gidd_dynamic_page */