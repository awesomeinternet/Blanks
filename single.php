<?php get_header(); ?>

<?php include 'includes/top.php' ?>
<section id="main">
	<div class="wrapper">
		<article>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php edit_post_link( __( 'Editar', '' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			<?php the_content(); ?>
		<?php endwhile; endif; ?>
		</article>

		<?php get_sidebar(); ?>
	</div>
</section>
<?php get_footer(); ?>
