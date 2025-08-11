<?php
/**
 * JOEMARU functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package JOEMARU
 * @subpackage JOEMARU
 * @since JOEMARU 1.0
 */

/**
 * JOEMARU only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'joemaru_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own joemaru_setup() function to override in a child theme.
 *
 * @since JOEMARU 1.0
 */
function joemaru_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/joemaru
	 * If you're building a theme based on JOEMARU, use a find and replace
	 * to change 'joemaru' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'joemaru' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since JOEMARU 1.0
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'joemaru' ),
		'social'  => __( 'Social Links Menu', 'joemaru' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', joemaru_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // joemaru_setup
add_action( 'after_setup_theme', 'joemaru_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since JOEMARU 1.0
 */
function joemaru_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'joemaru_content_width', 840 );
}
add_action( 'after_setup_theme', 'joemaru_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since JOEMARU 1.0
 */
function joemaru_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'joemaru' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'joemaru' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'joemaru' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'joemaru' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'joemaru' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'joemaru' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'joemaru_widgets_init' );

if ( ! function_exists( 'joemaru_fonts_url' ) ) :
/**
 * Register Google fonts for JOEMARU.
 *
 * Create your own joemaru_fonts_url() function to override in a child theme.
 *
 * @since JOEMARU 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function joemaru_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'joemaru' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'joemaru' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'joemaru' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	/* translators: If there are characters in your language that are not supported by Noto Serif JP, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Noto Serif JP font: on or off', 'joemaru' ) ) {
		$fonts[] = 'Noto Serif JP:400,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since JOEMARU 1.0
 */
function joemaru_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'joemaru_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since JOEMARU 1.0
 */
