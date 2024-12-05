<?php

function wp_rest_define_block_groups() {
  $common_blocks = ['core/image', 'core/group', 'core/columns', 'acf/textbox'];
  $editor_blocks = array_merge($common_blocks, ['core/gallery']);
  $admin_blocks = array_merge($editor_blocks, ['core/code', 'core/html']);

  return ['administrator' => $admin_blocks, 'editor' => $editor_blocks, 'default' => $common_blocks];
}

function wp_rest_assign_block_groups($allowed_blocks, $post) {
  $block_groups = wp_rest_define_block_groups();
  $current_user = wp_get_current_user();

  return $block_groups[in_array('administrator', $current_user->roles) ? 'administrator' : (in_array('editor', $current_user->roles) ? 'editor' : 'default')];
}
add_filter('allowed_block_types_all', 'wp_rest_assign_block_groups', 10, 2);
