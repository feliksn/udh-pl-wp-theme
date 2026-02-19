<?php

#добавляем в меню секцию для добавленяи телефона на сайт
add_action('customize_register', function (WP_Customize_Manager $wp_customize) {
    $wp_customize->add_section('udh-pl-wp-theme-options', array(
        'title' => __('Theme options', 'udh-pl_wp'),
        'priority' => 10
    ));

    #mail
    $wp_customize->add_setting('udh-pl-wp-mail');
    $wp_customize->add_control('udh-pl-wp-mail', array(
        'label' => __('Mail', 'udh-pl-wp'),
        'section' => 'udh-pl-wp-theme-options',
    ));

    #facebook
    $wp_customize->add_setting('udh-pl-wp-facebook');
    $wp_customize->add_control('udh-pl-wp-facebook', array(
        'label' => __('Facebook', 'udh-pl-wp'),
        'section' => 'udh-pl-wp-theme-options',
    ));

    #instagram
    $wp_customize->add_setting('udh-pl-wp-instagram');
    $wp_customize->add_control('udh-pl-wp-instagram', array(
        'label' => __('instagram', 'udh-pl-wp'),
        'section' => 'udh-pl-wp-theme-options',
    ));

    #linkedin
    $wp_customize->add_setting('udh-pl-wp-linkedin');
    $wp_customize->add_control('udh-pl-wp-linkedin', array(
        'label' => __('linkedin', 'udh-pl-wp'),
        'section' => 'udh-pl-wp-theme-options',
    ));

});

 
# функция для вывода в верстке 
function udh_pl_wp_theme_options()
{
    return array(
        'mail' => get_theme_mod('udh-pl-wp-mail'),
        'facebook' => get_theme_mod('udh-pl-wp-facebook'),
        'linkedin' => get_theme_mod('udh-pl-wp-linkedin'),
        'instagram' => get_theme_mod('udh-pl-wp-instagram'),
    );
};
