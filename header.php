<?php
    $header_title = $args['header_title'] ?? '';
    // Определить как глоб. переменную чтобы можно было использовать в футере
    global $social_links;
    $social_links = udh_pl_wp_theme_options();
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <header class="header helper-bg-image-cover-center">
        <div class="container">
            <?php
                wp_nav_menu([
                    'container' => '',
                    'menu_id' => 'menu-list',
                    'menu_class' => 'nav list-unstyled justify-content-center align-items-center'
                ]);
            ?>
        </div>
        <h1 class="header-title"><?php echo $header_title; ?></h1>
    </header>
    
    <!-- bottom-links -->
    <div class="header-bottom-links">
        <!-- lang-switcher -->
        <div>
            <a class="header-lang-switcher-link active" href="#">PL</a>
            <a class="header-lang-switcher-link" href="#">EN</a>
        </div>
        <!-- social links -->
        <div>
            <?php foreach( $social_links as $link_name => $link_value ) { ?>
                <?php if ( ! empty( $link_value ) ) :  ?>
                    <?php 
                        $bi_icon_name = $link_name == 'mail' ? 'bi-envelope-fill' : 'bi-' . $link_name; 
                        $link_value_before = $link_name == 'mail' ? 'mailto:' : '//';
                    ?> 
                    <a class="navbar-brand mx-2" href="<?php echo $link_value_before . $link_value; ?>">
                        <i class="bi <?php echo $bi_icon_name; ?>"></i>
                    </a>
                <?php endif; ?>
            <?php } ?>
        </div>
    </div>