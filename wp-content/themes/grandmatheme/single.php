<?php 
	get_header();
	if (have_posts()):
		while (have_posts()):
			the_post();
?>
<div class="post-wrapper">
	<div class="post-container clearfix">
		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<div class="post-content">
			<div class="post-header">
				<h3><?php the_title(); ?></h3>
				<p class="post-infos">
					<span class="upvote-btn" data-tipId="<?= get_the_ID(); ?>">IT WORKS ! (<span class="likes-count"><?php the_field('likes'); ?></span>)</span><span class="share"> SHARE</span>
				</p>
			</div>
			<div class="entry-content"><?php the_content(); ?></div>
		</div>
	</div>
</div>

<?php
		endwhile;
	endif;
	get_footer();
?>