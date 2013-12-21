<?php
//include file
function gidd_include_file( $file = "" ){

	if ( file_exists( $file ) ):
		include_once( $file );
		return true;
	endif;
	
	return false;
}

/*** Include files from a directory ***/
function gidd_include_files( $path_filter = "" ){
	foreach ( glob( $path_filter ) as $filename ){
		include_once "$filename";
	}
}

//directory exists
function gidd_dir_exists($dir_name = false, $path = './') {
    if(!$dir_name) return false;
   
    if(is_dir($path.$dir_name)) return true;
   
    $tree = glob($path.'*', GLOB_ONLYDIR);
    if($tree && count($tree)>0) {
        foreach($tree as $dir)
            if(gidd_dir_exists($dir_name, $dir.'/'))
                return true;
    }
   
    return false;
}

function gidd_is_odd( $num ){
  return ( boolean ) ( $num % 2 );
}

function gidd_is_even( $num ){
  if( is_odd( $num ) )
	return FALSE;
  return TRUE;
}

//Get the current url
function gidd_strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }
function gidd_current_url(){ 
	
	if(!isset($_SERVER['REQUEST_URI'])){
		$serverrequri = $_SERVER['PHP_SELF'];
	}else{
		$serverrequri = $_SERVER['REQUEST_URI'];
	}
	$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
	$protocol = gidd_strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
	$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
	return $protocol."://".$_SERVER['SERVER_NAME'].$port.$serverrequri;
	
}

