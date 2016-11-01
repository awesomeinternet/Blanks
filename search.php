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
		<div class="container">
			<div class="columns">
				<div class="column is-two-thirds">
					<article>
						<h1 class="title is-3">Búsqueda</h1>
						<h2 class="subtitle is-1">Términos de su búsqueda: <?php foreach($search_query as $term) { echo $term; } ?></h2>
						<div class="post-list">
							<?php
								if ( $search->have_posts() ) : while ($search->have_posts()) : $search->the_post();
							?>
							<div class="post">
								<a href="<?php the_permalink(); ?>"><img src="<?php featured_image($post->ID) ?>" alt="<?php the_title(); ?>"></a>
								<h2 class="title is-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<div class="subtitle is-5"><small>Publicado el <?php the_time('j F, Y'); ?> - <?php the_time('g:i a'); ?></small></div>
								<div class="content">
									<?php the_excerpt(); ?>
								</div>
								<div class="actions">
									<a href="<?php the_permalink(); ?>" class="button is-medium is-outlined is-primary">Leer más</a>
								</div>
							</div>
							<?php endwhile; endif; wp_reset_query(); ?>
						</div>
					</article>
				</div>
				<div class="column"><?php get_sidebar(); ?></div>
			</div>
		</div>
	</main>
<?php get_footer(); ?>
