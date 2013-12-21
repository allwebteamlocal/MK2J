<?php

function ___add_section( $id, $title, $priority = 35, $description = ""  ){
	$section = ___data();
	$section->name = "section";
	$section->id = $id;
	$section->title = $title;
	$section->priority = 35;
	$section->description = $description;
	return $section;
}

function ___add_setting( $id, $default = "", $type = "theme_mod", $cap = "", $transport = "refresh" ){

	$setting = ___data();
	$setting->name = "setting";
	$setting->id = $id;
	$setting->_default = $default;
	$setting->type = $type;
	$setting->capability = $cap;
	$setting->transport = $transport;
	
	return $setting;

}

function ___add_control( $setting_id, $label, $section, $type = "text"  ){

	$control = ___data();
	$control->name = "control";
	$control->_object = false;
	$control->id = $setting_id;
	$control->section = $section;
	$control->label = $label;
	$control->type = $type;	
	return $control;	
	
}


function ___add_control_object( $control, $label, $setting, $section ){

	$object = ___data();
	$object->name = "control";
	$object->_object = true;
	$object->control = $control;
	$object->label = $label;
	$object->setting = $setting;
	$object->section = $section;
	
	return $object;

}


function ___do_customize( $option, $wp_customize ){

	switch ( $option->name ){
	
		case 'section'	: 
							$args = array( 'title' => $option->title, 'priority' => $option->priority, 'description' => $option->description );
							$wp_customize->add_section( $option->id, $args );
							break;
		case 'setting'	:	
							if ( $option->capability != "" )
								$args = array( 'default' => $option->_default, 'type' => $option->type, 'capability' => $option->capability, 'transport' => $option->transport );
							else
								$args = array( 'default' => $option->_default, 'type' => $option->type, 'transport' => $option->transport );
							
							$wp_customize->add_setting( $option->id, $args );
							break;
							
		default			:
		
							if ( $option->_object ){							

								switch( $option->control ){
									
									case	"color"	:	
														$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $option->setting, 
														array(
															'label'   	=> $option->label,
															'section' 	=> $option->section,
															'settings'	=> $option->setting,
														) ) );
														break;
														
									case	"upload":	
														$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, $option->setting, 
														array(
															'label'   	=> $option->label,
															'section' 	=> $option->section,
															'settings'	=> $option->setting,
														) ) );
														break;
														
									default			:	break;
									
								}



								
							}else{							
								$args = array( 'label' => $option->label, 'section' => $option->section, 'type' => $option->type );
								$wp_customize->add_control( $option->id, $args );
							}
							
							break;
	
	
	
	
	}

}

/** end */