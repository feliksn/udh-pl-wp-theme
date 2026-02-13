<?php get_header('single'); ?>

<div class="container">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>

            <div class="row">
                <div class="col text-end">
                    <h3><?php the_title(); ?></h3>
                    <?php the_content(); ?>    
                </div>
                <div class="col text-center">
                    <?php the_post_thumbnail('medium'); ?>
                </div>
                <div class="col">
                    <?php get_template_part('components/singular/sing'); ?>
                </div>
            </div>

        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php get_footer(); ?>