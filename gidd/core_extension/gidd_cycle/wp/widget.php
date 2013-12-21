<?php
class Gidd_Cycle_Widget extends WP_Widget{

	function __construct(){
		parent::__construct( 'gidd_cycle_widget', 'Gidd Cycle', array( 'description' => __('Cycle your items every time you refresh the page.', 'gidd_cycle') ) );
	}	
	
	function widget( $args, $instance ){
	
		extract( $args );
		
		echo $before_widget;		
		
		
		$title = apply_filters( 'widget_title', $instance['gdcycle_title'] );
		if ( preg_match( '/^image:/', $title, $match ) ){
			$url = explode( $match[0], $title );
			$img = '<img src="'. $url[1] .'" alt="" />';
			echo $before_title . htmlspecialchars_decode( apply_filters( 'widget_title', $img ) ) . $after_title;
		}else{
			if ( ! empty( $title ) )
				echo $before_title . $title . $after_title;				
		}
		
		
		//term slug instead of term_id
		$position = $instance['gdcycle_position'];
		$term = get_term( $position, 'cycle_position' );
				
		//set args
		$args['cycle-position'] = $term->slug;
		$args['order'] = $instance['gdcycle_rand'];
		$args['name'] = $instance['gdcycle_name'];
		$args['key'] = $instance['gdcycle_key'];
		$args['showall'] = $instance['gdcycle_all'];
		$args['item-width'] = $instance['gdcycle_item_width'];
		$args['item-height'] = $instance['gdcycle_item_height'];
		$args['rotator-width'] = $instance['gdcycle_cycle_width'];
		$args['rotator-height'] = $instance['gdcycle_cycle_height'];	
		
		//show the rotator
		echo gidd_cycle_content( $args );
						
		echo $after_widget;
	
	}
	
	
	function update( $new_instance, $old_instance ){
	
		$instance = array();
		$instance['gdcycle_position'] = strip_tags( $new_instance['gdcycle_position'] );
		$instance['gdcycle_name'] = strip_tags( $new_instance['gdcycle_name'] );
		$instance['gdcycle_key'] = strip_tags( $new_instance['gdcycle_key'] );
		$instance['gdcycle_rand'] = strip_tags( $new_instance['gdcycle_rand'] );
		$instance['gdcycle_all'] = strip_tags( $new_instance['gdcycle_all'] );
		$instance['gdcycle_title'] = strip_tags( $new_instance['gdcycle_title'] );
		$instance['gdcycle_item_width'] = strip_tags( $new_instance['gdcycle_item_width'] );
		$instance['gdcycle_item_height'] = strip_tags( $new_instance['gdcycle_item_height'] );
		$instance['gdcycle_cycle_width'] = strip_tags( $new_instance['gdcycle_cycle_width'] );
		$instance['gdcycle_cycle_height'] = strip_tags( $new_instance['gdcycle_cycle_height'] );
			
		return $instance;
	
	}
	
	
	function form( $instance ){
		$position = ( isset( $instance[ 'gdcycle_position' ] ) ) ? $instance[ 'gdcycle_position' ] : "";
		$name = ( isset( $instance[ 'gdcycle_name' ] ) ) ? $instance[ 'gdcycle_name' ] : '';
		$key = ( isset( $instance[ 'gdcycle_key' ] ) ) ? $instance[ 'gdcycle_key' ] : '';
		$rand = ( isset( $instance[ 'gdcycle_rand' ] ) ) ? $instance[ 'gdcycle_rand' ] : '';
		$allposts = ( isset( $instance[ 'gdcycle_all' ] ) ) ? $instance[ 'gdcycle_all' ] : '';
		$title = ( isset( $instance[ 'gdcycle_title' ] ) ) ? $instance[ 'gdcycle_title' ] : '';
		$item_width = ( isset( $instance[ 'gdcycle_item_width' ] ) ) ? $instance[ 'gdcycle_item_width' ] : '';
		$item_height = ( isset( $instance[ 'gdcycle_item_height' ] ) ) ? $instance[ 'gdcycle_item_height' ] : '';
		$rotator_width = ( isset( $instance[ 'gdcycle_cycle_width' ] ) ) ? $instance[ 'gdcycle_cycle_width' ] : '';
		$rotator_height = ( isset( $instance[ 'gdcycle_cycle_height' ] ) ) ? $instance[ 'gdcycle_cycle_height' ] : '';
	?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'gdcycle_title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'gdcycle_title' ); ?>" name="<?php echo $this->get_field_name( 'gdcycle_title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'gdcycle_position' ); ?>"><?php _e( 'Position:' ); ?></label> 
			<select class="widefat" name="<?php echo $this->get_field_name( 'gdcycle_position' ); ?>" id="<?php echo $this->get_field_id( 'gdcycle_position' ); ?>">
			<option value=""></option>
			<?php echo gidd_cycle_list_terms( 'cycle_position', 'option', 0, $position ); ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'gdcycle_rand' ); ?>"><?php _e( 'Random:' ); ?></label> 
			<select class="widefat" name="<?php echo $this->get_field_name( 'gdcycle_rand' ); ?>" id="<?php echo $this->get_field_id( 'gdcycle_rand' ); ?>">
				<option value="">No</option>
				<option value="rand" <?php if( $rand == "rand" ){ echo 'selected="selected"'; } ?> >Yes</option>			
			</select>
		</p>		
						
		<p>
			<label for="<?php echo $this->get_field_id( 'gdcycle_name' ); ?>"><?php _e( 'Name:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'gdcycle_name' ); ?>" name="<?php echo $this->get_field_name( 'gdcycle_name' ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'gdcycle_key' ); ?>"><?php _e( 'Key:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'gdcycle_key' ); ?>" name="<?php echo $this->get_field_name( 'gdcycle_key' ); ?>" type="text" value="<?php echo esc_attr( $key ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'gdcycle_item_width' ); ?>"><?php _e( 'Item width:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'gdcycle_item_width' ); ?>" name="<?php echo $this->get_field_name( 'gdcycle_item_width' ); ?>" type="text" value="<?php echo esc_attr( $item_width ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'gdcycle_item_height' ); ?>"><?php _e( 'Item height:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'gdcycle_item_height' ); ?>" name="<?php echo $this->get_field_name( 'gdcycle_item_height' ); ?>" type="text" value="<?php echo esc_attr( $item_height ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'gdcycle_cycle_width' ); ?>"><?php _e( 'Rotator width:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'gdcycle_cycle_width' ); ?>" name="<?php echo $this->get_field_name( 'gdcycle_cycle_width' ); ?>" type="text" value="<?php echo esc_attr( $rotator_width ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'gdcycle_cycle_height' ); ?>"><?php _e( 'Rotator height:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'gdcycle_cycle_height' ); ?>" name="<?php echo $this->get_field_name( 'gdcycle_cycle_height' ); ?>" type="text" value="<?php echo esc_attr( $rotator_height ); ?>" />			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'gdcycle_all' ); ?>">
				<input id="<?php echo $this->get_field_id( 'gdcycle_all' ); ?>" name="<?php echo $this->get_field_name( 'gdcycle_all' ); ?>" type="checkbox" value="all" <?php if( $allposts == "all" ){ echo 'checked="checked"'; } ?> />
				<?php _e( 'Show all found posts' ); ?>	
			</label>						
		</p>
		
		<?php	
	}


}

/** end */