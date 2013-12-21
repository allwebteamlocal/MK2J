<?php
/** This file is not part of the template heirarchy. 
*	You can access it directly from the URL. 
*	For example: http://localhost/gidd/register-users/
*/


	add_filter('layout_register_users', 'gidd_layout_register_users');
	function gidd_layout_register_users( $layout ){
		
		//use another layout rather than bootstrap
		//pf2cr is a 2-columns layout with col1 & col2 as the action hook names
		return 'pf2cr';
	}
	

/** end */