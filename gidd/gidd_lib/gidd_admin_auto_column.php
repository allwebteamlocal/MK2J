<?php
/*** AUTOMATIC FUNCTION FOR HOOKS ***/

//auto add css/js for columns
function gidd_admin_column_script( $url, $path, $col, $name, $default_path, $default_url ){

	//css
	$css = $url . "$col/$col.css";
	$css_path = $path . "$col/$col.css";
		
	if ( $default_path != "" ){
		$css = $default_url . "$col/$col.css";
		$css_path = $default_path . "$col/$col.css";	
	}
				
	if ( file_exists( $css_path ) ){
		$css_callback = "echo '<link href=\"$css\" rel=\"stylesheet\" media=\"screen, projection\" />';";
		$css_func = create_function( null, $css_callback );
		add_action( 'gidd_admin_footer', $css_func );
	}elseif( file_exists( $default_path . "$col/$col.css" ) ){
		$css = ADMINDEFAULTURL . "$col/$col.css";
		$css_callback = "echo '<link href=\"$css\" rel=\"stylesheet\" media=\"screen, projection\" />';";
		$css_func = create_function( null, $css_callback );
		add_action( 'gidd_admin_head', $css_func );
	}
	
	//js
	$js = $url . "$col/$col.js";
	$js_path = $path . "$col/$col.js";
	
	if ( $default_path != "" ){
		$js = $default_url . "$col/$col.js";
		$js_path = $default_path . "$col/$col.js";	
	}
	
	if ( file_exists( $js_path ) ){
		$js_callback = "echo '<script src=\"$js\" type=\"text/javascript\"></script>';";
		$js_func = create_function( null, $js_callback );
		add_action( 'gidd_admin_footer', $js_func );		
	}elseif( file_exists( $default_path . "$col/$col.js" ) ){	
		$js = ADMINDEFAULTURL . "$col/$col.js";
		$js_callback = "echo '<script src=\"$js\" type=\"text/javascript\"></script>';";
		$js_func = create_function( null, $js_callback );
		add_action( 'gidd_admin_footer', $js_func );
	}
}

//auto include php from column folder
function gidd_admin_php_column( $path, $col, $name, $default = "", $app_path = "", $app_url = "" ){
	$inc = $path . "$col/$col.php";	
	$default_path = "";
	
	switch ( $default ){
		case "gidd_theme" 		: $default = CHILDTHEME . "default/$col/$col.php"; 
								  if ( file_exists( $default ) ){
									$default_path = array ( CHILDTHEME . "default/", CHILDTHEMEURL . "default/" );
								  }else{
									$default = ADMINDEFAULTPATH . "$col/$col.php";
									$default_path = array ( ADMINDEFAULTPATH, ADMINDEFAULTURL );									
								  }
								  break;
								  
		case "gidd_application" : $default = $app_path . "default/$col/$col.php";
								  if ( file_exists( $default ) ){
									$default_path = array( $app_path . "default/", $app_url . "default/" );
								  }else{
									$default = ADMINDEFAULTPATH . "$col/$col.php";		
									$default_path = array( ADMINDEFAULTPATH, ADMINDEFAULTURL );									
								  }
								  break;
								  
								  
		default 				: $default = CHILDTP . "default/$col/$col.php";
								  if ( file_exists( $default ) ){
									$default_path = array( CHILDTP . "default/", CHILDTPURL . "default/" );
								  }else{
									$default = ADMINDEFAULTPATH . "$col/$col.php";		
									$default_path = array( ADMINDEFAULTPATH, ADMINDEFAULTURL );
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
function gidd_admin_get_auto_column( $url, $path, $col, $name, $default, $app_path, $app_url ){
	$default_path = gidd_admin_php_column( $path, $col, $name, $default, $app_path, $app_url );
	if ( is_array( $default_path ) )
		gidd_admin_column_script( $url, $path, $col, $name, $default_path[0], $default_path[1] );
	else
		gidd_admin_column_script( $url, $path, $col, $name, "", "" );
}

/** auto include file for specific columns in the layout system **/
function gidd_admin_auto_column( $name, $path, $url = "", $default = "", $app_path = "", $app_url = "" ){
	
	$path = trailingslashit( $path );
	$url = trailingslashit( $url );
	
	//BEFORE WRAPPERS
	if ( !function_exists( "___before_admin_wrapper" ) ){		
		gidd_admin_get_auto_column( $url, $path, "before_admin_wrapper", $name, $default, $app_path, $app_url );		
	}
	
	if ( !function_exists( "___before_admin_container" ) )
		gidd_admin_get_auto_column( $url, $path, "before_admin_container", $name, $default, $app_path, $app_url );

	if ( !function_exists( "___before_admin_page" ) ){
		gidd_admin_get_auto_column( $url, $path, "before_admin_page", $name, $default, $app_path, $app_url );
	}
	
	if ( !function_exists( "___before_admin_content" ) ){
		gidd_admin_get_auto_column( $url, $path, "before_admin_content", $name, $default, $app_path, $app_url );
	}
		
	
	//AFTER WRAPPERS
	if ( !function_exists( "___after_admin_wrapper" ) ){
		gidd_admin_get_auto_column( $url, $path, "after_admin_wrapper", $name, $default, $app_path, $app_url );
	}
	
	if ( !function_exists( "___after_admin_container" ) ){
		gidd_admin_get_auto_column( $url, $path, "after_admin_container", $name, $default, $app_path, $app_url );
	}

	if ( !function_exists( "___after_admin_page" ) ){
		gidd_admin_get_auto_column( $url, $path, "after_admin_page", $name, $default, $app_path, $app_url );
	}
	
	if ( !function_exists( "___after_admin_content" ) ){
		gidd_admin_get_auto_column( $url, $path, "after_admin_content", $name, $default, $app_path, $app_url );
	}

	
	
	//HEADER
	if ( !function_exists( "___before_admin_header" ) ){
		gidd_admin_get_auto_column( $url, $path, "before_admin_header", $name, $default, $app_path, $app_url );
	}
	
	if ( !function_exists( "___admin_header" ) ){
		gidd_admin_get_auto_column( $url, $path, "admin_header", $name, $default, $app_path, $app_url );
	}

	if ( !function_exists( "___after_admin_header" ) ){
		gidd_admin_get_auto_column( $url, $path, "after_admin_header", $name, $default, $app_path, $app_url );
	}
	
	
	//FOOTER
	if ( !function_exists( "___before_admin_footer" ) ){
		gidd_admin_get_auto_column( $url, $path, "before_admin_footer", $name, $default, $app_path, $app_url );
	}
	
	if ( !function_exists( "___admin_footer" ) ){
		gidd_admin_get_auto_column( $url, $path, "admin_footer", $name, $default, $app_path, $app_url );
	}

	if ( !function_exists( "___after_admin_footer" ) ){
		gidd_admin_get_auto_column( $url, $path, "after_admin_footer", $name, $default, $app_path, $app_url );
	
	}	
	
	//CONTENT FOR ADMIN
	if ( !function_exists( "___admin_content" ) ){
		gidd_admin_get_auto_column( $url, $path, "admin_content", $name, $default, $app_path, $app_url );
	
	}

	
}


/** end */