function joemaru_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'joemaru-fonts', joemaru_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'joemaru-style', get_stylesheet_uri() );

	// Global background styles
	wp_enqueue_style( 'joemaru-global-background', get_template_directory_uri() . '/css/global-background.css', array( 'joemaru-style' ), '1.0.0' );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'joemaru-ie', get_template_directory_uri() . '/css/ie.css', array( 'joemaru-style' ), '20160816' );
	wp_style_add_data( 'joemaru-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'joemaru-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'joemaru-style' ), '20160816' );
	wp_style_add_data( 'joemaru-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'joemaru-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'joemaru-style' ), '20160816' );
	wp_style_add_data( 'joemaru-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'joemaru-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'joemaru-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'joemaru-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'joemaru-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'joemaru-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'joemaru-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'joemaru' ),
		'collapse' => __( 'collapse child menu', 'joemaru' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'joemaru_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since JOEMARU 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function joemaru_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'joemaru_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since JOEMARU 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function joemaru_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since JOEMARU 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function joemaru_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'joemaru_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since JOEMARU 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function joemaru_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'joemaru_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since JOEMARU 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function joemaru_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'joemaru_widget_tag_cloud_args' );

/**
 * 料金カードのアイコンSVGを返す
 * @param string $type アイコンの種類 (kase, charter, bay)
 * @return string SVGアイコンのHTML
 */
function get_price_card_icon($type) {
    $icons = [
        'kase' => '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M19.5 21.13C19.6658 21.13 19.8247 21.0642 19.9419 20.9469C20.0592 20.8297 20.125 20.6708 20.125 20.505C20.125 20.3392 20.0592 20.1803 19.9419 20.0631C19.8247 19.9458 19.6658 19.88 19.5 19.88C19.3342 19.88 19.1753 19.9458 19.0581 20.0631C18.9408 20.1803 18.875 20.3392 18.875 20.505C18.875 20.6708 18.9408 20.8297 19.0581 20.9469C19.1753 21.0642 19.3342 21.13 19.5 21.13ZM24.125 20.505C24.125 20.6708 24.0592 20.8297 23.9419 20.9469C23.8247 21.0642 23.6658 21.13 23.5 21.13C23.3342 21.13 23.1753 21.0642 23.0581 20.9469C22.9408 20.8297 22.875 20.6708 22.875 20.505C22.875 20.3392 22.9408 20.1803 23.0581 20.0631C23.1753 19.9458 23.3342 19.88 23.5 19.88C23.6658 19.88 23.8247 19.9458 23.9419 20.0631C24.0592 20.1803 24.125 20.3392 24.125 20.505ZM21.5 23.13C21.6658 23.13 21.8247 23.0642 21.9419 22.9469C22.0592 22.8297 22.125 22.6708 22.125 22.505C22.125 22.3392 22.0592 22.1803 21.9419 22.0631C21.8247 21.9458 21.6658 21.88 21.5 21.88C21.3342 21.88 21.1753 21.9458 21.0581 22.0631C20.9408 22.1803 20.875 22.3392 20.875 22.505C20.875 22.6708 20.9408 22.8297 21.0581 22.9469C21.1753 23.0642 21.3342 23.13 21.5 23.13ZM22.125 18.505C22.125 18.6708 22.0592 18.8297 21.9419 18.9469C21.8247 19.0642 21.6658 19.13 21.5 19.13C21.3342 19.13 21.1753 19.0642 21.0581 18.9469C20.9408 18.8297 20.875 18.6708 20.875 18.505C20.875 18.3392 20.9408 18.1803 21.0581 18.0631C21.1753 17.9458 21.3342 17.88 21.5 17.88C21.6658 17.88 21.8247 17.9458 21.9419 18.0631C22.0592 18.1803 22.125 18.3392 22.125 18.505ZM11 17.5C11 17.3674 11.0527 17.2402 11.1464 17.1464C11.2402 17.0527 11.3674 17 11.5 17H12.5C12.6326 17 12.7598 17.0527 12.8536 17.1464C12.9473 17.2402 13 17.3674 13 17.5C13 17.6326 12.9473 17.7598 12.8536 17.8536C12.7598 17.9473 12.6326 18 12.5 18H11.5C11.3674 18 11.2402 17.9473 11.1464 17.8536C11.0527 17.7598 11 17.6326 11 17.5Z" fill="white"/>
            <path d="M10 8.915C9.7881 8.84015 9.59572 8.71864 9.43709 8.55946C9.27846 8.40027 9.15762 8.20747 9.08351 7.99531C9.0094 7.78315 8.9839 7.55705 9.00891 7.33371C9.03392 7.11038 9.10879 6.89551 9.228 6.705L9.229 6.703L9.231 6.7L9.235 6.694L9.245 6.677C9.29103 6.60446 9.33939 6.53342 9.39 6.464C9.485 6.329 9.62 6.146 9.797 5.929C10.147 5.498 10.665 4.926 11.347 4.353C12.701 3.21 14.782 2 17.5 2C21.759 2 26 5.603 26 10.5V28.5C26 28.8978 25.842 29.2794 25.5607 29.5607C25.2794 29.842 24.8978 30 24.5 30C24.1022 30 23.7206 29.842 23.4393 29.5607C23.158 29.2794 23 28.8978 23 28.5V24.21C22.3928 24.4552 21.7348 24.5476 21.0836 24.479C20.4324 24.4105 19.808 24.1832 19.2652 23.817C18.7223 23.4508 18.2777 22.9569 17.9704 22.3787C17.663 21.8006 17.5022 21.1558 17.5022 20.501C17.5022 19.8462 17.663 19.2014 17.9704 18.6233C18.2777 18.0451 18.7223 17.5512 19.2652 17.185C19.808 16.8188 20.4324 16.5915 21.0836 16.523C21.7348 16.4544 22.3928 16.5468 23 16.792V10.5C23 7.397 20.241 5 17.5 5C15.717 5 14.298 5.789 13.279 6.647C12.8593 7.00226 12.473 7.39523 12.125 7.821C12.0037 7.97052 11.8886 8.12499 11.78 8.284L11.769 8.3V8.299C11.5892 8.58469 11.3182 8.80137 11 8.914V13H11.5C11.6326 13 11.7598 13.0527 11.8536 13.1464C11.9473 13.2402 12 13.3674 12 13.5C12 13.6326 11.9473 13.7598 11.8536 13.8536C11.7598 13.9473 11.6326 14 11.5 14H11V14.027C12.1002 14.15 13.1164 14.6742 13.8544 15.4995C14.5923 16.3247 15.0002 17.393 15 18.5C15 23.589 13.161 25.613 12.363 26.492C12.141 26.736 12 26.892 12 27V27.5C12 27.645 12.252 27.664 12.61 27.69C13.487 27.756 15 27.87 15 30H12.5C11.5 30 10.5 29 10.5 28.5C10.5 29 9.5 30 8.5 30H6C6 27.87 7.513 27.756 8.39 27.69C8.748 27.664 9 27.645 9 27.5V27C9 26.891 8.859 26.736 8.637 26.492C7.84 25.612 6 23.589 6 18.5C6.00003 17.3931 6.40801 16.3251 7.14594 15.5001C7.88387 14.6751 8.89998 14.151 10 14.028V14H9.5C9.36739 14 9.24021 13.9473 9.14645 13.8536C9.05268 13.7598 9 13.6326 9 13.5C9 13.3674 9.05268 13.2402 9.14645 13.1464C9.24021 13.0527 9.36739 13 9.5 13H10V8.915ZM21.5 17.5C20.7044 17.5 19.9413 17.8161 19.3787 18.3787C18.8161 18.9413 18.5 19.7044 18.5 20.5C18.5 21.2956 18.8161 22.0587 19.3787 22.6213C19.9413 23.1839 20.7044 23.5 21.5 23.5C22.2956 23.5 23.0587 23.1839 23.6213 22.6213C24.1839 22.0587 24.5 21.2956 24.5 20.5C24.5 19.7044 24.1839 18.9413 23.6213 18.3787C23.0587 17.8161 22.2956 17.5 21.5 17.5ZM14 18.5C14 17.5717 13.6313 16.6815 12.9749 16.0251C12.3185 15.3687 11.4283 15 10.5 15C9.57174 15 8.6815 15.3687 8.02513 16.0251C7.36875 16.6815 7 17.5717 7 18.5C7 19.4283 7.36875 20.3185 8.02513 20.9749C8.6815 21.6313 9.57174 22 10.5 22C11.4283 22 12.3185 21.6313 12.9749 20.9749C13.6313 20.3185 14 19.4283 14 18.5Z" fill="white"/>
        </svg>',
        'charter' => '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M19.5 21.13C19.6658 21.13 19.8247 21.0642 19.9419 20.9469C20.0592 20.8297 20.125 20.6708 20.125 20.505C20.125 20.3392 20.0592 20.1803 19.9419 20.0631C19.8247 19.9458 19.6658 19.88 19.5 19.88C19.3342 19.88 19.1753 19.9458 19.0581 20.0631C18.9408 20.1803 18.875 20.3392 18.875 20.505C18.875 20.6708 18.9408 20.8297 19.0581 20.9469C19.1753 21.0642 19.3342 21.13 19.5 21.13ZM24.125 20.505C24.125 20.6708 24.0592 20.8297 23.9419 20.9469C23.8247 21.0642 23.6658 21.13 23.5 21.13C23.3342 21.13 23.1753 21.0642 23.0581 20.9469C22.9408 20.8297 22.875 20.6708 22.875 20.505C22.875 20.3392 22.9408 20.1803 23.0581 20.0631C23.1753 19.9458 23.3342 19.88 23.5 19.88C23.6658 19.88 23.8247 19.9458 23.9419 20.0631C24.0592 20.1803 24.125 20.3392 24.125 20.505ZM21.5 23.13C21.6658 23.13 21.8247 23.0642 21.9419 22.9469C22.0592 22.8297 22.125 22.6708 22.125 22.505C22.125 22.3392 22.0592 22.1803 21.9419 22.0631C21.8247 21.9458 21.6658 21.88 21.5 21.88C21.3342 21.88 21.1753 21.9458 21.0581 22.0631C20.9408 22.1803 20.875 22.3392 20.875 22.505C20.875 22.6708 20.9408 22.8297 21.0581 22.9469C21.1753 23.0642 21.3342 23.13 21.5 23.13ZM22.125 18.505C22.125 18.6708 22.0592 18.8297 21.9419 18.9469C21.8247 19.0642 21.6658 19.13 21.5 19.13C21.3342 19.13 21.1753 19.0642 21.0581 18.9469C20.9408 18.8297 20.875 18.6708 20.875 18.505C20.875 18.3392 20.9408 18.1803 21.0581 18.0631C21.1753 17.9458 21.3342 17.88 21.5 17.88C21.6658 17.88 21.8247 17.9458 21.9419 18.0631C22.0592 18.1803 22.125 18.3392 22.125 18.505ZM11 17.5C11 17.3674 11.0527 17.2402 11.1464 17.1464C11.2402 17.0527 11.3674 17 11.5 17H12.5C12.6326 17 12.7598 17.0527 12.8536 17.1464C12.9473 17.2402 13 17.3674 13 17.5C13 17.6326 12.9473 17.7598 12.8536 17.8536C12.7598 17.9473 12.6326 18 12.5 18H11.5C11.3674 18 11.2402 17.9473 11.1464 17.8536C11.0527 17.7598 11 17.6326 11 17.5Z" fill="white"/>
            <path d="M10 8.915C9.7881 8.84015 9.59572 8.71864 9.43709 8.55946C9.27846 8.40027 9.15762 8.20747 9.08351 7.99531C9.0094 7.78315 8.9839 7.55705 9.00891 7.33371C9.03392 7.11038 9.10879 6.89551 9.228 6.705L9.229 6.703L9.231 6.7L9.235 6.694L9.245 6.677C9.29103 6.60446 9.33939 6.53342 9.39 6.464C9.485 6.329 9.62 6.146 9.797 5.929C10.147 5.498 10.665 4.926 11.347 4.353C12.701 3.21 14.782 2 17.5 2C21.759 2 26 5.603 26 10.5V28.5C26 28.8978 25.842 29.2794 25.5607 29.5607C25.2794 29.842 24.8978 30 24.5 30C24.1022 30 23.7206 29.842 23.4393 29.5607C23.158 29.2794 23 28.8978 23 28.5V24.21C22.3928 24.4552 21.7348 24.5476 21.0836 24.479C20.4324 24.4105 19.808 24.1832 19.2652 23.817C18.7223 23.4508 18.2777 22.9569 17.9704 22.3787C17.663 21.8006 17.5022 21.1558 17.5022 20.501C17.5022 19.8462 17.663 19.2014 17.9704 18.6233C18.2777 18.0451 18.7223 17.5512 19.2652 17.185C19.808 16.8188 20.4324 16.5915 21.0836 16.523C21.7348 16.4544 22.3928 16.5468 23 16.792V10.5C23 7.397 20.241 5 17.5 5C15.717 5 14.298 5.789 13.279 6.647C12.8593 7.00226 12.473 7.39523 12.125 7.821C12.0037 7.97052 11.8886 8.12499 11.78 8.284L11.769 8.3V8.299C11.5892 8.58469 11.3182 8.80137 11 8.914V13H11.5C11.6326 13 11.7598 13.0527 11.8536 13.1464C11.9473 13.2402 12 13.3674 12 13.5C12 13.6326 11.9473 13.7598 11.8536 13.8536C11.7598 13.9473 11.6326 14 11.5 14H11V14.027C12.1002 14.15 13.1164 14.6742 13.8544 15.4995C14.5923 16.3247 15.0002 17.393 15 18.5C15 23.589 13.161 25.613 12.363 26.492C12.141 26.736 12 26.892 12 27V27.5C12 27.645 12.252 27.664 12.61 27.69C13.487 27.756 15 27.87 15 30H12.5C11.5 30 10.5 29 10.5 28.5C10.5 29 9.5 30 8.5 30H6C6 27.87 7.513 27.756 8.39 27.69C8.748 27.664 9 27.645 9 27.5V27C9 26.891 8.859 26.736 8.637 26.492C7.84 25.612 6 23.589 6 18.5C6.00003 17.3931 6.40801 16.3251 7.14594 15.5001C7.88387 14.6751 8.89998 14.151 10 14.028V14H9.5C9.36739 14 9.24021 13.9473 9.14645 13.8536C9.05268 13.7598 9 13.6326 9 13.5C9 13.3674 9.05268 13.2402 9.14645 13.1464C9.24021 13.0527 9.36739 13 9.5 13H10V8.915ZM21.5 17.5C20.7044 17.5 19.9413 17.8161 19.3787 18.3787C18.8161 18.9413 18.5 19.7044 18.5 20.5C18.5 21.2956 18.8161 22.0587 19.3787 22.6213C19.9413 23.1839 20.7044 23.5 21.5 23.5C22.2956 23.5 23.0587 23.1839 23.6213 22.6213C24.1839 22.0587 24.5 21.2956 24.5 20.5C24.5 19.7044 24.1839 18.9413 23.6213 18.3787C23.0587 17.8161 22.2956 17.5 21.5 17.5ZM14 18.5C14 17.5717 13.6313 16.6815 12.9749 16.0251C12.3185 15.3687 11.4283 15 10.5 15C9.57174 15 8.6815 15.3687 8.02513 16.0251C7.36875 16.6815 7 17.5717 7 18.5C7 19.4283 7.36875 20.3185 8.02513 20.9749C8.6815 21.6313 9.57174 22 10.5 22C11.4283 22 12.3185 21.6313 12.9749 20.9749C13.6313 20.3185 14 19.4283 14 18.5Z" fill="white"/>
        </svg>',
        'bay' => '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M19.5 21.13C19.6658 21.13 19.8247 21.0642 19.9419 20.9469C20.0592 20.8297 20.125 20.6708 20.125 20.505C20.125 20.3392 20.0592 20.1803 19.9419 20.0631C19.8247 19.9458 19.6658 19.88 19.5 19.88C19.3342 19.88 19.1753 19.9458 19.0581 20.0631C18.9408 20.1803 18.875 20.3392 18.875 20.505C18.875 20.6708 18.9408 20.8297 19.0581 20.9469C19.1753 21.0642 19.3342 21.13 19.5 21.13ZM24.125 20.505C24.125 20.6708 24.0592 20.8297 23.9419 20.9469C23.8247 21.0642 23.6658 21.13 23.5 21.13C23.3342 21.13 23.1753 21.0642 23.0581 20.9469C22.9408 20.8297 22.875 20.6708 22.875 20.505C22.875 20.3392 22.9408 20.1803 23.0581 20.0631C23.1753 19.9458 23.3342 19.88 23.5 19.88C23.6658 19.88 23.8247 19.9458 23.9419 20.0631C24.0592 20.1803 24.125 20.3392 24.125 20.505ZM21.5 23.13C21.6658 23.13 21.8247 23.0642 21.9419 22.9469C22.0592 22.8297 22.125 22.6708 22.125 22.505C22.125 22.3392 22.0592 22.1803 21.9419 22.0631C21.8247 21.9458 21.6658 21.88 21.5 21.88C21.3342 21.88 21.1753 21.9458 21.0581 22.0631C20.9408 22.1803 20.875 22.3392 20.875 22.505C20.875 22.6708 20.9408 22.8297 21.0581 22.9469C21.1753 23.0642 21.3342 23.13 21.5 23.13ZM22.125 18.505C22.125 18.6708 22.0592 18.8297 21.9419 18.9469C21.8247 19.0642 21.6658 19.13 21.5 19.13C21.3342 19.13 21.1753 19.0642 21.0581 18.9469C20.9408 18.8297 20.875 18.6708 20.875 18.505C20.875 18.3392 20.9408 18.1803 21.0581 18.0631C21.1753 17.9458 21.3342 17.88 21.5 17.88C21.6658 17.88 21.8247 17.9458 21.9419 18.0631C22.0592 18.1803 22.125 18.3392 22.125 18.505ZM11 17.5C11 17.3674 11.0527 17.2402 11.1464 17.1464C11.2402 17.0527 11.3674 17 11.5 17H12.5C12.6326 17 12.7598 17.0527 12.8536 17.1464C12.9473 17.2402 13 17.3674 13 17.5C13 17.6326 12.9473 17.7598 12.8536 17.8536C12.7598 17.9473 12.6326 18 12.5 18H11.5C11.3674 18 11.2402 17.9473 11.1464 17.8536C11.0527 17.7598 11 17.6326 11 17.5Z" fill="white"/>
            <path d="M10 8.915C9.7881 8.84015 9.59572 8.71864 9.43709 8.55946C9.27846 8.40027 9.15762 8.20747 9.08351 7.99531C9.0094 7.78315 8.9839 7.55705 9.00891 7.33371C9.03392 7.11038 9.10879 6.89551 9.228 6.705L9.229 6.703L9.231 6.7L9.235 6.694L9.245 6.677C9.29103 6.60446 9.33939 6.53342 9.39 6.464C9.485 6.329 9.62 6.146 9.797 5.929C10.147 5.498 10.665 4.926 11.347 4.353C12.701 3.21 14.782 2 17.5 2C21.759 2 26 5.603 26 10.5V28.5C26 28.8978 25.842 29.2794 25.5607 29.5607C25.2794 29.842 24.8978 30 24.5 30C24.1022 30 23.7206 29.842 23.4393 29.5607C23.158 29.2794 23 28.8978 23 28.5V24.21C22.3928 24.4552 21.7348 24.5476 21.0836 24.479C20.4324 24.4105 19.808 24.1832 19.2652 23.817C18.7223 23.4508 18.2777 22.9569 17.9704 22.3787C17.663 21.8006 17.5022 21.1558 17.5022 20.501C17.5022 19.8462 17.663 19.2014 17.9704 18.6233C18.2777 18.0451 18.7223 17.5512 19.2652 17.185C19.808 16.8188 20.4324 16.5915 21.0836 16.523C21.7348 16.4544 22.3928 16.5468 23 16.792V10.5C23 7.397 20.241 5 17.5 5C15.717 5 14.298 5.789 13.279 6.647C12.8593 7.00226 12.473 7.39523 12.125 7.821C12.0037 7.97052 11.8886 8.12499 11.78 8.284L11.769 8.3V8.299C11.5892 8.58469 11.3182 8.80137 11 8.914V13H11.5C11.6326 13 11.7598 13.0527 11.8536 13.1464C11.9473 13.2402 12 13.3674 12 13.5C12 13.6326 11.9473 13.7598 11.8536 13.8536C11.7598 13.9473 11.6326 14 11.5 14H11V14.027C12.1002 14.15 13.1164 14.6742 13.8544 15.4995C14.5923 16.3247 15.0002 17.393 15 18.5C15 23.589 13.161 25.613 12.363 26.492C12.141 26.736 12 26.892 12 27V27.5C12 27.645 12.252 27.664 12.61 27.69C13.487 27.756 15 27.87 15 30H12.5C11.5 30 10.5 29 10.5 28.5C10.5 29 9.5 30 8.5 30H6C6 27.87 7.513 27.756 8.39 27.69C8.748 27.664 9 27.645 9 27.5V27C9 26.891 8.859 26.736 8.637 26.492C7.84 25.612 6 23.589 6 18.5C6.00003 17.3931 6.40801 16.3251 7.14594 15.5001C7.88387 14.6751 8.89998 14.151 10 14.028V14H9.5C9.36739 14 9.24021 13.9473 9.14645 13.8536C9.05268 13.7598 9 13.6326 9 13.5C9 13.3674 9.05268 13.2402 9.14645 13.1464C9.24021 13.0527 9.36739 13 9.5 13H10V8.915ZM21.5 17.5C20.7044 17.5 19.9413 17.8161 19.3787 18.3787C18.8161 18.9413 18.5 19.7044 18.5 20.5C18.5 21.2956 18.8161 22.0587 19.3787 22.6213C19.9413 23.1839 20.7044 23.5 21.5 23.5C22.2956 23.5 23.0587 23.1839 23.6213 22.6213C24.1839 22.0587 24.5 21.2956 24.5 20.5C24.5 19.7044 24.1839 18.9413 23.6213 18.3787C23.0587 17.8161 22.2956 17.5 21.5 17.5ZM14 18.5C14 17.5717 13.6313 16.6815 12.9749 16.0251C12.3185 15.3687 11.4283 15 10.5 15C9.57174 15 8.6815 15.3687 8.02513 16.0251C7.36875 16.6815 7 17.5717 7 18.5C7 19.4283 7.36875 20.3185 8.02513 20.9749C8.6815 21.6313 9.57174 22 10.5 22C11.4283 22 12.3185 21.6313 12.9749 20.9749C13.6313 20.3185 14 19.4283 14 18.5Z" fill="white"/>
        </svg>'
    ];

    return isset($icons[$type]) ? $icons[$type] : '';
}

function mytheme_enqueue_captain_styles() {
    if (is_page_template('page-captain.php')) {
        wp_enqueue_style(
            'captain-custom',
            get_template_directory_uri() . '/css/captain-custom.css',
            array(),
            filemtime(get_template_directory() . '/css/captain-custom.css')
        );
    }
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_captain_styles');
function mytheme_enqueue_access_styles() {
	if (is_page_template('page-access.php')) {
			wp_enqueue_style(
					'access-custom',
					get_template_directory_uri() . '/css/captain-custom.css',
					array(),
					filemtime(get_template_directory() . '/css/captain-custom.css')
			);
	}
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_access_styles');

function mytheme_enqueue_footer_styles() {
    wp_enqueue_style(
        'footer-custom',
        get_template_directory_uri() . '/css/footer-custom.css',
        array(),
        filemtime(get_template_directory() . '/css/footer-custom.css')
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_footer_styles');

function mytheme_enqueue_price_styles() {
    if (is_page_template('page-price.php')) {
        wp_enqueue_style(
            'captain-custom',
            get_template_directory_uri() . '/css/captain-custom.css',
            array(),
            filemtime(get_template_directory() . '/css/captain-custom.css')
        );
    }
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_price_styles');

function mytheme_enqueue_price_detail_styles() {
    if (is_page('price')) {
        wp_enqueue_style('price-detail-custom', get_template_directory_uri() . '/css/price-detail-custom.css', array(), '1.0.0');
    }
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_price_detail_styles');

// お知らせカスタム投稿タイプの追加
function create_news_post_type() {
    $labels = array(
        'name'               => 'お知らせ',
        'singular_name'      => 'お知らせ',
        'menu_name'          => 'お知らせ',
        'add_new'            => '新規追加',
        'add_new_item'       => '新規お知らせを追加',
        'edit_item'          => 'お知らせを編集',
        'new_item'           => '新しいお知らせ',
        'view_item'          => 'お知らせを表示',
        'search_items'       => 'お知らせを検索',
        'not_found'          => 'お知らせが見つかりませんでした',
        'not_found_in_trash' => 'ゴミ箱にお知らせが見つかりませんでした'
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'news'),
        'capability_type'    => 'post',
        'menu_icon'          => 'dashicons-megaphone',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'taxonomies'         => array('post_tag'),
        'menu_position'      => 5,
        'show_in_rest'       => true,
    );

    register_post_type('news', $args);
}
add_action('init', 'create_news_post_type');

// お知らせのカスタムタクソノミーを追加
function create_news_taxonomies() {
    $labels = array(
        'name'              => 'カテゴリー',
        'singular_name'     => 'カテゴリー',
        'search_items'      => 'カテゴリーを検索',
        'all_items'         => 'すべてのカテゴリー',
        'parent_item'       => '親カテゴリー',
        'parent_item_colon' => '親カテゴリー:',
        'edit_item'         => 'カテゴリーを編集',
        'update_item'       => 'カテゴリーを更新',
        'add_new_item'      => '新規カテゴリーを追加',
        'new_item_name'     => '新しいカテゴリー名',
        'menu_name'         => 'カテゴリー'
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => false
    );

    register_taxonomy('news_category', 'news', $args);
}
add_action('init', 'create_news_taxonomies');

// お知らせページのCSSを読み込む
function mytheme_enqueue_news_styles() {
    if (is_post_type_archive('news') || 
        is_post_type_archive('diary') || 
        is_post_type_archive('post') || is_home() || is_category() || is_tag() ||
        is_tax('fish_species') || is_date() || is_month() || is_year() ||
        (isset($_GET['post_type']) && $_GET['post_type'] == 'post')) {
        wp_enqueue_style('news-custom', get_template_directory_uri() . '/css/news-custom.css', array(), '1.0.0');
        
        // 階層構造アーカイブのJavaScriptを読み込む
        wp_enqueue_script('archive-toggle', get_template_directory_uri() . '/js/archive-toggle.js', array(), '1.0.0', true);
    }
    
    // 全ての個別ページ（釣果・お知らせ・日記）で統一CSSを読み込む
    if (is_singular('post') || is_singular('news') || is_singular('diary')) {
        wp_enqueue_style('single-post-custom', get_template_directory_uri() . '/css/single-post-custom.css', array(), '1.0.0');
        // サイドバー用のnews-customも読み込む
        wp_enqueue_style('news-custom', get_template_directory_uri() . '/css/news-custom.css', array(), '1.0.0');
        
        // 個別ページでもアーカイブJavaScriptを読み込む（サイドバー用）
        wp_enqueue_script('archive-toggle', get_template_directory_uri() . '/js/archive-toggle.js', array(), '1.0.0', true);
    }
    
    // 全ページでヘッダー・フッター・スクロールトップボタン・ハンバーガーメニューのCSSとJSを読み込む
    wp_enqueue_style('header-custom', get_template_directory_uri() . '/css/header-custom.css', array(), '1.0.0');
    wp_enqueue_style('footer-custom', get_template_directory_uri() . '/css/footer-custom.css', array(), '1.0.0');
    wp_enqueue_style('scroll-to-top', get_template_directory_uri() . '/css/scroll-to-top.css', array(), '1.0.0');
    wp_enqueue_script('scroll-to-top', get_template_directory_uri() . '/js/scroll-to-top.js', array(), '1.0.0', true);
    wp_enqueue_script('hamburger-menu', get_template_directory_uri() . '/js/hamburger-menu.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_news_styles');

// サイドバーのCSSを登録
function enqueue_sidebar_styles() {
    wp_enqueue_style('sidebar-custom', get_template_directory_uri() . '/css/sidebar-custom.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'enqueue_sidebar_styles');

// 魚種のカスタムタクソノミーを追加
function register_fish_species_taxonomy() {
    $labels = array(
        'name'              => '魚種',
        'singular_name'     => '魚種',
        'search_items'      => '魚種を検索',
        'all_items'         => 'すべての魚種',
        'parent_item'       => '親の魚種',
        'parent_item_colon' => '親の魚種:',
        'edit_item'         => '魚種を編集',
        'update_item'       => '魚種を更新',
        'add_new_item'      => '新しい魚種を追加',
        'new_item_name'     => '新しい魚種名',
        'menu_name'         => '魚種'
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => false,
        'show_in_rest'      => true,
        'show_in_menu'      => true,
        'menu_position'     => 5,
        'menu_icon'         => 'dashicons-fish',
    );

    register_taxonomy('fish_species', array('post'), $args);
}
add_action('init', 'register_fish_species_taxonomy');

// 管理画面のメニューに魚種を追加
function add_fish_species_menu() {
    add_menu_page(
        '魚種管理', // ページタイトル
        '魚種管理', // メニュータイトル
        'manage_options', // 権限
        'edit-tags.php?taxonomy=fish_species&post_type=post', // メニュースラッグ
        '', // コールバック関数（空でOK）
        'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJjdXJyZW50Q29sb3IiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBjbGFzcz0iZmVhdGhlciBmZWF0aGVyLWZpc2giPjxwYXRoIGQ9Ik0yMiAxMGMwIDYuNjI3LTUuMzczIDEyLTEyIDEyUzAgMTYuNjI3IDAgMTAgNS4zNzMgMCAxMiAwczEyIDQuMzczIDEyIDEweiIvPjxwYXRoIGQ9Ik0xMiAxNnYtNCIvPjxwYXRoIGQ9Ik0xMiA4VjgiLz48cGF0aCBkPSJNMTYgMTJjMCAyLjIxLTEuNzkxIDQtNCA0cy00LTEuNzkxLTQtNCAxLjc5MS00IDR6Ii8+PC9zdmc+', // カスタムSVGアイコン
        5 // 位置（投稿の下）
    );
}
add_action('admin_menu', 'add_fish_species_menu');

// 管理画面のスタイルを追加
function add_fish_species_admin_styles() {
    ?>
    <style>
        #adminmenu .toplevel_page_edit-tags-php-taxonomy-fish_species .wp-menu-image::before {
            content: '';
            background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZmZmIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIgY2xhc3M9ImZlYXRoZXIgZmVhdGhlci1maXNoIj48cGF0aCBkPSJNMjIgMTBjMCA2LjYyNy01LjM3MyAxMi0xMiAxMlMwIDE2LjYyNyAwIDEwIDUuMzczIDAgMTIgMHMxMiA0LjM3MyAxMiAxMHoiLz48cGF0aCBkPSJNMTIgMTZ2LTQiLz48cGF0aCBkPSJNMTIgOFY4Ii8+PHBhdGggZD0iTTE2IDEyYzAgMi4yMS0xLjc5MSA0LTQgNHMtNC0xLjc5MS00LTQgMS43OTEtNCA0LTQgNCAxLjc5MSA0IDR6Ii8+PC9zdmc+');
            background-size: 20px;
            background-position: center;
            background-repeat: no-repeat;
            width: 20px;
            height: 20px;
            display: inline-block;
            vertical-align: middle;
        }
        #adminmenu .toplevel_page_edit-tags-php-taxonomy-fish_species:hover .wp-menu-image::before {
            background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIgY2xhc3M9ImZlYXRoZXIgZmVhdGhlci1maXNoIj48cGF0aCBkPSJNMjIgMTBjMCA2LjYyNy01LjM3MyAxMi0xMiAxMlMwIDE2LjYyNyAwIDEwIDUuMzczIDAgMTIgMHMxMiA0LjM3MyAxMiAxMHoiLz48cGF0aCBkPSJNMTIgMTZ2LTQiLz48cGF0aCBkPSJNMTIgOFY4Ii8+PHBhdGggZD0iTTE2IDEyYzAgMi4yMS0xLjc5MSA0LTQgNHMtNC0xLjc5MS00LTQgMS43OTEtNCA0LTQgNCAxLjc5MSA0IDR6Ii8+PC9zdmc+');
        }
    </style>
    <?php
}
add_action('admin_head', 'add_fish_species_admin_styles');

// Facebook SDK読み込み
function add_facebook_sdk() {
    ?>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v18.0"></script>
    <?php
}
add_action('wp_footer', 'add_facebook_sdk');

/**
 * アーカイブページの投稿表示数を6件に制限
 */
function joemaru_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_archive() || is_home()) {
            $query->set('posts_per_page', 8);
        }
    }
}
add_action('pre_get_posts', 'joemaru_posts_per_page');

// きょうの日記カスタム投稿タイプ
function create_diary_post_type() {
    register_post_type('diary',
        array(
            'labels' => array(
                'name' => 'きょうの日記',
                'singular_name' => '日記',
                'add_new' => '新しい日記を追加',
                'add_new_item' => '新しい日記を追加',
                'edit_item' => '日記を編集',
                'new_item' => '新しい日記',
                'view_item' => '日記を表示',
                'search_items' => '日記を検索',
                'not_found' => '日記が見つかりません',
                'not_found_in_trash' => 'ゴミ箱に日記はありません',
                'menu_name' => 'きょうの日記'
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'diary'),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'taxonomies' => array('post_tag'),
            'menu_icon' => 'dashicons-edit-page',
            'show_in_rest' => true,
            'menu_position' => 6,
        )
    );
}
add_action('init', 'create_diary_post_type');

// 通常投稿のラベルを「釣果」に変更し、アーカイブスラッグを設定
function change_post_labels() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = '釣果';
    $labels->singular_name = '釣果';
    $labels->add_new = '新しい釣果を追加';
    $labels->add_new_item = '新しい釣果を追加';
    $labels->edit_item = '釣果を編集';
    $labels->new_item = '新しい釣果';
    $labels->view_item = '釣果を表示';
    $labels->search_items = '釣果を検索';
    $labels->not_found = '釣果が見つかりませんでした';
    $labels->not_found_in_trash = 'ゴミ箱に釣果はありません';
    $labels->all_items = 'すべての釣果';
    $labels->menu_name = '釣果';
    $labels->name_admin_bar = '釣果';
    
    // 通常投稿にアーカイブを有効にする（基本パーマリンクでは rewrite 不要）
    $wp_post_types['post']->has_archive = true;
    $wp_post_types['post']->show_in_rest = true;
}
add_action('admin_menu', 'change_post_labels');
add_action('init', 'change_post_labels');

// リライトルールをフラッシュする（テーマ有効化時）
function joemaru_flush_rewrite_rules() {
    // カスタム投稿タイプとタクソノミーを登録
    create_news_post_type();
    create_news_taxonomies();
    create_diary_post_type();
    register_fish_species_taxonomy();
    change_post_labels();
    
    // リライトルールをフラッシュ
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'joemaru_flush_rewrite_rules');

// 管理画面でパーマリンクを再保存するためのフック
function joemaru_force_flush_rewrite_rules() {
    if (isset($_GET['flush_rewrite_rules']) && $_GET['flush_rewrite_rules'] == '1') {
        flush_rewrite_rules();
        wp_redirect(admin_url('options-permalink.php?settings-updated=true'));
        exit;
    }
}
add_action('admin_init', 'joemaru_force_flush_rewrite_rules');

// パーマリンク設定ページにフラッシュボタンを追加
function joemaru_add_flush_button() {
    ?>
    <div class="wrap">
        <h3>リライトルールのフラッシュ</h3>
        <p>カスタム投稿タイプやページが404エラーになる場合は、以下のボタンをクリックしてください。</p>
        <a href="<?php echo admin_url('options-permalink.php?flush_rewrite_rules=1'); ?>" class="button button-primary">リライトルールをフラッシュ</a>
    </div>
    <?php
}
add_action('load-options-permalink.php', function() {
    add_action('admin_notices', 'joemaru_add_flush_button');
});

// 独自閲覧数カウント機能を無効化（count-per-dayプラグインに置き換え）
// function joemaru_count_page_views() {
//     // 管理者やボットのアクセスは除外
//     if (is_admin() || is_robots() || is_feed() || is_trackback()) {
//         return;
//     }
//     
//     // Ajaxリクエストは除外
//     if (defined('DOING_AJAX') && DOING_AJAX) {
//         return;
//     }
//     
//     // 今日の日付を取得
//     $today = date('Y-m-d');
//     $yesterday = date('Y-m-d', strtotime('-1 day'));
//     
//     // 総閲覧数を更新
//     $total_views = get_option('joemaru_total_views', 0);
//     $total_views++;
//     update_option('joemaru_total_views', $total_views);
//     
//     // 今日の閲覧数を更新
//     $today_views = get_option('joemaru_today_views_' . $today, 0);
//     $today_views++;
//     update_option('joemaru_today_views_' . $today, $today_views);
//     
//     // 昨日の閲覧数を保存（表示用）
//     $yesterday_views = get_option('joemaru_today_views_' . $yesterday, 0);
//     update_option('joemaru_yesterday_views', $yesterday_views);
//     
//     // 古いデータを削除（30日以上前）
//     $old_date = date('Y-m-d', strtotime('-30 days'));
//     delete_option('joemaru_today_views_' . $old_date);
// }
// add_action('wp', 'joemaru_count_page_views');

function joemaru_get_page_views() {
    // Count Per Dayプラグインの標準関数を優先的に使用
    if (function_exists('cpd_get_all_stats')) {
        $stats = cpd_get_all_stats();
        if ($stats && isset($stats['total'])) {
            $today = date('Y-m-d');
            $yesterday = date('Y-m-d', strtotime('-1 day'));
            
            // プラグインの標準関数で今日と昨日の統計を取得
            $today_views = function_exists('cpd_get_stats') ? cpd_get_stats($today) : 0;
            $yesterday_views = function_exists('cpd_get_stats') ? cpd_get_stats($yesterday) : 0;
            
            return array(
                'total' => (int)$stats['total'],
                'today' => (int)$today_views,
                'yesterday' => (int)$yesterday_views
            );
        }
    }
    
    // Count Per Dayプラグインのデータベースから直接取得を試行
    global $wpdb;
    
    // Count Per Dayのテーブル名（複数の可能性を試行）
    $possible_tables = array(
        $wpdb->prefix . 'cpd_counter',
        $wpdb->prefix . 'count_per_day',
        $wpdb->prefix . 'cpd_counterdata'
    );
    
    $cpd_table = null;
    foreach ($possible_tables as $table) {
        if ($wpdb->get_var("SHOW TABLES LIKE '$table'") == $table) {
            $cpd_table = $table;
            break;
        }
    }
    
    // テーブルが見つかった場合はデータを取得
    if ($cpd_table) {
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        
        // テーブル構造を確認して適切なクエリを実行
        $columns = $wpdb->get_results("DESCRIBE $cpd_table");
        $count_column = 'count';
        $date_column = 'date';
        
        // カラム名を確認
        foreach ($columns as $column) {
            if (strpos($column->Field, 'count') !== false) {
                $count_column = $column->Field;
            }
            if (strpos($column->Field, 'date') !== false) {
                $date_column = $column->Field;
            }
        }
        
        // 総閲覧数を取得
        $total_views = $wpdb->get_var("SELECT SUM($count_column) FROM $cpd_table");
        
        // 今日の閲覧数を取得
        $today_views = $wpdb->get_var($wpdb->prepare(
            "SELECT SUM($count_column) FROM $cpd_table WHERE $date_column = %s", 
            $today
        ));
        
        // 昨日の閲覧数を取得
        $yesterday_views = $wpdb->get_var($wpdb->prepare(
            "SELECT SUM($count_column) FROM $cpd_table WHERE $date_column = %s", 
            $yesterday
        ));
        
        return array(
            'total' => (int)$total_views,
            'today' => (int)$today_views,
            'yesterday' => (int)$yesterday_views
        );
    }
    
    // プラグインが無効またはデータが取得できない場合は既存データを返す
    $today = date('Y-m-d');
    $total_views = get_option('joemaru_total_views', 0);
    $today_views = get_option('joemaru_today_views_' . $today, 0);
    $yesterday_views = get_option('joemaru_yesterday_views', 0);
    
    return array(
        'total' => $total_views,
        'today' => $today_views,
        'yesterday' => $yesterday_views
    );
}

// Count Per Dayプラグイン用初期設定（テーマ有効化時）
function joemaru_init_page_views() {
    // Count Per Dayプラグインを使用するため、独自データベース初期化は不要
    // プラグインが管理するため、この関数は空にする
}
add_action('after_switch_theme', 'joemaru_init_page_views');

// 管理画面ダッシュボードに閲覧数ウィジェットを追加
function joemaru_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'joemaru_page_views_widget',
        'サイト閲覧数',
        'joemaru_dashboard_widget_content'
    );
}
add_action('wp_dashboard_setup', 'joemaru_add_dashboard_widget');

// ダッシュボードウィジェットの内容（Count Per Day対応）
function joemaru_dashboard_widget_content() {
    $page_views = joemaru_get_page_views();
    $today = date('Y年n月j日');
    $yesterday = date('Y年n月j日', strtotime('-1 day'));
    
    echo '<div style="padding: 10px;">';
    echo '<h4>📊 閲覧数統計（Count Per Day）</h4>';
    
    // Count Per Dayプラグインが有効かチェック
    if (function_exists('cpd_get_all_stats')) {
        echo '<table style="width: 100%; border-collapse: collapse;">';
        echo '<tr style="border-bottom: 1px solid #ddd;"><td style="padding: 8px;"><strong>総閲覧数</strong></td><td style="padding: 8px; text-align: right;"><strong>' . number_format($page_views['total']) . '</strong></td></tr>';
        echo '<tr style="border-bottom: 1px solid #ddd;"><td style="padding: 8px;">今日の閲覧数 (' . $today . ')</td><td style="padding: 8px; text-align: right;">' . number_format($page_views['today']) . '</td></tr>';
        echo '<tr><td style="padding: 8px;">昨日の閲覧数 (' . $yesterday . ')</td><td style="padding: 8px; text-align: right;">' . number_format($page_views['yesterday']) . '</td></tr>';
        echo '</table>';
        echo '<p style="margin-top: 15px; font-size: 12px; color: #666;">※ Count Per Dayプラグインのデータを使用</p>';
        
        // プラグイン設定へのリンクを追加
        echo '<p style="margin-top: 10px;"><a href="' . admin_url('admin.php?page=count-per-day') . '" style="text-decoration: none;">📈 詳細統計を見る</a></p>';
        
        // デバッグ情報を追加（管理者のみ表示）
        if (current_user_can('manage_options')) {
            echo '<div style="margin-top: 15px; padding: 10px; background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 4px;">';
            echo '<h5 style="margin: 0 0 10px 0; color: #495057;">🔧 デバッグ情報</h5>';
            echo '<p style="margin: 5px 0; font-size: 12px;"><strong>プラグイン関数:</strong> ' . (function_exists('cpd_get_all_stats') ? '有効' : '無効') . '</p>';
            echo '<p style="margin: 5px 0; font-size: 12px;"><strong>今日の日付:</strong> ' . date('Y-m-d') . '</p>';
            echo '<p style="margin: 5px 0; font-size: 12px;"><strong>昨日の日付:</strong> ' . date('Y-m-d', strtotime('-1 day')) . '</p>';
            
            // プラグインの生データを確認
            if (function_exists('cpd_get_all_stats')) {
                $raw_stats = cpd_get_all_stats();
                echo '<p style="margin: 5px 0; font-size: 12px;"><strong>生データ:</strong> ' . print_r($raw_stats, true) . '</p>';
            }
            echo '</div>';
        }
    } else {
        echo '<div style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 4px; padding: 10px; margin-bottom: 10px;">';
        echo '<p style="margin: 0; color: #856404;"><strong>⚠️ Count Per Dayプラグインが無効です</strong></p>';
        echo '<p style="margin: 5px 0 0 0; font-size: 12px; color: #856404;">プラグインを有効化すると、より詳細な統計が利用できます。</p>';
        echo '</div>';
        
        // 既存データがあれば表示
        if ($page_views['total'] > 0) {
            echo '<table style="width: 100%; border-collapse: collapse;">';
            echo '<tr style="border-bottom: 1px solid #ddd;"><td style="padding: 8px;"><strong>総閲覧数（旧データ）</strong></td><td style="padding: 8px; text-align: right;"><strong>' . number_format($page_views['total']) . '</strong></td></tr>';
            echo '<tr style="border-bottom: 1px solid #ddd;"><td style="padding: 8px;">今日の閲覧数 (' . $today . ')</td><td style="padding: 8px; text-align: right;">' . number_format($page_views['today']) . '</td></tr>';
            echo '<tr><td style="padding: 8px;">昨日の閲覧数 (' . $yesterday . ')</td><td style="padding: 8px; text-align: right;">' . number_format($page_views['yesterday']) . '</td></tr>';
            echo '</table>';
            echo '<p style="margin-top: 15px; font-size: 12px; color: #666;">※ 旧システムのデータです</p>';
        }
    }
    
    echo '</div>';
}
// 閲覧数リセット機能を無効化（Count Per Dayプラグインを使用）
// function joemaru_reset_page_views() {
//     if (isset($_GET['reset_views']) && $_GET['reset_views'] === '1' && current_user_can('manage_options')) {
//         update_option('joemaru_total_views', 0);
//         $today = date('Y-m-d');
//         update_option('joemaru_today_views_' . $today, 0);
//         update_option('joemaru_yesterday_views', 0);
        
//         wp_redirect(admin_url('index.php?views_reset=1'));
//         exit;
//     }
// }
// add_action('admin_init', 'joemaru_reset_page_views');

// Facebook SDK読み込み（改良版）
function joemaru_enqueue_facebook_sdk() {
    // Facebook SDK初期化スクリプト（より確実な方法）
    $facebook_init_script = "
    // Facebook SDK初期化
    window.fbAsyncInit = function() {
        FB.init({
            xfbml: true,
            version: 'v18.0'
        });
        
        // 初期化完了後にページプラグインを解析
        FB.XFBML.parse();
    };
    
    // Facebook SDK読み込み（複数の方法でフォールバック）
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); 
        js.id = id;
        js.async = true;
        js.defer = true;
        js.crossOrigin = 'anonymous';
        js.src = 'https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v18.0';
        
        // エラーハンドリング
        js.onerror = function() {
            console.log('Facebook SDK読み込み失敗 - 代替手段を試行');
            // 英語版SDKで再試行
            var jsEn = d.createElement(s);
            jsEn.id = id + '_en';
            jsEn.async = true;
            jsEn.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0';
            fjs.parentNode.insertBefore(jsEn, fjs);
        };
        
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    ";
    
    // スクリプトをフッターに追加
    wp_add_inline_script('wp-includes-js', $facebook_init_script);
}
add_action('wp_enqueue_scripts', 'joemaru_enqueue_facebook_sdk');

