<?php

$theme	= ___subpage( 'Theme' );

//field
$arr_layout			= array('Bootstrap 12 Grid Columns', 'Bootstrap 16 Grid Columns', 'Bootstrap 24 Grid Columns', 'PF-2CR', 'PF-2CL', 'COL1F', 'COL2R', 'COL2L', 'COL3H', 'COL3B');
$layout				= ___select( 'Default layout', $arr_layout, 'Select a default layout for the theme.' );
$fontawesome		= ___checkbox( 'Font awesome', 'Load font awesome.' );
$genericons			= ___checkbox( 'Genericons', 'Load genericons.' );
$editor				= ___checkbox( 'Editor Style', 'Disable gidd editor style.' );

//array of fields
$arr_theme	= array( $layout, $fontawesome, $genericons, $editor );

___section( array ( 'Gidd Admin', 'g7b193a12' ), $theme, $arr_theme, "<b>Configure theme options.</b>" );
unset( $arr_theme );

/** end */