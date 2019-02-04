<?php
/**
 *
 * @package Celsius
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1120; /* pixels */
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function celsius_setup() {

	load_theme_textdomain( 'celsius', get_template_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'celsius_setup' );

/*
 * Remove unnecessary hooks from parent theme
 */
remove_action( 'init', 'isola_google_fonts' );
remove_action( 'admin_enqueue_scripts', 'isola_admin_scripts' );

function celsius_scripts() {

	wp_enqueue_style( 'celsius-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'celsius-style', get_stylesheet_uri() );
	wp_enqueue_style( 'celsius-droid-serif' );
	wp_enqueue_style( 'celsius-droid-sans' );

	wp_dequeue_style( 'isola-source-sans-pro' );

}
add_action( 'wp_enqueue_scripts', 'celsius_scripts', 29 );

/**
 * Register Google Fonts
 */
function celsius_google_fonts() {

	$protocol = is_ssl() ? 'https' : 'http';

	/*	translators: If there are characters in your language that are not supported
		by Droid Serif, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Droid Serif font: on or off', 'celsius' ) ) {

		wp_register_style( 'celsius-droid-serif', "$protocol://fonts.googleapis.com/css?family=Libre+Baskerville:400,700,400italic" );

	}

	/*	translators: If there are characters in your language that are not supported
		by Droid Sans, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Droid Sans font: on or off', 'celsius' ) ) {

		wp_register_style( 'celsius-droid-sans', "$protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,300italic,400italic,600italic" );

	}

}
add_action( 'init', 'celsius_google_fonts' );

/**
 * Enqueue Google Fonts for custom headers
 */
function celsius_admin_scripts( $hook_suffix ) {

	if ( 'appearance_page_custom-header' != $hook_suffix )
		return;

	wp_enqueue_style( 'celsius-droid-serif' );
	wp_enqueue_style( 'celsius-droid-sans' );

}
add_action( 'admin_enqueue_scripts', 'celsius_admin_scripts' );

/* Style custom headers to match the theme in the admin */

function isola_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			background: #fff;
			border: none;
			border-bottom: 1px solid #f2f2f2;
			font-size: 20px;
			padding: 0;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
			font-family: "Libre Baskerville", Times, serif;
			font-size: 0.75em;
			line-height: 2.13333em;
			font-weight: bold;
			margin: 0;
			padding: 8px 5%;
		}
		#headimg h1 a {
			text-decoration: none;
		}
		#headimg h1 a:hover {
			color: #2cbba5 !important;
		}
		#desc {
			display: none;
		}
		#headimg img {
			max-width: 100%;
			height: auto;
		}
	</style>
<?php
}

/* Apply new default font color to custom header */
function celsius_custom_header_args( $args ) {

	$args['default-text-color'] = '444444';

	return $args;
}
add_filter( 'isola_custom_header_args', 'celsius_custom_header_args' );

// updater for WordPress.com themes
if ( is_admin() )
	include dirname( __FILE__ ) . '/inc/updater.php';