/**
 * 管理画面のタイトルを「丈丸渡船」に変更
 */
function joemaru_admin_title($admin_title, $title) {
    return '丈丸渡船 - ' . $admin_title;
}
add_filter('admin_title', 'joemaru_admin_title', 10, 2);

/**
 * ログイン画面のタイトルを「丈丸渡船」に変更
 */
function joemaru_login_title($login_title) {
    return '丈丸渡船 - ' . $login_title;
}
add_filter('login_title', 'joemaru_login_title');

// 年別・月別アーカイブを階層構造で取得する関数
function get_hierarchical_archives($post_type = 'post') {
    global $wpdb;
    
    // 投稿タイプに応じたテーブル名を設定
    $table_name = $wpdb->posts;
    
    // 年別の投稿数を取得
    $years_query = $wpdb->prepare("
        SELECT YEAR(post_date) as year, COUNT(*) as count
        FROM {$table_name}
        WHERE post_type = %s AND post_status = 'publish'
        GROUP BY YEAR(post_date)
        ORDER BY year DESC
    ", $post_type);
    
    $years = $wpdb->get_results($years_query);
    
    $archive_data = array();
    
    foreach ($years as $year_data) {
        $year = $year_data->year;
        $year_count = $year_data->count;
        
        // 月別の投稿数を取得
        $months_query = $wpdb->prepare("
            SELECT MONTH(post_date) as month, COUNT(*) as count
            FROM {$table_name}
            WHERE post_type = %s AND post_status = 'publish' AND YEAR(post_date) = %d
            GROUP BY MONTH(post_date)
            ORDER BY month DESC
        ", $post_type, $year);
        
        $months = $wpdb->get_results($months_query);
        
        $months_data = array();
        foreach ($months as $month_data) {
            $month = $month_data->month;
            $month_count = $month_data->count;
            
            // 月別アーカイブのURLを生成
            if ($post_type === 'post') {
                $month_url = get_month_link($year, $month);
            } else {
                $month_url = add_query_arg(array(
                    'post_type' => $post_type,
                    'year' => $year,
                    'monthnum' => $month
                ), home_url('/'));
            }
            
            $months_data[] = array(
                'month' => $month,
                'month_name' => date_i18n('n月', mktime(0, 0, 0, $month, 1, $year)),
                'count' => $month_count,
                'url' => $month_url
            );
        }
        
        // 年別アーカイブのURLを生成
        if ($post_type === 'post') {
            $year_url = get_year_link($year);
        } else {
            $year_url = add_query_arg(array(
                'post_type' => $post_type,
                'year' => $year
            ), home_url('/'));
        }
        
        $archive_data[] = array(
            'year' => $year,
            'count' => $year_count,
            'url' => $year_url,
            'months' => $months_data
        );
    }
    
    return $archive_data;
}

// タグサポート追加後のリライトルール更新
function joemaru_update_taxonomies() {
    // お知らせと日記にタグサポートを追加
    register_taxonomy_for_object_type('post_tag', 'news');
    register_taxonomy_for_object_type('post_tag', 'diary');
}
add_action('init', 'joemaru_update_taxonomies', 15);

// カスタムSEOメタタグとOGタグを追加
function joemaru_custom_meta_tags() {
    // ページ別のメタデータを設定
    $meta_data = joemaru_get_page_meta_data();
    
    if ($meta_data) {
        ?>
        <!-- カスタムメタタグ -->
        <meta name="description" content="<?php echo esc_attr($meta_data['description']); ?>">
        <meta name="keywords" content="<?php echo esc_attr($meta_data['keywords']); ?>">
        <meta name="robots" content="index, follow">
        
        <!-- Canonical -->
        <link rel="canonical" href="<?php echo esc_url($meta_data['canonical']); ?>">
        
        <!-- Favicon -->
        <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/h1-icon.png">
        
        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="<?php echo esc_attr($meta_data['title']); ?>">
        <meta name="twitter:description" content="<?php echo esc_attr($meta_data['description']); ?>">
        <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/images/h1-icon.png">
        
        <!-- Open Graph -->
        <meta property="og:site_name" content="丈丸渡船">
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?php echo esc_attr($meta_data['title']); ?>">
        <meta property="og:description" content="<?php echo esc_attr($meta_data['description']); ?>">
        <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/images/insta-fish.jpg">
        <meta property="og:url" content="<?php echo esc_url($meta_data['canonical']); ?>">
        
        <?php if (is_front_page()) : ?>
        <!-- 構造化データ: LocalBusiness (FishingBoat) -->
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "FishingBoat",
          "name": "丈丸渡船",
          "image": "<?php echo get_template_directory_uri(); ?>/images/h1-icon.png",
          "@id": "<?php echo esc_url(home_url('/')); ?>",
          "url": "<?php echo esc_url(home_url('/')); ?>",
          "telephone": "090-1417-9322",
          "priceRange": "¥4,000〜¥15,000",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "曽根町149",
            "addressLocality": "尾鷲市",
            "addressRegion": "三重県",
            "postalCode": "519-3924",
            "addressCountry": "JP"
          },
          "openingHours": "Mo-Su 07:00-20:00",
          "description": "三重県賀田湾でカセ・筏釣り、ルアー五目が楽しめる完全チャーター制の渡船サービス。初心者歓迎、釣果重視の玄人にも対応。"
        }
        </script>
        <?php endif; ?>
        
        <!-- 構造化データ: パンくずリスト -->
        <script type="application/ld+json">
        <?php echo json_encode($meta_data['breadcrumb'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
        </script>
        <?php
    }
}

// ページ別メタデータを取得する関数
function joemaru_get_page_meta_data() {
    $base_keywords = "丈丸渡船,賀田湾,尾鷲市,三重県,釣り,渡船,チャーター船";
    
    if (is_front_page()) {
        return array(
            'title' => '賀田インターから約5分の丈丸渡船 – 賀田湾でカセ筏釣り',
            'description' => '三重県尾鷲・賀田湾で一年中チヌ釣り！春はアオリイカ、秋冬は青物も。賀田インターから車で5分、筏・カセ・チャーター釣りが楽しめる丈丸渡船。初心者も安心のサポートで釣りデビューにも最適。',
            'keywords' => $base_keywords . ',カセ釣り,筏釣り,チヌ釣り,アオリイカ,青物,釣り初心者歓迎',
            'canonical' => home_url('/'),
            'breadcrumb' => array(
                "@context" => "https://schema.org",
                "@type" => "BreadcrumbList",
                "itemListElement" => array(
                    array(
                        "@type" => "ListItem",
                        "position" => 1,
                        "name" => "ホーム",
                        "item" => home_url('/')
                    )
                )
            )
        );
    } elseif (is_page('price')) {
        return array(
            'title' => '料金について – 丈丸渡船｜賀田湾の筏・カセ・チャーター釣りプラン',
            'description' => '丈丸渡船では、筏・カセ釣りやチャーター船など、初心者やファミリーにも最適なプランを明確な料金でご案内。賀田湾でゆったり釣り体験を。',
            'keywords' => $base_keywords . ',料金,カセ釣り料金,筏釣り料金,チャーター料金,釣り船料金',
            'canonical' => get_permalink(),
            'breadcrumb' => array(
                "@context" => "https://schema.org",
                "@type" => "BreadcrumbList",
                "itemListElement" => array(
                    array("@type" => "ListItem", "position" => 1, "name" => "ホーム", "item" => home_url('/')),
                    array("@type" => "ListItem", "position" => 2, "name" => "料金について", "item" => get_permalink())
                )
            )
        );
    } elseif (is_page('access')) {
        return array(
            'title' => 'アクセス – 丈丸渡船｜賀田インターから車で約5分・駐車場完備',
            'description' => '丈丸渡船までのアクセス方法をご案内。賀田インターから車で5分、ナビ検索や駐車場情報、周辺目印も掲載中。',
            'keywords' => $base_keywords . ',アクセス,地図,駐車場,賀田インター,曽根町,道順,車',
            'canonical' => get_permalink(),
            'breadcrumb' => array(
                "@context" => "https://schema.org",
                "@type" => "BreadcrumbList",
                "itemListElement" => array(
                    array("@type" => "ListItem", "position" => 1, "name" => "ホーム", "item" => home_url('/')),
                    array("@type" => "ListItem", "position" => 2, "name" => "アクセス", "item" => get_permalink())
                )
            )
        );
    } elseif (is_page('captain')) {
        return array(
            'title' => '船長紹介 – 丈丸渡船｜賀田湾を知り尽くす父子船頭のご案内',
            'description' => '三重県・賀田湾で船を操る親子船長をご紹介。ベテラン船頭・村田丈幸と若船頭・京が、丁寧な案内と安心のサポートで皆さまをお迎えします。',
            'keywords' => $base_keywords . ',船長,船長紹介,釣りガイド,ベテラン船長,釣り指導',
            'canonical' => get_permalink(),
            'breadcrumb' => array(
                "@context" => "https://schema.org",
                "@type" => "BreadcrumbList",
                "itemListElement" => array(
                    array("@type" => "ListItem", "position" => 1, "name" => "ホーム", "item" => home_url('/')),
                    array("@type" => "ListItem", "position" => 2, "name" => "船長紹介", "item" => get_permalink())
                )
            )
        );
    } elseif (is_post_type_archive('post') || is_home()) {
        return array(
            'title' => '賀田湾の最新釣果 – 丈丸渡船｜チヌ・アオリイカ・青物の実績情報',
            'description' => '丈丸渡船の最新釣果情報を随時更新中。賀田湾でのチヌ釣り、青物、アオリイカなどの実績を写真付きで紹介。初心者の方も釣果の参考に！',
            'keywords' => $base_keywords . ',釣果,釣果情報,チヌ,アオリイカ,青物,釣り結果,魚種',
            'canonical' => get_post_type_archive_link('post'),
            'breadcrumb' => array(
                "@context" => "https://schema.org",
                "@type" => "BreadcrumbList",
                "itemListElement" => array(
                    array("@type" => "ListItem", "position" => 1, "name" => "ホーム", "item" => home_url('/')),
                    array("@type" => "ListItem", "position" => 2, "name" => "釣果一覧", "item" => get_post_type_archive_link('post'))
                )
            )
        );
    } elseif (is_post_type_archive('news')) {
        return array(
            'title' => 'お知らせ – 丈丸渡船｜営業情報・メディア掲載・臨時休業など',
            'description' => '丈丸渡船からのお知らせ一覧。営業日・キャンペーン・臨時休業などの最新情報を随時更新中。初めての方も事前チェックにおすすめ。',
            'keywords' => $base_keywords . ',お知らせ,営業情報,運航状況,イベント,最新情報',
            'canonical' => get_post_type_archive_link('news'),
            'breadcrumb' => array(
                "@context" => "https://schema.org",
                "@type" => "BreadcrumbList",
                "itemListElement" => array(
                    array("@type" => "ListItem", "position" => 1, "name" => "ホーム", "item" => home_url('/')),
                    array("@type" => "ListItem", "position" => 2, "name" => "お知らせ", "item" => get_post_type_archive_link('news'))
                )
            )
        );
    } elseif (is_post_type_archive('diary')) {
        return array(
            'title' => 'きょうの日記 – 丈丸渡船｜賀田湾の釣り日記と自然の記録',
            'description' => '賀田湾での釣り日和を写真と共に綴る船長の「きょうの日記」。日々の釣果や自然の変化を気ままに発信中。',
            'keywords' => $base_keywords . ',船長日記,海況情報,釣り日記,日々の記録,賀田湾情報',
            'canonical' => get_post_type_archive_link('diary'),
            'breadcrumb' => array(
                "@context" => "https://schema.org",
                "@type" => "BreadcrumbList",
                "itemListElement" => array(
                    array("@type" => "ListItem", "position" => 1, "name" => "ホーム", "item" => home_url('/')),
                    array("@type" => "ListItem", "position" => 2, "name" => "きょうの日記", "item" => get_post_type_archive_link('diary'))
                )
            )
        );
    } elseif (is_tag()) {
        $tag = get_queried_object();
        $tag_name = $tag->name;
        return array(
            'title' => '「' . $tag_name . '」のタグ一覧 – 丈丸渡船｜賀田湾での釣果・お知らせを絞り込み',
            'description' => '「' . $tag_name . '」に関連する釣果や日記、お知らせを一覧で表示。賀田湾での釣り体験をタグごとにまとめてチェック！',
            'keywords' => $base_keywords . ',' . $tag_name . ',記事一覧,関連記事,釣り情報',
            'canonical' => get_tag_link($tag->term_id),
            'breadcrumb' => array(
                "@context" => "https://schema.org",
                "@type" => "BreadcrumbList",
                "itemListElement" => array(
                    array("@type" => "ListItem", "position" => 1, "name" => "ホーム", "item" => home_url('/')),
                    array("@type" => "ListItem", "position" => 2, "name" => "タグ: " . $tag_name, "item" => get_tag_link($tag->term_id))
                )
            )
        );
    } elseif (is_tax('fish_species')) {
        $term = get_queried_object();
        $fish_name = $term->name;
        return array(
            'title' => '「' . $fish_name . '」の釣果一覧 – 丈丸渡船｜賀田湾で釣りを楽しむ',
            'description' => '丈丸渡船での「' . $fish_name . '」の釣果一覧。賀田湾で釣れる' . $fish_name . 'の最新釣果情報、釣り方のコツ、おすすめポイントなどをご紹介します。',
            'keywords' => $base_keywords . ',' . $fish_name . ',釣果,魚種,釣り方,ポイント',
            'canonical' => get_term_link($term),
            'breadcrumb' => array(
                "@context" => "https://schema.org",
                "@type" => "BreadcrumbList",
                "itemListElement" => array(
                    array("@type" => "ListItem", "position" => 1, "name" => "ホーム", "item" => home_url('/')),
                    array("@type" => "ListItem", "position" => 2, "name" => "釣果一覧", "item" => get_post_type_archive_link('post')),
                    array("@type" => "ListItem", "position" => 3, "name" => $fish_name, "item" => get_term_link($term))
                )
            )
        );
    } elseif (is_category()) {
        $category = get_queried_object();
        $cat_name = $category->name;
        return array(
            'title' => '「' . $cat_name . '」カテゴリの記事一覧 – 丈丸渡船｜賀田湾で釣りを楽しむ',
            'description' => '丈丸渡船の「' . $cat_name . '」カテゴリの記事一覧。賀田湾での釣りに関する' . $cat_name . 'の情報や最新記事をお届けします。',
            'keywords' => $base_keywords . ',' . $cat_name . ',カテゴリ,記事一覧,釣り情報',
            'canonical' => get_category_link($category->term_id),
            'breadcrumb' => array(
                "@context" => "https://schema.org",
                "@type" => "BreadcrumbList",
                "itemListElement" => array(
                    array("@type" => "ListItem", "position" => 1, "name" => "ホーム", "item" => home_url('/')),
                    array("@type" => "ListItem", "position" => 2, "name" => "カテゴリ: " . $cat_name, "item" => get_category_link($category->term_id))
                )
            )
        );
    } elseif (is_single()) {
        $post = get_queried_object();
        $post_title = $post->post_title;
        $post_type = $post->post_type;
        
        if ($post_type === 'post') {
            $archive_name = '釣果一覧';
            $archive_url = get_post_type_archive_link('post');
        } elseif ($post_type === 'news') {
            $archive_name = 'お知らせ';
            $archive_url = get_post_type_archive_link('news');
        } elseif ($post_type === 'diary') {
            $archive_name = 'きょうの日記';
            $archive_url = get_post_type_archive_link('diary');
        } else {
            $archive_name = '記事一覧';
            $archive_url = home_url('/');
        }
        
        return array(
            'title' => $post_title . ' – 丈丸渡船｜賀田湾で釣りを楽しむ',
            'description' => get_the_excerpt($post) ?: '丈丸渡船の記事「' . $post_title . '」をご覧ください。賀田湾での釣りに関する最新情報をお届けします。',
            'keywords' => $base_keywords . ',' . $post_title . ',個別記事,詳細情報',
            'canonical' => get_permalink($post),
            'breadcrumb' => array(
                "@context" => "https://schema.org",
                "@type" => "BreadcrumbList",
                "itemListElement" => array(
                    array("@type" => "ListItem", "position" => 1, "name" => "ホーム", "item" => home_url('/')),
                    array("@type" => "ListItem", "position" => 2, "name" => $archive_name, "item" => $archive_url),
                    array("@type" => "ListItem", "position" => 3, "name" => $post_title, "item" => get_permalink($post))
                )
            )
        );
    }
    
    return false;
}
add_action('wp_head', 'joemaru_custom_meta_tags');

// カスタムタイトルタグ（全ページ対応）
function joemaru_custom_title($title) {
    $meta_data = joemaru_get_page_meta_data();
    if ($meta_data) {
        return $meta_data['title'];
    }
    return $title;
}
add_filter('pre_get_document_title', 'joemaru_custom_title');

// Instagram フィード取得機能（手動管理型）
function joemaru_get_instagram_data() {
    $instagram_username = 'joemaru_mrtk';
    
    // 管理画面で設定された手動データを優先
    $manual_data = get_option('joemaru_instagram_manual_data');
    if (!empty($manual_data) && is_array($manual_data)) {
        return $manual_data;
    }
    
    // デフォルトデータ（手動設定がない場合）
    $instagram_data = array(
        'success' => true,
        'method' => 'manual',
        'profile_image' => get_template_directory_uri() . '/images/murata.png',
        'username' => $instagram_username,
        'latest_post' => array(
            'image_url' => get_template_directory_uri() . '/images/fish.png',
            'caption' => '賀田湾で今日も素晴らしい釣果でした🎣 最新の情報はInstagramをご覧ください！',
            'permalink' => "https://www.instagram.com/{$instagram_username}/",
            'timestamp' => current_time('c')
        )
    );
    
    return $instagram_data;
}

// Instagram設定ページを管理画面に追加
function joemaru_instagram_admin_menu() {
    add_options_page(
        'Instagram設定', 
        'Instagram設定',
        'manage_options',
        'joemaru-instagram-settings',
        'joemaru_instagram_settings_page'
    );
}
add_action('admin_menu', 'joemaru_instagram_admin_menu');

// Instagram設定ページ
function joemaru_instagram_settings_page() {
    if (isset($_POST['submit'])) {
        // 手動データの保存
        $manual_data = array(
            'success' => true,
            'method' => 'manual',
            'profile_image' => esc_url_raw($_POST['profile_image']),
            'username' => 'joemaru_mrtk',
            'latest_post' => array(
                'image_url' => esc_url_raw($_POST['post_image']),
                'caption' => sanitize_textarea_field($_POST['caption']),
                'permalink' => esc_url_raw($_POST['permalink'] ?: 'https://www.instagram.com/joemaru_mrtk/'),
                'timestamp' => current_time('c')
            )
        );
        
        update_option('joemaru_instagram_manual_data', $manual_data);
        echo '<div class="notice notice-success"><p>Instagram投稿データを更新しました！</p></div>';
    }
    
    // 現在のデータを取得
    $current_data = get_option('joemaru_instagram_manual_data', array());
    $profile_image = $current_data['profile_image'] ?? '';
    $post_image = $current_data['latest_post']['image_url'] ?? '';
    $caption = $current_data['latest_post']['caption'] ?? '';
    $permalink = $current_data['latest_post']['permalink'] ?? '';
    ?>
    <div class="wrap">
        <h1>Instagram設定</h1>
        <p>実際のInstagramの最新投稿に合わせて、サイドバーの表示を手動で更新できます。</p>
        
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row">プロフィール画像URL</th>
                    <td>
                        <input type="url" name="profile_image" value="<?php echo esc_attr($profile_image); ?>" class="regular-text" placeholder="https://example.com/profile.jpg" />
                        <p class="description">Instagramのプロフィール画像のURLを入力してください。</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">最新投稿画像URL</th>
                    <td>
                        <input type="url" name="post_image" value="<?php echo esc_attr($post_image); ?>" class="regular-text" placeholder="https://example.com/post.jpg" required />
                        <p class="description">最新投稿の画像URLを入力してください。（必須）</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">キャプション</th>
                    <td>
                        <textarea name="caption" rows="4" class="large-text" placeholder="本日の釣果です🎣"><?php echo esc_textarea($caption); ?></textarea>
                        <p class="description">投稿のキャプションを入力してください。</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">投稿リンク</th>
                    <td>
                        <input type="url" name="permalink" value="<?php echo esc_attr($permalink); ?>" class="regular-text" placeholder="https://www.instagram.com/p/ABC123/" />
                        <p class="description">実際の投稿のURLを入力してください。（任意）</p>
                    </td>
                </tr>
            </table>
            <?php submit_button('Instagram投稿を更新'); ?>
        </form>
        
        <h2>現在の表示内容</h2>
        <?php $instagram_data = joemaru_get_instagram_data(); ?>
        <div style="background: #f9f9f9; padding: 15px; border-radius: 5px; margin: 15px 0;">
            <div style="display: flex; align-items: center; margin-bottom: 10px;">
                <img src="<?php echo esc_url($instagram_data['profile_image']); ?>" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;" alt="プロフィール" />
                <strong><?php echo esc_html($instagram_data['username']); ?></strong>
            </div>
            
            <?php if (!empty($instagram_data['latest_post']['image_url'])): ?>
            <p><strong>投稿画像:</strong></p>
            <img src="<?php echo esc_url($instagram_data['latest_post']['image_url']); ?>" style="max-width: 300px; height: auto; border-radius: 8px;" alt="最新投稿" />
            <?php endif; ?>
            
            <?php if (!empty($instagram_data['latest_post']['caption'])): ?>
            <p><strong>キャプション:</strong><br>
            <?php echo nl2br(esc_html($instagram_data['latest_post']['caption'])); ?></p>
            <?php endif; ?>
        </div>
        
        <h3>画像のアップロード方法</h3>
        <ol>
            <li><strong>メディアライブラリ</strong>から画像をアップロード</li>
            <li>アップロードした画像の<strong>URL</strong>をコピー</li>
            <li>上記フォームの<strong>「最新投稿画像URL」</strong>に貼り付け</li>
            <li>または、Instagramの画像を<strong>右クリック → 「画像のURLをコピー」</strong></li>
        </ol>
        
        <p><a href="<?php echo admin_url('upload.php'); ?>" class="button">メディアライブラリを開く</a></p>
    </div>
    <?php
}

// Instagram データ管理機能
function joemaru_clear_instagram_cache() {
    // 手動管理なので特別な処理は不要
    return true;
}

// 管理画面でInstagram管理ボタンを追加
add_action('admin_bar_menu', function($wp_admin_bar) {
    if (current_user_can('manage_options')) {
        $wp_admin_bar->add_node(array(
            'id' => 'instagram-settings',
            'title' => '丈丸渡船',
            'href' => admin_url('options-general.php?page=joemaru-instagram-settings'),
        ));
    }
});

// Facebook Graph API 設定
function joemaru_facebook_settings_init() {
    add_settings_section(
        'joemaru_facebook_settings',
        'Facebook API設定',
        'joemaru_facebook_settings_callback',
        'joemaru-facebook-settings'
    );

    add_settings_field(
        'joemaru_facebook_page_id',
        'FacebookページID',
        'joemaru_facebook_page_id_callback',
        'joemaru-facebook-settings',
        'joemaru_facebook_settings'
    );

    add_settings_field(
        'joemaru_facebook_access_token',
        'ページアクセストークン',
        'joemaru_facebook_access_token_callback',
        'joemaru-facebook-settings',
        'joemaru_facebook_settings'
    );

    register_setting('joemaru_facebook_settings', 'joemaru_facebook_page_id');
    register_setting('joemaru_facebook_settings', 'joemaru_facebook_access_token');
}
add_action('admin_init', 'joemaru_facebook_settings_init');

// Facebook設定ページを管理メニューに追加
function joemaru_facebook_admin_menu() {
    add_options_page(
        'Facebook設定',
        'Facebook設定',
        'manage_options',
        'joemaru-facebook-settings',
        'joemaru_facebook_settings_page'
    );
}
add_action('admin_menu', 'joemaru_facebook_admin_menu');

// Facebook設定ページの表示
function joemaru_facebook_settings_page() {
    ?>
    <div class="wrap">
        <h1>Facebook API設定</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('joemaru_facebook_settings');
            do_settings_sections('joemaru-facebook-settings');
            submit_button();
            ?>
        </form>
        
        <div style="margin-top: 30px; padding: 20px; background: #f0f8ff; border-radius: 8px;">
            <h3>📋 設定手順</h3>
            <ol>
                <li><strong>Meta for Developers</strong>で新しいアプリを作成</li>
                <li><strong>Facebookページ</strong>をビジネスアカウントに変更</li>
                <li><strong>Graph API Explorer</strong>でページアクセストークンを取得</li>
                <li>上記のフィールドにページIDとアクセストークンを入力</li>
            </ol>
            
            <h4>🔗 参考リンク</h4>
            <ul>
                <li><a href="https://developers.facebook.com/" target="_blank">Meta for Developers</a></li>
                <li><a href="https://developers.facebook.com/tools/explorer/" target="_blank">Graph API Explorer</a></li>
            </ul>
        </div>
        
        <?php
        // テスト表示
        $page_id = get_option('joemaru_facebook_page_id');
        $access_token = get_option('joemaru_facebook_access_token');
        
        if ($page_id && $access_token) {
            echo '<div style="margin-top: 20px; padding: 15px; background: #e8f5e8; border-radius: 8px;">';
            echo '<h3>📱 プレビュー</h3>';
            
            $facebook_data = joemaru_get_facebook_data();
            if ($facebook_data && $facebook_data['success']) {
                echo '<p>✅ API接続成功！最新投稿を取得できました。</p>';
                echo '<p><strong>投稿数:</strong> ' . count($facebook_data['posts']) . '件</p>';
            } else {
                echo '<p>❌ API接続に失敗しました。設定を確認してください。</p>';
            }
            echo '</div>';
        }
        ?>
    </div>
    <?php
}

function joemaru_facebook_settings_callback() {
    echo '<p>Facebook Graph APIを使用して投稿を自動取得するための設定です。</p>';
}

function joemaru_facebook_page_id_callback() {
    $value = get_option('joemaru_facebook_page_id');
    echo '<input type="text" name="joemaru_facebook_page_id" value="' . esc_attr($value) . '" style="width: 300px;" placeholder="例: 123456789012345" />';
    echo '<p class="description">FacebookページのページIDを入力してください。</p>';
}

function joemaru_facebook_access_token_callback() {
    $value = get_option('joemaru_facebook_access_token');
    echo '<input type="password" name="joemaru_facebook_access_token" value="' . esc_attr($value) . '" style="width: 500px;" placeholder="ページアクセストークンを入力" />';
    echo '<p class="description">Facebook Graph API Explorer で取得したページアクセストークンを入力してください。</p>';
}

// Facebook投稿データを取得
function joemaru_get_facebook_data() {
    $page_id = get_option('joemaru_facebook_page_id');
    $access_token = get_option('joemaru_facebook_access_token');
    
    if (empty($page_id) || empty($access_token)) {
        return array('success' => false, 'method' => 'no_settings');
    }
    
    // キャッシュをチェック（12時間）
    $cache_key = 'joemaru_facebook_data_' . md5($page_id);
    $cached_data = get_transient($cache_key);
    
    if ($cached_data !== false) {
        $cached_data['method'] = 'cached_api';
        return $cached_data;
    }
    
    // Graph API でページ情報と投稿を取得
    $url = "https://graph.facebook.com/v18.0/{$page_id}";
    $params = array(
        'fields' => 'name,picture.width(200).height(200),posts.limit(5){message,created_time,picture,permalink_url,attachments}',
        'access_token' => $access_token
    );
    
    $request_url = $url . '?' . http_build_query($params);
    $response = wp_remote_get($request_url, array(
        'timeout' => 15,
        'headers' => array(
            'User-Agent' => 'WordPress/' . get_bloginfo('version')
        )
    ));
    
    if (is_wp_error($response)) {
        return array('success' => false, 'method' => 'api_error');
    }
    
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);
    
    if (!$data || isset($data['error'])) {
        return array('success' => false, 'method' => 'api_error', 'error' => $data['error'] ?? 'Unknown error');
    }
    
    // データを整形
    $result = array(
        'success' => true,
        'method' => 'api',
        'page_name' => $data['name'] ?? '',
        'page_image' => $data['picture']['data']['url'] ?? '',
        'posts' => array()
    );
    
    if (isset($data['posts']['data']) && !empty($data['posts']['data'])) {
        foreach ($data['posts']['data'] as $post) {
            if (empty($post['message'])) continue; // メッセージがない投稿はスキップ
            
            $post_data = array(
                'message' => $post['message'],
                'created_time' => $post['created_time'],
                'permalink' => $post['permalink_url'] ?? '',
                'picture' => ''
            );
            
            // 画像を取得
            if (isset($post['picture'])) {
                $post_data['picture'] = $post['picture'];
            } elseif (isset($post['attachments']['data'][0]['media']['image']['src'])) {
                $post_data['picture'] = $post['attachments']['data'][0]['media']['image']['src'];
            }
            
            $result['posts'][] = $post_data;
        }
    }
    
    // 12時間キャッシュ
    set_transient($cache_key, $result, 12 * HOUR_IN_SECONDS);
    
    return $result;
}

// 自動アイキャッチ画像設定機能
function joemaru_auto_set_featured_image($post_id) {
    // 自動保存やリビジョンは除外
    if (wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
        return;
    }
    
    // 既にアイキャッチ画像が設定されている場合は処理しない
    if (has_post_thumbnail($post_id)) {
        return;
    }
    
    // 投稿タイプが post, news, diary のみ対象
    $post_type = get_post_type($post_id);
    if (!in_array($post_type, array('post', 'news', 'diary'))) {
        return;
    }
    
    // 投稿内容を取得
    $post = get_post($post_id);
    $content = $post->post_content;
    
    // 投稿内容から最初の画像のURLを抽出
    $first_image = joemaru_get_first_image_from_content($content);
    
    if ($first_image) {
        // 画像URLから添付ファイルIDを取得
        $attachment_id = joemaru_get_attachment_id_by_url($first_image);
        
        if ($attachment_id) {
            // アイキャッチ画像として設定
            set_post_thumbnail($post_id, $attachment_id);
        }
    }
}

// 投稿保存時にアイキャッチ画像を自動設定
add_action('save_post', 'joemaru_auto_set_featured_image');

// 投稿内容から最初の画像URLを取得する関数
function joemaru_get_first_image_from_content($content) {
    // WordPressの画像ブロック（Gutenberg）から抽出
    if (preg_match('/<!-- wp:image.*?-->(.*?)<!-- \/wp:image -->/s', $content, $matches)) {
        if (preg_match('/<img[^>]+src="([^"]+)"/', $matches[1], $img_matches)) {
            return $img_matches[1];
        }
    }
    
    // 通常のimgタグから抽出
    if (preg_match('/<img[^>]+src="([^"]+)"/i', $content, $matches)) {
        return $matches[1];
    }
    
    // WordPressのメディア添付ファイルURLパターンから抽出
    if (preg_match('/wp-content\/uploads\/[^"\s]+\.(jpg|jpeg|png|gif|webp)/i', $content, $matches)) {
        return $matches[0];
    }
    
    return false;
}

// 画像URLから添付ファイルIDを取得する関数
function joemaru_get_attachment_id_by_url($image_url) {
    global $wpdb;
    
    // 相対URLの場合は絶対URLに変換
    if (strpos($image_url, 'http') !== 0) {
        $image_url = home_url($image_url);
    }
    
    // データベースから添付ファイルIDを検索
    $attachment_id = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->posts} WHERE guid = %s AND post_type = 'attachment'",
        $image_url
    ));
    
    if (!$attachment_id) {
        // ファイル名のみで検索を試行
        $filename = basename($image_url);
        $attachment_id = $wpdb->get_var($wpdb->prepare(
            "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_wp_attached_file' AND meta_value LIKE %s",
            '%' . $wpdb->esc_like($filename)
        ));
    }
    
    return $attachment_id;
}

