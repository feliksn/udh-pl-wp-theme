<?php

add_action('init', function () {
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
