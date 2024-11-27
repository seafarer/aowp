<?php

/**
 * Registers the `level` taxonomy,
 * for use with 'activity'.
 */
function level_init() {
	register_taxonomy( 'level', [ 'activity' ], [
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
			'name'                       => __( 'Adventure Levels', 'twentytwentyfive' ),
			'singular_name'              => _x( 'Adventure Level', 'taxonomy general name', 'twentytwentyfive' ),
			'search_items'               => __( 'Search Adventure Levels', 'twentytwentyfive' ),
			'popular_items'              => __( 'Popular Adventure Levels', 'twentytwentyfive' ),
			'all_items'                  => __( 'All Adventure Levels', 'twentytwentyfive' ),
			'parent_item'                => __( 'Parent Adventure Level', 'twentytwentyfive' ),
			'parent_item_colon'          => __( 'Parent Adventure Level:', 'twentytwentyfive' ),
			'edit_item'                  => __( 'Edit Adventure Level', 'twentytwentyfive' ),
			'update_item'                => __( 'Update Adventure Level', 'twentytwentyfive' ),
			'view_item'                  => __( 'View Adventure Level', 'twentytwentyfive' ),
			'add_new_item'               => __( 'Add New Adventure Level', 'twentytwentyfive' ),
			'new_item_name'              => __( 'New Adventure Level', 'twentytwentyfive' ),
			'separate_items_with_commas' => __( 'Separate Adventure Levels with commas', 'twentytwentyfive' ),
			'add_or_remove_items'        => __( 'Add or remove Adventure Levels', 'twentytwentyfive' ),
			'choose_from_most_used'      => __( 'Choose from the most used Adventure Levels', 'twentytwentyfive' ),
			'not_found'                  => __( 'No Adventure Levels found.', 'twentytwentyfive' ),
			'no_terms'                   => __( 'No Adventure Levels', 'twentytwentyfive' ),
			'menu_name'                  => __( 'Adventure Levels', 'twentytwentyfive' ),
			'items_list_navigation'      => __( 'Adventure Levels list navigation', 'twentytwentyfive' ),
			'items_list'                 => __( 'Adventure Levels list', 'twentytwentyfive' ),
			'most_used'                  => _x( 'Most Used', 'level', 'twentytwentyfive' ),
			'back_to_items'              => __( '&larr; Back to Adventure Levels', 'twentytwentyfive' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'level',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'level_init' );

/**
 * Sets the post updated messages for the `level` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `level` taxonomy.
 */
function level_updated_messages( $messages ) {

	$messages['level'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Adventure Level added.', 'twentytwentyfive' ),
		2 => __( 'Adventure Level deleted.', 'twentytwentyfive' ),
		3 => __( 'Adventure Level updated.', 'twentytwentyfive' ),
		4 => __( 'Adventure Level not added.', 'twentytwentyfive' ),
		5 => __( 'Adventure Level not updated.', 'twentytwentyfive' ),
		6 => __( 'Adventure Levels deleted.', 'twentytwentyfive' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'level_updated_messages' );