// 既存投稿にアイキャッチ画像を一括設定する関数（管理画面で手動実行用）
function joemaru_bulk_set_featured_images() {
    // 管理者権限チェック
    if (!current_user_can('manage_options')) {
        wp_die('権限がありません');
    }
    
    // アイキャッチ画像が設定されていない投稿を取得
    $posts = get_posts(array(
        'post_type' => array('post', 'news', 'diary'),
        'post_status' => 'publish',
        'numberposts' => -1,
        'meta_query' => array(
            array(
                'key' => '_thumbnail_id',
                'compare' => 'NOT EXISTS'
            )
        )
    ));
    
    $updated_count = 0;
    
    foreach ($posts as $post) {
        // 投稿内容から最初の画像を取得
        $first_image = joemaru_get_first_image_from_content($post->post_content);
        
        if ($first_image) {
            $attachment_id = joemaru_get_attachment_id_by_url($first_image);
            
            if ($attachment_id) {
                set_post_thumbnail($post->ID, $attachment_id);
                $updated_count++;
            }
        }
    }
    
    // 結果をメッセージで表示
    add_action('admin_notices', function() use ($updated_count) {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p>' . $updated_count . '件の投稿にアイキャッチ画像を設定しました。</p>';
        echo '</div>';
    });
}

// 管理画面にアイキャッチ一括設定ボタンを追加
function joemaru_add_bulk_featured_image_button() {
    add_management_page(
        'アイキャッチ画像一括設定',
        'アイキャッチ一括設定',
        'manage_options',
        'bulk-featured-images',
        'joemaru_bulk_featured_images_page'
    );
}
add_action('admin_menu', 'joemaru_add_bulk_featured_image_button');

