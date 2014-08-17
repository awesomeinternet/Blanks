<?php get_header(); include 'includes/top.php'; ?>

	<section id="main">
		<div class="wrapper">
			<article>
				<h2><?php the_title(); ?></h2>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php edit_post_link( __( 'Edit', '' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
					<?php the_content(); ?>
				<?php endwhile; endif; ?>
			</article>

			<?php get_sidebar(); ?>
		</div>
	</section>
<?php get_footer(); ?>
