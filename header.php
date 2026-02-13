<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <!--Присваиваем переменной функцию котора я будет в дальнейшем выводить из админки номери почту в нужных местах-->
    <?php $udh_pl_wp_theme_options = udh_pl_wp_theme_options(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="mb-3 border-bottom">
        <div class="container">
            <?php
            wp_nav_menu([
                'container' => '',
                'menu_id' => 'menu-list',
                'menu_class' => 'nav list-unstyled'
            ]);
            ?>
        </div>

    </header>