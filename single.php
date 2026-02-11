<?php get_header(); ?>

<div class="container">
    <?php if( have_posts() ) { ?>
        <?php while( have_posts() ) { ?>
            <?php the_post(); ?>
            
            <?php the_post_thumbnail('medium'); ?>
            <h1 class="heading"><?php the_title(); ?></h1>
            <?php the_content()?>
            
        <?php } ?>
    <?php } ?>
</div>

<?php get_footer(); ?>