<?php

Class Gidd_Customize{

	public static function register( $wp_customize ){
	
		//1. Define a new section (if desired) to the Theme Customizer
		$wp_customize->add_section( 'gidd_options', 
			array(
				'title' => __( 'gidd Options', 'gidd' ), //Visible title of section
				'priority' => 35, //Determines what order this appears in
				'capability' => 'edit_theme_options', //Capability needed to tweak
				'description' => __('Customize gidd design options.', 'gidd'), //Descriptive tooltip
			) 
		);
		
		//2. Register new settings to the WP database...
		$wp_customize->add_setting( 'gidd_options[link_color]', //Give it a SERIALIZED name (so all theme settings can live under one db record)
			array(
				'default' => '#2BA6CB', //Default setting/value to save
				'type' => 'option', //Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			) 
		);
		
		$wp_customize->add_setting( 'gidd_options[header_background]', //Give it a SERIALIZED name (so all theme settings can live under one db record)
			array(
				'default' => '#fff', //Default setting/value to save
				'type' => 'option', //Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			) 
		);

		$wp_customize->add_setting( 'gidd_options[footer_background]', //Give it a SERIALIZED name (so all theme settings can live under one db record)
			array(
				'default' => '#fff', //Default setting/value to save
				'type' => 'option', //Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			) 
		);
		
		$wp_customize->add_setting( 'gidd_options[posttitle_color]', //Give it a SERIALIZED name (so all theme settings can live under one db record)
			array(
				'default' => '#FA8435', //Default setting/value to save
				'type' => 'option', //Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			) 
		);
		
		$wp_customize->add_setting( 'gidd_options[widget_background]', //Give it a SERIALIZED name (so all theme settings can live under one db record)
			array(
				'default' => '#fff', //Default setting/value to save
				'type' => 'option', //Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			) 
		);
		
		
		$wp_customize->add_setting( 'gidd_options[widgettitle_color]', //Give it a SERIALIZED name (so all theme settings can live under one db record)
			array(
				'default' => '#444', //Default setting/value to save
				'type' => 'option', //Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			) 
		);
		
		$wp_customize->add_setting( 'gidd_options[widgetlink_color]', //Give it a SERIALIZED name (so all theme settings can live under one db record)
			array(
				'default' => '#2BA6CB', //Default setting/value to save
				'type' => 'option', //Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			) 
		);

		$wp_customize->add_setting( 'gidd_options[page_background]', //Give it a SERIALIZED name (so all theme settings can live under one db record)
			array(
				'default' => '#fff', //Default setting/value to save
				'type' => 'option', //Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			) 
		);
		
		$wp_customize->add_setting( 'gidd_options[text_color]', //Give it a SERIALIZED name (so all theme settings can live under one db record)
			array(
				'default' => '#333', //Default setting/value to save
				'type' => 'option', //Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			) 
		);
		
		$wp_customize->add_setting( 'gidd_options[primary_menu]', //Give it a SERIALIZED name (so all theme settings can live under one db record)
			array(
				'default' => '#efefef', //Default setting/value to save
				'type' => 'option', //Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			) 
		);

		 //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'gidd_header_background', //Set a unique ID for the control
			array(
				'label' => __( 'Header Background Color', 'gidd' ), //Admin-visible name of the control
				'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'gidd_options[header_background]', //Which setting to load and manipulate (serialized is okay)
				'priority' => 11, //Determines the order this control appears in for the specified section
			)
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'gidd_footer_background', //Set a unique ID for the control
			array(
				'label' => __( 'Footer Background Color', 'gidd' ), //Admin-visible name of the control
				'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'gidd_options[footer_background]', //Which setting to load and manipulate (serialized is okay)
				'priority' => 12, //Determines the order this control appears in for the specified section
			) 
		) );
		
		
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'gidd_pagebackground_color', //Set a unique ID for the control
			array(
				'label' => __( 'Page Background Color', 'gidd' ), //Admin-visible name of the control
				'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'gidd_options[page_background]', //Which setting to load and manipulate (serialized is okay)
				'priority' => 13, //Determines the order this control appears in for the specified section
			) 
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'gidd_primary_menu', //Set a unique ID for the control
			array(
				'label' => __( 'Primary menu background color', 'gidd' ), //Admin-visible name of the control
				'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'gidd_options[primary_menu]', //Which setting to load and manipulate (serialized is okay)
				'priority' => 14, //Determines the order this control appears in for the specified section
			) 
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'gidd_widget_background', //Set a unique ID for the control
			array(
				'label' => __( 'Widget Background Color', 'gidd' ), //Admin-visible name of the control
				'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'gidd_options[widget_background]', //Which setting to load and manipulate (serialized is okay)
				'priority' => 15, //Determines the order this control appears in for the specified section
			) 
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'gidd_link_color', //Set a unique ID for the control
			array(
				'label' => __( 'Link Color', 'gidd' ), //Admin-visible name of the control
				'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'gidd_options[link_color]', //Which setting to load and manipulate (serialized is okay)
				'priority' => 16, //Determines the order this control appears in for the specified section
			) 
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'gidd_posttitle_color', //Set a unique ID for the control
			array(
				'label' => __( 'Post Title Color', 'gidd' ), //Admin-visible name of the control
				'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'gidd_options[posttitle_color]', //Which setting to load and manipulate (serialized is okay)
				'priority' => 17, //Determines the order this control appears in for the specified section
			) 
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'gidd_widgettitle_color', //Set a unique ID for the control
			array(
				'label' => __( 'Widget Title Color', 'gidd' ), //Admin-visible name of the control
				'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'gidd_options[widgettitle_color]', //Which setting to load and manipulate (serialized is okay)
				'priority' => 18, //Determines the order this control appears in for the specified section
			) 
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'gidd_widgetlink_color', //Set a unique ID for the control
			array(
				'label' => __( 'Widget Link Color', 'gidd' ), //Admin-visible name of the control
				'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'gidd_options[widgetlink_color]', //Which setting to load and manipulate (serialized is okay)
				'priority' => 19, //Determines the order this control appears in for the specified section
			) 
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'gidd_text_color', //Set a unique ID for the control
			array(
				'label' => __( 'Text Color', 'gidd' ), //Admin-visible name of the control
				'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'gidd_options[text_color]', //Which setting to load and manipulate (serialized is okay)
				'priority' => 20, //Determines the order this control appears in for the specified section
			) 
		) );
		
		
		//4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

	}
	
	
	/**
    * This will output the custom WordPress settings to the live theme's WP head.
    * 
    * Used by hook: 'wp_head'
    * 
    * @see add_action('wp_head',$func)
    * @since MyTheme 1.0
    */
   public static function header_output() {
      ?>
      <!--Customizer CSS--> 
      <style type="text/css">
           <?php self::generate_css('.site-header a', 'color', 'header_textcolor', '#'); ?> 
           <?php self::generate_css('body', 'background-color', 'background_color', '#'); ?> 
           <?php self::generate_css('a', 'color', 'gidd_options[link_textcolor]'); ?>
		   <?php self::generate_css('#footer', 'background', 'gidd_options[footer_background]'); ?>
		   <?php self::generate_css('.gidd-page .main-posts .posttitle h2 a', 'background', 'gidd_options[posttitle_color]'); ?>
		   <?php self::generate_css('.gidd-page .sidebar li.widget-container', 'background', 'gidd_options[widget_background]'); ?>
		   <?php self::generate_css('.gidd-page .sidebar li.widget-container h3', 'color', 'gidd_options[widgettitle_color]'); ?>
		   <?php self::generate_css('.gidd-page .sidebar li.widget-container ul li a', 'color', 'gidd_options[widgetlink_color]'); ?>
		   <?php self::generate_css('.gidd-page', 'background', 'gidd_options[page_background]'); ?>
		   <?php self::generate_css('body', 'color', 'gidd_options[text_color]'); ?>
		   <?php self::generate_css('#header', 'background', 'gidd_options[header_background]'); ?>
		   <?php self::generate_css('#header .menu-primary-wrap', 'background', 'gidd_options[primary_menu]'); ?>
      
	  </style> 
      <!--/Customizer CSS-->
      <?php
   }
   
   
   /**
    * This outputs the javascript needed to automate the live settings preview.
    * Also keep in mind that this function isn't necessary unless your settings 
    * are using 'transport'=>'postMessage' instead of the default 'transport'
    * => 'refresh'
    * 
    * Used by hook: 'customize_preview_init'
    * 
    * @see add_action('customize_preview_init',$func)
    * @since Gidd 1.0
    */
   public static function live_preview()
   {
      wp_enqueue_script( 
           'gidd-themecustomizer', //Give the script an ID
           GIDDURL.'core_extension/gidd_conf/theme-customizer.js', //Define it's JS file
           array( 'jquery','customize-preview' ), //Define dependencies
           '', //Define a version (optional) 
           true //Specify whether to put in footer (leave this true)
      );
   }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) )
      {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo )
         {
            echo $return;
         }
      }
      return $return;
    }


}


//Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'Gidd_Customize' , 'register' ) );

//Output custom CSS to live site
add_action( 'wp_head' , array( 'Gidd_Customize' , 'header_output' ) );

//Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'Gidd_Customize' , 'live_preview' ) );


/** gidd_customize.php */