<?php

$addon	= ___subpage( 'Addon' );

//field
$seo		= ___checkbox( 'Gidd SEO', 'Enable Gidd SEO.' );
$config		= ___checkbox( 'Gidd WP Config', 'Enable Gidd WP Config.' );
$download	= ___checkbox( 'Gidd Download', 'Simple download link plugin using shortcode [GDL]' );

//array of fields
$arr_addon	= array( $seo, $config, $download );

___section( array ( 'Gidd Admin', 'g7b193a12' ), $addon, $arr_addon, "<b>Activate/deactivate optional addons.</b>" );
unset( $arr_addon );


/** end */