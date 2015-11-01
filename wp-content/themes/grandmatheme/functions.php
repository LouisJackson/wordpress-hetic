<?php 

add_theme_support('post-thumbnails');
add_image_size('home', 510, 355);
register_nav_menus();

function grandma_widgets_init() {

  register_sidebar( array(
    'name'          => 'Home left sidebar',
    'id'            => 'home_left',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => '',
  ) );

}
add_action( 'widgets_init', 'grandma_widgets_init' );


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
		'thumbnail',
		'revisions'
	   )
    )
  );
}

add_action('init', 'create_tips');

?>