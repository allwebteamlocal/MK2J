<?php
/*** Generate ID from string ***/
function ___id( $string ){

	$string = str_replace( " ", "_", $string );
	$string = sha1( $string );
	$string = 'g' . substr( $string, 0, 8 );
	return $string;

}

function ___app( $name ){
	if ( !empty ( $name ) ){
		
		$path = "";
		$url = "";
		if ( is_multisite() ):			
		
			$id = get_current_blog_id();
			if ( gidd_dir_exists( $name, CHILDAPP . "$id/" ) ):
				$path = CHILDAPP . "$id/$name/";
				$url = CHILDAPPURL . "$id/$name/";
				gidd_include_file( $path . 'gidd_load.php' );
			else:
				$path = CHILDAPP . "$name/";
				$url = CHILDAPPURL . "$name/";
				gidd_include_file( $path . 'gidd_load.php' );		
			endif;
		
		else:
			$path = CHILDAPP . "$name/";
			$url = CHILDAPPURL . "$name/";
			gidd_include_file( $path . 'gidd_load.php' );
			
		endif;
		
		//track the loaded app for gidd_dynamic_page.php
		$url  .= 'template/';
		$path .= 'template/';
		
		$app 	= ___registry( '___app' );
		$app[ "$url" ]	= $path;
				
		___registry( '___app', $app );
	
	}
}

//get & set global page name
function ___name( $name = "" ){
	global $page_name;
	
	if( $name != "" )
		$page_name = $name;
	
	return $page_name;
}

//factory method
function ___object( $type, $param = "" ){
	$class = "Gidd_" . $type;
	if ( class_exists( $class ) )
		return ( $param == "" ) ? new $class() : new $class( $param );
}

//common render method
function ___render( $object, $data ){
	$object->render( $data->get_data() );
}

//get & set registry
function ___registry( $key = "", $val = "" ){
	$gidd = Gidd_Registry::get_instance();
	if ( empty( $key ) && empty( $val ) )
		return $gidd;
	else
		return empty( $val ) ? $gidd->get( "$key" ) : $gidd->set( "$key", $val );
}

function ___clear( $key = "" ){
	$gidd = Gidd_Registry::get_instance();
	$gidd->clear($key );
}

//get & set data
function ___data( $val = "" ){
	$data = ___object( 'data' );
	
	if (! empty( $val ) )
		$data->set_data( $val );
		
	return $data;
}

//word_limit helper
function ___limit( $limit = NULL ){
	
	$wl = NULL;		
	if ( ! isset( $limit ) )
		$limit = new Word_Limit_Length;
	
	$wl = ___object( 'WP_Word_Limit', $limit );
	$wl->set_data( ___registry( 'word_limit' )->get_data() );
	return $wl;
	
}


//construct template object
function ___html( $data ){	
	___render( ___object( 'WP_Template' ), $data );
}

function ___admin( $data ){
	___render( ___object( 'Admin_Template' ), $data );
}

//shorter loop data object
function ___loop(){
	return ___registry( 'gidd_loop' );
}

//get paged var
function ___paged(){

	//Fix homepage pagination
	$paged = "";
	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } 
	else if ( get_query_var('page') ) { $paged = get_query_var('page'); } 
	else{ $paged = 1; }
	
	return $paged;		

}

/*** REGISTER HOOK HELPER ***/
function ___do( $hook, $page = "default" ) {
	$func = "___" . $hook . "_" . $page;
	do_action( $func );
}

function ___add( $hook, $page = "default" ) {

	$hook = "___" . $hook;
	$func = $hook . "_" . $page;	
		
	if ( function_exists( $hook ) ):
		add_action( $func, $hook );
	else:
		//add default action
		if ( function_exists( $hook . '_default' ) )
			add_action( $func, $hook . '_default' );
		
	endif;			
		
}

/*** APPLY FILTERS HELPER ***/
function ___apply( $filter_name, $var, $page = "default" ){
	$name = $filter_name . "_" . $page;
	return apply_filters( $name, $var );
}

//not yet implemented
function ___filter(){}


/* End of function gidd_common.php */