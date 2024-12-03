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
			'name'                       => __( 'Seasons', 'ao' ),
			'singular_name'              => _x( 'Season', 'taxonomy general name', 'ao' ),
			'search_items'               => __( 'Search Seasons', 'ao' ),
			'popular_items'              => __( 'Popular Seasons', 'ao' ),
			'all_items'                  => __( 'All Seasons', 'ao' ),
			'parent_item'                => __( 'Parent Season', 'ao' ),
			'parent_item_colon'          => __( 'Parent Season:', 'ao' ),
			'edit_item'                  => __( 'Edit Season', 'ao' ),
			'update_item'                => __( 'Update Season', 'ao' ),
			'view_item'                  => __( 'View Season', 'ao' ),
			'add_new_item'               => __( 'Add New Season', 'ao' ),
			'new_item_name'              => __( 'New Season', 'ao' ),
			'separate_items_with_commas' => __( 'Separate seasons with commas', 'ao' ),
			'add_or_remove_items'        => __( 'Add or remove seasons', 'ao' ),
			'choose_from_most_used'      => __( 'Choose from the most used seasons', 'ao' ),
			'not_found'                  => __( 'No seasons found.', 'ao' ),
			'no_terms'                   => __( 'No seasons', 'ao' ),
			'menu_name'                  => __( 'Seasons', 'ao' ),
			'items_list_navigation'      => __( 'Seasons list navigation', 'ao' ),
			'items_list'                 => __( 'Seasons list', 'ao' ),
			'most_used'                  => _x( 'Most Used', 'season', 'ao' ),
			'back_to_items'              => __( '&larr; Back to Seasons', 'ao' ),
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
		1 => __( 'Season added.', 'ao' ),
		2 => __( 'Season deleted.', 'ao' ),
		3 => __( 'Season updated.', 'ao' ),
		4 => __( 'Season not added.', 'ao' ),
		5 => __( 'Season not updated.', 'ao' ),
		6 => __( 'Seasons deleted.', 'ao' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'season_updated_messages' );
