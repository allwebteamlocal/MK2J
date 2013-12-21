<?php

function ___conf( $key, $data = "" ){
	
	if ( $data != "" )
		___registry( $key, $data );
		
	return ___registry( $key );
}

//save a default theme object to registry
$conf = ___data();
$conf->fav = CHILDURL . 'fav.png';
$conf->analystic = "";
$conf->custom_background = true;
$conf->custom_header = true;

___conf( 'theme', $conf );


//customer header default
$conf = ___data();
$conf->default_text_color = '444';
$conf->default_image = '';
$conf->width = 960;
$conf->height = 120;
$conf->max_width = 2000;
$conf->flex_height = true;
$conf->flex_width = true;
$conf->random_default = false;

___conf( 'custom-header', $conf );


/** conf_default.php **/