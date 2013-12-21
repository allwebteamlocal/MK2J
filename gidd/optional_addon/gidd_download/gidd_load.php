<?php
add_shortcode('GDL', 'gidd_download_tag_func');
function gidd_download_tag_func( $atts ) {
	
	//attribute
	extract(shortcode_atts(array(
		'file' => '',
		'directory' => 'gidd-download',
		'text' => 'Download',
		'width' => '',
		'height' => '',
		'padding' => '',
		'margin' => '',
		'background' => '',
		'display' => ''
	), $atts));
	
	$upload_dir = wp_upload_dir();
	$baseurl = trailingslashit( $upload_dir['baseurl'] );
	$download = $baseurl . $directory . '/' . $file;
	
	$width 		= ( $width != "" ) 		? "width: $width; "  			 : "";
	$height 	= ( $height != "" ) 	? "height: $height; " 			 : "";
	$padding 	= ( $padding != "" ) 	? "padding: $padding; " 		 : "";
	$margin 	= ( $margin != "" ) 	? "margin: $margin; "			 : "";
	$background = ( $background != "" ) ? "background: $background; " 	 : "";
	$display 	= ( $display != "" ) 	? "display: $display; " 	 	 : "";
	
	$a = '<a style="'. $display . $width . $height . $padding . $margin . $background .'" class="gidd_download_link" href="'. $download .'">'. $text .'</a>';
	return $a;

}


/** end */