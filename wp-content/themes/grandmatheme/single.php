<?php 
	get_header();

if (have_posts()):
	while (have_posts()):
		the_post(); ?>

		<h1><?php the_title(); ?></h1>
		<p><span class="likes-count"><?php the_field('likes'); ?></span> likes</p> 
		<button class="upvote-btn" data-tipId="<?= get_the_ID(); ?>">Like</button>
		<p><?php the_content(); ?></p>
<?php 
	endwhile;
endif;

get_footer();