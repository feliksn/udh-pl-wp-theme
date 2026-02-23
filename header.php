<?php
    $header_title = $args['header_title'] ?? '';
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
                    'menu_class' => 'nav list-unstyled justify-content-center'
                ]);
            ?>
        </div>
        <h1 class="header-title"><?php echo $header_title; ?></h1>
    </header>