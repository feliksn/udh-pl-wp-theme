<?php get_header('single'); ?>

<div class="container">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>

            <div class="row">
                <div class="col-5 text-end ps-5">
                    <h3><?php the_title(); ?></h3>
                    <?php the_content(); ?>    
                </div>
                <div class="col-2 text-center">
                    <?php the_post_thumbnail('medium'); ?>
                </div>
                <div class="col-5">
                    <?php get_template_part('components/block-product/block-product'); ?>
                </div>
            </div>

        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php get_footer(); ?>