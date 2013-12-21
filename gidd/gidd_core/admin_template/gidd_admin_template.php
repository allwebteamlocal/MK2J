<?php

//base admin template class with some built-in functionality
class Gidd_Admin_Template extends Gidd_Data{

	private function html_head(){
				
		echo gidd_doctype( $this->doctype, ___name() ); #filter.php
		
		if ( $this->doctype != "HTML5" ){
			language_attributes();		
			echo ">";
		}
					
		//Add head profile
		echo gidd_head_profile( $this->doctype ); #filter.php
		
		//Add filter to show html content type
		echo gidd_html_content_type( $this->doctype ); #filter.php
		
		$option = get_option('g4e7afebc');  #gidd_wp_helper.php		
		if ( isset( $option['g89ec4ec2'] ) && ( $option['g89ec4ec2'] != "" ) ){
			echo '<meta name="viewport" content="width=device-width, initial-scale=1.0" />';
		}
		
		
		$addon = get_option( 'g5e1a928b' );
		//use gidd SEO
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
			
		
		}else{			
			//not use gidd SEO
			echo '<title>';
			wp_title( '|', true, 'right' );
			echo '</title>';		
		}		
		
		
		//Add filter to show robot settings
		$robot = '';		
		$option = get_option('gbe46f2ff');
		if ( isset( $option['gca12316d'] ) && ( $option['gca12316d'] != "" ) )
			$robot = '<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />';

		echo ___apply( 'gidd_admin_layout_robot', $robot, ___name() );
				
		//Add filter to show favicon
		echo gidd_fav_icon(); #filter.php
				
		//Add filter for canonical url
		echo gidd_canonical_url(); #filter.php
				
		//Add custom script & style		
		$jquery = '<script src="'. site_url('/wp-includes/js/jquery/jquery.js') .'" type="text/javascript"></script>';
		$bpopup = '<script src="'. GIDDURL . 'gidd_master/js/jquery.bpopup.min.js' .'" type="text/javascript"></script>';
		
		echo apply_filters( 'gidd_admin_jquery', $jquery );
		echo apply_filters( 'gidd_admin_bpopup', $bpopup );
	
		//Add scripts from admin options
		$option = get_option('g4e7afebc');  #gidd_wp_helper.php
		$bootstrap = isset( $option['g89ec4ec2'] ) ? $option['g89ec4ec2'] : "";
		$fontawesome = isset( $option['g6ac73f09'] ) ? $option['g6ac73f09'] : "";
		$genericons = isset( $option['gdd0948ef'] ) ? $option['gdd0948ef'] : "";

		___admin_bootstrap( $bootstrap );		
		___fontawesome( $fontawesome, "admin" );
		___genericons( $genericons, "admin" );
		
		
		//admin default
		$defaultcss = ADMINDEFAULTURL .'default.css';
		$defaultjs = ADMINDEFAULTURL .'default.js';
		
		if ( file_exists( $defaultcss ) )
			echo '<link href="'. $defaultcss .'" rel="stylesheet" media="screen, projection" />';
		
		if ( file_exists( $defaultjs ) )
			echo '<script src="'. $defaultjs .'" type="text/javascript"></script>'; 
		
		//automatically include css & javascript files with proper naming
		___script( "admin" );
						
		___do( 'before_admin_head', ___name() );
		do_action( 'gidd_admin_head' );
		echo '</head>';
	}
	
	private function close_html(){
		
		___do( 'before_admin_footer', ___name() );
		do_action( 'gidd_admin_footer' );
		___do( 'after_admin_footer', ___name() );
		echo '</body></html>';
	}
	
	//can be overridden by child class
	private function html_body(){

		$page_class = "gidd-admin-page";
		$option = get_option('g4e7afebc');  #gidd_wp_helper.php
		
		if ( isset( $option['g89ec4ec2'] ) && ( $option['g89ec4ec2'] != "" ) ){
			$page_class .= " container";
		}
			
		echo ( "<body " ); body_class( array('custom gidd-admin', 'admin-' . ___name() ) ); echo ( ">" );
		___do( 'before_admin_wrapper', ___name() );		
		echo '<div class="gidd-admin-wrapper">';
		___do( 'before_admin_container', ___name() );				
		echo '<div class="gidd-admin-container">';
		
		___do( 'before_admin_page', ___name() );
		echo '<div class="' . $page_class . '">';
		
		$data = ___data();
		$data->layout = $this->layout;
		___render( ___object('WP_Layout', ___object( "Admin" ) ), $data );			
		
		echo '</div>';
		
		___do( 'after_admin_page', ___name() );				
		echo '</div>';
		___do( 'after_admin_container', ___name() );			
		echo '</div>';
		___do( 'after_admin_wrapper', ___name() );		
		
	}
	
	
	protected function admin_template(){
	
		$base = parse_url( gidd_current_url(), PHP_URL_PATH );
		$base = str_replace( "-", "_", $base );
		$path = trailingslashit( str_replace ( DIRPATH, "", $base ) );
		
		$tp = gidd_include_file( CHILDTP . $path . ___name() . '.php' );
		if ( $tp ){			
			#gidd_lib/gidd_auto_column.php
			gidd_admin_auto_column( ___name(), CHILDTP . $path, CHILDTPURL . $path, 'gidd_template' );
		}else{
			
			//get app paths
			$app = ___registry( '___app' );
			if ( is_array( $app ) ):
				foreach ( $app as $app_url => $app_path ){
					$default_app = gidd_include_file( $app_path . 'default/default.php' );					
					if( !$default_app )
						gidd_include_file( ADMINDEFAULTPATH . 'default.php' );
										
					gidd_include_file( $app_path . $path . ___name() . '.php' );
					gidd_admin_auto_column( ___name(), $app_path . $path, $app_url . $path, 'gidd_application', $app_path, $app_url );
					
				}
			endif;
						
		}

	}
	
	protected function html(){	
		$this->html_head();
		$this->html_body();
		$this->close_html();	
	}
	
	
	//get the whole wp page
	function render( $data ){
	
		$this->set_data( $data );		
	
		//set name
		___name( $this->name );
		
		//auto hook admin column
		$this->admin_template();
						
		//load auto hooks
		gidd_include_file( GIDDCORE . 'admin_template/gidd_admin_auto_hooks.php' );
		
		$this->html();  //this generates the body content

	}
}

/** end */