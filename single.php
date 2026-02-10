<?php get_header(); ?>

<!-- Рекомендация: использовать функцию the_title() внутри цикла, а для заголовка страницы использовать single_post_title() вне цикла. -->

<!-- Название Записи пределами цикла -->
<?php single_post_title(); ?>

<?php if( have_posts() ) { ?>
    <?php while( have_posts() ) { ?>
        <?php the_post(); ?>
        
        <!--миниатюра (размер миниатюры - thumbnail)-->
        <?php the_post_thumbnail('thumbnail'); ?>
        
        <!-- Название записи внутри цикла -->
        <?php the_title() ?>
        
        <!--контент записи ( то что в редакторе написано )-->
        <?php the_content()?>
    <?php } ?>
<?php } ?>



<?php get_footer(); ?>