<?php

/*** ADD HTML TITLE IN HEAD ***/
function gidd_read_format( $input ){
	
	$input = wp_kses( $input, "" );
	$input = preg_replace( "/%blog_description%/i", get_bloginfo('description'), $input );	
	$input = preg_replace( "/%category_description%/i", category_description(), $input );	
	$input = preg_replace( "/%blog_name%/i", get_bloginfo( 'name' ), $input );
	$input = preg_replace( "/%page_title%/i", single_post_title('', false), $input );
	$input = preg_replace( "/%post_title%/i", single_post_title('', false), $input );
	$input = preg_replace( "/%category_title%/i", single_cat_title('', false), $input );	
	$input = preg_replace( "/%tag_title%/i", single_tag_title('', false), $input );
	$input = preg_replace( "/%search%/i", get_search_query(), $input );
	$input = preg_replace( "/%404%/i", wp_title('', false), $input );
	$input = preg_replace( "/%paged%/i", get_query_var('paged'), $input );
	
	return trim( $input );
}


add_filter( 'gidd_html_title_default', 'default_html_title' );
function default_html_title( $default ){
	
	$meta = "";
	if ( is_singular() )
		$meta = get_post_meta( get_the_ID(), 'g952d9bb5', true );
	
	$option = get_option( 'g4f04bb4d' );
	$format = "";
	$default_format = isset( $option['g7236f893'] ) ? stripslashes ( $option['g7236f893'] ) : "";
	
	//this works with post type with capability_type = post only
	if ( isset( $meta['g43209ebd'] ) && ( $meta['g43209ebd'] != "" ) ){
		$format = stripslashes( $meta['g43209ebd'] );
	}else{
		if ( is_singular() )
			$format = isset( $option['ge5871d30'] ) ? stripslashes ( $option['ge5871d30'] ) : $default_format;
		else
			$format = isset( $option['g7236f893'] ) ? stripslashes ( $option['g7236f893'] ) : "";
	}
	
	$default .= gidd_read_format( $format );
	return $default;
}


add_filter( 'gidd_html_title_home', 'home_html_title' );
add_filter( 'gidd_html_title_index', 'home_html_title' );
add_filter( 'gidd_html_title_front_page', 'home_html_title' );
function home_html_title( $home ){
	$option = get_option( 'g4f04bb4d' );
	$format = ( $option != "" ) ? stripslashes ( $option['g2bc648dd'] ) : "";
	$home .= gidd_read_format( $format );
	return $home;
}

add_filter( 'gidd_html_title_single', 'single_html_title' );
function single_html_title( $single ){
	$meta = "";
	if ( is_singular() )
		$meta = get_post_meta( get_the_ID(), 'g952d9bb5', true );
	
	$option = get_option( 'g4f04bb4d' );
	$format = "";
	$default = isset( $option['g7236f893'] ) ? stripslashes ( $option['g7236f893'] ) : "";
	
	if ( isset( $meta['g43209ebd'] ) && ( $meta['g43209ebd'] != "" ) ){
		$format = stripslashes( $meta['g43209ebd'] );
	}else{
		if ( is_singular() )
			$format = isset( $option['ge5871d30'] ) ? stripslashes ( $option['ge5871d30'] ) : $default;
		else
			$format = isset( $option['g7236f893'] ) ? stripslashes ( $option['g7236f893'] ) : "";
	}
	

	$single .= gidd_read_format( $format );
	return $single;
}

add_filter( 'gidd_html_title_page', 'page_html_title' );
function page_html_title( $page ){
	$meta = "";
	if ( is_singular() )
		$meta = get_post_meta( get_the_ID(), 'g952d9bb5', true );
	
	$option = get_option( 'g4f04bb4d' );
	$format = "";

	
	if ( isset( $meta['g43209ebd'] ) && ( $meta['g43209ebd'] != "" ) ){
		$format = stripslashes( $meta['g43209ebd'] );
	}else{
		if ( is_singular() )
			$format = isset( $option['gf2dfc1ed'] ) ? stripslashes ( $option['gf2dfc1ed'] ) : stripslashes ( $option['g7236f893'] );
		else
			$format = isset( $option['g7236f893'] ) ? stripslashes ( $option['g7236f893'] ) : "";
	}
	

	$page .= gidd_read_format( $format );
	return $page;
}

