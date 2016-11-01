<?php get_header(); ?>
	<main>
		<div class="container">
			<div class="columns">
				<div class="column is-two-thirds">
					<article>
						<?php if (have_posts()) : ?>

						<?php
						/* If this is a category archive */
						if (is_category()) { ?>
							<h1 class="title is-3">Archive for:</h1>
							<h2 class="subtitle is-1"><?php echo single_cat_title(); ?></h2>
						<?php }
						/* If this is a tag archive */
						elseif (is_tag()) { ?>
							<h1 class="title is-3">Archive for:</h1>
							<h2 class="subtitle is-1"><?php echo single_tag_title(); ?></h2>
						<?php }
						/* If this is a monthly archive */
						elseif (is_month()) { ?>
							<h1 class="title is-3">Archive for:</h1>
							<h2 class="subtitle is-1"><?php the_time('F, Y'); ?></h2>
						<?php }
						/* If this is a yearly archive */
						elseif (is_year()) { ?>
							<h1 class="title is-3">Archive for:</h1>
							<h2 class="subtitle is-1"><?php the_time('Y'); ?></h2>
						<?php }
						/* If this is a paged archive */
						elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

						<?php } ?>

						<div class="posts-list">
						<?php while (have_posts()) : the_post(); ?>
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
						<?php endwhile; else: ?>
							<div class="post no-found"><p><?php _e('Sorry, nothing found.'); ?></p></div>
						<?php endif; ?>
						</div>
					</article>
				</div>
				<div class="column"><?php get_sidebar(); ?></div>
			</div>
		</div>
	</main>
<?php get_footer(); ?>
