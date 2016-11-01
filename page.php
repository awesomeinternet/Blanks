<?php get_header(); ?>

	<main>
		<div class="container">
			<div class="columns">
				<div class="column is-two-thirds">
					<article>
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<div class="content">
								<h1 class="title is-1"><?php the_title(); ?></h1>
								<?php the_content(); ?>
							</div>
						<?php endwhile; endif; ?>
					</article>
				</div>
				<div class="column">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</main>
<?php get_footer(); ?>
