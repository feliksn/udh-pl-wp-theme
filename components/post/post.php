
    <div class="post-item">

        <!--Задаю класс именно обертки элемента -->

        <!-- .post-image -->
        <div class="post-image">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium'); ?>
            </a>
        </div>


        <div class="post-body">

            <!-- .post-title -->
            <div class="post-title">
                <h3>
                    <?php the_title(); ?>
                </h3>
            </div>

            <p class="post-excerpt"><?php the_excerpt(); ?></p>

            <!-- .post-link -->
            <a class="post-link" href="<?php the_permalink(); ?>">
                zobacz wszystkie produkty
            </a>

        </div><!--.post-body-->

    </div><!--.post-item-->