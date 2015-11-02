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
							
								<?php echo '<pre>';
								print_r(get_field('taxonomy'));
								echo '</pre>'; ?>
								<?php acf_form(array(
										'post_id'		=> 'new_post',
										'post_title'    =>	true,
										'post_content'    => false,
										'new_post'		=> array(
											'post_type'		=> 'tips',
											'post_status'		=> 'publish'
 										),
										'fields' => array('name','e-mail','etapes','the_taxonomy'),
										'submit_value'		=> 'Submit'
									)); ?>
							</div>
						</div>
					</div>
				</div>


			<?php endwhile; ?>

<?php get_footer(); ?>