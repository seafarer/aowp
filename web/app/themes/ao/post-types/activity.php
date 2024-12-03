<?php

/**
 * Registers the `activity` post type.
 */
function activity_init() {
  register_post_type(
    'activity',
    [
      'labels'                => [
        'name'                  => __( 'Activities', 'ao' ),
        'singular_name'         => __( 'Activities', 'ao' ),
        'all_items'             => __( 'All Activities', 'ao' ),
        'archives'              => __( 'Activities Archives', 'ao' ),
        'attributes'            => __( 'Activities Attributes', 'ao' ),
        'insert_into_item'      => __( 'Insert into Activities', 'ao' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Activities', 'ao' ),
        'featured_image'        => _x( 'Featured Image', 'activity', 'ao' ),
        'set_featured_image'    => _x( 'Set featured image', 'activity', 'ao' ),
        'remove_featured_image' => _x( 'Remove featured image', 'activity', 'ao' ),
        'use_featured_image'    => _x( 'Use as featured image', 'activity', 'ao' ),
        'filter_items_list'     => __( 'Filter Activities list', 'ao' ),
        'items_list_navigation' => __( 'Activities list navigation', 'ao' ),
        'items_list'            => __( 'Activities list', 'ao' ),
        'new_item'              => __( 'New Activities', 'ao' ),
        'add_new'               => __( 'Add New', 'ao' ),
        'add_new_item'          => __( 'Add New Activities', 'ao' ),
        'edit_item'             => __( 'Edit Activities', 'ao' ),
        'view_item'             => __( 'View Activities', 'ao' ),
        'view_items'            => __( 'View Activities', 'ao' ),
        'search_items'          => __( 'Search Activities', 'ao' ),
        'not_found'             => __( 'No Activities found', 'ao' ),
        'not_found_in_trash'    => __( 'No Activities found in trash', 'ao' ),
        'parent_item_colon'     => __( 'Parent Activities:', 'ao' ),
        'menu_name'             => __( 'Activities', 'ao' ),
      ],
      'public'                => true,
      'hierarchical'          => false,
      'show_ui'               => true,
      'show_in_nav_menus'     => true,
      'supports'              => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
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
 * @param array $messages Post updated messages.
 *
 * @return array Messages for the `activity` post type.
 */
function activity_updated_messages( $messages ) {
  global $post;

  $permalink = get_permalink( $post );

  $messages['activity'] = [
    0  => '',
    // Unused. Messages start at index 1.
    /* translators: %s: post permalink */
    1  => sprintf( __( 'Activities updated. <a target="_blank" href="%s">View Activities</a>', 'ao' ), esc_url( $permalink ) ),
    2  => __( 'Custom field updated.', 'ao' ),
    3  => __( 'Custom field deleted.', 'ao' ),
    4  => __( 'Activities updated.', 'ao' ),
    /* translators: %s: date and time of the revision */
    5  => isset( $_GET['revision'] ) ? sprintf( __( 'Activities restored to revision from %s', 'ao' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    /* translators: %s: post permalink */
    6  => sprintf( __( 'Activities published. <a href="%s">View Activities</a>', 'ao' ), esc_url( $permalink ) ),
    7  => __( 'Activities saved.', 'ao' ),
    /* translators: %s: post permalink */
    8  => sprintf( __( 'Activities submitted. <a target="_blank" href="%s">Preview Activities</a>', 'ao' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
    /* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
    9  => sprintf( __( 'Activities scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Activities</a>', 'ao' ), date_i18n( __( 'M j, Y @ G:i', 'ao' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
    /* translators: %s: post permalink */
    10 => sprintf( __( 'Activities draft updated. <a target="_blank" href="%s">Preview Activities</a>', 'ao' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
  ];

  return $messages;
}

add_filter( 'post_updated_messages', 'activity_updated_messages' );

/**
 * Sets the bulk post updated messages for the `activity` post type.
 *
 * @param array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param int[] $bulk_counts Array of item counts for each message, used to build internationalized strings.
 *
 * @return array Bulk messages for the `activity` post type.
 */
function activity_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
  global $post;

  $bulk_messages['activity'] = [
    /* translators: %s: Number of Activities. */
    'updated'   => _n( '%s Activities updated.', '%s Activities updated.', $bulk_counts['updated'], 'ao' ),
    'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Activities not updated, somebody is editing it.', 'ao' ) :
      /* translators: %s: Number of Activities. */
      _n( '%s Activities not updated, somebody is editing it.', '%s Activities not updated, somebody is editing them.', $bulk_counts['locked'], 'ao' ),
    /* translators: %s: Number of Activities. */
    'deleted'   => _n( '%s Activities permanently deleted.', '%s Activities permanently deleted.', $bulk_counts['deleted'], 'ao' ),
    /* translators: %s: Number of Activities. */
    'trashed'   => _n( '%s Activities moved to the Trash.', '%s Activities moved to the Trash.', $bulk_counts['trashed'], 'ao' ),
    /* translators: %s: Number of Activities. */
    'untrashed' => _n( '%s Activities restored from the Trash.', '%s Activities restored from the Trash.', $bulk_counts['untrashed'], 'ao' ),
  ];

  return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'activity_bulk_updated_messages', 10, 2 );
