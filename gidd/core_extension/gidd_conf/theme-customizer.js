/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	// Update the site title in real time...
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title' ).html( newval );
		} );
	} );
	
	//Update the site description in real time...
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );

	//Update site title color in real time...
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( newval ) {
			$('#site-title a').css('color', newval );
		} );
	} );

	//Update site background color...
	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) {
			$('body').css('background-color', newval );
		} );
	} );
	
	//Update link color in real time...
	wp.customize( 'gidd_options[link_color]', function( value ) {
		value.bind( function( newval ) {
			$('a').css('color', newval );
		} );
	} );
	
	//Update footer background color in real time...
	wp.customize( 'gidd_options[footer_background]', function( value ) {
		value.bind( function( newval ) {
			$('#footer').css('background', newval );
		} );
	} );
	
	//Update post title color in real time...
	wp.customize( 'gidd_options[posttitle_color]', function( value ) {
		value.bind( function( newval ) {
			$('.gidd-page .main-posts .posttitle h2 a').css('color', newval );
		} );
	} );

	//Update widget background in real time...
	wp.customize( 'gidd_options[widget_background]', function( value ) {
		value.bind( function( newval ) {
			$('.gidd-page .sidebar li.widget-container').css('background', newval );
		} );
	} );
	
	//Update widget title color in real time...
	wp.customize( 'gidd_options[widgettitle_color]', function( value ) {
		value.bind( function( newval ) {
			$('.gidd-page .sidebar li.widget-container h3').css('color', newval );
		} );
	} );
	
	//Update widget link color in real time...
	wp.customize( 'gidd_options[widgetlink_color]', function( value ) {
		value.bind( function( newval ) {
			$('.gidd-page .sidebar li.widget-container ul li a').css('color', newval );
		} );
	} );
	
	//Update page background color in real time...
	wp.customize( 'gidd_options[page_background]', function( value ) {
		value.bind( function( newval ) {
			$('.gidd-page').css('background', newval );
		} );
	} );
	
	//Update text color in real time...
	wp.customize( 'gidd_options[text_color]', function( value ) {
		value.bind( function( newval ) {
			$('body').css('color', newval );
		} );
	} );
	
	//Update primary menu background in real time...
	wp.customize( 'gidd_options[primary_menu]', function( value ) {
		value.bind( function( newval ) {
			$('#header .menu-primary-wrap').css('background', newval );
		} );
	} );
	
	//Update header background in real time...
	wp.customize( 'gidd_options[header_background]', function( value ) {
		value.bind( function( newval ) {
			$('#header').css('background', newval );
		} );
	} );
	
	
} )( jQuery );