add_filter('gidd_html_title_category', 'category_html_title');
add_filter('gidd_html_title_archive', 'category_html_title');
function category_html_title( $category ){
	$option  = get_option( 'g4f04bb4d' );
	$format = ( $option != "" ) ? stripslashes ( $option['g4b9e5b7f'] ) : "";
	$category .= gidd_read_format ( $format );
	return $category;
}

add_filter('gidd_html_title_tag', 'tag_html_title');
function tag_html_title( $tag ){
	$option  = get_option( 'g4f04bb4d' );
	$format = ( $option['g6f1fbcdc'] != "" ) ? stripslashes ( $option['g6f1fbcdc'] ) : "";
	$tag .= gidd_read_format ( $format );
	return $tag;
}

add_filter('gidd_html_title_search', 'search_html_title');
function search_html_title( $search ){
	$option  = get_option( 'g4f04bb4d' );
	$format = ( $option != "" ) ? stripslashes ( $option['g7362e75a'] ) : "";
	$search .= gidd_read_format ( $format );
	return $search;
}

add_filter('gidd_html_title_404', 'fourofour_html_title');
function fourofour_html_title( $fof ){
	$option  = get_option( 'g4f04bb4d' );
	$format = ( $option != "" ) ? stripslashes ( $option['g61de4024'] ) : "";
	$fof .= gidd_read_format ( $format );
	return $fof;
}

add_filter('gidd_html_title_paged', 'paged_html_title');
function paged_html_title( $paged ){
	$option = get_option( 'g4f04bb4d' );
	$format = ( $option != "" ) ? stripslashes ( $option['gc43c3bb2'] ) : "";
	$paged .= gidd_read_format ( $format );
	return $paged;
}


/*** ADD META DESCRIPTION TO HTML HEAD ***/
add_filter( 'gidd_html_description_home', 'home_html_desciption' );
add_filter( 'gidd_html_description_index', 'home_html_desciption' );
add_filter( 'gidd_html_description_front_page', 'home_html_desciption' );
function home_html_desciption( $desc ){
	$option = get_option( 'g1792afb7' );	
	$desc .= '<meta content="';
	$desc .= isset( $option['g8d16b40e'] ) ? wp_kses( stripslashes( $option['g8d16b40e'] ), "" ) : "";
	$desc .= '" name="description" />';
	return $desc;
}

add_filter( 'gidd_html_description_single', 'single_html_description' );
function single_html_description( $desc ){
	$seo_meta = "";
	if ( is_singular() )
		$seo_meta = get_post_meta( get_the_ID(), 'g952d9bb5', true );
	
	$meta_desc = isset( $seo_meta['g55f8ebc8'] ) ? $seo_meta['g55f8ebc8'] : "";
	$desc = "";
	if ( $meta_desc != "" ){
		$desc .= '<meta content="';
		$desc .= wp_kses( $meta_desc, "" );
		$desc .= '" name="description" />';	
	}else{
		$general = get_option( 'g1792afb7' );
		$desc .= '<meta content="';
		$desc .= isset( $general['ge3d9d11a'] ) ? wp_kses( stripslashes( $general['ge3d9d11a'] ), "" ) : "";
		$desc .= '" name="description" />';
	}
	
	return $desc;
}

add_filter( 'gidd_html_description_page', 'page_html_description' );
function page_html_description( $desc ){
	$seo_meta = "";
	if ( is_singular() )
		$seo_meta = get_post_meta( get_the_ID(), 'g952d9bb5', true );
	
	$meta_desc = isset( $seo_meta['g55f8ebc8'] ) ? $seo_meta['g55f8ebc8'] : "";
	$desc = "";
	if ( $meta_desc != "" ){
		$desc .= '<meta content="';
		$desc .= wp_kses( $meta_desc, "" );
		$desc .= '" name="description" />';	
	}else{
		$general = get_option( 'g1792afb7' );
		$desc .= '<meta content="';
		$desc .= isset( $general['ge3d9d11a'] ) ? wp_kses( stripslashes( $general['ge3d9d11a'] ), "" ) : "";
		$desc .= '" name="description" />';
	}
	
	return $desc;
}

