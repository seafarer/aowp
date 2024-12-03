<?php

/**
 * Registers the `age` taxonomy,
 * for use with 'activity'.
 */
function age_init() {
	register_taxonomy( 'age', [ 'activity' ], [
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
			'name'                       => __( 'Ages', 'ao' ),
			'singular_name'              => _x( 'Age', 'taxonomy general name', 'ao' ),
			'search_items'               => __( 'Search Ages', 'ao' ),
			'popular_items'              => __( 'Popular Ages', 'ao' ),
			'all_items'                  => __( 'All Ages', 'ao' ),
			'parent_item'                => __( 'Parent Age', 'ao' ),
			'parent_item_colon'          => __( 'Parent Age:', 'ao' ),
			'edit_item'                  => __( 'Edit Age', 'ao' ),
			'update_item'                => __( 'Update Age', 'ao' ),
			'view_item'                  => __( 'View Age', 'ao' ),
			'add_new_item'               => __( 'Add New Age', 'ao' ),
			'new_item_name'              => __( 'New Age', 'ao' ),
			'separate_items_with_commas' => __( 'Separate ages with commas', 'ao' ),
			'add_or_remove_items'        => __( 'Add or remove ages', 'ao' ),
			'choose_from_most_used'      => __( 'Choose from the most used ages', 'ao' ),
			'not_found'                  => __( 'No ages found.', 'ao' ),
			'no_terms'                   => __( 'No ages', 'ao' ),
			'menu_name'                  => __( 'Ages', 'ao' ),
			'items_list_navigation'      => __( 'Ages list navigation', 'ao' ),
			'items_list'                 => __( 'Ages list', 'ao' ),
			'most_used'                  => _x( 'Most Used', 'age', 'ao' ),
			'back_to_items'              => __( '&larr; Back to Ages', 'ao' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'age',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'age_init' );

/**
 * Sets the post updated messages for the `age` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `age` taxonomy.
 */
function age_updated_messages( $messages ) {

	$messages['age'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Age added.', 'ao' ),
		2 => __( 'Age deleted.', 'ao' ),
		3 => __( 'Age updated.', 'ao' ),
		4 => __( 'Age not added.', 'ao' ),
		5 => __( 'Age not updated.', 'ao' ),
		6 => __( 'Ages deleted.', 'ao' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'age_updated_messages' );
