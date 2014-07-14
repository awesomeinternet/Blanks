<?php

/*************************************************************************/
/*** FUNCTIONS **********************************************************/
/***********************************************************************/

/*
* 1. Register scripts and stylesheets
* 2. Custom login form
* 3. Retrieve Featured image URL
* 4. Breadcrumbs
*/

// 1. Register scripts and stylesheets
function scriptsAndStyles() {
  if (!is_admin()) {

  // Set the path to where scripts and styles dirs are, if you must.
  $scriptsDir = get_bloginfo('template_url') . "/js/";
 	$cssDir = get_bloginfo('template_url') . "/css/";

  // Register the CSS files
  										//Handle            SOURCE           DEP   VER    MEDIA
  wp_register_style( 'Normalize', $cssDir.'normalize.css', null, null, 'screen');
  wp_register_style( 'Fonts', $cssDir.'fonts.css', null, null, 'screen');

  // Register the javascript files
											//Handle            SOURCE            DEP   VER  FOOTER?
  wp_register_script( 'jQuery', $scriptsDir.'jquery-1.8.2.min.js', null, 1, true);
	wp_register_script( 'Custom', $scriptsDir.'custom.js', null, 1, true);

	//load the styles
  wp_enqueue_style('Normalize');
  wp_enqueue_style('Fonts');

  //load the scripts
  wp_enqueue_script('jQuery');
  wp_enqueue_script('Custom');
  }
}

// 2. Custom login form
function customLogin() {
	$files = '<link rel="stylesheet" media="all" href="'.get_bloginfo('template_directory').'/css/login.css" />
						<link rel="stylesheet" media="all" href="'.get_bloginfo('template_directory').'/css/fonts.css" />
	          <script src="'.get_bloginfo('template_directory').'/js/login.js"></script>';
	echo $files;
}

function customLoginUrl() {
	return get_bloginfo('url');
}

function customLoginTitle() {
	return get_bloginfo('blogname');
}

// 3. Retrieve Featured image URL, must be called inside the loop.
function featuredImgUrl($postID, $thumbname) {
		$thumbname = $thumbname || 'single-post-thumbnail';
    $imageURL = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), $thumbname );
    echo $imageURL[0];
}
function get_featuredImgUrl($postID, $thumbname) {
		$thumbname = $thumbname || 'single-post-thumbnail';
    $imageURL = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), $thumbname );
    return $imageURL[0];
}

// 4. Breadcrumbs
function the_breadcrumbs() {
	global $post;
	$crumbs = '<p><a href="'.get_option('home').'">Inicio</a>';

	//if the page has a parent add title and link of parent
	if($post->post_parent) {
	$crumbs .= ' &raquo; <a href="'.get_permalink($post->post_parent).'">'.get_the_title($post->post_parent).'</a>';
	}

	// if it's not the front page of the site, but isn't the blog either
	if((!is_front_page()) && (is_page())) {
	$crumbs .= ' &raquo; '.get_the_title($post->ID);
	}

	//if it's the news/blog home page or any type of archive
	if((is_home() ||(is_archive()))) {
	$crumbs .= ' &raquo; '.get_the_title(get_option(page_for_posts));
	}

	//if it's a single news/blog post
	if(is_single()) {
	$crumbs .= ' &raquo; <a href="'.get_permalink(get_option(page_for_posts)).'">'.get_the_title(get_option(page_for_posts)).'</a>';
	$crumbs .= ' &raquo; '.get_the_title($post->ID);
	}
	$crumbs .= '</p>'."\n";
	echo $crumbs;
}

/*************************************************************************/
/*** THEME FEATURES *****************************************************/
/***********************************************************************/

/*
* 1. Custom menu support
* 2. Register Sidebar
* 3. Custom Post Type
* 4. Custom Markup for WordPress galleries
*/

// 1. Custom menu support
function customMainMenu() {
  register_nav_menus(
    array( 'main-menu' => __( 'Main Menu' ) )
  );
}

// 2. Register Sidebar
if ( function_exists('register_sidebar')) {

	//Sidebar Principal
	register_sidebar(array(
	  'name' => 'Sidebar principal',
	  'before_widget' => '<li id="%1$s" class="widget %2$s">',
	  'after_widget' => '</li>',
	  'before_title' => '<h2>',
	  'after_title' => '</h2>',
	));
}

