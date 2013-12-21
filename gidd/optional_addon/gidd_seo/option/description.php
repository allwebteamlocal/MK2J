<?php
$description	= ___subpage( 'Site Description' );

//field
$home_desc			= ___textarea( 'Home Description', 'Put your description about the homepage here.' );
$general_desc		= ___textarea( 'General Description', 'Put a general descrition about the website.' );


//array of fields
$arr_description	= array(
						$home_desc, 
						$general_desc
					);
										
___section( array ( 'Gidd SEO', 'g952d9bb5' ), $description, $arr_description, "<b>Description settings for search engines.</b>" );
unset( $arr_description );


/** end **/