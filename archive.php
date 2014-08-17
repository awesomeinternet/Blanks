<?php get_header(); include 'includes/top.php'; ?>
	<section id="main">
		<div class="wrapper">
			<article>
				<?php if (have_posts()) : ?>

				<?php
				/* If this is a category archive */
				if (is_category()) { ?>
					<h2 class="post-title">Archive for: <?php echo single_cat_title(); ?></h2>
				<?php }
				/* If this is a tag archive */
				elseif (is_tag()) { ?>
					<h2 class="post-title">Archive for: <?php echo single_tag_title(); ?></h2>
				<?php }
				/* If this is a monthly archive */
				elseif (is_month()) { ?>
					<h2 class="post-title">Archive for: <?php the_time('F, Y'); ?></h2>
				<?php }
				/* If this is a yearly archive */
				elseif (is_year()) { ?>
					<h2 class="post-title">Archive for: <?php the_time('Y'); ?></h2>
				<?php }
				/* If this is a paged archive */
				elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

				<?php } ?>

				<ul>
				<?php while (have_posts()) : the_post(); ?>
						<li>
							<h3><a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
							<p class="meta"><small>Publicado el <?php the_time('F j, Y'); ?> - <?php the_time('g:i a'); ?> <?php edit_post_link( __( 'Editar', '' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?></small></p>
							<?php the_excerpt(); ?>
						</li>
				<?php endwhile; else: ?>
					<li class="no-found"><p><?php _e('Sorry, nothing found.'); ?></p></li>
				<?php endif; ?>
				</ul>
			</article>

			<?php get_sidebar(); ?>
		</div>
	</section>
<?php get_footer(); ?>
