<?php get_header('single'); ?>

<div class="container">
    
    <!-- блок с основной картинкой, описанием, лого и пр. продукта -->
   	<?php get_template_part('components/block-product/block-product'); ?>

    <!-- блок с статистикой (данные про продукт) -->
    <?php get_template_part('components/block-statistics/block-statistics'); ?>

</div>

<?php get_footer(); ?>