<?php get_header(); ?>

	<main>
		<div class="container">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="content">
					<div class="columns">
						<div class="column ">
							<div class="subtitle is-5"><small>Publicado el <?php the_time('j F, Y'); ?></small></div>
						</div>
						<div class="column">
							<?php the_author() ?>
						</div>
						<div class="column is-two-thirds">
							<h1 class="title is-1">Big Typography</h1>
							<h2 class="subtitle is-3">Explore</h2>
							<?php the_field('extracto'); ?>
						</div>
					</div>
					<?php the_content(); ?>
				</div>
			<?php endwhile; endif; ?>
		</div>
	</main>
<?php get_footer(); ?>
