<?php
/*** HTML DOCTYPE ***/
function gidd_doctype( $doctype = "", $page = "" ) {
	$doc = "";
	switch ( $doctype ) {
		case "XHTML 1.0 Strict" :
			$doc  = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
			$doc .= '<html xmlns="http://www.w3.org/1999/xhtml" ';
			break;

		case "HTML 4.01 Strict" :
			$doc  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">';
			$doc .= '<html ';
			break;

		case "HTML 4.01 Transitional" :
			$doc  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
			$doc .= '<html ';
			break;
			
		case "HTML5" :
			$doc = "";
			
			echo '<!DOCTYPE html>';
			echo '<!--[if lt IE 7]> <html class="ie ie6" '; language_attributes(); echo '> <![endif]-->';
			echo '<!--[if IE 7]> <html class="ie ie7" '; language_attributes(); echo '> <![endif]-->';
			echo '<!--[if IE 8]> <html class="ie ie8" '; language_attributes(); echo '> <![endif]-->';
			echo '<!--[if (gte IE 9)|!(IE)]><!--> <html class="" '; language_attributes(); echo '> <!--<![endif]-->';
			
			break;

		default :
			$doc  = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
			$doc .= '<html xmlns="http://www.w3.org/1999/xhtml" ';
	}
	
	return ___apply( 'gidd_doctype', $doc, $page );
	
}

/*** ADD HEAD PROFILE ***/
function gidd_head_profile( $doctype = "" ) {
    $profile = '';	
	switch ( $doctype ) {
		case "XHTML 1.0 Strict" : $profile = '<head profile="http://gmpg.org/xfn/11">'; break;
		case "HTML 4.01 Strict" : $profile = '<head>'; break;
		case "HTML 4.01 Transitional" : $profile = '<head>'; break;
		case "HTML5" : $profile = '<head>'; break;
		default : $profile = '<head profile="http://gmpg.org/xfn/11">';
	}
    return ___apply( 'gidd_head_profile', $profile );
}

/*** ADD HTML CONTENT TYPE TO HEAD ***/
function gidd_html_content_type( $doctype ) {

	if ( $doctype == 'HTML5' ){
		$content = '<meta charset="'. get_bloginfo( 'charset' ) .'" />';
	}else{
		$content  = '<meta http-equiv="Content-Type" content="';
		$content .= get_bloginfo( 'html_type' );
		$content .= '; charset='. get_bloginfo( 'charset' ) .'"/>';
	}

	return ___apply( "gidd_html_content_type", $content );
}

/*** ADD FAV ICON URL TO THE HEAD ***/
function gidd_fav_icon() {
	
	$conf = ___conf('theme');
	$url = $conf->fav;	
	
	//get option
	$option = get_option('g9239ee2c');
	$fav_url = isset( $option['gb0c1b6ee'] ) ? $option['gb0c1b6ee'] : "";
	if ( $fav_url != "" ){
		$url = $fav_url;
	}
		
	$fav = '<link rel="shortcut icon" href="'. esc_url( apply_filters('gidd_fav_icon', $url) ) .'" />';
	return $fav;
}

/*** ADD CANONICAL URL TO THE HEAD ***/
function gidd_canonical_url() {
	if ( is_singular() ) {
		$canonical = '<link rel="canonical" href="'. get_permalink() .'" />';
		return apply_filters( 'gidd_canonical_url', $canonical );
	}
}

/*** ADD FEED URL TO HEAD ***/
function gidd_show_feed() {
	$feed  = '<link rel="alternate" type="application/rss+xml" title="';
	$feed .= esc_html( get_bloginfo( 'name' ) ) . " RSS Feed";
	$feed .= '" href="' . esc_url ( get_bloginfo( 'rss2_url' ) ) . '" />';
	return apply_filters('gidd_show_feed', $feed);
}

/*** ADD COMMENTS RSS TO HEAD ***/
function gidd_show_comments_rss() {
	$rss  = '<link rel="alternate" type="application/rss+xml" title="';
	$rss .= esc_html( get_bloginfo( 'name' ) ) . " Comments RSS Feed";
	$rss .= '" href="' . get_bloginfo( 'comments_rss2_url' ) . '" />';
	return apply_filters('gidd_show_feed', $rss);
}

/*** ADD PINGBACK URL TO HEAD ***/
function gidd_show_pingback_url() {
	$pingback = '<link rel="pingback" href="'. get_bloginfo( 'pingback_url' ) .'" />';
	return apply_filters( 'gidd_show_pingback_url', $pingback );
}

/*** ADD SUPPORT FOR THREADED COMMENTS ***/
function gidd_show_comment_reply() {
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/*** ADD STYLE TO HEAD ***/
function ___style( $layout = "" ){

	$master  = '<link rel="stylesheet" media="screen, projection" href="'. CHILDURL . 'gidd/gidd_master/master.css' .'" />';
	$style 	 = "";
	
	if( file_exists( CHILDTHEME . 'style.css' ) ){
		$style  .= '<link rel="stylesheet" media="screen, projection" href="'. CHILDTHEMEURL .'style.css" />';
	}
	
	if( file_exists( CHILDTP . 'style.css' ) ){
		$style  .= '<link rel="stylesheet" media="screen, projection" href="'. CHILDTPURL .'style.css" />';
	}
		
	$master = apply_filters( 'gidd_master_style', $master );
	$style  = apply_filters( 'gidd_main_style', $style, ___name() );
	
	$layout = strtolower( $layout );
	if ( ( $layout == "col1f" ) || ( $layout == "col2l" ) || ( $layout == "col2r" ) || 
		 ( $layout == "col3h" ) || ( $layout == "col3b" ) || ( $layout == "pf2cl" ) ||
		 ( $layout == "pf2cr" ) ){

		echo $link = $master . $style;
				
	}else{	
		if ( file_exists( CHILDTHEME . 'style.css' ) )
			wp_enqueue_style('gidd-style-wp', CHILDTHEMEURL . 'style.css', '', '1', 'screen,projection');	
			wp_enqueue_style('gidd-style', CHILDTPURL . 'style.css', '', '1', 'screen,projection');	
	}
		
}

/** end */