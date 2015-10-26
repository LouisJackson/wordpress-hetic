<?php 

add_theme_support('post-thumbnails');
add_image_size('home', 510, 355);

function remove_post_custom_fields(){
  remove_meta_box('likes', 'tips', 'normal');
}
add_action('admin_menu', 'remove_post_custom_fields');

register_nav_menus();

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

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

add_action( 'init', 'create_tips' );

?>