// 管理画面ページの表示
function joemaru_bulk_featured_images_page() {
    if (isset($_POST['bulk_set_featured_images']) && wp_verify_nonce($_POST['bulk_featured_nonce'], 'bulk_set_featured_images')) {
        joemaru_bulk_set_featured_images();
    }
    
    // アイキャッチなしの投稿数を取得
    $posts_without_thumbnail = get_posts(array(
        'post_type' => array('post', 'news', 'diary'),
        'post_status' => 'publish',
        'numberposts' => -1,
        'meta_query' => array(
            array(
                'key' => '_thumbnail_id',
                'compare' => 'NOT EXISTS'
            )
        ),
        'fields' => 'ids'
    ));
    
    $count = count($posts_without_thumbnail);
    ?>
    <div class="wrap">
        <h1>アイキャッチ画像一括設定</h1>
        <p>記事内の最初の画像を自動的にアイキャッチ画像として設定します。</p>
        
        <div class="notice notice-info">
            <p><strong>対象投稿数:</strong> <?php echo $count; ?>件</p>
            <p>アイキャッチ画像が設定されていない投稿（釣果・お知らせ・日記）が対象です。</p>
        </div>
        
        <?php if ($count > 0) : ?>
            <form method="post" onsubmit="return confirm('<?php echo $count; ?>件の投稿を処理します。実行しますか？');">
                <?php wp_nonce_field('bulk_set_featured_images', 'bulk_featured_nonce'); ?>
                <p class="submit">
                    <input type="submit" name="bulk_set_featured_images" class="button-primary" value="アイキャッチ画像を一括設定">
                </p>
            </form>
        <?php else : ?>
            <p>アイキャッチ画像が未設定の投稿はありません。</p>
        <?php endif; ?>
        
        <h2>機能説明</h2>
        <ul>
            <li>新しく投稿を作成・更新する際、記事内に画像があればアイキャッチ画像として自動設定されます</li>
            <li>既にアイキャッチ画像が設定されている投稿は変更されません</li>
            <li>記事内の最初に出現する画像が使用されます</li>
            <li>Gutenbergエディタとクラシックエディタの両方に対応しています</li>
        </ul>
    </div>
<?php
}
/**
 * PDF管理機能
 * フッターの業務規程PDFをCMS上で管理できるようにする
 */

