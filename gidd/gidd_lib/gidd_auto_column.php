<?php
/*** AUTOMATIC FUNCTION FOR HOOKS ***/

//auto add css/js to wp_head for columns
function gidd_column_script( $url, $path, $col, $name, $default_path, $default_url ){

	//css
	$css = $url . "$col/$col.css";
	$css_path = $path . "$col/$col.css";
		
	if ( $default_path != "" ){
		$css = $default_url . "$col/$col.css";
		$css_path = $default_path . "$col/$col.css";	
	}
			
	if ( file_exists( $css_path ) ){
		$css_callback = "wp_enqueue_style('$col-$name', '$css', '', '1.0.0');";
		$css_func = create_function( null, $css_callback );
		add_action( 'wp_footer', $css_func );
	}elseif( file_exists( $default_path . "$col/$col.css" ) ){
	
		$css = DEFAULTURL . "$col/$col.css";
		$css_callback = "wp_enqueue_style('$col-$name', '$css', '', '1.0.0', 'false');";
		$css_func = create_function( null, $css_callback );
		add_action( 'wp_head', $css_func );
	
	}
	
	//js
	$js = $url . "$col/$col.js";
	$js_path = $path . "$col/$col.js";
	
	if ( $default_path != "" ){
		$js = $default_url . "$col/$col.js";
		$js_path = $default_path . "$col/$col.js";	
	}
	
	if ( file_exists( $js_path ) ){
		$js_callback = "wp_enqueue_script('$col-$name', '$js', '', '1.0.0', true);";
		$js_func = create_function( null, $js_callback );
		add_action( 'wp_footer', $js_func );		
	}elseif( file_exists( $default_path . "$col/$col.js" ) ){	
		$js = DEFAULTURL . "$col/$col.js";
		$js_callback = "wp_enqueue_script('$col-$name', '$js', '', '1.0.0', true);";
		$js_func = create_function( null, $js_callback );
		add_action( 'wp_footer', $js_func );
	}
}

//auto include php from column folder
function gidd_php_column( $path, $col, $name, $default = "", $app_path = "", $app_url = "" ){
	$inc = $path . "$col/$col.php";	
	$default_path = "";
	
	switch ( $default ){
		case "gidd_theme" 		: $default = CHILDTHEME . "default/$col/$col.php"; 
								  if ( file_exists( $default ) ){
									$default_path = array ( CHILDTHEME . "default/", CHILDTHEMEURL . "default/" );
								  }else{
									$default = DEFAULTPATH . "$col/$col.php";
									$default_path = array ( DEFAULTPATH, DEFAULTURL );									
								  }
								  break;
								  
		case "gidd_application" : $default = $app_path . "default/$col/$col.php";
								  if ( file_exists( $default ) ){
									$default_path = array( $app_path . "default/", $app_url . "default/" );
								  }else{
									$default = DEFAULTPATH . "$col/$col.php";		
									$default_path = array( DEFAULTPATH, DEFAULTURL );									
								  }
								  break;
								  
								  
		default 				: $default = CHILDTP . "default/$col/$col.php";
								  if ( file_exists( $default ) ){
									$default_path = array( CHILDTP . "default/", CHILDTPURL . "default/" );
								  }else{
									$default = DEFAULTPATH . "$col/$col.php";		
									$default_path = array( DEFAULTPATH, DEFAULTURL );
								  } 		
	}
	
	$is_default = false;
	
	if ( !file_exists( $inc ) ){
		if ( file_exists( $default ) ){
			$inc = $default;
			$is_default = true;
		}		
	}
	
	if ( file_exists( $inc ) ){
		$callback = "gidd_include_file('$inc');";
		$func = create_function( null, $callback );	
		add_action( "___$col" . '_' . $name, $func );
	}
	
	if ( $is_default )
		return $default_path;
	else
		return "";
		
}

//simplify function call for gidd_auto_column
function gidd_get_auto_column( $url, $path, $col, $name, $default, $app_path, $app_url ){
	$default_path = gidd_php_column( $path, $col, $name, $default, $app_path, $app_url );
	if ( is_array( $default_path ) )
		gidd_column_script( $url, $path, $col, $name, $default_path[0], $default_path[1] );
	else
		gidd_column_script( $url, $path, $col, $name, "", "" );
}