// 3. Custom Post Type
/*function custom_posts() {
	$labels = array(
		'name'               => _x( 'Eventos', 'post type general name' ),
		'singular_name'      => _x( 'Evento', 'post type singular name' ),
		'add_new'            => _x( 'Agregar nuevo', 'book' ),
		'add_new_item'       => __( 'Agregar nuevo Evento' ),
		'edit_item'          => __( 'Editar Evento' ),
		'new_item'           => __( 'Nuevo Evento' ),
		'all_items'          => __( 'Todos los Eventos' ),
		'view_item'          => __( 'Ver Evento' ),
		'search_items'       => __( 'Buscar Eventos' ),
		'not_found'          => __( 'No se encontraron eventos' ),
		'not_found_in_trash' => __( 'No se encontraron eventos en la papelera' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Eventos'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Contiene todos los eventos',
		'public'        => true,
		'menu_position' => 4,
		'menu_icon'			=> '',
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
		'capability_type' => 'post',
		'rewrite' => array('slug' => 'eventos', 'with_front' => false)
	);
	register_post_type( 'evento', $args );
}

function custom_taxonomies() {

	//Lugares taxonomies-------------------------------------------------------------------------------
	$labels = array(
		'name'              => _x( 'Lugares', 'taxonomy general name' ),
		'singular_name'     => _x( 'Lugar', 'taxonomy singular name' ),
		'search_items'      => __( 'Buscar por lugar' ),
		'all_items'         => __( 'Todos los lugar' ),
		'edit_item'         => __( 'Editar lugar' ),
		'update_item'       => __( 'Actualizar lugar' ),
		'add_new_item'      => __( 'Agregar lugar' ),
		'new_item_name'     => __( 'Nuevo lugar' ),
		'menu_name'         => __( 'Lugares' )
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'lugar_del_evento', 'evento', $args );
}
*/

// 4. Custom Markup for WordPress galleries

/*
* In order to enable this first uncomment the function below,
* next go to the "REMOVING ACTIONS" section and uncomment "remove_shortcode('gallery', 'gallery_shortcode');",
* finally go to the "ADDING SHORTCODES" section and uncomment "add_shortcode('gallery', 'myGalleryShortcode');"
* thats all you're ready to go.
*
* This code will make all galleries in you WordPress installation be generated like this:
*
* <div id='$selector' class='gallery galleryid-{$id}'>
* 	<div class='gallery-item'>
*			<a href=""><img src=""></a>
*		</div>
* </div>
*/

/* function myGalleryShortcode($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'div',
		'icontag'    => 'span',
		'captiontag' => 'span',
		'columns'    => 1,
		'size'       => 'full',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	//$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		$gallery_style = "";
	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id}'>";
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, false, false);

		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "$link";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= '';
	}

	$output .= "
		</div>\n";

	return $output;
}
*/

/*************************************************************************/
/*** REMOVING ACTIONS ***************************************************/
/***********************************************************************/

remove_action('wp_head', 'wp_generator');
// remove_shortcode('gallery', 'gallery_shortcode');

/*************************************************************************/
/*** ADDING ACTIONS *****************************************************/
/***********************************************************************/

add_action( 'init', 'customMainMenu' );
add_action('login_head', 'customLogin');
add_action( 'wp_head', 'scriptsAndStyles', 0);
//add_action('init', 'custom_posts' );
//add_action( 'init', 'custom_taxonomies', 0);

/*************************************************************************/
/*** ADDING SHORCODES ***************************************************/
/***********************************************************************/
// add_shortcode('gallery', 'myGalleryShortcode');

/*************************************************************************/
/*** ADDING FILTERS *****************************************************/
/***********************************************************************/

add_filter('login_headerurl', 'customLoginUrl');
add_filter('login_headertitle', 'customLoginTitle');

/*************************************************************************/
/*** ADDING THEME SUPPORT ***********************************************/
/***********************************************************************/
add_theme_support( 'post-thumbnails' );

$defaults = array (
	'default-color'          => '',
	'default-image'          => '',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );

?>