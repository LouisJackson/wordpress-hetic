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
      'has_archive' => false,
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

add_filter( 'acf/get_valid_field', 'change_input_labels');
function change_input_labels($field) {
  if($field['name'] == '_post_title') {
    $field['label'] = 'How to';
  }
    
  return $field;  
}

function init_likes($post_id){
  add_post_meta($post_id, 'likes', 0);
}
add_action('acf/save_post', 'init_likes', 30);

show_admin_bar(false);

?>