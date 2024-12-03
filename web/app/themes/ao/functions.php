<?php
/**
 * Adventure Outdoors Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Adventure_Outdoors_Theme
 */

function ao_setup() {
  add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'ao_setup');

/**
 * Custom Post Types
 */
require get_template_directory() . '/post-types/activity.php';

/**
 * Taxonomy
 */
require get_template_directory() . '/taxonomies/age.php';
require get_template_directory() . '/taxonomies/destination.php';
require get_template_directory() . '/taxonomies/level.php';
require get_template_directory() . '/taxonomies/season.php';
require get_template_directory() . '/taxonomies/type.php';
require get_template_directory() . '/taxonomies/time.php';

function allow_cors_headers() {
  // Make sure you replace 'http://localhost:4321' with your actual Astro dev server URL
  $allowed_origins = array(
    'http://localhost:4321',
    'http://localhost:3000',
    'http://192.168.2.200:4321',
    'https://aowp.wildroar.dev',
    'https://aoastro.vercel.app'
  );

  if ( isset( $_SERVER['HTTP_ORIGIN'] ) && in_array( $_SERVER['HTTP_ORIGIN'], $allowed_origins ) ) {
    header( "Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN'] );
    header( "Access-Control-Allow-Methods: GET, POST, OPTIONS" );
    header( "Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization" );
    header( 'Access-Control-Allow-Credentials: true' );

    // Handle preflight requests
    if ( $_SERVER['REQUEST_METHOD'] == 'OPTIONS' ) {
      status_header( 200 );
      exit();
    }
  }
}

// Add the headers to REST API requests
add_action( 'rest_api_init', function () {
  remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
  add_filter( 'rest_pre_serve_request', function ( $value ) {
    allow_cors_headers();

    return $value;
  } );
} );

// Optional: Add headers to all requests (if you need CORS for non-REST endpoints)
add_action( 'init', 'allow_cors_headers' );
