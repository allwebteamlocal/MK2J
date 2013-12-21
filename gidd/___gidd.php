<?php

function gidd_measure( $layout, $measure ){

	$measure = strtolower( $measure );

	switch ( $layout ){
	
		case 'col2l'	:	
								if ( $measure == "em" )
									return EM2CL;
								elseif ( $measure == "percent" )
									return PERCENT2CL;
								else
									return PX2CL;
								
								break;
								
								
		case 'col1f'	:	
								if ( $measure == "em" )
									return EM1CF;
								elseif ( $measure == "percent" )
									return PERCENT1CF;
								else
									return PX1CF;
								
								break;
								
		
		case 'col3h'	:	
								if ( $measure == "em" )
									return EM3CH;
								elseif ( $measure == "percent" )
									return PERCENT3CH;
								else
									return PX3CH;
								
								break;
								
								
		case 'col3b'	:	
								if ( $measure == "em" )
									return EM3CB;
								elseif ( $measure == "percent" )
									return PERCENT3CB;
								else
									return PX3CB;
								
								break;
								
								
		case 'pf2cl'	:		
								return PF2CL;
								break;
		
		case 'pf2cr'	:		
								return PF2CR;
								break;
								
		case 'bootstrap12':									
		case 'bootstrap16':	
		case 'bootstrap24':
		case 'admin':			break;
												
		default			:	
								if ( $measure == "em" )
									return EM2CR;
								elseif ( $measure == "percent" )
									return PERCENT2CR;
								else
									return PX2CR;		
									
								break;
								
	}

}

function ___gidd( $name, $layout = "bootstrap16", $measure = "pixel", $jquery = "wp" ){

	$data = ___data();
	$data->name = $name;
	
	//get layout option from admin
	$option = get_option( 'ga797e309' );
	$layout = isset( $option['g5769718b'] ) ? $option['g5769718b'] : "";
			
	switch ( $layout ){
		case "0"	: $layout = "bootstrap12"; break;
		case "1"	: $layout = "bootstrap16"; break;
		case "2"	: $layout = "bootstrap24"; break;
		case "3"	: $layout = "pf2cr"; break;
		case "4"	: $layout = "pf2cl"; break;
		case "5"	: $layout = "col1f"; break;
		case "6"	: $layout = "col2r"; break;
		case "7"	: $layout = "col2l"; break;
		case "8"	: $layout = "col3h"; break;
		case "9"	: $layout = "col3b"; break;
		default		: $layout = "bootstrap16"; break;
	}
	
	//allow theme to change the layout
	$layout  = apply_filters( 'default_layout', $layout );
	$measure = apply_filters( 'default_measure', $measure );
	
	$layout  = ___apply( 'layout', $layout, $name );
	$measure = ___apply( 'measure', $measure, $name );
		
	$data->layout = strtolower( "$layout" );
	$data->path = gidd_measure( strtolower( $layout ), $measure );
	$data->jquery = "$jquery";
	$data->measure = $measure;
	
	if( ( $data->layout == "bootstrap12" ) || ( $data->layout == "bootstrap16" ) || ( $data->layout == "bootstrap24" ) ){
		$data->doctype = "HTML5";
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	}	
	
	if( $data->layout == "admin" ){
	
		//Add filter to show html doctype
		$option = get_option('g4e7afebc');  #gidd_wp_helper.php
		$bootstrap = isset( $option['g89ec4ec2'] ) ? $option['g89ec4ec2'] : "";
		
		if ( $bootstrap != "" ){
			$data->doctype = "HTML5";
			add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
		}
	
		___admin( $data ); //render the template
	
	}else{
		___html( $data ); //render the template
	}
	
}


/** end */