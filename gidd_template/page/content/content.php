<?php

$id = get_the_ID();

if ( $id == 10){

	echo '<h2>';
	echo get_the_title( $id );
	echo '</h2>';
}


$url = gidd_current_url();
$last = get_last_segment( $url );

if( $last == "produits"){

	echo 'volla!!!!!!!!!!!!!!!!!!!!';

}




/** **/