<?php

//allow users to hook and put their own templates
$action = '___html_' . ___name();
if ( function_exists( $action ) ){
	do_action( $action );
}else{
	if ( function_exists( '___html_default' ) ):
		do_action( '___html_default' );
	else:
		___gidd( ___name() );
	endif;

}
	
/** end */