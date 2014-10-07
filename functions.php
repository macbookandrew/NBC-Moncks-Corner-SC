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

// Add missionaries custom post type
function create_missionary_post() {

	$labels = array(
		'name'                => 'Missionaries',
		'singular_name'       => 'Missionary',
		'menu_name'           => 'Missionaries',
		'parent_item_colon'   => 'Parent Missionary:',
		'all_items'           => 'All Missionaries',
		'view_item'           => 'View Missionary',
		'add_new_item'        => 'Add New Missionary',
		'add_new'             => 'Add New',
		'edit_item'           => 'Edit Missionary',
		'update_item'         => 'Update Missionary',
		'search_items'        => 'Search Missionary',
		'not_found'           => 'Not found',
		'not_found_in_trash'  => 'Not found in Trash',
	);
	$rewrite = array(
		'slug'                => 'ministries/missions/',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => 'missionary',
		'description'         => 'Missionaries',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', ),
		'taxonomies'          => array( 'country' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 25,
		'menu_icon'           => 'dashicons-businessman',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'missionary', $args );

}
// Hook into the 'init' action
add_action( 'init', 'create_missionary_post', 0 );

// add country taxonomy
function missionary_country() {

	$labels = array(
		'name'                       => 'Countries',
		'singular_name'              => 'Country',
		'menu_name'                  => 'Country',
		'all_items'                  => 'All Countries',
		'parent_item'                => 'Parent Country',
		'parent_item_colon'          => 'Parent Country:',
		'new_item_name'              => 'New Country Name',
		'add_new_item'               => 'Add New Country',
		'edit_item'                  => 'Edit Country',
		'update_item'                => 'Update Country',
		'separate_items_with_commas' => 'Separate countries with commas',
		'search_items'               => 'Search Countries',
		'add_or_remove_items'        => 'Add or remove countries',
		'choose_from_most_used'      => 'Choose from the most used countries',
		'not_found'                  => 'Not Found',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'country', array( 'missionary' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'missionary_country', 0 );

// add Modernizr: svg
add_action( 'wp_enqueue_scripts', 'enqueue_modernizr' );
function enqueue_modernizr() {
    wp_enqueue_script( 'modernizr-svg', get_stylesheet_directory_uri() . '/js/modernizr.svg.js' );
}

// load flag webicons only on missionary pages
//if ( is_post_type_archive( 'missionary' ) || is_singular( 'missionary' ) ) {
    function enqueue_flag_webicons() {
        wp_enqueue_style( 'flag-webicons', get_stylesheet_directory_uri() . '/css/flag-webicons.css' );
    }
    add_action( 'wp_enqueue_scripts', 'enqueue_flag_webicons' );
//}
