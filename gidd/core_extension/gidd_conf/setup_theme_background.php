<?php

/** GIDD THEME CUSTOMIZE **/
add_action('wp_head', 'gidd_theme_customize');
function gidd_theme_customize(){

	$option = get_option('gidd_options');
	
	echo '<style type="text/css">';
	echo 'a{ color: '. $option['link_color'] .' }';
	echo '#footer{ background: '. $option['footer_background'] .' }';
	echo '.gidd-page .main-posts .posttitle h2 a{ color: '. $option['posttitle_color'] .' }';
	echo '.gidd-page .sidebar li.widget-container{ background: '. $option['widget_background'] .' }';
	echo '.gidd-page .sidebar li.widget-container h3{ color: '. $option['widgettitle_color'] .' }';
	echo '.gidd-page .sidebar li.widget-container ul li a{ color: '. $option['widgetlink_color'] .' }';
	echo '.gidd-page{ background: '. $option['page_background'] .' }';
	echo 'body{ color: '. $option['text_color'] .' }';
	echo '.menu-primary-wrap{ background: '. $option['primary_menu'] .' }';
	echo '#header{ background: '. $option['header_background'] .' }';
	
	echo '</style>';

}


/** CUSTOM BACKGROUND & HEADER **/
// Add support for custom backgrounds.
add_theme_support( 'custom-background', array(
	'default-color' => 'efefef',
) );

add_action( 'after_setup_theme', 'gidd_custom_header_setup' );
function gidd_custom_header_setup() {

	$conf = ___conf('custom-header');
	$conf = apply_filters( 'gidd_custom_header_setup', $conf ); 

	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => $conf->default_text_color,
		'default-image'          => $conf->default_image,

		// Set height and width, with a maximum value for the width.
		'height'                 => $conf->height,
		'width'                  => $conf->width,
		'max-width'              => $conf->max_width,

		// Support flexible height and width.
		'flex-height'            => $conf->flex_height,
		'flex-width'             => $conf->flex_width,

		// Random image rotation off by default.
		'random-default'         => $conf->random_default,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'gidd_header_style',
		'admin-head-callback'    => 'gidd_admin_header_style',
		'admin-preview-callback' => 'gidd_admin_header_image',
	);

	add_theme_support( 'custom-header', $args );
}


function gidd_header_style() {
	$header_image = get_header_image();
	$text_color   = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( empty( $header_image ) && $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="gidd-header-css">
	<?php
		if ( ! empty( $header_image ) ) :
	?>
		.site-header { background: url(<?php header_image(); ?>) no-repeat scroll top; background-size: <?php echo get_custom_header()->width ?>px <?php echo get_custom_header()->height ?>px;	}
		.site-header h1, .site-header h2{ margin: 0; } .site-header a.home-link{ display: block; }
	<?php
		endif;

		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,.site-description {	position: absolute;	clip: rect(1px 1px 1px 1px); /* IE7 */ clip: rect(1px, 1px, 1px, 1px); }
	<?php
		if ( empty( $header_image ) ) :
	?>
		.site-header .home-link { min-height: 0; }
	<?php
			endif;

		// If the user has set a custom color for the text, use that.
		elseif ( $text_color != get_theme_support( 'custom-header', 'default-text-color' ) ) :
	?>
		.site-title, .site-description { color: #<?php echo esc_attr( $text_color ); ?>; }
	<?php endif; ?>
	</style>
	<?php
}

function gidd_admin_header_style() {
$header_image = get_header_image();
?>
	<style type="text/css" id="gidd-admin-header-css">
	.appearance_page_custom-header #headimg {
		border: none;
		-webkit-box-sizing: border-box;
		-moz-box-sizing:    border-box;
		box-sizing:         border-box;
		<?php
		if ( ! empty( $header_image ) ) {
			echo 'background: url(' . esc_url( $header_image ) . ') no-repeat scroll top; background-size: '. get_custom_header()->width .'px '. get_custom_header()->height .'px;';
		} ?>
		padding: 0 20px;
	}
	#headimg .home-link {
		-webkit-box-sizing: border-box;
		-moz-box-sizing:    border-box;
		box-sizing:         border-box;
		margin: 0 auto;
		max-width: 1040px;
		<?php
		if ( ! empty( $header_image ) || display_header_text() ) {
			echo 'min-height: '. get_custom_header()->height .'px;';
		} ?>
		width: 100%;
	}
	<?php if ( ! display_header_text() ) : ?>
	#headimg h1,
	#headimg h2 {
		position: absolute !important;
		clip: rect(1px 1px 1px 1px); /* IE7 */
		clip: rect(1px, 1px, 1px, 1px);
	}
	<?php endif; ?>
	#headimg h1 {
		font: bold 60px/1 Bitter, Georgia, serif;
		margin: 0;
		padding: 58px 0 10px;
	}
	#headimg h1 a {
		text-decoration: none;
	}
	#headimg h1 a:hover {
		text-decoration: underline;
	}
	#headimg h2 {
		font: 200 italic 24px "Source Sans Pro", Helvetica, sans-serif;
		margin: 0;
		text-shadow: none;
	}
	.default-header img {
		max-width: 230px;
		width: auto;
	}
	</style>
<?php
}

function gidd_admin_header_image() {
	?>
	<div id="headimg">
		<?php
		if ( ! display_header_text() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 id="desc" class="displaying-header-text"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }





/** end */