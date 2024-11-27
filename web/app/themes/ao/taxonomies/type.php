<?php

/**
 * Registers the `type` taxonomy,
 * for use with 'activity'.
 */
function type_init() {
	register_taxonomy( 'type', [ 'activity' ], [
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
			'name'                       => __( 'Activity Types', 'ao' ),
			'singular_name'              => _x( 'Activity Type', 'taxonomy general name', 'ao' ),
			'search_items'               => __( 'Search Activity Types', 'ao' ),
			'popular_items'              => __( 'Popular Activity Types', 'ao' ),
			'all_items'                  => __( 'All Activity Types', 'ao' ),
			'parent_item'                => __( 'Parent Activity Type', 'ao' ),
			'parent_item_colon'          => __( 'Parent Activity Type:', 'ao' ),
			'edit_item'                  => __( 'Edit Activity Type', 'ao' ),
			'update_item'                => __( 'Update Activity Type', 'ao' ),
			'view_item'                  => __( 'View Activity Type', 'ao' ),
			'add_new_item'               => __( 'Add New Activity Type', 'ao' ),
			'new_item_name'              => __( 'New Activity Type', 'ao' ),
			'separate_items_with_commas' => __( 'Separate Activity Types with commas', 'ao' ),
			'add_or_remove_items'        => __( 'Add or remove Activity Types', 'ao' ),
			'choose_from_most_used'      => __( 'Choose from the most used Activity Types', 'ao' ),
			'not_found'                  => __( 'No Activity Types found.', 'ao' ),
			'no_terms'                   => __( 'No Activity Types', 'ao' ),
			'menu_name'                  => __( 'Activity Types', 'ao' ),
			'items_list_navigation'      => __( 'Activity Types list navigation', 'ao' ),
			'items_list'                 => __( 'Activity Types list', 'ao' ),
			'most_used'                  => _x( 'Most Used', 'type', 'ao' ),
			'back_to_items'              => __( '&larr; Back to Activity Types', 'ao' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'type',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'type_init' );

/**
 * Sets the post updated messages for the `type` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `type` taxonomy.
 */
function type_updated_messages( $messages ) {

	$messages['type'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Activity Type added.', 'ao' ),
		2 => __( 'Activity Type deleted.', 'ao' ),
		3 => __( 'Activity Type updated.', 'ao' ),
		4 => __( 'Activity Type not added.', 'ao' ),
		5 => __( 'Activity Type not updated.', 'ao' ),
		6 => __( 'Activity Types deleted.', 'ao' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'type_updated_messages' );