add_filter( 'gidd_html_description_default', 'default_html_description' );
function default_html_description( $desc ){
	$meta = "";
	if( is_singular() )
		$meta = get_post_meta( get_the_ID(), 'g952d9bb5', true );
		
	$general = get_option( 'g1792afb7' );
	$default = isset( $general['ge3d9d11a'] ) ? wp_kses( stripslashes( $general['ge3d9d11a'] ), "" ) : "";
		
	$desc .= '<meta content="';
	$desc .= ( isset( $meta['g55f8ebc8'] ) && ( $meta['g55f8ebc8'] != "" ) ) ? wp_kses( stripslashes( $meta['g55f8ebc8'] ), "" ) : $default;
	$desc .= '" name="description" />';
	return $desc;
}



/*** ADD META ROBOT TO HEAD ***/
function gidd_noodp_noydir(){
	$option = get_option('gbe46f2ff');
	$robot  = ( isset( $option['g447d8398'] ) && ( $option['g447d8398'] != "" ) ) ? 'noodp' : '';
	$robot .= ( isset( $option['g038e078f'] ) && ( $option['g038e078f'] != "" ) ) ? ',noydir' : '';
	return $robot;
}

function gidd_add_robot( $robot ){
	$option = get_option('gbe46f2ff');
	$content = ( $option['g960dbe8c'] != "" ) ? 'noindex,nofollow' : 'noindex,follow';
	
	if ( isset( $option['g447d8398'] ) && ( $option['g447d8398'] != "" ) )
		$content .= ",";
	
	$robot .= '<meta content="';		
	$robot .= $content;
	$robot .= gidd_noodp_noydir();
	$robot .= '" name="robots" />';
	
	return $robot;
}

add_filter( 'gidd_html_robot_default', 'default_html_robot' );
function default_html_robot( $robot ){
	
	$option = get_option('gbe46f2ff');
	
	$meta = "";
	if( is_singular() ) 
		$meta = get_post_meta( get_the_ID(), 'g952d9bb5', true );

	//THIS IS DEFAULT ROBOT TEXT FOR UNMANAGED PAGES
	$robottext = "noindex,follow";
	
	if ( isset( $meta['g7cd45b9c'] ) && ( $meta['g7cd45b9c'] != "" ) ):
		
		switch( $meta['g7cd45b9c'] ){
			case '0' : $robottext = "index,follow"; break;
			case '1' : $robottext = "index,nofollow"; break;
			case '2' : $robottext = "noindex,follow"; break;
			case '3' : $robottext = "noindex,nofollow"; break;
			default: break;
		}

	endif;

	//comma
	$comma = "";
	if ( $robottext != "" ){
		if( isset( $option['g447d8398'] ) && ( $option['g447d8398'] != "" ) ):
			$comma = ",";
		endif;
	}
	
	$robot .= '<meta content="';	
	$robot .= $robottext;	
	$robot .= $comma; 
	$robot .= gidd_noodp_noydir();
	$robot .= '" name="robots" />';

	return $robot;
	
}

add_filter( 'gidd_html_robot_home', 'blog_html_robot' );
add_filter( 'gidd_html_robot_index', 'blog_html_robot' );
add_filter( 'gidd_html_robot_front_page', 'blog_html_robot' );
function blog_html_robot( $robot ){
	$option = get_option('gbe46f2ff');
	$arr_robot = array();
	if ( isset( $option['g1721ea5e'] ) && ( $option['g1721ea5e'] != "" ) ) $arr_robot[] = "noindex";
	if ( isset( $option['gfa2cdff8'] ) && ( $option['gfa2cdff8'] ) ) $arr_robot[] = "nofollow";
	if ( isset( $option['g8f38da1b'] ) && ( $option['g8f38da1b'] ) ) $arr_robot[] = "noarchive";
	
	$show_robot = "";
	foreach($arr_robot as $value){
		$show_robot .= $value . ",";
	}

	$comma = "";
	if ( count ( $arr_robot ) > 0 ){
		if( isset( $option['g447d8398'] ) && ( $option['g447d8398'] != "" ) ):
			$comma = ",";
		endif;
	}
	
	$robot .= '<meta content="';	
	$robot .= rtrim($show_robot, ',');	
	$robot .= $comma; 
	$robot .= gidd_noodp_noydir();
	$robot .= '" name="robots" />';	
	return $robot;
}

