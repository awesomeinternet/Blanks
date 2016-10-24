<?php

 /*
  * Template name: Search Page
  *
 */

	get_header();

	global $query_string;

	$query_args = explode("&", $query_string);
	$search_query = array();

	if( strlen($query_string) > 0 ) {
		foreach($query_args as $key => $string) {
			$query_split = explode("=", $string);
			$search_query[$query_split[0]] = urldecode($query_split[1]);
		}
	}

	$search = new WP_Query($search_query);
?>

	<main>
		<div class="wrapper">
			<article>
				<h1 class="has-sub-title">Búsqueda</h1>
				<h2>Términos de su búsqueda: <?php foreach($search_query as $term) { echo $term; } ?></h2>
				<div class="post-list">
					<?php
						if ( $search->have_posts() ) : while ($search->have_posts()) : $search->the_post();
					?>
					<div class="post">
						<a href="<?php the_permalink(); ?>"><img src="<?php featured_image($post->ID) ?>" alt="<?php the_title(); ?>"></a>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="the-excerpt">
							<?php the_excerpt(); ?>
						</div>
						<div class="actions">
							<a href="<?php the_permalink(); ?>" class="btn">Leer más</a>
						</div>
					</div>
					<?php endwhile; endif; wp_reset_query(); ?>
				</div>
			</article>

			<?php get_sidebar(); ?>
		</div>
	</main>
<?php get_footer(); ?>
