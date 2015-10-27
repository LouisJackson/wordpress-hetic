<?php 
	get_header();
?>

<h1><?php the_title(); ?></h1>
<p><span class="likes-count"><?php the_field('likes'); ?></span> likes</p> 
<button class="upvote-btn" data-tipId="<?= get_the_ID(); ?>">Like</button>
<p><?php the_content(); ?></p>

<?php
	get_footer();
?>