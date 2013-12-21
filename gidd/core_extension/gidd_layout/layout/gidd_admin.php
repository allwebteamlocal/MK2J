<?php
Class Gidd_Admin{
	public function gidd_content( $gl ) {
	
		___do( 'before_admin_header', ___name() );
		___do( 'admin_header', ___name() );
		___do( 'after_admin_header', ___name() );
		
		___do( 'before_admin_content', ___name() );
		___do( 'admin_content', ___name() );
		___do( 'after_admin_content', ___name() );
		
		___do( 'before_admin_footer', ___name() );
		___do( 'admin_footer', ___name() );
		___do( 'after_admin_footer', ___name() );
		
	}
}

/* gidd_admin.php */