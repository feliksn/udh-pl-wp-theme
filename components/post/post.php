
    <div class="post-item">

        <!--Задаю класс именно обертки элемента -->

        <!-- .post-image -->
        <div class="post-image">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium', array('class' => 'post-image')); ?>
            </a>
        </div>


        <div class="post-body">

            <h3 class="post-title"><?php the_title(); ?></h3>

            <p class="post-excerpt"><?php the_excerpt(); ?></p>

            <a class="post-link" href="<?php the_permalink(); ?>">
                zobacz wszystkie produkty
            </a>

        </div><!--.post-body-->

    </div><!--.post-item-->