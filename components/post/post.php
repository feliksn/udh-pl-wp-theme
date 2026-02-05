<div class="post-item">
    <!-- .post-image -->
    <?php the_post_thumbnail(); ?>
    
    <!-- .post-title -->
    <?php the_title('<h3>', '</h3>'); ?>
    
    <!-- .post-excerpt -->
    <?php the_excerpt(); ?>

    <!-- .post-link -->
    <a href="<?php the_permalink(); ?>">More...</a>
</div>