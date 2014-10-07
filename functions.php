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
	register_post_type( 'missionary',
		array(
			'supports' => array(
				'title',
				'editor',
				'revisions',
				'thumbnail',
				'author'
			),
            'taxonomies' => array( 'country' ),
			'labels' => array(
				'name' => __( 'Missionaries' ),
				'singular_name' => __( 'Missionary' ),
				'add_new_item' => __( 'Add New Missionary' ),
				'edit_item' => __( 'Edit Missionary' ),
				'new_item' => __( 'New Missionary' ),
				'view_item' => __( 'View Missionary' ),
				'search_items' => __( 'Search Missionaries' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'ministries/missions', 'with_front' => 'false' ),
			'capability_type' => 'edit_post',
            'menu_icon' => 'dashicons-businessman'
		)
	);
}
add_action( 'init', 'create_missionary_post' );

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
