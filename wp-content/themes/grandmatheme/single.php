<?php 
	get_header();

	function has_liked(){		
		$queryIp = $GLOBALS['wpdb']->get_col("SELECT * FROM ip_likes WHERE post_id = '". get_the_ID() ."' AND ip_address = '". $_SERVER['REMOTE_ADDR'] ."'");
		return !empty($queryIp);
	}
	

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
					<span class="upvote-btn <?= has_liked() ? 'active' : ''; ?>" data-tipId="<?= get_the_ID(); ?>">IT WORKS ! (<span class="likes-count"><?php the_field('likes'); ?></span>)</span><span class="share"> SHARE</span>
				</p>
			</div>
			<div class="entry-content">
				<?php $i = 1;
				foreach (get_field('etapes') as $step): ?>
					<h4><?= $i; ?>.</h4>
					<p><?= $step['steps'] ?></p>
				<?php 
				$i++;
				endforeach; ?>
			</div>
		</div>
	</div>
</div>

<?php
		endwhile;
	endif;
	get_footer();
?>