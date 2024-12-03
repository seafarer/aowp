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
			'name'                       => __( 'Destinations', 'ao' ),
			'singular_name'              => _x( 'Destination', 'taxonomy general name', 'ao' ),
			'search_items'               => __( 'Search Destinations', 'ao' ),
			'popular_items'              => __( 'Popular Destinations', 'ao' ),
			'all_items'                  => __( 'All Destinations', 'ao' ),
			'parent_item'                => __( 'Parent Destination', 'ao' ),
			'parent_item_colon'          => __( 'Parent Destination:', 'ao' ),
			'edit_item'                  => __( 'Edit Destination', 'ao' ),
			'update_item'                => __( 'Update Destination', 'ao' ),
			'view_item'                  => __( 'View Destination', 'ao' ),
			'add_new_item'               => __( 'Add New Destination', 'ao' ),
			'new_item_name'              => __( 'New Destination', 'ao' ),
			'separate_items_with_commas' => __( 'Separate destinations with commas', 'ao' ),
			'add_or_remove_items'        => __( 'Add or remove destinations', 'ao' ),
			'choose_from_most_used'      => __( 'Choose from the most used destinations', 'ao' ),
			'not_found'                  => __( 'No destinations found.', 'ao' ),
			'no_terms'                   => __( 'No destinations', 'ao' ),
			'menu_name'                  => __( 'Destinations', 'ao' ),
			'items_list_navigation'      => __( 'Destinations list navigation', 'ao' ),
			'items_list'                 => __( 'Destinations list', 'ao' ),
			'most_used'                  => _x( 'Most Used', 'destination', 'ao' ),
			'back_to_items'              => __( '&larr; Back to Destinations', 'ao' ),
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
		1 => __( 'Destination added.', 'ao' ),
		2 => __( 'Destination deleted.', 'ao' ),
		3 => __( 'Destination updated.', 'ao' ),
		4 => __( 'Destination not added.', 'ao' ),
		5 => __( 'Destination not updated.', 'ao' ),
		6 => __( 'Destinations deleted.', 'ao' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'destination_updated_messages' );
