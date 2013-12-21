<?php

//base WP template class with some built-in functionality
class Gidd_WP_Template extends Gidd_Data{

	private function html_head(){
		
		//Add filter to show html doctype
		echo gidd_doctype( $this->doctype, ___name() ); #filter.php
		
		if ( $this->doctype != "HTML5" ){
			language_attributes();		
			echo ">";
		}
		
		//Add head profile
		echo gidd_head_profile( $this->doctype ); #filter.php

		//Add filter to show html content type
		echo gidd_html_content_type( $this->doctype ); #filter.php

		//For responsive design
		if( ( $this->layout == "bootstrap12" ) || ( $this->layout == "bootstrap16" ) || ( $this->layout == "bootstrap24" ) ){
			echo '<meta name="viewport" content="width=device-width, initial-scale=1.0" />';
		}
		
	
		//Gidd SEO enable
		$addon = get_option( 'g5e1a928b' );
		if ( isset( $addon['g952d9bb5'] ) && ( $addon['g952d9bb5'] != "" ) ){

			echo '<title>';
				
			$title = "";
			$default_title = "";
			
			echo ___apply( 'gidd_html_title', $title, ___name() ); #seo.ext
			
			if( !has_filter('gidd_html_title_' . ___name() ) )
				echo apply_filters( 'gidd_html_title_default', $default_title );
			
			echo '</title>';
			
			
			//Add filter to show meta description
			$description = "";
			$default_description = "";
			
			echo ___apply( 'gidd_html_description', $description, ___name() ); #seo.ext
			
			if( !has_filter('gidd_html_description_' . ___name() ) )
				echo apply_filters( 'gidd_html_description_default', $default_description );
			
			//Add filter to show robot settings
			$robot = "";
			$default_robot = "";
			
			echo ___apply( 'gidd_html_robot', $robot, ___name() ); #seo.ext

			if( !has_filter('gidd_html_robot_' . ___name() ) )
				echo apply_filters( 'gidd_html_robot_default', $default_robot );
				
		}else{
		
			//not use gidd SEO
			echo '<title>';
			wp_title( '|', true, 'right' );
			echo '</title>';

		}

		
		//Add filter to show favicon
		echo gidd_fav_icon(); #filter.php
		
		//add link to layout stylesheet
		gidd_add_layout_style( $this->layout, $this->path, $this->measure );
				
		//Add filter for canonical url
		echo gidd_canonical_url(); #filter.php
				
		//Add pingback url
		echo gidd_show_pingback_url(); #filter.php
				
		//Enable comment threading
		gidd_show_comment_reply(); #filter.php
		
		___bootstrap( $this->layout ); #gidd_wp_helper.php
		___style( $this->layout );
		
		//automatically include css & javascript files with proper naming
		___script();
		
		___do( 'parent_head', ___name() );		
		___do( 'head', ___name() );
		
		wp_print_scripts();
		wp_head();
		echo '</head>';		
	}
	
	private function close_html(){
		
		___do( 'before_wp_footer',  ___name() );
		wp_footer();
		___do( 'after_wp_footer', ___name() );
				
		echo '</body></html>';
	}
	
	//can be overridden by child class
	private function html_body(){
				
		echo ( "<body " ); body_class( array('custom', ___name() ) ); echo ( ">" );
		___do( 'before_wrapper', ___name() );		
		echo '<div class="gidd-wrapper">';
		___do( 'before_container', ___name() );				
		echo '<div class="gidd-container">';
		___do( 'before_page', ___name() );
				
		$layout = ( $this->layout == "" ) ? "bootstrap16" : $this->layout;
				
		if ( ( $layout == "bootstrap12" ) || ( $layout == "bootstrap16" ) || ( $layout == "bootstrap24" ) ){
			echo '<div class="gidd-page container container-full">';
		}else{
			echo '<div class="gidd-page">';
		}
		
		$data = ___data();
		$data->measure = $this->measure;
		$data->layout = $layout;
		
		if ( ( $layout == "bootstrap12" ) || ( $layout == "bootstrap16" ) || ( $layout == "bootstrap24" ) ){
			$layout = "bootstrap";
		}			
		___render( ___object('WP_Layout', ___object( "$layout" ) ), $data );
				
		echo '</div>';
		___do( 'after_page', ___name() );				
		echo '</div>';
		___do( 'after_container', ___name() );			
		echo '</div>';
		___do( 'after_wrapper', ___name() );		
		
	}
	
	protected function html(){	
		$this->html_head();
		$this->html_body();
		$this->close_html();	
	}
	
	
	protected function wp_template(){
	
		//include action hook files
		//run when wp_template is returned
		$wptp = ___registry( "GIDDWPTP" );
		if ( $wptp ):
		
			$childtp = gidd_include_file( CHILDTP . 'default/default.php' );
			if ( !$childtp )
				gidd_include_file( DEFAULTPATH . 'default.php' );
			
			$tp = gidd_include_file( CHILDTP . ___name() . '/' . ___name() . '.php' );
			if ( $tp ){				
				#gidd_lib/gidd_auto_column.php
				gidd_auto_column( ___name(), CHILDTP . ___name(), CHILDTPURL . ___name(), 'gidd_template' );
			}else{
				//get app paths
				$app = ___registry( '___app' );	
				if ( is_array( $app ) ):
					foreach ( $app as $app_url => $app_path ){
						$default_app = gidd_include_file( $app_path . 'default/default.php' );					
						if( !$default_app )
							gidd_include_file( DEFAULTPATH . 'default.php' );
						
						
						gidd_include_file( $app_path . ___name() . '/' . ___name() . '.php' );
						gidd_auto_column( ___name(), $app_path . ___name(), $app_url . ___name(), 'gidd_application', $app_path );
					}
				endif;
			}
			
		endif;	
			
				
		//clear wp template flag
		___clear( "GIDDWPTP" );
			
	}
	
	//get the whole wp page
	function render( $data ){
	
		$this->set_data( $data );		
	
		//set name
		___name( $this->name );
		
		//run when wp_template is reutrned from gidd_dynamic_page
		$this->wp_template();
				
		//load auto hooks
		gidd_include_file( GIDDCORE . 'wp_template/gidd_auto_hooks.php' );
		
		//layout style hook
		___do( 'layout_style', ___name() );
				
		$this->html();  //this generates the body content

	}
}

/** end */