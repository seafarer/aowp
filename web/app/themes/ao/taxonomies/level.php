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
			'name'                       => __( 'Adventure Levels', 'ao' ),
			'singular_name'              => _x( 'Adventure Level', 'taxonomy general name', 'ao' ),
			'search_items'               => __( 'Search Adventure Levels', 'ao' ),
			'popular_items'              => __( 'Popular Adventure Levels', 'ao' ),
			'all_items'                  => __( 'All Adventure Levels', 'ao' ),
			'parent_item'                => __( 'Parent Adventure Level', 'ao' ),
			'parent_item_colon'          => __( 'Parent Adventure Level:', 'ao' ),
			'edit_item'                  => __( 'Edit Adventure Level', 'ao' ),
			'update_item'                => __( 'Update Adventure Level', 'ao' ),
			'view_item'                  => __( 'View Adventure Level', 'ao' ),
			'add_new_item'               => __( 'Add New Adventure Level', 'ao' ),
			'new_item_name'              => __( 'New Adventure Level', 'ao' ),
			'separate_items_with_commas' => __( 'Separate Adventure Levels with commas', 'ao' ),
			'add_or_remove_items'        => __( 'Add or remove Adventure Levels', 'ao' ),
			'choose_from_most_used'      => __( 'Choose from the most used Adventure Levels', 'ao' ),
			'not_found'                  => __( 'No Adventure Levels found.', 'ao' ),
			'no_terms'                   => __( 'No Adventure Levels', 'ao' ),
			'menu_name'                  => __( 'Adventure Levels', 'ao' ),
			'items_list_navigation'      => __( 'Adventure Levels list navigation', 'ao' ),
			'items_list'                 => __( 'Adventure Levels list', 'ao' ),
			'most_used'                  => _x( 'Most Used', 'level', 'ao' ),
			'back_to_items'              => __( '&larr; Back to Adventure Levels', 'ao' ),
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
		1 => __( 'Adventure Level added.', 'ao' ),
		2 => __( 'Adventure Level deleted.', 'ao' ),
		3 => __( 'Adventure Level updated.', 'ao' ),
		4 => __( 'Adventure Level not added.', 'ao' ),
		5 => __( 'Adventure Level not updated.', 'ao' ),
		6 => __( 'Adventure Levels deleted.', 'ao' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'level_updated_messages' );