/*** close all open xhtml tags at the end of the string ***/		
function gidd_close_tags( $html ) {		
	preg_match_all( '#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result );
	$openedtags = $result[1]; #put all open tags into an array
	
	preg_match_all( '#</([a-z]+)>#iU', $html, $result );
	$closedtags = $result[1];
	$len_opened = count( $openedtags );

	//all tags are closed
	if ( count( $closedtags ) == $len_opened ) {
		return $html;
	}
	
	$arr_single_tags = array( 'meta','img','br','link','area', 'input', 'hr' );
	$openedtags = array_reverse( $openedtags );
	
	//close tags
	for ($i=0; $i < $len_opened; $i++) {
		if ( !in_array( $openedtags[$i], $arr_single_tags ) ) {
			if (!in_array($openedtags[$i], $closedtags)){
			  $html .= '</'.$openedtags[$i].'>';
			} else {
				unset($closedtags[array_search($openedtags[$i], $closedtags)]);
			}
		}
	}
			
	return $html;
}


function ___space( $num ){
	return '<div class="space" style="width: 1px; height: '. $num .'px;"></div>';
}

function ___clearBoth(){
	return '<div class="clearBoth"></div>';
}

//get last segment from url
function get_last_segment( $url ) {
        
		  $path = parse_url( $url, PHP_URL_PATH ); // to get the path from a whole URL
        $pathTrimmed = trim($path, '/'); // normalise with no leading or trailing slash
        $pathTokens = explode('/', $pathTrimmed); // get segments delimited by a slash

        if (substr($path, -1) !== '/')
            array_pop($pathTokens);

        return end($pathTokens); // get the last segment
}

//get id by slug
function get_ID_by_slug( $slug, $posttype = "post" ) {
	$args = array(
	  'name' => $slug,
	  'post_type' => $posttype,
	  'post_status' => 'publish',
	  'showposts' => 1,
	  'caller_get_posts' => 1
	);
	
	$posts = get_posts( $args );
	
	if( $posts ):
		return $posts[0]->ID;
	endif;
	
	return null;	
}

//register post type
function gidd_register_post_type( $args ){	
		
	$name 		= $args->name;
	$singular	= $args->singular;
	$plural 	= $args->plural;
	$slug 		= $args->slug;
	$search		= ( $args->exclude_from_search == "" ) ? false : $args->exclude_from_search;
	$archive	= ( $args->has_archive == "" ) ? true : $args->has_archive;
	$support 	= ( $args->support == "" ) ? array('title', 'editor', 'thumbnail') : $args->support;
	
	$position	= $args->menu_position;
	$cap_type	= ( $args->capability_type == "" ) ? 'post' : $args->capability_type;
	$tax		= ( $args->taxonomies == "" ) ? array('post_tag') : $args->taxonomies;
	$nav		= $args->show_in_nav_menus;
	$menu		= $args->show_in_menu;
	$show_ui	= ( $args->show_ui == "" ) ? true : $args->show_ui;
	$public		= ( $args->_public == "" ) ? true : $args->_public;
	$front		= ( $args->with_front == "" ) ? false : $args->with_front;
	
	$cap		= ( $args-> capabilities == "" ) ? array() : $args->capabilities;
	$description= $args->description;
	$adminbar	= $args->show_in_admin_bar;
	$meta_cap	= $args->map_meta_cap;
	$meta_cb	= $args->register_meta_box_cb;
	$hier		= $args->hierarchical;
	$query_var	= $args->query_var;
	$can_export	= ( $args->can_export == "" ) ? true : $args->can_export;
		
	
	register_post_type( "$name",	
		array(
			'label'					=> "$plural",
			'labels' 				=> array(
				'name' 				=> __( "$plural" ),
				'singular_name' 	=> __( $singular ),
				'add_new' 			=> __( "Add $plural" ),
				'add_new_item' 		=> __( "Add " . $singular ),
				'edit_item' 		=> __( "Edit " . $singular ),
				'view_item' 		=> __( "Read " . $singular )
			),
			
			'description'			=> $description,
			'public' 				=> $public,
			'show_ui' 				=> $show_ui,
			'exclude_from_search' 	=> $search,
			'capability_type' 		=> $cap_type,
			'capability' 			=> $cap,
			'show_in_nav_menus' 	=> $nav,
			'show_in_menu' 			=> $menu,
			'menu_position' 		=> $position,
			'has_archive' 			=> $archive,
			'taxonomies' 			=> $tax,
			'map_meta_cap' 			=> $meta_cap,
			'hierarchical' 			=> $hier,
			'register_meta_box_cb'	=> $meta_cb,
			'query_var'				=> $query_var,
			'can_export'			=> $can_export,
			'rewrite' 				=> array('slug' => "$slug", 'with_front' => $front),
			'supports' 				=> $support )
		);		
}

//register taxonomy
function gidd_register_taxonomy( $data ){
	
	//param
	$name 			= $data->name;
	$type 			= $data->object_type;
	$singular 		= $data->singular;
	$plural 		= $data->plural;
	$slug			= $data->slug;
	$tagcloud		= ( $data->show_tagcloud == "" ) ? true : $data->show_tagcloud;
	
	$public			= ( $data->_public == "" ) ? true : $data->_public;
	$show_ui		= ( $data->show_ui == "" ) ? true : $data->show_ui;
	$hier			= ( $data->hierarchical == "" ) ? false : $data->hierarchical;
	$menu			= $data->show_in_nav_menus;
	$front			= ( $data->with_front == "" ) ? false : $data->with_front;
	$cap			= ( $data->capabilities == "" ) ? array() : $data->capabilities;
	
	$query_var		= $data->query_var;
	$admin_column 	= ( $data->show_admin_column == "" ) ? false : $data->show_admin_column;
	$count_callback = $data->update_count_callback;
	$sort			= $data->_sort;
	
	
	//label
	$labels = array(
					'name'                          => "$plural",
					'singular_name'                 => $singular,
					'search_items'                  => "Search $plural",
					'popular_items'                 => "Popular $plural",
					'all_items'                     => "All $plural",
					'parent_item'                   => "Parent " . $singular,
					'edit_item'                     => "Edit " . $singular,
					'update_item'                   => "Update " . $singular,
					'add_new_item'                  => "Add " . $singular,
					'new_item_name'                 => "New " . $singular,
					'separate_items_with_commas'    => "Seperate $plural with commas",
					'add_or_remove_items'           => "Add or remove " . $singular,
					'choose_from_most_used'         => "Choose from the most used $plural"
			  );
	
	//args
	$args = array(
	
		'label'                         => "$plural",
		'labels'                        => $labels,
		
		'public'                        => $public,
		'show_ui'                       => $show_ui,
		'hierarchical'                  => $hier,
		'show_in_nav_menus'             => $menu,
		'query_var'                     => $query_var,
		'show_tagcloud'					=> $tagcloud,
		'show_admin_column'				=> $admin_column,
		'update_count_callback'			=> $count_callback,
		'capabilities'					=> $cap,
		'sort'							=> $sort,
		'rewrite'                       => array('slug' => "$slug", 'with_front' => $front),
	
	);

	register_taxonomy( "$name", "$type", $args );
	
}


function gidd_check_mail( $user_email ){
		
	$err = "";
	if ( $user_email == '' ) {
		$err .= '<p>Email is required.</p>';
	} elseif ( ! is_email( $user_email ) ) {						
		$err .= '<p>This email is not valid.</p>';
	} elseif ( email_exists( $user_email ) ) {
		$err .= '<p>This email already exists.</p>';
	}
	
	return $err;
}


//list specific terms, support 3 types of outputs: option, array and li
function ___list_terms( $name, $output = "li", $hide_empty = 0, $selected = "" ){
	
	$terms = get_terms( "$name", 'hide_empty=' . $hide_empty );
	$count = count($terms);
	if ( $count > 0 ):
	
		$result = "";		
		//option
		if ( $output == "option" ):
			foreach ( $terms as $term ){
				
				if ( $term->term_id == $selected )
					$result .= '<option selected="selected" value="'. $term->term_id .'">'. $term->name .'</option>';
				else
					$result .= '<option value="'. $term->term_id .'">'. $term->name .'</option>';
			}
			return $result;
			
		//array
		elseif ( $output == "array" ):
			$arr_terms = array();
			foreach ( $terms as $term ):
				$arr_terms[ $term->term_id ] = $term->name;
			endforeach;
			return $arr_terms;
		
		//li
		else:		
			foreach ( $terms as $term ){
				$result .= '<li><a href="'. get_term_link( $term ) .'" >' . $term->name . '</a></li>';
			}
			return $result;
		endif;
		
	endif;
	
}

//include files from specific url
function gidd_get_template( $url, $tppath, $tpurl, $base, $app_template = "" ){
	
	//remove base slug and keep only url path
	$path = trailingslashit( str_replace ( DIRPATH, "", $base ) );
	
	//load action hooks from gidd_template folder
	$childtp = gidd_include_file( CHILDTP . 'default/default.php' );
	if ( !$childtp )
		gidd_include_file( DEFAULTPATH . 'default.php' );
	
	if ( $tpurl == "CHILDTP" ):
		gidd_include_file( $tppath . $path . ___name() . '.php' );
		gidd_auto_column( ___name(), $tppath . $path, CHILDTPURL . $path, 'gidd_template' );
	else:
		
		//allow template override within gidd_template
		$tp = gidd_include_file( CHILDTP . $path . ___name() . '.php' );
		if ( $tp ){
			gidd_auto_column( ___name(), CHILDTP . $path, CHILDTPURL . $path, 'gidd_template' );
		}else{			
		
			//for gidd_application
			$default_app = gidd_include_file( $tppath . 'default/default.php' );
			if ( !$default_app )
				gidd_include_file( DEFAULTPATH . 'default.php' );
				
						
			if ( $app_template != "" )
				$path = "$app_template/";
				
			$tp = gidd_include_file( $tppath . $path . ___name() . '.php' );
			gidd_auto_column( ___name(), $tppath . $path, $tpurl . $path, 'gidd_application', $tppath, $tpurl );
			
		}
		
	endif;
		
	//use in gidd_wp_helper.php
	if ( $tpurl != "CHILDTP" ){
		___registry( 'current_tpurl', $tpurl . $path );
		___registry( 'current_tppath', $tppath . $path );
	}
		
}



function gidd_get_user_role( $id ){
    $user = new WP_User( $id );
    return array_shift($user->roles);
}

function gidd_post_nav() {
	if(function_exists('wp_pagenavi')){
		wp_pagenavi();
	}else{
		if(function_exists('wp_paginate')){
			wp_paginate();
		}else{
		
			// Don't print empty markup if there's nowhere to navigate.
			$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}
		
			if ( is_singular() ):
			?>
				<div class="navigation post-navigation" role="navigation">
					<div class="nav-links">
						<?php
						if ( is_attachment() ) :
							previous_post_link( '%link', __( '<span class="meta-nav">Published In: </span>%title', 'gidd' ) );
						else :
							previous_post_link( '%link', __( '<span class="meta-nav">Previous Post: </span>%title', 'gidd' ) );
							next_post_link( '%link', __( '<span class="meta-nav">Next Post: </span>%title', 'gidd' ) );
						endif;
						?>
					</div><!-- .nav-links -->
				</div><!-- .navigation -->
			<?php
			else:
			?>
				<div class="navigation post-navigation">
					<div class="alignleft"><?php previous_posts_link('&laquo; Previous Entries') ?></div>
					<div class="alignright"><?php next_posts_link('Next Entries &raquo;','') ?></div>
				</div>
			<?php
			endif;
		}
	}
}

