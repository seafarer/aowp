<?php

/**
 * Registers the `activity` post type.
 */
function activity_init() {
	register_post_type(
		'activity',
		[
			'labels'                => [
				'name'                  => __( 'Activities', 'twentytwentyfive' ),
				'singular_name'         => __( 'Activities', 'twentytwentyfive' ),
				'all_items'             => __( 'All Activities', 'twentytwentyfive' ),
				'archives'              => __( 'Activities Archives', 'twentytwentyfive' ),
				'attributes'            => __( 'Activities Attributes', 'twentytwentyfive' ),
				'insert_into_item'      => __( 'Insert into Activities', 'twentytwentyfive' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Activities', 'twentytwentyfive' ),
				'featured_image'        => _x( 'Featured Image', 'activity', 'twentytwentyfive' ),
				'set_featured_image'    => _x( 'Set featured image', 'activity', 'twentytwentyfive' ),
				'remove_featured_image' => _x( 'Remove featured image', 'activity', 'twentytwentyfive' ),
				'use_featured_image'    => _x( 'Use as featured image', 'activity', 'twentytwentyfive' ),
				'filter_items_list'     => __( 'Filter Activities list', 'twentytwentyfive' ),
				'items_list_navigation' => __( 'Activities list navigation', 'twentytwentyfive' ),
				'items_list'            => __( 'Activities list', 'twentytwentyfive' ),
				'new_item'              => __( 'New Activities', 'twentytwentyfive' ),
				'add_new'               => __( 'Add New', 'twentytwentyfive' ),
				'add_new_item'          => __( 'Add New Activities', 'twentytwentyfive' ),
				'edit_item'             => __( 'Edit Activities', 'twentytwentyfive' ),
				'view_item'             => __( 'View Activities', 'twentytwentyfive' ),
				'view_items'            => __( 'View Activities', 'twentytwentyfive' ),
				'search_items'          => __( 'Search Activities', 'twentytwentyfive' ),
				'not_found'             => __( 'No Activities found', 'twentytwentyfive' ),
				'not_found_in_trash'    => __( 'No Activities found in trash', 'twentytwentyfive' ),
				'parent_item_colon'     => __( 'Parent Activities:', 'twentytwentyfive' ),
				'menu_name'             => __( 'Activities', 'twentytwentyfive' ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => [ 'title', 'editor', 'thumbnail' ],
			'has_archive'           => true,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_rest'          => true,
			'rest_base'             => 'activity',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
	);

}

add_action( 'init', 'activity_init' );

/**
 * Sets the post updated messages for the `activity` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `activity` post type.
 */
function activity_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['activity'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Activities updated. <a target="_blank" href="%s">View Activities</a>', 'twentytwentyfive' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'twentytwentyfive' ),
		3  => __( 'Custom field deleted.', 'twentytwentyfive' ),
		4  => __( 'Activities updated.', 'twentytwentyfive' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Activities restored to revision from %s', 'twentytwentyfive' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Activities published. <a href="%s">View Activities</a>', 'twentytwentyfive' ), esc_url( $permalink ) ),
		7  => __( 'Activities saved.', 'twentytwentyfive' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Activities submitted. <a target="_blank" href="%s">Preview Activities</a>', 'twentytwentyfive' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Activities scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Activities</a>', 'twentytwentyfive' ), date_i18n( __( 'M j, Y @ G:i', 'twentytwentyfive' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Activities draft updated. <a target="_blank" href="%s">Preview Activities</a>', 'twentytwentyfive' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	];

	return $messages;
}

add_filter( 'post_updated_messages', 'activity_updated_messages' );

/**
 * Sets the bulk post updated messages for the `activity` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `activity` post type.
 */
function activity_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['activity'] = [
		/* translators: %s: Number of Activities. */
		'updated'   => _n( '%s Activities updated.', '%s Activities updated.', $bulk_counts['updated'], 'twentytwentyfive' ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Activities not updated, somebody is editing it.', 'twentytwentyfive' ) :
						/* translators: %s: Number of Activities. */
						_n( '%s Activities not updated, somebody is editing it.', '%s Activities not updated, somebody is editing them.', $bulk_counts['locked'], 'twentytwentyfive' ),
		/* translators: %s: Number of Activities. */
		'deleted'   => _n( '%s Activities permanently deleted.', '%s Activities permanently deleted.', $bulk_counts['deleted'], 'twentytwentyfive' ),
		/* translators: %s: Number of Activities. */
		'trashed'   => _n( '%s Activities moved to the Trash.', '%s Activities moved to the Trash.', $bulk_counts['trashed'], 'twentytwentyfive' ),
		/* translators: %s: Number of Activities. */
		'untrashed' => _n( '%s Activities restored from the Trash.', '%s Activities restored from the Trash.', $bulk_counts['untrashed'], 'twentytwentyfive' ),
	];

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'activity_bulk_updated_messages', 10, 2 );
