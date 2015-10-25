<?php 
	get_header();
?>
	<div class="content clearfix">
		<div class="categories">
		<li class="title">Categories</li>
		<?php 
		 $args = array(
		'show_option_all'    => 'all',
		'orderby'            => 'name',
		'order'              => 'ASC',
		'style'              => 'list',
		'show_count'         => 0,
		'hide_empty'         => 1,
		'use_desc_for_title' => 1,
		'child_of'           => 0,
		'feed'               => '',
		'feed_type'          => '',
		'feed_image'         => '',
		'exclude'            => '1',
		'exclude_tree'       => '',
		'include'            => '',
		'hierarchical'       => 1,
		'title_li'           => __( '' ),
		'show_option_none'   => __( '' ),
		'number'             => null,
		'echo'               => 1,
		'depth'              => 0,
		'current_category'   => 0,
		'pad_counts'         => 0,
		'taxonomy'           => 'category',
		'walker'             => null
	    );
	    wp_list_categories( $args ); 
		 ?> 
		</div>
		<div class="ordering">
			<span class="title">Order By</span>
			<a href="#" class="active">Recent</a>
			<a href="#">Ancient</a>
			<a href="#">Like</a>
		</div>
		<div class="tips">
			<?php 
			$args = array( 'post_type' => 'tips', 'posts_per_page' => 10 );
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
			  echo '<div class="entry"><div class="img-container"><div class="wrapper">';
			  the_post_thumbnail('home');
			  echo'</div></div><h3>';
			  the_title();
			  echo '</h3></div>';
			endwhile;
			 ?>
		</div>
	</div>
<?php
	get_footer();
 ?>