// PDF管理用のカスタムフィールドを追加
function joemaru_add_pdf_management_fields() {
    add_settings_section(
        'pdf_management_section',
        'PDF管理設定',
        'joemaru_pdf_management_section_callback',
        'general'
    );

    add_settings_field(
        'footer_pdf_file',
        '業務規程PDFファイル',
        'joemaru_footer_pdf_field_callback',
        'general',
        'pdf_management_section'
    );

    register_setting('general', 'footer_pdf_file');
}
add_action('admin_init', 'joemaru_add_pdf_management_fields');

// PDF管理セクションの説明
function joemaru_pdf_management_section_callback() {
    echo '<p>フッターに表示される業務規程PDFファイルを管理します。ファイルをアップロードすると、既存のファイルが自動的に置き換えられます。</p>';
}

// PDFファイルアップロードフィールド
function joemaru_footer_pdf_field_callback() {
    $current_pdf = get_option('footer_pdf_file');
    
    echo '<div class="pdf-upload-container">';
    
    // 現在のPDFファイルの表示
    if ($current_pdf) {
        $pdf_url = wp_get_attachment_url($current_pdf);
        $pdf_filename = basename($pdf_url);
        echo '<div class="current-pdf-info">';
        echo '<strong>現在のPDF:</strong> ';
        echo '<a href="' . esc_url($pdf_url) . '" target="_blank">' . esc_html($pdf_filename) . '</a>';
        echo ' <a href="' . esc_url($pdf_url) . '" download class="button button-small">ダウンロード</a>';
        echo '</div>';
    } else {
        echo '<div class="current-pdf-info">';
        echo '<strong>現在のPDF:</strong> 設定されていません';
        echo '</div>';
    }
    
    echo '<br>';
    
    // ファイルアップロードフィールド
    echo '<input type="file" name="footer_pdf_upload" id="footer_pdf_upload" accept=".pdf" />';
    echo '<input type="hidden" name="footer_pdf_file" id="footer_pdf_file" value="' . esc_attr($current_pdf) . '" />';
    
    echo '<p class="description">PDFファイルを選択してアップロードしてください。既存のファイルは自動的に置き換えられます。</p>';
    
    echo '</div>';
    
    // JavaScript for file upload handling
    echo '<script>
    jQuery(document).ready(function($) {
        $("#footer_pdf_upload").on("change", function() {
            var file = this.files[0];
            if (file) {
                var formData = new FormData();
                formData.append("action", "upload_footer_pdf");
                formData.append("footer_pdf_file", file);
                formData.append("nonce", "' . wp_create_nonce('upload_footer_pdf_nonce') . '");
                
                $.ajax({
                    url: ajaxurl,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $("#footer_pdf_file").val(response.data.attachment_id);
                            $(".current-pdf-info").html("<strong>現在のPDF:</strong> " + file.name + " <a href=\"" + response.data.url + "\" target=\"_blank\">" + file.name + "</a> <a href=\"" + response.data.url + "\" download class=\"button button-small\">ダウンロード</a>");
                            alert("PDFファイルが正常にアップロードされました。");
                        } else {
                            alert("エラー: " + response.data);
                        }
                    },
                    error: function() {
                        alert("アップロード中にエラーが発生しました。");
                    }
                });
            }
        });
    });
    </script>';
}

