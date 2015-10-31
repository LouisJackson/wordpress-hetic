<?php 
	get_header();
?>
<div class="content clearfix">
	<div class="result-query"><span class="active">Results for</span><li class="title"><?= the_search_query(); ?></li></div>
	<div class="tips">
		<?php 
		$args = array('post_type' => 'tips', 'posts_per_page' => 10, 's' => get_search_query());
		$loop = new WP_Query($args);
		$i = 0;

		while ($loop->have_posts()) : $loop->the_post();
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
				<?php if ((($i - 2) % 3) == 0): ?></div><?php endif;
			$i++;
		endwhile; ?>
	</div>
</div>

<?php
	get_footer();