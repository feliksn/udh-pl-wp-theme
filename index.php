<?php
	get_header();
	_get_template_css('post');
?>

<div class="container">
	<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-0">
		<?php if (have_posts()) { ?>
			<?php while (have_posts()) { ?>
				<?php the_post(); ?>

				<?php get_template_part('templates/post/post'); ?>

			<?php } ?>
		<?php } else { ?>

			<h4>Niczego nie odnależiono!</h4>

		<?php } ?>
	</div>
</div>

<?php get_footer(); ?>