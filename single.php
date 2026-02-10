<?php get_header(); ?>


<!--название записи-->
<?php single_post_title(); ?> || 

<!--или-->

<?php the_title() ?>

<hr/>


<!--миниатюра (размер миниатюры - thumbnail)-->
<?php the_post_thumbnail('thumbnail'); ?>

<!--контент записи ( то что в редакторе написано )-->
<?php the_content()?>




<?php get_footer(); ?>