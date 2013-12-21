<?php
/*** AUTOMATIC HOOK DETECTION ***/
$name = ___name();

/** GENERAL */

___add( 'layout_sytle', $name );
___add( 'init', $name );
___add( 'parent_head', $name );
___add( 'head', $name );


___add( 'before_wrapper', $name );
___add( 'before_container', $name );
___add( 'before_page', $name );


___add( 'after_page', $name );
___add( 'after_container', $name );
___add( 'after_wrapper', $name );


___add( 'before_content', $name );
___add( 'before_colmask', $name );
___add( 'before_cols', $name );


___add( 'after_cols', $name );
___add( 'after_content', $name );

___add( 'content', $name );


/** HEADER HOOKS */
___add( 'before_header', $name );
___add( 'header', $name );
___add( 'after_header', $name );


/** FOOTER HOOKS */
___add( 'before_footer', $name );
___add( 'footer', $name );
___add( 'after_footer', $name );


/** COL1 HOOKS */
___add( 'before_col1', $name );
___add( 'col1', $name );
___add( 'after_col1', $name );


/** COL2 HOOKS */
___add( 'before_col2', $name );
___add( 'col2', $name );
___add( 'after_col2', $name );


/** COL3 HOOKS */
___add( 'before_col3', $name );
___add( 'col3', $name );
___add( 'after_col3', $name );

/* End of gidd_auto_hooks.php */