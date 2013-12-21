<?php

//$wpc is array ( 'Gidd WP Config', 'g0776eb65' )
$wpc = ___subpage( 'Gidd WP Config', ___registry( 'gidd_admin' ) );

if( is_wp_version_le('3.8') ){
	gidd_include_file( dirname( __FILE__ ) . '/admin_options/dashboard.php' );
	gidd_include_file( dirname( __FILE__ ) . '/action/dashboard.php' );
}

gidd_include_file( dirname( __FILE__ ) . '/admin_options/left_menu.php' );
gidd_include_file( dirname( __FILE__ ) . '/action/left_menu.php' );

gidd_include_file( dirname( __FILE__ ) . '/admin_options/adminbar.php' );
gidd_include_file( dirname( __FILE__ ) . '/action/adminbar.php' );


gidd_include_file( dirname( __FILE__ ) . '/admin_options/widget.php' );
gidd_include_file( dirname( __FILE__ ) . '/action/widgets.php' );

gidd_include_file( dirname( __FILE__ ) . '/admin_options/update.php' );
gidd_include_file( dirname( __FILE__ ) . '/action/update.php' );


/** end */