<?php

/**
 * Registers the `time` taxonomy,
 * for use with 'activity'.
 */
function time_init() {
	register_taxonomy( 'time', [ 'activity' ], [
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
			'name'                       => __( 'Times', 'ao' ),
			'singular_name'              => _x( 'Time', 'taxonomy general name', 'ao' ),
			'search_items'               => __( 'Search Times', 'ao' ),
			'popular_items'              => __( 'Popular Times', 'ao' ),
			'all_items'                  => __( 'All Times', 'ao' ),
			'parent_item'                => __( 'Parent Time', 'ao' ),
			'parent_item_colon'          => __( 'Parent Time:', 'ao' ),
			'edit_item'                  => __( 'Edit Time', 'ao' ),
			'update_item'                => __( 'Update Time', 'ao' ),
			'view_item'                  => __( 'View Time', 'ao' ),
			'add_new_item'               => __( 'Add New Time', 'ao' ),
			'new_item_name'              => __( 'New Time', 'ao' ),
			'separate_items_with_commas' => __( 'Separate Times with commas', 'ao' ),
			'add_or_remove_items'        => __( 'Add or remove Times', 'ao' ),
			'choose_from_most_used'      => __( 'Choose from the most used Times', 'ao' ),
			'not_found'                  => __( 'No Times found.', 'ao' ),
			'no_terms'                   => __( 'No Times', 'ao' ),
			'menu_name'                  => __( 'Times', 'ao' ),
			'items_list_navigation'      => __( 'Times list navigation', 'ao' ),
			'items_list'                 => __( 'Times list', 'ao' ),
			'most_used'                  => _x( 'Most Used', 'time', 'ao' ),
			'back_to_items'              => __( '&larr; Back to Times', 'ao' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'time',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'time_init' );

/**
 * Sets the post updated messages for the `time` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `time` taxonomy.
 */
function time_updated_messages( $messages ) {

	$messages['time'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Time added.', 'ao' ),
		2 => __( 'Time deleted.', 'ao' ),
		3 => __( 'Time updated.', 'ao' ),
		4 => __( 'Time not added.', 'ao' ),
		5 => __( 'Time not updated.', 'ao' ),
		6 => __( 'Times deleted.', 'ao' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'time_updated_messages' );
