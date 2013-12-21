<?php

$seo 	= ___subpage( 'Gidd SEO', ___registry( 'gidd_admin' ) );

gidd_include_file( dirname( __FILE__ ) . '/option/title.php' );
gidd_include_file( dirname( __FILE__ ) . '/option/description.php' );
gidd_include_file( dirname( __FILE__ ) . '/option/robots.php' );
gidd_include_file( dirname( __FILE__ ) . '/option/posttype.php' );
gidd_include_file( dirname( __FILE__ ) . '/meta_seo.php' );

//seo implementation
gidd_include_file( dirname( __FILE__ ) . '/seo.php' );


/** gidd_load.php */