<?php 

	get_header();

	if (isset($_GET)){
		if(isset($_GET['order']) && $_GET['order'] == 'reverse'){
			$order = $_GET['order'];
		}

		else if(isset($_GET['order']) && $_GET['order'] == 'likes'){
			$order = $_GET['order'];
		}

		else {
			$order = '';
		}
	}
?>
	<div class="content clearfix">
		<div class="categories">
		<li class="title">Categories</li>
		<?php 
		 $cat_args = array(
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
	    wp_list_categories( $cat_args ); 
		 ?> 
		</div>
		<div class="ordering">
			<span class="title">Order By</span>
			<a href="?order=default" class="<?= ($order == '') ? 'active' : ''; ?>">Recent</a>
			<a href="?order=reverse" class="<?= ($order == 'reverse') ? 'active' : ''; ?>">Ancient</a>
			<a href="?order=likes" class="<?= ($order == 'likes') ? 'active' : ''; ?>">Like</a>
		</div>
		<div class="tips">
			<?php 
			$args = array( 'post_type' => 'tips', 'posts_per_page' => 10 );

			if ($order == 'reverse'){
				$args['order'] = 'DESC';
				$args['orderby'] = 'date';
			}

			else if ($order == 'likes'){
				$args['order'] = 'DESC';
				$args['orderby'] = 'meta_value_num';
				$args['meta_key'] = 'likes';
			}

			else {
				$args['order'] = 'ASC';
				$args['orderby'] = 'date';
			}

			$loop = new WP_Query( $args );
			$i = 0;
			while ( $loop->have_posts() ) : $loop->the_post();
			
			if (($i % 3) == 0): ?><div class="tips-row"><?php endif; ?>
			<div class="entry">
				<div class="img-container">
			  		<div class="wrapper">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail('home'); ?>
						</a>
			 		</div>
			 	</div>

	  			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	  				<h3>
	  					<?php the_title(); ?>
	  				</h3>
	  			</a>
	  		</div>
			<?php if ((($i - 2) % 3) == 0): ?></div><?php endif; ?>
			<?php $i++;
			endwhile; ?>
		</div>
	</div>
<?php
	get_footer();
?>