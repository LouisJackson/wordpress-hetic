<?php 

add_theme_support('post-thumbnails');
add_image_size('home', 510, 355);
register_nav_menus();

function register_my_menu() {
  register_nav_menu('header-menu',__('Header Menu'));
}
add_action('init', 'register_my_menu');

function create_tips() {
  register_post_type( 'tips',
    array(
      'labels' => array(
        'name' => __( 'Tips' ),
        'singular_name' => __( 'Tip' )
      ),
      'public' => true,
      'taxonomies' => array('category'),
      'has_archive' => true,
      'supports' => array(
		'title',
		'author',
		'excerpt',
		'editor',
		'thumbnail',
		'revisions'
	   )
    )
  );
}
add_action('init', 'create_tips');