/** auto include file for specific columns in the layout system **/
function gidd_auto_column( $name, $path, $url = "", $default = "", $app_path = "", $app_url = "" ){
	
	$path = trailingslashit( $path );
	$url = trailingslashit( $url );
	
	//BEFORE WRAPPERS
	if ( !function_exists( "___before_wrapper" ) ){		
		gidd_get_auto_column( $url, $path, "before_wrapper", $name, $default, $app_path, $app_url );		
	}
	
	if ( !function_exists( "___before_container" ) )
		gidd_get_auto_column( $url, $path, "before_container", $name, $default, $app_path, $app_url );

	if ( !function_exists( "___before_page" ) ){
		gidd_get_auto_column( $url, $path, "before_page", $name, $default, $app_path, $app_url );
	}
	
	if ( !function_exists( "___before_content" ) ){
		gidd_get_auto_column( $url, $path, "before_content", $name, $default, $app_path, $app_url );
	}
	
	if ( !function_exists( "___before_colmask" ) ){
		gidd_get_auto_column( $url, $path, "before_colmask", $name, $default, $app_path, $app_url );
	}

	if ( !function_exists( "___before_cols" ) ){
		gidd_get_auto_column( $url, $path, "before_cols", $name, $default, $app_path, $app_url );
	}
	
	
	//AFTER WRAPPERS
	if ( !function_exists( "___after_wrapper" ) ){
		gidd_get_auto_column( $url, $path, "after_wrapper", $name, $default, $app_path, $app_url );
	}
	
	if ( !function_exists( "___after_container" ) ){
		gidd_get_auto_column( $url, $path, "after_container", $name, $default, $app_path, $app_url );
	}

	if ( !function_exists( "___after_page" ) ){
		gidd_get_auto_column( $url, $path, "after_page", $name, $default, $app_path, $app_url );
	}
	
	if ( !function_exists( "___after_content" ) ){
		gidd_get_auto_column( $url, $path, "after_content", $name, $default, $app_path, $app_url );
	}

	if ( !function_exists( "___after_cols" ) ){
		gidd_get_auto_column( $url, $path, "after_cols", $name, $default, $app_path, $app_url );
	}
	
	
	//HEADER
	if ( !function_exists( "___before_header" ) ){
		gidd_get_auto_column( $url, $path, "before_header", $name, $default, $app_path, $app_url );
	}
	
	if ( !function_exists( "___header" ) ){
		gidd_get_auto_column( $url, $path, "header", $name, $default, $app_path, $app_url );
	}

	if ( !function_exists( "___after_header" ) ){
		gidd_get_auto_column( $url, $path, "after_header", $name, $default, $app_path, $app_url );
	}
	
	
	//FOOTER
	if ( !function_exists( "___before_footer" ) ){
		gidd_get_auto_column( $url, $path, "before_footer", $name, $default, $app_path, $app_url );
	}
	
	if ( !function_exists( "___footer" ) ){
		gidd_get_auto_column( $url, $path, "footer", $name, $default, $app_path, $app_url );
	}

	if ( !function_exists( "___after_footer" ) ){
		gidd_get_auto_column( $url, $path, "after_footer", $name, $default, $app_path, $app_url );
	
	}	
	
	//CONTENT FOR BOOTSTRAP
	if ( !function_exists( "___content" ) ){
		gidd_get_auto_column( $url, $path, "content", $name, $default, $app_path, $app_url );
	
	}
	
	//COL1
	if ( !function_exists( "___before_col1" ) ){	
		gidd_get_auto_column( $url, $path, "before_col1", $name, $default, $app_path, $app_url );
	}
	
	if ( !function_exists( "___col1" ) ){
		gidd_get_auto_column( $url, $path, "col1", $name, $default, $app_path, $app_url );
		
	}

	if ( !function_exists( "___after_col1" ) ){
		gidd_get_auto_column( $url, $path, "after_col1", $name, $default, $app_path, $app_url );
	}
	
	
	//COL2
	if ( !function_exists( "___before_col2" ) ){
		gidd_get_auto_column( $url, $path, "before_col2", $name, $default, $app_path, $app_url );
	}
	
	if ( !function_exists( "___col2" ) ){
		gidd_get_auto_column( $url, $path, "col2", $name, $default, $app_path, $app_url );
	}

	if ( !function_exists( "___after_col2" ) ){
		gidd_get_auto_column( $url, $path, "after_col2", $name, $default, $app_path, $app_url );
	}
	
	
	//COL3
	if ( !function_exists( "___before_col3" ) ){
		gidd_get_auto_column( $url, $path, "before_col3", $name, $default, $app_path, $app_url );
	}
	
	if ( !function_exists( "___col3" ) ){
		gidd_get_auto_column( $url, $path, "col3", $name, $default, $app_path, $app_url );
	}

	if ( !function_exists( "___after_col3" ) ){
		gidd_get_auto_column( $url, $path, "after_col3", $name, $default, $app_path, $app_url );
	}
	
}


/* End of gidd_auto_functions.php */