<?php

class Gidd_Term_Widget extends WP_Widget{

	function __construct(){
		parent::__construct( 'gidd_term_widget', 'Show Terms', array( 'description' => __( 'Show terms by specifying its name.', 'gidd_term' ) ) );
	}	
	
	function widget( $args, $instance ){
	
		extract( $args );
		echo $before_widget;		
				
		$title = apply_filters( 'widget_title', $instance['gt_title'] );
		if ( preg_match( '/^image:/', $title, $match ) ){
			$url = explode( $match[0], $title );
			$img = '<img src="'. $url[1] .'" alt="" />';
			echo $before_title . htmlspecialchars_decode( apply_filters( 'widget_title', $img ) ) . $after_title;
		}else{
			if ( ! empty( $title ) )
				echo $before_title . $title . $after_title;				
		}
		
		$term = $instance['gt_term'];
		echo '<ul class="term-list term-'. $term .'">';
		echo ___list_terms( $term );
		echo '</ul>';
		
		echo $after_widget;
	}
	
	
	function update( $new_instance, $old_instance ){
	
		$instance = array();
		$instance['gt_title'] = strip_tags( $new_instance['gt_title'] );
		$instance['gt_term'] = strip_tags( $new_instance['gt_term'] );
			
		return $instance;
	}
	
	
	function form( $instance ){
		
		$title 			= ( isset( $instance[ 'gt_title' ] ) ) ? $instance[ 'gt_title' ] : "Category";
		$term 			= ( isset( $instance[ 'gt_term' ] ) ) ? $instance[ 'gt_term' ] : "category";
		
	?>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'gt_title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'gt_title' ); ?>" name="<?php echo $this->get_field_name( 'gt_title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'gt_term' ); ?>"><?php _e( 'Terms:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'gt_term' ); ?>" name="<?php echo $this->get_field_name( 'gt_term' ); ?>" type="text" value="<?php echo esc_attr( $term ); ?>" />			
		</p>
		
		<?php	
	}


}

/** end */