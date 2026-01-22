<?php get_header(); ?>

<div class="container">
    <?php if ( have_posts() ) { ?>
		<?php while ( have_posts() ) { ?>
			<?php the_post(); ?>
			
			<!-- post item -->
			<div id="post-<?php the_ID(); ?>" <?php post_class('col'); ?>>
                <?php the_title('<h3>', '</h3>'); ?>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>">Read more...</a>
			</div>

		<?php } ?>
	<?php } else { ?>
		
		<h4>Nothig was found!</h4>
	
	<?php } ?>
</div>

<?php get_footer(); ?>