<?php
//HELPER
//list specific terms, support 3 types of outputs: option, array and li
function gidd_cycle_list_terms( $name, $output = "li", $hide_empty = 0, $selected = "" ){
	
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

//register position for cycle items
function register_cycle_position( $position, $slug = "" ){
	$args = array();

	if ( $slug != "" )
		$args['slug'] = $slug;
				
	if( term_exists( $slug, 'cycle_position' ) )
		return;

	if ( term_exists( $position, 'cycle_position' ) )
		return;
	
		
	$callback = "wp_insert_term( '$position', 'cycle_position', '$args' );";
	$func = create_function('', $callback );
	add_action( 'init', $func );
}

//count the number of cycle items based on position
function gidd_count_cycle_items( $position = "" ){
	global $wpdb;
	
	$sql  = "SELECT COUNT(*) FROM $wpdb->posts p ";
	$sql .= "INNER JOIN $wpdb->term_relationships r ON r.object_id = p.ID ";
	$sql .= "INNER JOIN $wpdb->term_taxonomy x ON x.term_taxonomy_id = r.term_taxonomy_id ";
	$sql .= "INNER JOIN $wpdb->terms t ON t.term_id = x.term_id ";
	$sql .= "WHERE p.post_status = 'publish' AND p.post_type = 'gidd_cycle' ";
	$sql .= "AND x.taxonomy = 'cycle_position' AND t.slug = '$position'";
	
	$count = 0;
	$result = $wpdb->get_var( $sql );
	
	if ( $result > 0 )
		$count = intval( $result );
		
	return $count;
	
}

//show the cycle content
function gidd_cycle_content( $args ){

	if ( !$args instanceof Gidd_Data ){ return; }
	
	$posts_per_page = gidd_count_cycle_items( $args->cycle_position );	
	$position = $args->cycle_position;
	$name = ( $args->name != "" ) ? $args->name : "gdc";
	$key = ( $args->key != "" ) ? $args->key : "gdcc";
	$order = ( $args->order != "" ) ? $args->order : "";
	$allposts = ( $args->show_all != "" ) ? $args->show_all : "";
	$item_width = $args->item_width;
	$item_height = $args->item_height;
	$rotator_width = $args->rotator_width;
	$rotator_height = $args->rotator_height;
	
	//reset the count session
	if ( isset( $_SESSION["$key"] ) && ( $_SESSION["$key"] != "" ) ){
		
		//round the session value
		$_SESSION["$key"] = round( $_SESSION["$key"], 0, PHP_ROUND_HALF_UP );
				
		if ($_SESSION["$key"] >= $posts_per_page){			
			$_SESSION["$key"] = 0;
		}

	}else{
		$_SESSION["$key"] = 0;	
	}
	
	global $wp_query;
	$temp = $wp_query;
	$wp_query = null;
	$args = array( 'post_type' => 'gidd_cycle', 'posts_per_page' => $posts_per_page, 'paged' => "", 'gidd_cycle_position' => $position, 'orderby' => $order, 'post_status' => 'publish' );
	$wp_query = new WP_Query( $args );
	
	if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) : $wp_query->the_post();
			
			//get expiry date
			$ex_date = get_post_meta( get_the_ID(), 'giddcycle_meta_expiry', true );			
			if ( $ex_date == "" ){
				
				//if user not fill in the expiry meta box, it shows all the times
				$content = strip_tags( get_the_content(), "<p><a><img><object><embed><param><iframe>" );
				
				//save advert into session
				$sn = isset( $_SESSION["$name"] ) ? count( $_SESSION["$name"] ) : 0;
				if ( $sn < $wp_query->post_count ){
					$_SESSION["$name"][] = $content;					
				}
				
			}else{
			
				$timestamp = strtotime( $ex_date );
				$today = strtotime( "today" );
				$expired = ($timestamp < $today) ? true : false;		

				if ( $expired ){
					
					$content = '<span class="cycle-expired"></span>';
					//save advert into session
					if ( count( $_SESSION["$name"] ) < $wp_query->post_count ){
						$_SESSION["$name"][] = $content;					
					}
					
				}else{
				
					$content = strip_tags( get_the_content(), "<p><a><img><object><embed><param><iframe>" );
					//save advert into session
					if ( count( $_SESSION["$name"] ) < $wp_query->post_count ){
						$_SESSION["$name"][] = $content;					
					}
				
				}			
			}
					
		endwhile;
	endif;
	
			
	$cycle = "";
	if ( $wp_query->found_posts > 0 ) :
	
		if ( $allposts == "all" )
			$cycle .= '<div class="giddcycle-wrap giddcycle-wrap-widget giddcycle-wrap-cycle giddcycle-widget-all" style="width: '. $rotator_width .'px; height: '. $rotator_height .'px;">';
		else
			$cycle .= '<div class="giddcycle-wrap giddcycle-wrap-widget giddcycle-wrap-cycle" style="width: '. $rotator_width .'px; height: '. $rotator_height .'px;">';
		
		$cycle .= '<div class="giddcycle-content" style="width: '. $rotator_width .'px; height: '. $rotator_height .'px;">';
		$cycle .= '<div class="giddcycle-box">';
		
		
		//display the advert by cycling the session data
		$loop_ind = 0;
		if ( isset( $_SESSION["$key"] ) ):
			for( $i = intval( $_SESSION["$key"] ); $i < $posts_per_page; $i++ ){
			
				if ( $loop_ind == 0 )
					$cycle .= '<div class="giddcycle-item giddcycle-first-item" style="width: '. $item_width .'px; height: '. $item_height .'px;">';
				else
					$cycle .= '<div class="giddcycle-item" style="width: '. $item_width .'px; height: '. $item_height .'px;">';
					
				$cycle .= isset ( $_SESSION["$name"][$i] ) ? $_SESSION["$name"][$i] : "";
				$cycle .= '</div>';		
				$loop_ind++;
			}
		endif;

		//reloop the session to display the adverts remained above
		$ind = $posts_per_page - $loop_ind;		
		if ( $loop_ind < $posts_per_page ){
			for( $lc = 0; $lc < $ind; $lc++){
				$cycle .= '<div class="giddcycle-item" style="width: '. $item_width .'px; height: '. $item_height .'px;">';
				$cycle .= $_SESSION["$name"][$lc];
				$cycle .= '</div>';
			}
		}
		
		$cycle .= '</div></div></div>';
		
	endif;
	
	$wp_query = null;
	$wp_query = $temp;
	wp_reset_query();
	
	//setup session data
	//add 0.5 because it adds 2 at a time
	$_SESSION["$key"] = isset( $_SESSION["$key"] ) ? ( $_SESSION["$key"] += 0.5 ) : 0;
		
	return $cycle;
}

/** end */