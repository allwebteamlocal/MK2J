<?php
add_action( '___head_g952d9bb5', '___head_g952d9bb5' );
function ___head_g952d9bb5(){
?>
	<style type="text/css">
		#g952d9bb5 .count, #g952d9bb5 .count-title{
			font-size: 16px;
			color: #2c79ec;
			margin-bottom: 10px;
			float: left;
		}
		
		#g952d9bb5 .count-label{ float: left; padding-right: 20px;}
		#g952d9bb5 .count-box{ padding-top: 10px; }
		#g952d9bb5 .count-desc{ color: #777; font-size: 10px; padding-left: 20px; }
		#g952d9bb5 .line{ border-bottom: 1px solid #ccc; height: 10px;  }
	</style>

<?php

	wp_enqueue_script( 'gidd-seo', GIDDURL . 'optional_addon/gidd_seo/gidd_seo.js', array('jquery'), '1.0.0', true );

}


//support for custom post type
add_action('init', 'gidd_create_seo_metabox');
function gidd_create_seo_metabox(){

	//metabox location
	$mb_loc = array( 'post', 'page' );

	$type_options = get_option( 'g1341a626' );
	if ( isset( $type_options ) && is_array( $type_options ) ){
		foreach( $type_options as $type => $checked ){
			
			//gidd_post_type
			$post_types = gidd_get_posttype();
			if ( isset( $post_types ) && is_array( $post_types ) ):
				foreach( $post_types as $pt ){

					if ( ___id( $pt ) == $type ){								
						$mb_loc[] = $pt;				
					}
					
				}
			endif;
		}
	}
	
	//create metabox
	$mb_loc = apply_filters( 'gidd_seo_metabox', $mb_loc );
	___metabox('gidd_seo', 'Gidd SEO', 'gidd_seo_metabox', $mb_loc );
	
}

function gidd_seo_metabox( $mb ){

	$title 		= ___text( 'SEO Title', 'Use this title for SEO if the default title is not suitable.' );
	$desc 		= ___textarea( 'Description', 'Use this description for SEO if needed' );
	$keyword	= ___text( 'Keywords', 'list of keywords (comma seperated)' );
	
	$arr_robot	= array('index,follow', 'index,nofollow', 'noindex,follow', 'noindex,nofollow'); 
	$robot		= ___select( 'Robot', $arr_robot, 'Select a robot setting for this post or page.' );
	
	
	echo '<div class="single-field">';
	echo ___field( $title, $mb );
	echo '</div>';
	
	echo '<div class="count-box">';
	echo '<div class="count-label">Characters:</div>';
	echo '<div class="count-title">0</div><span class="count-desc">Recommended max of 65 characters.</span>';
	echo '</div>';
	echo '<div class="clear"></div>';
	
	echo '<div class="line"></div>';
	echo ___space(15);
	
	echo '<div class="single-field">';
	echo ___field( $desc, $mb );
	echo '</div>';
	
	echo '<div class="count-box">';
	echo '<div class="count-label">Characters:</div>';
	echo '<div class="count">0</div><span class="count-desc">Recommended max of 160 characters.</span>';
	echo '</div>';
	echo '<div class="clear"></div>';
	
	echo '<div class="line"></div>';
	echo ___space(15);
	
	echo '<div class="single-field">';
	echo ___field( $keyword, $mb );
	echo '</div>';
	echo '<div class="clear"></div>';
	
	echo '<div class="line"></div>';
	echo ___space(15);
		
	echo '<div class="single-field">';
	echo ___field( $robot, $mb );
	echo '</div>';
	echo '<div class="clear"></div>';
	
	echo ___space(10);
	

}


/** end **/