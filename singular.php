<?php get_header('single'); ?>

<div class="container">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>

            <div class="row">

                <div class="col-5 d-flex flex-column text-end align-items-end ps-5">
                    <!-- заглушка для картинки брэнда -->
                    <div style="width: 119px; height: 93px; border-radius: 40px; background-color: tomato; text-align: center; line-height: 93px">
                        pic prod
                    </div>
                    <h3><?php the_title(); ?></h3>
                    <?php the_content(); ?>    
                </div>

                <div class="col-2 d-flex justify-content-center align-self-end">
                    <?php the_post_thumbnail('medium'); ?>
                </div>
                <div class="col-5">
                    <?php get_template_part('components/block-product/block-pics-links-products'); ?>
                </div>
            </div>

        <?php endwhile; ?>
    <?php endif; ?>

    <!-- блок с статистикой (данные про продукт) -->
    <?php get_template_part('components/block-statistics/block-statistics'); ?>

</div>

<?php get_footer(); ?>