<?php
class Gidd_Singular_Loop extends Gidd_WP_Loop {

	protected function loop() {
		if ( is_singular() ) {
			while ( have_posts() ) {
				the_post();
				
				//HOOK BEFORE POST	
				___do( "before_post", ___name() );
				
				echo ( '<div ' ); post_class(); echo ( '>' );
				
				//HOOK BEFORE POST CONTENT
				echo '<div class="before_post_content">';
				$this->show_avatar();				
				$this->show_thumbnail();
				___do( "before_post_content", ___name() );
				echo '</div>';
				
				echo ( '<div class="postcontent">' );
				
				//HOOK BEFORE LOOP TITLE
				___do( "before_loop_title", ___name() );
				
				$header = $this->header;
				$lf = Gidd_WP_Loop_Format::get_instance();
				$lf->get( $header );
				
				$this->show_thumbnail( 'after-title' );
				
				//HOOK AFTER LOOP TITLE
				echo '<div class="after_loop_title">';
				___do( "after_loop_title", ___name() );
				echo '</div>';
				
				echo ( '<div class="postentry">' );			
				the_content();			
				
				echo ('<div class="clearBoth"></div>');
				wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'gidd' ), 'after' => '</div>', 'pagelink' => 'Page %' ) );						
				echo ('<div class="clearBoth"></div>');						
				echo ( '</div>' ); //end of postcontent
				
				//HOOK BEFORE LOOP FOOTER
				___do( "before_loop_footer", ___name() );
				
				$footer = $this->footer;
				$lf->get( $footer );
					
				
				//HOOK AFTER LOOP FOOTER
				___do( "after_loop_footer", ___name() );
				
				echo ( '<div class="clearBoth"></div>' );
				
				//HOOK AFTER POST CONTENT			
				___do( "after_post_content", ___name() );			
				
				echo ( '</div></div>' );
				
				//HOOK AFTER POST
				___do( "after_post", ___name() );
			}
		}		
	}

	
}

/** end */