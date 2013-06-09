<!DOCTYPE html>
<html lang="es_ES">
<head>
<meta charset="utf-8"/>
<title><?php
    if (function_exists('is_tag') && is_tag()) {
       single_tag_title("Archivo para la etiqueta &quot;"); echo '&quot; - '; }
    elseif (is_archive()) {
       wp_title(''); echo ' Archivo - '; }
    elseif (is_search()) {
       echo 'B&uacute;squeda &quot;'.wp_specialchars($s).'&quot; - '; }
    elseif (!(is_404()) && (is_single()) || (is_page())) {
       wp_title(''); echo ' - '; }
    elseif (is_404()) {
       echo '404 No Encontrado - '; }
    if (is_home()) {
       bloginfo('name'); echo ' - '; bloginfo('description'); }
    else {
        bloginfo('name'); }
    if ($paged > 1) {
       echo ' - p&aacute;gina '. $paged; }?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="description" content="<?php bloginfo('description'); ?>"/>
<meta name="keywords" content=""/>
<meta name="owner" content=""/>
<meta name="rating" content="General"/>
<link rel="author" href="humans.txt" />
<!--Icons-->
<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/images/icons/apple-touch-icon-114x114.png"/>
<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/images/icons/apple-touch-icon-72x72.png"/>
<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/images/icons/apple-touch-icon-57x57.png"/>
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/icons/favicon.png"/>
<!--Facebook Tags-->
<meta property="og:title" content="<?php bloginfo('name') ?> - <?php bloginfo('description'); ?>"/>
<meta property="og:type" content="website"/>
<meta property="og:url" content="<?php echo home_url(); ?>"/>
<meta property="og:image" content="<?php bloginfo('template_directory'); ?>/images/fb_image.png"/>
<meta property="og:site_name" content="<?php bloginfo('name') ?>"/>
<meta property="og:description" content="<?php bloginfo('name') ?> - <?php bloginfo('description'); ?>"/>
<!--[if IE]>
	<script src="<?php bloginfo('template_directory'); ?>/js/html5shiv.js"></script>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" media="screen"/>
<![endif]-->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" media="all"/>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<link href="<?php echo home_url(); ?>" rel="index" title="<?php bloginfo('name') ?> - <?php bloginfo('description'); ?>"/>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
