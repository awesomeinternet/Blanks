<?php get_header(); ?>

<?php include 'includes/top.php' ?>

<section id="main">
	<div class="wrapper">
		<h1 class="bt-title"><?php bloginfo('name'); ?></h1>
		<h2 class="bt-description"><?php bloginfo('description'); ?></h2>

		<div class="clearfloat">
			<?php get_sidebar();?>
			<article>
			<?php if (have_posts()) : while (have_posts()): the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
					<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Enlace permanente a <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<p class="meta">Publicado en <?php the_time('F jS, Y'); ?></p>
					<?php the_content('Leer más'); ?>
					<p><?php the_tags('Etiquetas: ', ',', '<br />'); ?> Publicado bajo <?php the_category(', '); ?> | <?php edit_post_link('Editar', '', ' | '); ?> <?php comments_popup_link('Sin Comentarios &#187;', '1 Comentario &#187;', '% Comentarios &#187;'); ?></p>
				</div>
			<?php endwhile; ?>
				<?php next_post_link('&laquo; Entradas Antiguas') ?>
				<?php previous_post_link('Entradas Nuevas &raquo;') ?>
			<?php else : ?>
				<h2>No hay post</h2>
			<?php endif; ?>
			</article>
		</div>
	</div>
</section>
<?php get_footer(); ?>
