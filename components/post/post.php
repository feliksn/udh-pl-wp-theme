<div class="post-item position-relative">

    <!-- .post-image -->
    <div class="overflow-hidden">
        <?php the_post_thumbnail('medium', array('class' => 'post-image')); ?>
    </div>

    <div class="post-body">
        <h3 class="heading mb-0"><?php the_title(); ?></h3>
        <p class="mb-0"><?php the_excerpt(); ?></p>
        <a class="link stretched-link mt-auto" href="<?php the_permalink(); ?>">
            zobacz wszystkie produkty
        </a>
    </div><!--.post-body-->

</div><!--.post-item-->