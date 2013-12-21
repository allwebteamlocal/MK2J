<?php
//strategy 3
class Word_Limit_DB{

	public function get_content( $wl ){
		$option = get_option( "gdc7f77b4" );
		$pattern =  stripslashes ( htmlspecialchars( $option['ga611e19e'] ) );		
		$output = htmlspecialchars( $wl->content );
		$content = "";
		
		if ( is_string ( $pattern ) && ! empty( $pattern ) ){
			preg_match_all ($pattern, $output, $matches );
			$content = implode ( ' ', $matches[0] );						
		}
				
		return $wl->balance_tags( htmlspecialchars_decode($content) );
	}
}

/** end */