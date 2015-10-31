<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
		<input type="submit" id="searchsubmit" value="" />
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search for a tip..."/>
	</div>
</form>