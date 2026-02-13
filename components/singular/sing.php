<div class="d-flex">
    <?php
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1,          // вывести все посты
            'tax_query' => array([
                'taxonomy' => 'category', // таксономия-категория
                'field'    => 'slug',
                'terms'    => 'piwo',     // slug вашей категории
            ]),
        );
        $query = new WP_Query($args);
    ?>
    <?php if ($query->have_posts()) : ?>
        <?php while ($query->have_posts()) : ?>
            <?php $query->the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="mx-3">
                <?php the_post_thumbnail('thumbnail'); ?>
            </a>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php endif ?>
</div>