<?php get_header('single'); ?>

<div class="container">
    <?php if (have_posts()) { ?>
        <?php while (have_posts()) { ?>
            <?php the_post(); ?>


            <?php get_template_part('components/singular/sing'); ?>


        <?php } ?>
    <?php } ?>
</div>

<?php get_footer(); ?>