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

	wp_deregister_script('jquery');

  // Set the path to where scripts and styles dirs are, if you must.
  $scriptsDir = get_bloginfo('template_url')."/js/";
 	$cssDir = get_bloginfo('template_url')."/css/";
	
  // Register the CSS files
  										//Handle            SOURCE           DEP   VER    MEDIA
  wp_register_style( 'Normalize', $cssDir.'normalize.css', null, null, 'screen');
  wp_register_style( 'Fonts', $cssDir.'fonts.css', null, null, 'screen');

  // Register the javascript files
											//Handle            SOURCE            DEP   VER  FOOTER?
  wp_register_script('jQuery', $scriptsDir.'jquery-1.8.2.min.js', null, 1.8, true);
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
function featuredImageUrl() {
	if (has_post_thumbnail( 'single-post-thumbnail' )) {
		$imageURL = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
		echo $imageURL[0];
	}
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
* 3. Adding Custom Post Types to the main query
* 4. Custom Post Type
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
/*function my_custom_post_events() {
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
*/

// 4. Adding Custom Post Types to the main query
function add_my_post_types_to_query( $query ) {
	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'evento') );
	return $query;
}

/*************************************************************************/
/*** REMOVING ACTIONS ***************************************************/
/***********************************************************************/

remove_action('wp_head', 'wp_generator');

/*************************************************************************/
/*** ADDING ACTIONS *****************************************************/
/***********************************************************************/

add_action( 'init', 'customMainMenu' );
add_action('login_head', 'customLogin');
add_action( 'wp_head', 'scriptsAndStyles', 0);
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );

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