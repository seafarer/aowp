<?php

/**
 * Registers the `season` taxonomy,
 * for use with 'activity'.
 */
function season_init() {
	register_taxonomy( 'season', [ 'activity' ], [
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
			'name'                       => __( 'Seasons', 'twentytwentyfive' ),
			'singular_name'              => _x( 'Season', 'taxonomy general name', 'twentytwentyfive' ),
			'search_items'               => __( 'Search Seasons', 'twentytwentyfive' ),
			'popular_items'              => __( 'Popular Seasons', 'twentytwentyfive' ),
			'all_items'                  => __( 'All Seasons', 'twentytwentyfive' ),
			'parent_item'                => __( 'Parent Season', 'twentytwentyfive' ),
			'parent_item_colon'          => __( 'Parent Season:', 'twentytwentyfive' ),
			'edit_item'                  => __( 'Edit Season', 'twentytwentyfive' ),
			'update_item'                => __( 'Update Season', 'twentytwentyfive' ),
			'view_item'                  => __( 'View Season', 'twentytwentyfive' ),
			'add_new_item'               => __( 'Add New Season', 'twentytwentyfive' ),
			'new_item_name'              => __( 'New Season', 'twentytwentyfive' ),
			'separate_items_with_commas' => __( 'Separate seasons with commas', 'twentytwentyfive' ),
			'add_or_remove_items'        => __( 'Add or remove seasons', 'twentytwentyfive' ),
			'choose_from_most_used'      => __( 'Choose from the most used seasons', 'twentytwentyfive' ),
			'not_found'                  => __( 'No seasons found.', 'twentytwentyfive' ),
			'no_terms'                   => __( 'No seasons', 'twentytwentyfive' ),
			'menu_name'                  => __( 'Seasons', 'twentytwentyfive' ),
			'items_list_navigation'      => __( 'Seasons list navigation', 'twentytwentyfive' ),
			'items_list'                 => __( 'Seasons list', 'twentytwentyfive' ),
			'most_used'                  => _x( 'Most Used', 'season', 'twentytwentyfive' ),
			'back_to_items'              => __( '&larr; Back to Seasons', 'twentytwentyfive' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'season',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'season_init' );

/**
 * Sets the post updated messages for the `season` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `season` taxonomy.
 */
function season_updated_messages( $messages ) {

	$messages['season'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Season added.', 'twentytwentyfive' ),
		2 => __( 'Season deleted.', 'twentytwentyfive' ),
		3 => __( 'Season updated.', 'twentytwentyfive' ),
		4 => __( 'Season not added.', 'twentytwentyfive' ),
		5 => __( 'Season not updated.', 'twentytwentyfive' ),
		6 => __( 'Seasons deleted.', 'twentytwentyfive' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'season_updated_messages' );
