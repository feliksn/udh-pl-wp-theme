 <div class="d-flex">

     <?php the_post_thumbnail('medium'); ?>

     <div>
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

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
            ?>

                 <a href="<?php the_permalink(); ?>" class="m-3">
                     <?php the_post_thumbnail('thumbnail'); ?>
                 </a>

         <?php }
                wp_reset_postdata();
            } ?>

     </div>

 </div>


 <h1 class="heading"><?php the_title(); ?></h1>

 <?php the_content() ?>