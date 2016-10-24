<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title><?php
      if (function_exists('is_tag') && is_tag()) {
         single_tag_title("Archive for tag &quot;"); echo '&quot; - '; }
      elseif (is_archive()) {
         wp_title(''); echo ' Archive - '; }
      elseif (is_search()) {
         echo 'Search &quot;'.wp_specialchars($s).'&quot; - '; }
      elseif (!(is_404()) && (is_single()) || ( !is_page('Homepage') )) {
         wp_title(''); echo ' - '; }
      elseif (is_404()) {
         echo '404 Not Found - '; }
      if (is_home() || is_page('Homepage') ) {
         bloginfo('name'); echo ' - '; bloginfo('description'); }
      else {
          bloginfo('name'); }
      if ($paged > 1) {
         echo ' - page '. $paged; }?></title>

  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.png">

  <meta name="description" content=""/>
  <meta name="keywords" content=""/>
  <meta name="owner" content=""/>
  <meta name="rating" content="General"/>

  <!--Facebook Tags-->
  <meta property="og:title" content=""/>
  <meta property="og:type" content="website"/>
  <meta property="og:url" content=""/>
  <meta property="og:image" content="<?php bloginfo('template_directory'); ?>/images/fb_image.png"/>
  <meta property="og:site_name" content=""/>
  <meta property="og:description" content=""/>

  <!--[if IE]>
  	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" media="screen"/>
  <![endif]-->

  <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" media="all"/>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <link href="<?php echo home_url(); ?>" rel="index" title="<?php bloginfo('name') ?> - <?php bloginfo('description'); ?>"/>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header>
    <div class="wrapper">
      <div class="logo-wrapper">
        <a href="<?php bloginfo('url') ?>">
          <?php if( get_field('logo', 2) ) { ?>
          <img src="<?php the_field('logo', 2); ?>" width="175" alt="<?php bloginfo('name') ?>">
          <?php } else { ?>
          <img src="<?php bloginfo('template_directory'); ?>/images/logo.png" width="175" alt="<?php bloginfo('name') ?>">
          <?php } ?>
        </a>
      </div>
      <nav>
        <div class="nav-inner">
          <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
        </div>
      </nav>
      <a href="#" class="nav-trigger"><i class="fa fa-navicon"></i></a>
    </div>
  </header>
