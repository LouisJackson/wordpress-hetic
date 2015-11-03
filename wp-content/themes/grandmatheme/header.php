<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<!-- SEO meta -->
    <meta name="robots" content="index, follow" />
    <meta name="description" content="Starter H3" />
    <!-- End SEO meta -->

    <!-- IE meta -->
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta name="msapplication-tap-highlight" content="no" />
    <!-- End IE meta -->
   
    <!-- Apple meta -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="Starter H3" />
    <!-- End Apple meta -->

    <!-- Mobile meta -->
    <meta name="HandheldFriendly" content="true" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui" />
    <!-- End mobile meta -->

    <!-- Facebook meta -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content=""/>
    <meta property="og:title" content=""/>
    <meta property="og:image" content="" />
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <!-- End Facebook meta -->

    <!-- Twitter meta -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:site" content="" />
    <meta name="twitter:image" content="" />
    <!-- End Twitter meta -->

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:700,800,300,400,800italic,700italic,600italic,400italic,300italic,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
	<title>Grandma's Recipes</title>
</head>
<body <?php body_class(); ?>>
	
	<section class="intro-header">
		<div class="title">
			<h1>Grandma's tips</h1>
			<h2>Discover the best tips your grandma could give you!</h2>
		</div>
        <div class="background">
            <div class="icon_lipstick-beauty"></div>
            <div class="icon_bandage-health"></div>
            <div class="icon_bucket-cleaning"></div>
            <div class="icon_lamp-idea"></div>
            <div class="icon_needle"></div>
            <div class="icon_pie-ccoking"></div>
        </div>
		<div class="get-started">
			Get started
		</div>
	</section>
    <?php 
    
        $active_post = array(get_the_id());

        $args = array('posts_per_page' => 1, 'orderby' => 'rand', 'post_type' => 'tips', 'exclude' => $active_post);
        $rand_post = get_posts($args);
        $rand_url = $rand_post[0]->guid;
     ?>
	<section class="main-container" data-random="<?php echo $rand_url ?>">
		<nav><?php dynamic_sidebar( 'home_left' ); ?></nav>