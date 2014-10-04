<?php

include('functions-branding.php');
include('functions-church.php');

/* deregister Bitter and Open Sans webfonts */
function deregister_default_fonts() {
    wp_deregister_style( 'twentythirteen-fonts' );
}
add_action( 'wp_enqueue_scripts', 'deregister_default_fonts', 100 );

/* add sidebar in header */
if ( function_exists( 'register_sidebar' ) ) {
    $header_sidebar_args = array(
        'name'          => 'Header Widget Area',
        'id'            => 'theme-header',
        'description'   => 'Appears in the header of the site.',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
    );
    register_sidebar( $header_sidebar_args );
}

// register modernizr custom build
function register_modernizr() {
    wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/js/modernizr.custom.17706.js' );
}
add_action( 'wp_enqueue_scripts', 'register_modernizr' );
