<?php
Class Gidd_Bootstrap{
	public function gidd_content( $gl ) {
	
		___do( 'before_header', ___name() );
		___do( 'header', ___name() );
		___do( 'after_header', ___name() );
		
		___do( 'before_content', ___name() );
		___do( 'content', ___name() );
		___do( 'after_content', ___name() );
		
		___do( 'before_footer', ___name() );
		___do( 'footer', ___name() );
		___do( 'after_footer', ___name() );
		
	}
}

/* gidd_bootstrap.php */