<?php get_header(); ?>

<main>
	<div class="wrapper">
		<a href="<?php echo home_url(); ?>" class="go-home"><span>&larr;</span>Back to <?php bloginfo('name'); ?></a>
		<h1>Error 404</h1>
		<p>Not found</p>
		<?php get_search_form(); ?>
	</div>
</main>


<?php get_footer(); ?>