add_filter( 'gidd_html_robot_single', 'singular_html_robot' );
add_filter( 'gidd_html_robot_page', 'singular_html_robot' );
function singular_html_robot( $robot ){
	$option = get_option('gbe46f2ff');
	
	$meta = "";
	if( is_singular() ) 
		$meta = get_post_meta( get_the_ID(), 'g952d9bb5', true );
	
	$robottext = "";
	
	if ( isset( $meta['g7cd45b9c'] ) && ( $meta['g7cd45b9c'] != "" ) ):
		
		switch( $meta['g7cd45b9c'] ){
			case '0' : $robottext = "index,follow"; break;
			case '1' : $robottext = "index,nofollow"; break;
			case '2' : $robottext = "noindex,follow"; break;
			case '3' : $robottext = "noindex,nofollow"; break;
			default: break;
		}

	endif;

	//comma
	$comma = "";
	if ( $robottext != "" ){
		if( isset( $option['g447d8398'] ) && ( $option['g447d8398'] != "" ) ):
			$comma = ",";
		endif;
	}
	
	$robot .= '<meta content="';	
	$robot .= $robottext;	
	$robot .= $comma; 
	$robot .= gidd_noodp_noydir();
	$robot .= '" name="robots" />';

	return $robot;	
}

add_filter( 'gidd_html_robot_archive', 'category_html_robot' );
add_filter( 'gidd_html_robot_category', 'category_html_robot' );
function category_html_robot( $robot ){
	$option = get_option('gbe46f2ff');
	if ( isset( $option['g0890f4a0'] ) && ( $option['g0890f4a0'] != "" ) ){
		$robot .= gidd_add_robot( $robot );
	}
	return $robot;
}

add_filter( 'gidd_html_robot_author', 'author_html_robot' );
function author_html_robot( $robot ){
	$option = get_option('gbe46f2ff');
	if ( isset( $option['g0d2cabe3'] ) && ( $option['g0d2cabe3'] != "" ) ){
		$robot .= gidd_add_robot( $robot );
	}
	return $robot;
}

add_filter( 'gidd_html_robot_tag', 'tag_html_robot' );
function tag_html_robot( $robot ){
	$option = get_option('gbe46f2ff');
	if ( isset( $option['g58c274da'] ) && ( $option['g58c274da'] != "" ) ){
		$robot .= gidd_add_robot( $robot );
	}
	return $robot;
}

add_filter( 'gidd_html_robot_search', 'search_html_robot' );
function search_html_robot( $robot ){
	$option = get_option('gbe46f2ff');
	if ( isset( $option['g099a1962'] ) && ( $option['g099a1962'] != "" ) ){
		$robot .= gidd_add_robot( $robot );
	}
	return $robot;
}

add_filter( 'gidd_html_robot_attachment', 'attachment_html_robot' );
function attachment_html_robot( $robot ){
	$option = get_option('gbe46f2ff');
	if ( isset( $option['g5ca0f860'] ) && ( $option['g5ca0f860'] != "" ) ){
		$robot .= gidd_add_robot( $robot );
	}
	return $robot;
}

add_filter( 'gidd_html_robot_archives', 'archives_html_robot' );
function archives_html_robot( $robot ){
	$option = get_option('gbe46f2ff');
	if ( isset( $option['g69468752'] ) && ( $option['g69468752'] != "" ) ){
		$robot .= gidd_add_robot( $robot );
	}
	return $robot;
}


/** seo.php */