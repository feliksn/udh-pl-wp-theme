<?php
    // Включаем функции для отдельного продукта в самом начале файла, чтобы было эти функции были доступны для всего что будем писать ниже.
    _get_template_fn('single-product');

    // После активац можно вызватть любую функцию из templates/single-product/single-product-fn.php и записать результат в переменную
    $related_products = _get_related_products();
    
    // После чего вызываем шапку сайта
    // get_queried_object() - используем за пределами циклов if...while(have_posts())... чтобы получить данные записи
    get_header( null, [ 'header_title' => get_queried_object()->post_title ] );
    
    // Включаем стили для на странице отдельного продукта
    _get_template_css('single-product');
?>


<div class="container">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>

            <?php $product_id = get_the_ID(); ?>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                <!-- left col -->
                <div class="col text-end d-none d-lg-block">
                    <span class="brand-logo ms-auto">LOGO</span>
                    <h1 class="heading"><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
                
                <!-- mid col -->
                <div class="col">
                    <span class="brand-logo d-md-none mx-auto">LOGO</span>
                    <?php the_post_thumbnail('large', ['class' => 'd-block mx-auto img-fluid']); ?>
                </div>

                <!-- right col -->
                <div class="col text-sm-center text-md-start">
                    <!-- Brand logo (screen width: 768px - 991px) -->
                    <span class="brand-logo d-lg-none d-md-block d-none">LOGO</span>
                    <!-- Related products -->
                    <div class="related-products justify-content-md-start">
                        <?php foreach( $related_products as $related_product ) { ?>
                            <?php $active_class = $product_id == $related_product['id'] ? 'active' : ''?>
                            <a class="related-product-link <?php echo $active_class; ?>"
                                href="<?php echo $related_product['link']; ?>">
                                <img class="related-product-image"
                                    src="<?php echo $related_product['image_url'] ?>"
                                    alt="">
                            </a>
                        <?php } ?>
                    </div>
                    <!-- Title and content (screen max-width: 991px) -->
                    <div class="d-lg-none">
                        <h1 class="heading"><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                    </div>
                    <!-- Category, subcategory, type -->
                    <p>
                        <strong>Piwo, jasny lager</strong><br>
                        <strong>Podgatunek:</strong> American lager
                    </p>
                    <!-- Product content data -->
                    <p>
                        <strong>Alkohol:</strong> 4,7% obj.<br>
                        <strong>Ekstrakt:</strong> 10,75% wag.
                    </p>
                    <!-- Product package data -->
                    <p>
                        <strong>Pakowanie:</strong><br>
                        butelka 330 ml – 4 x 6 sztuk w opakowaniu
                    </p>
                </div>
            </div> <!-- .row -->

        <?php endwhile; ?>
    <?php endif; ?>

    <!-- Product numbers -->
    <div class="row row-cols-lg-4 row-cols-sm-2 row-cols-xs-1 text-center mb-4">
        <div>
            <div class="product-numbers-num">4.7<span>%</span></div>
            <div class="product-numbers-desc">zawartość alkoholu </div>
        </div>
        <div>
            <div class="product-numbers-num">10.75<span>%</span></div>
            <div class="product-numbers-desc">zawartość ekstraktu </div>
        </div>
        <div>
            <div class="product-numbers-num">330<span>ml</span></div>
            <div class="product-numbers-desc">pojemność </div>
        </div>
        <div>
            <div class="product-numbers-num">24<span>szt.</span></div>
            <div class="product-numbers-desc">sztuk w opakowaniu </div>
        </div>
    </div>

</div>

<?php get_footer(); ?>