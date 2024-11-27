<?php

/**
 * Registers the `destination` taxonomy,
 * for use with 'activity'.
 */
function destination_init() {
	register_taxonomy( 'destination', [ 'activity' ], [
		'hierarchical'          => false,
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_admin_column'     => false,
		'query_var'             => true,
		'rewrite'               => true,
		'capabilities'          => [
			'manage_terms' => 'edit_posts',
			'edit_terms'   => 'edit_posts',
			'delete_terms' => 'edit_posts',
			'assign_terms' => 'edit_posts',
		],
		'labels'                => [
			'name'                       => __( 'Destinations', 'twentytwentyfive' ),
			'singular_name'              => _x( 'Destination', 'taxonomy general name', 'twentytwentyfive' ),
			'search_items'               => __( 'Search Destinations', 'twentytwentyfive' ),
			'popular_items'              => __( 'Popular Destinations', 'twentytwentyfive' ),
			'all_items'                  => __( 'All Destinations', 'twentytwentyfive' ),
			'parent_item'                => __( 'Parent Destination', 'twentytwentyfive' ),
			'parent_item_colon'          => __( 'Parent Destination:', 'twentytwentyfive' ),
			'edit_item'                  => __( 'Edit Destination', 'twentytwentyfive' ),
			'update_item'                => __( 'Update Destination', 'twentytwentyfive' ),
			'view_item'                  => __( 'View Destination', 'twentytwentyfive' ),
			'add_new_item'               => __( 'Add New Destination', 'twentytwentyfive' ),
			'new_item_name'              => __( 'New Destination', 'twentytwentyfive' ),
			'separate_items_with_commas' => __( 'Separate destinations with commas', 'twentytwentyfive' ),
			'add_or_remove_items'        => __( 'Add or remove destinations', 'twentytwentyfive' ),
			'choose_from_most_used'      => __( 'Choose from the most used destinations', 'twentytwentyfive' ),
			'not_found'                  => __( 'No destinations found.', 'twentytwentyfive' ),
			'no_terms'                   => __( 'No destinations', 'twentytwentyfive' ),
			'menu_name'                  => __( 'Destinations', 'twentytwentyfive' ),
			'items_list_navigation'      => __( 'Destinations list navigation', 'twentytwentyfive' ),
			'items_list'                 => __( 'Destinations list', 'twentytwentyfive' ),
			'most_used'                  => _x( 'Most Used', 'destination', 'twentytwentyfive' ),
			'back_to_items'              => __( '&larr; Back to Destinations', 'twentytwentyfive' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'destination',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'destination_init' );

/**
 * Sets the post updated messages for the `destination` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `destination` taxonomy.
 */
function destination_updated_messages( $messages ) {

	$messages['destination'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Destination added.', 'twentytwentyfive' ),
		2 => __( 'Destination deleted.', 'twentytwentyfive' ),
		3 => __( 'Destination updated.', 'twentytwentyfive' ),
		4 => __( 'Destination not added.', 'twentytwentyfive' ),
		5 => __( 'Destination not updated.', 'twentytwentyfive' ),
		6 => __( 'Destinations deleted.', 'twentytwentyfive' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'destination_updated_messages' );
