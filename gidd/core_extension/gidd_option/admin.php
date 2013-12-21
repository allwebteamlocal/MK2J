<?php

$admin	= ___subpage( 'Admin' );

//field
$arrgrid 			= array('12' => '12 Grid Columns', '16' => '16 Grid Columns', '24' => '24 Grid Columns');
$bootstrap			= ___select( 'Bootstrap', $arrgrid, 'Add Bootstrap into gidd admin template.' );
$fontawesome		= ___checkbox( 'Font awesome', 'Load font awesome.' );
$genericons			= ___checkbox( 'Genericons', 'Load genericons.' );


//array of fields
$arr_admin	= array( $bootstrap, $fontawesome, $genericons );

___section( array ( 'Gidd Admin', 'g7b193a12' ), $admin, $arr_admin, "<b>Configure admin theme options.</b>" );
unset( $arr_admin );

/** end */