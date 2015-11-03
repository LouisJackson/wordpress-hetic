<?php acf_form_head(); ?>
<?php get_header(); ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="post-wrapper">
					<div class="post-container clearfix">
						<div class="post-content">
							<div class="post-header">
								<h3><?php the_title(); ?></h3>
							</div>
							<div class="entry-content">
							
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				</div>


			<?php endwhile; ?>

<?php get_footer(); ?>