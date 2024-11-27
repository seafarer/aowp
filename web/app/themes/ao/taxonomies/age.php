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
			'name'                       => __( 'Ages', 'twentytwentyfive' ),
			'singular_name'              => _x( 'Age', 'taxonomy general name', 'twentytwentyfive' ),
			'search_items'               => __( 'Search Ages', 'twentytwentyfive' ),
			'popular_items'              => __( 'Popular Ages', 'twentytwentyfive' ),
			'all_items'                  => __( 'All Ages', 'twentytwentyfive' ),
			'parent_item'                => __( 'Parent Age', 'twentytwentyfive' ),
			'parent_item_colon'          => __( 'Parent Age:', 'twentytwentyfive' ),
			'edit_item'                  => __( 'Edit Age', 'twentytwentyfive' ),
			'update_item'                => __( 'Update Age', 'twentytwentyfive' ),
			'view_item'                  => __( 'View Age', 'twentytwentyfive' ),
			'add_new_item'               => __( 'Add New Age', 'twentytwentyfive' ),
			'new_item_name'              => __( 'New Age', 'twentytwentyfive' ),
			'separate_items_with_commas' => __( 'Separate ages with commas', 'twentytwentyfive' ),
			'add_or_remove_items'        => __( 'Add or remove ages', 'twentytwentyfive' ),
			'choose_from_most_used'      => __( 'Choose from the most used ages', 'twentytwentyfive' ),
			'not_found'                  => __( 'No ages found.', 'twentytwentyfive' ),
			'no_terms'                   => __( 'No ages', 'twentytwentyfive' ),
			'menu_name'                  => __( 'Ages', 'twentytwentyfive' ),
			'items_list_navigation'      => __( 'Ages list navigation', 'twentytwentyfive' ),
			'items_list'                 => __( 'Ages list', 'twentytwentyfive' ),
			'most_used'                  => _x( 'Most Used', 'age', 'twentytwentyfive' ),
			'back_to_items'              => __( '&larr; Back to Ages', 'twentytwentyfive' ),
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
		1 => __( 'Age added.', 'twentytwentyfive' ),
		2 => __( 'Age deleted.', 'twentytwentyfive' ),
		3 => __( 'Age updated.', 'twentytwentyfive' ),
		4 => __( 'Age not added.', 'twentytwentyfive' ),
		5 => __( 'Age not updated.', 'twentytwentyfive' ),
		6 => __( 'Ages deleted.', 'twentytwentyfive' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'age_updated_messages' );
