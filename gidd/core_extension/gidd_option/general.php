<?php

$general	= ___subpage( 'General' );

//field
$fav			= ___text( 'Custom fav icon', 'Full url to custom fav icon' );
$home_link		= ___checkbox( 'Home link', 'Show home link in primary menu.' );
$remove_footer	= ___checkbox( 'Remove footer', 'Remove WordPress admin footer.' );

//array of fields
$arr_general	= array( $home_link, $remove_footer, $fav );

___section( array ( 'Gidd Admin', 'g7b193a12' ), $general, $arr_general, "<b>General settings for Gidd themes.</b>" );
unset( $arr_general );








/** end */