//this function sets unlimited data field dynamically
function ___k(){
	
	$data = ___data();
	for( $i=0; $i < func_num_args(); $i++ ){
		$arg = func_get_arg( $i );
		$data->$arg = "";
	}
	return $data;
}

//this function set the value to __k() dynamically
function ___v( $data ){
	$i = 1;
	$dt = ___data ( $data->get_data() );
	foreach( $dt->get_data() as $k => $v ){
		$dt->$k = func_get_arg( $i );
		$i++;
		
		if ( $i >= func_num_args() )
			break;
	}
	
	//this removes null values from array and always returns new data object
	$arr = array_filter( $dt->get_data(), create_function('$a', 'return $a!="";') );
	$dt->set_data( $arr );
	return $dt;
}

function gidd_get_posttype(){
	
	//get a list of post type
	$args = array(
		'public'   => true,
		'_builtin' => false
	);
	
	$output = 'names'; // names or objects, note names is the default
	$type = get_post_types( $args, $output );
	
	if ( is_array(  $type ) ):
		return $type;
	else:
		return array();
	endif;
}

if ( ! function_exists( 'is_wp_version_gte' ) ) {
	function is_wp_version_gte( $version = '' ) {
		global $wp_version;
		
		if ( $wp_version >= $version )
			return true;
			
		return false;
	}
}

if ( ! function_exists( 'is_wp_version_le' ) ) {
	function is_wp_version_le( $version = '' ) {
		global $wp_version;
				
		if ( $wp_version < $version )
			return true;
			
		return false;
	}
}

/** end */