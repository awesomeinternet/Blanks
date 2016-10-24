<?php get_header(); ?>
	<main>
		<div class="wrapper">
			<article>
				<?php if (have_posts()) : ?>

				<?php
				/* If this is a category archive */
				if (is_category()) { ?>
					<h1 class="has-sub-title">Archive for:</h1>
					<h2><?php echo single_cat_title(); ?></h2>
				<?php }
				/* If this is a tag archive */
				elseif (is_tag()) { ?>
					<h1 class="has-sub-title">Archive for:</h1>
					<h2><?php echo single_tag_title(); ?></h2>
				<?php }
				/* If this is a monthly archive */
				elseif (is_month()) { ?>
					<h1 class="has-sub-title">Archive for:</h1>
					<h2><?php the_time('F, Y'); ?></h2>
				<?php }
				/* If this is a yearly archive */
				elseif (is_year()) { ?>
					<h1 class="has-sub-title">Archive for:</h1>
					<h2><?php the_time('Y'); ?></h2>
				<?php }
				/* If this is a paged archive */
				elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

				<?php } ?>

				<div class="posts-list">
				<?php while (have_posts()) : the_post(); ?>
					<div class="post">
						<div class="post-head">
							<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<div class="meta"><small>Publicado el <?php the_time('j F, Y'); ?> - <?php the_time('g:i a'); ?></small></div>
							<?php the_excerpt(); ?>
						</div>
					</div>
				<?php endwhile; else: ?>
					<div class="post no-found"><p><?php _e('Sorry, nothing found.'); ?></p></div>
				<?php endif; ?>
				</div>
			</article>

			<?php get_sidebar(); ?>
		</div>
	</main>
<?php get_footer(); ?>
