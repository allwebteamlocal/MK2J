<?php
/*** AUTOMATIC HOOK DETECTION ***/
$name = ___name();

/** GENERAL */

___add( 'before_admin_wrapper', $name );
___add( 'before_admin_container', $name );
___add( 'before_admin_page', $name );


___add( 'after_admin_page', $name );
___add( 'after_admin_container', $name );
___add( 'after_admin_wrapper', $name );


___add( 'before_admin_content', $name );
___add( 'admin_content', $name );
___add( 'after_admin_content', $name );


/** HEADER HOOKS */
___add( 'before_admin_header', $name );
___add( 'admin_header', $name );
___add( 'after_admin_header', $name );


/** FOOTER HOOKS */
___add( 'before_admin_footer', $name );
___add( 'admin_footer', $name );
___add( 'after_admin_footer', $name );


/** end */