// PDFファイルアップロード処理
function joemaru_upload_footer_pdf() {
    // セキュリティチェック
    if (!wp_verify_nonce($_POST['nonce'], 'upload_footer_pdf_nonce')) {
        wp_die('セキュリティチェックに失敗しました。');
    }
    
    if (!current_user_can('manage_options')) {
        wp_die('権限がありません。');
    }
    
    // ファイルチェック
    if (!isset($_FILES['footer_pdf_file']) || $_FILES['footer_pdf_file']['error'] !== UPLOAD_ERR_OK) {
        wp_send_json_error('ファイルのアップロードに失敗しました。');
    }
    
    $file = $_FILES['footer_pdf_file'];
    
    // ファイル形式チェック
    $allowed_types = array('application/pdf');
    $file_type = wp_check_filetype($file['name']);
    
    if (!in_array($file_type['type'], $allowed_types)) {
        wp_send_json_error('PDFファイルのみアップロード可能です。');
    }
    
    // ファイルサイズチェック（10MB制限）
    if ($file['size'] > 10 * 1024 * 1024) {
        wp_send_json_error('ファイルサイズは10MB以下にしてください。');
    }
    
    // 既存のPDFファイルを削除
    $existing_pdf = get_option('footer_pdf_file');
    if ($existing_pdf) {
        wp_delete_attachment($existing_pdf, true);
    }
    
    // 新しいファイルをアップロード
    $upload = wp_handle_upload($file, array('test_form' => false));
    
    if (isset($upload['error'])) {
        wp_send_json_error('ファイルのアップロードに失敗しました: ' . $upload['error']);
    }
    
    // メディアライブラリに追加
    $attachment = array(
        'post_mime_type' => $upload['type'],
        'post_title' => sanitize_file_name($file['name']),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    
    $attachment_id = wp_insert_attachment($attachment, $upload['file']);
    
    if (is_wp_error($attachment_id)) {
        wp_send_json_error('メディアライブラリへの追加に失敗しました。');
    }
    
    // メタデータを生成
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attachment_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
    wp_update_attachment_metadata($attachment_id, $attachment_data);
    
    // オプションを更新
    update_option('footer_pdf_file', $attachment_id);
    
    wp_send_json_success(array(
        'attachment_id' => $attachment_id,
        'url' => $upload['url'],
        'filename' => $file['name']
    ));
}
add_action('wp_ajax_upload_footer_pdf', 'joemaru_upload_footer_pdf');

// PDFファイルのURLを取得する関数
function joemaru_get_footer_pdf_url() {
    $pdf_id = get_option('footer_pdf_file');
    if ($pdf_id) {
        return wp_get_attachment_url($pdf_id);
    }
    return false;
}

// PDFファイル名を取得する関数
function joemaru_get_footer_pdf_filename() {
    $pdf_id = get_option('footer_pdf_file');
    if ($pdf_id) {
        $pdf_url = wp_get_attachment_url($pdf_id);
        return basename($pdf_url);
    }
    return false;
}

// 管理画面にPDF管理メニューを追加
function joemaru_add_pdf_management_menu() {
    // トップレベルメニューとして追加
    add_menu_page(
        'PDF管理',
        'PDF管理',
        'manage_options',
        'pdf-management',
        'joemaru_pdf_management_page',
        'dashicons-pdf',
        30
    );
    
    // サブメニューも残す（一般設定内）
    add_submenu_page(
        'options-general.php',
        'PDF管理',
        'PDF管理',
        'manage_options',
        'pdf-management-settings',
        'joemaru_pdf_management_page'
    );
}
add_action('admin_menu', 'joemaru_add_pdf_management_menu');

// ダッシュボードにPDF管理ウィジェットを追加
function joemaru_add_pdf_dashboard_widget() {
    wp_add_dashboard_widget(
        'pdf_management_widget',
        '📄 業務規程PDF管理',
        'joemaru_pdf_dashboard_widget_content'
    );
}
add_action('wp_dashboard_setup', 'joemaru_add_pdf_dashboard_widget');

// ダッシュボードウィジェットの内容
function joemaru_pdf_dashboard_widget_content() {
    $current_pdf = get_option('footer_pdf_file');
    
    echo '<div style="padding: 10px 0;">';
    
    if ($current_pdf) {
        $pdf_url = wp_get_attachment_url($current_pdf);
        $pdf_filename = basename($pdf_url);
        
        echo '<div style="background: #dff0d8; border: 1px solid #d6e9c6; padding: 10px; border-radius: 4px; margin-bottom: 15px;">';
        echo '<strong>✅ 現在のPDF:</strong> ' . esc_html($pdf_filename);
        echo '</div>';
        
        echo '<p><a href="' . esc_url($pdf_url) . '" target="_blank" class="button button-primary">PDFを確認</a></p>';
    } else {
        echo '<div style="background: #f2dede; border: 1px solid #ebccd1; padding: 10px; border-radius: 4px; margin-bottom: 15px;">';
        echo '<strong>⚠️ 注意:</strong> PDFファイルが設定されていません';
        echo '</div>';
    }
    
    echo '<p><a href="' . admin_url('admin.php?page=pdf-management') . '" class="button button-secondary">PDF管理ページへ</a></p>';
    echo '<p><a href="' . admin_url('options-general.php') . '" class="button button-secondary">一般設定で管理</a></p>';
    
    echo '</div>';
}

// 管理バーにPDF管理メニューを追加
function joemaru_add_pdf_admin_bar_menu($wp_admin_bar) {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    $current_pdf = get_option('footer_pdf_file');
    $pdf_status = $current_pdf ? '設定済み' : '未設定';
    
    // メインメニュー
    $wp_admin_bar->add_menu(array(
        'id' => 'pdf-management',
        'title' => '📄 PDF管理 (' . $pdf_status . ')',
        'href' => admin_url('admin.php?page=pdf-management'),
        'meta' => array(
            'title' => '業務規程PDFファイルを管理'
        )
    ));
    
    // サブメニュー
    $wp_admin_bar->add_menu(array(
        'parent' => 'pdf-management',
        'id' => 'pdf-management-page',
        'title' => 'PDF管理ページ',
        'href' => admin_url('admin.php?page=pdf-management')
    ));
    
    $wp_admin_bar->add_menu(array(
        'parent' => 'pdf-management',
        'id' => 'pdf-settings',
        'title' => '一般設定で管理',
        'href' => admin_url('options-general.php')
    ));
    
    if ($current_pdf) {
        $pdf_url = wp_get_attachment_url($current_pdf);
        $wp_admin_bar->add_menu(array(
            'parent' => 'pdf-management',
            'id' => 'pdf-view',
            'title' => '現在のPDFを確認',
            'href' => $pdf_url,
            'meta' => array(
                'target' => '_blank'
            )
        ));
    }
}
add_action('admin_bar_menu', 'joemaru_add_pdf_admin_bar_menu', 100);

// PDF管理ページ用のスタイルを追加
function joemaru_pdf_management_admin_styles() {
    $screen = get_current_screen();
    if ($screen && ($screen->id === 'settings_page_pdf-management' || $screen->id === 'options-general')) {
        echo '<style>
        .pdf-upload-container {
            background: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 10px 0;
        }
        .current-pdf-info {
            background: #fff;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .current-pdf-info a {
            text-decoration: none;
        }
        .current-pdf-info .button {
            margin-left: 10px;
        }
        #footer_pdf_upload {
            margin: 10px 0;
            padding: 10px;
            border: 2px dashed #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }
        #footer_pdf_upload:hover {
            border-color: #0073aa;
        }
        .pdf-management-card {
            background: #fff;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 1px 1px rgba(0,0,0,.04);
        }
        .pdf-management-card h2 {
            margin-top: 0;
            color: #23282d;
        }
        .pdf-status {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }
        .pdf-status.active {
            background: #dff0d8;
            color: #3c763d;
        }
        .pdf-status.inactive {
            background: #f2dede;
            color: #a94442;
        }
        </style>';
    }
}
add_action('admin_head', 'joemaru_pdf_management_admin_styles');

