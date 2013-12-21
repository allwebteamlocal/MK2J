<?php
class Gidd_Content_Loop extends Gidd_WP_Loop {
	protected function loop() {
		
		global $wp_query;
				
		$loop_counter = 0;
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		
		$args = $this->args;
		$args['paged'] = $this->paged;
		$wp_query->query( $args );
		
		if( $wp_query->have_posts() ){
		
			echo '<div class="postgroup postgroup-first '. $this->_class .'">';
		
			___do( "before_content_loop", ___name() );
			while ( $wp_query->have_posts() ) {
				global $post;
				$wp_query->the_post();
							
				$this->show_post_div( $loop_counter );						
				
				echo '<div class="before_loop_header">';
				echo $this->show_avatar();
				$this->show_thumbnail();
				___do( 'before_loop_header', ___name() );
				echo '</div>';
				$this->loop_header();
				echo '<div class="after_loop_header">';
				___do( 'after_loop_header', ___name() );
				echo '</div>';
				
				$this->loop_content();
				___do( 'before_loop_footer', ___name() );
				$this->loop_footer();
				___do( 'after_loop_footer', ___name() );
				
				echo '</div>'; //end of show_post_div
								
				
				$this->add_clear_div( $loop_counter );
				$loop_counter++;
				
				
				if ( is_int( $this->items_per_group ) ){
					$current_position = $wp_query->current_post + 1;
					if ( ( $current_position < $wp_query->found_posts ) && ( $current_position % $this->items_per_group == 0 ) ){
						echo '</div><div class="postgroup '. $this->_class .'">';
						$loop_counter = 0; //reset the loop counter for each group
					}
				}
			
			}
			
			___do( "after_content_loop", ___name() );	
			
			echo '</div>';
			
			if ( $this->paged != "" ){
				gidd_post_nav();
			}
		
		}
		
		$wp_query = null;
		$wp_query = $temp;
		
		/* RESET QUERY */
		wp_reset_query();	
		
	}
	
	public function loop_header() {
		if ( $this->content != "thumbs-only" ) {
			echo ( '<div class="postcontent">' );
			
			$header = $this->header;
			$lf = Gidd_WP_Loop_Format::get_instance();
			$lf->get( $header );
			
			$this->show_thumbnail( 'after-title' );
			$this->show_read_more( 'after-title' );
		}
	}
	
	public function loop_content() {
		if ( $this->content != "none" ){
			echo '<div class="postentry">';
			$this->loop_method( $this->content );
			$this->show_read_more();
			echo '</div>';
		}
	}
	
	public function loop_footer() {
		if ( $this->content != "thumbs-only" ) {
			$footer = $this->footer;
			$lf = Gidd_WP_Loop_Format::get_instance();
			$lf->get( $footer );
			echo ( '<div class="clearBoth"></div>' );
			echo ( '</div>' ); //end of postcontent
		}
	}
}

/** end */