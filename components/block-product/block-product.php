<?php if (have_posts()) : ?>
	<?php while (have_posts()) : ?>
		<?php the_post(); ?>

		<div class="grid-container">

			<!-- заглушка для картинки брэнда -->
			<div class="item-1 d-flex justify-content-center justify-content-md-start justify-content-xl-end align-items-center">
				<div style="width: 119px; height: 93px; border-radius: 40px; background-color: tomato; text-align: center; line-height: 93px">
					brand img
				</div>
			</div>


			<div class="item-2 d-flex flex-column text-xl-end align-items-xl-end ps-xl-5">
				<div class="d-flex justify-content-center justify-content-md-start justify-content-xl-end">
					<h3><?php the_title(); ?></h3>
				</div>
				<?php the_content(); ?>
			</div>

			<div class="item-3 d-flex justify-content-center align-self-start">
				<?php the_post_thumbnail('large'); ?>
			</div>

			<div class="item-4 d-flex justify-content-start align-items-center">
				<?php get_template_part('components/block-product/block-pics-links-products'); ?>
			</div>

			<div class="item-5">
				<p>
					<strong>Piwo, jasny lager</strong>
				</p>
				<p><strong>Alkohol:</strong> 4,7% obj. | Ekstrakt: 10,75% wag.</p>
				<p><strong>Podgatunek:</strong> American lager</p>
				<p><strong>Pakowanie:</strong></p>
				<p>butelka 330 ml – 4 x 6 sztuk w opakowaniu</p>
			</div>

		</div>

	<?php endwhile; ?>
<?php endif; ?>