<?php get_header(); ?>

<div class="container">
	<div class="row justify-content-center justify-content-md-start">
		<?php if (have_posts()) { ?>
			<?php while (have_posts()) { ?>
				<?php the_post(); ?>

				<?php get_template_part('components/post/post'); ?>

			<?php } ?>
		<?php } else { ?>

			<h4>Niczego nie odnależiono!</h4>

		<?php } ?>
	</div>
</div>

<?php get_footer(); ?>