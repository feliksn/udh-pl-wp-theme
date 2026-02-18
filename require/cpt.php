<?php

// Register custom post types
add_action('init', function () {

    // brand
    register_post_type('brand', [
        'label'  => null,
        'labels' => [
            'name'               => 'Marki',
            'singular_name'      => 'Marka',
            'add_new'            => 'Dodaj markę',
            'add_new_item'       => 'Dodaj markę',
            'edit_item'          => 'Edytuj markę',
            'new_item'           => 'Nowa marka',
            'view_item'          => 'Oglądaj markę',
            'search_items'       => 'Szukaj marki',
            'not_found'          => 'Nie znaleziono',
            'not_found_in_trash' => 'Nie znaleziono w koszu',
            'menu_name'          => 'Marka',
        ],
        'public'              => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => false,
        'show_in_rest'        => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-awards',
        'hierarchical'        => true,
        'supports'            => array('title', 'editor', 'page-attributes', 'thumbnail'),
    ]);

    // product
    register_post_type('product', [
        'label'  => null,
        'labels' => [
            'name'               => 'Produkty',
            'singular_name'      => 'Produkt',
            'add_new'            => 'Dodaj produkt',
            'add_new_item'       => 'Dodaj produkt',
            'edit_item'          => 'Edytuj produkt',
            'new_item'           => 'Nowy produkt',
            'view_item'          => 'Oglądaj produkt',
            'search_items'       => 'Szukaj produkt',
            'not_found'          => 'Nie znaleziono',
            'not_found_in_trash' => 'Nie znaleziono w koszu',
            'menu_name'          => 'Produkt',
        ],
        'public'              => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => false,
        'show_in_rest'        => true,
        'menu_position'       => 21,
        'menu_icon'           => 'dashicons-products',
        'hierarchical'        => false,
        'supports'            => array('title', 'editor', 'page-attributes', 'thumbnail'),
        'taxonomies'          => ['category'],
        'has_archive'         => true,
        'rewrite'             => true,
    ]);

    // news
    register_post_type('news', [
        'label'  => null,
        'labels' => [
            'name'               => 'Nowość',
            'singular_name'      => 'Nowość',
            'add_new'            => 'Dodaj nowość',
            'add_new_item'       => 'Dodaj nowość',
            'edit_item'          => 'Edytuj nowość',
            'new_item'           => 'Nowa nowość',
            'view_item'          => 'Oglądaj nowość',
            'search_items'       => 'Szukaj nowość',
            'not_found'          => 'Nie znaleziono',
            'not_found_in_trash' => 'Nie znaleziono',
            'menu_name'          => 'Nowość',
        ],
        'public'              => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => false,
        'show_in_rest'        => true,
        'menu_position'       => 22,
        'menu_icon'           => 'dashicons-pets',
        'hierarchical'        => true,
        'supports'            => array('title', 'editor', 'page-attributes', 'thumbnail'),
    ]);
});


?>