// PDF管理ページの内容
function joemaru_pdf_management_page() {
    if (!current_user_can('manage_options')) {
        wp_die('権限がありません。');
    }
    
    echo '<div class="wrap">';
    echo '<h1>PDF管理</h1>';
    echo '<p>フッターに表示される業務規程PDFファイルを管理します。</p>';
    
    $current_pdf = get_option('footer_pdf_file');
    
    if ($current_pdf) {
        $pdf_url = wp_get_attachment_url($current_pdf);
        $pdf_filename = basename($pdf_url);
        
        echo '<div class="pdf-management-card">';
        echo '<h2>現在のPDFファイル</h2>';
        echo '<p><span class="pdf-status active">アクティブ</span></p>';
        echo '<p><strong>ファイル名:</strong> ' . esc_html($pdf_filename) . '</p>';
        echo '<p><strong>URL:</strong> <a href="' . esc_url($pdf_url) . '" target="_blank">' . esc_url($pdf_url) . '</a></p>';
        echo '<p><a href="' . esc_url($pdf_url) . '" download class="button button-primary">PDFをダウンロード</a></p>';
        echo '</div>';
    } else {
        echo '<div class="pdf-management-card">';
        echo '<h2>現在のPDFファイル</h2>';
        echo '<p><span class="pdf-status inactive">未設定</span></p>';
        echo '<p>PDFファイルが設定されていません。デフォルトのPDFファイルが表示されます。</p>';
        echo '</div>';
    }
    
    echo '<div class="pdf-management-card">';
    echo '<h2>PDFファイルの更新</h2>';
    echo '<p>新しいPDFファイルをアップロードするには、<a href="' . admin_url('options-general.php') . '">一般設定</a>ページの「PDF管理設定」セクションをご利用ください。</p>';
    echo '<p><a href="' . admin_url('options-general.php') . '" class="button button-secondary">一般設定ページへ</a></p>';
    echo '</div>';
    
    echo '</div>';
}
