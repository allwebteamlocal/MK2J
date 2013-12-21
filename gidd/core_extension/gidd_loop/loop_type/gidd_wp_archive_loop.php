<?php
class Gidd_Archive_Loop extends Gidd_WP_Loop {
	protected function loop() {		
		
		$loop_counter = 0;
		while ( have_posts() ) {
			the_post();
			global $post;
			
			//HOOK BEFORE POST	
			___do( "before_archive_post", ___name() );
			
			$this->show_post_div( $loop_counter );
			echo '<div class="before_loop_header">';
			$this->show_thumbnail();
			___do( 'before_loop_header', ___name() );
			echo '</div>';
			
			echo ( '<div class="postcontent">' );
			
			//SHOW HEADER
			$header = $this->header;
			$lf = Gidd_WP_Loop_Format::get_instance();
			$lf->get( $header );
			
			echo '<div class="after_loop_header">';
			$this->show_thumbnail( 'after_title' );
			___do( 'afer_loop_header', ___name() );
			echo '</div>';
			
			echo ( '<div class="postentry">' );			
			
			$this->loop_method( $this->content );
			
			$footer = $this->footer;
			$lf->get( $footer );
			$this->show_read_more();
			echo ('<div class="clearBoth"></div>');
			echo ( '</div></div>' );
			___do( 'archive_loop_after_footer', ___name() );
			echo '</div>';
			
			//HOOK AFTER POST
			___do( "after_archive_post", ___name() );
			
			$this->add_clear_div( $loop_counter );
			$loop_counter++;
		}
				
		/* RESET QUERY */
		wp_reset_query();
		
	}
}

/** end */