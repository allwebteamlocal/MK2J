<?php
//use init for gidd_get_posttype to work
add_action('init', 'gidd_seo_types');
function gidd_seo_types(){

	$posttype	= ___subpage( 'Post Types' );	
	$post_types = gidd_get_posttype();
	
	//unset several post types
	if ( isset( $post_types['gidd_static'] ) && ( $post_types['gidd_static'] != "" ) )
		unset( $post_types['gidd_static'] );
	
	if ( isset( $post_types['gidd_cycle'] ) && ( $post_types['gidd_cycle'] != "" ) )
		unset( $post_types['gidd_cycle'] );
	
	if ( isset( $post_types['gidd_reply'] ) && ( $post_types['gidd_reply'] != "" ) )
		unset( $post_types['gidd_reply'] );
	
	if ( isset( $post_types['gidd_forum'] ) && ( $post_types['gidd_forum'] != "" ) )
		unset( $post_types['gidd_forum'] );
	
	if ( isset( $post_types['gidd_topic'] ) && ( $post_types['gidd_topic'] != "" ) )
		unset( $post_types['gidd_topic'] );
	
	if ( isset( $post_types['gidd_reply'] ) && ( $post_types['gidd_reply'] != "" ) )
		unset( $post_types['gidd_reply'] );
	
	if ( isset( $post_types['forum'] ) && ( $post_types['forum'] != "" ) )
		unset( $post_types['forum'] );
	
	if ( isset( $post_types['topic'] ) && ( $post_types['topic'] != "" ) )
		unset( $post_types['topic'] );
	
	if ( isset( $post_types['reply'] ) && ( $post_types['reply'] != "" ) )
		unset( $post_types['reply'] );
	
	
	$arr_posttype = array();
	foreach( $post_types as $type ){
		$arr_posttype[] = ___checkbox( $type, 'Enable support for ' . $type );
	}
	
	
	___section( array ( 'Gidd SEO', 'g952d9bb5' ), $posttype, $arr_posttype, "<b>SEO metabox support for post types.</b>" );
	unset( $arr_posttype );
	
}

/** end **/