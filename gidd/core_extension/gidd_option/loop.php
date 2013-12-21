<?php

$loop	= ___subpage( 'Loop' );

//field
$excerpt_length			= ___text( 'Excerpt length', 'Set length for the excerpt. Default is 55.' );
$excerpt_more			= ___text( 'Excerpt More Text', '' );
$match_pattern			= ___text( 'Content Limit Match Pattern', 'Change the default content limit algorithm to your custom match pattern by using preg_match_all. Leave it empty to use the default. Suggested Pattern: /(.*)(?=<!--\\s?limit\\s?-->)/is' );


//array of fields
$arr_loop	= array( $excerpt_length, $excerpt_more, $match_pattern );

___section( array ( 'Gidd Admin', 'g7b193a12' ), $loop, $arr_loop, "<b>Configure loop options.</b>" );
unset( $arr_loop );




/** end */