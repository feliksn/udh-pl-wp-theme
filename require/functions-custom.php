<?php
// Пользовательские функции начинаются с "_" чтобы отличать от иных функций WP и др.(функции плагинов) если таковы будут
// Параметры функций начинаются с "$_" чтобы в функции можно было отличить аргумент функции от переменной, которая создается в самой функции

// Display data in the var
function _var( $_var ){
    echo '<pre>' . print_r( $_var, true ) . '</pre>';
}

/**
 * Init template functions for dedicated place
 */
function _init_template_fn($_name){
    require_once THEME_PATH . "/templates/$_name/$_name-fn.php";
}

/**
 * Init template styles for dedicated place
 */
function _init_template_css($_name){
    $theme_uri = THEME_URI;
    echo "\n<style>@import url('$theme_uri/templates/$_name/$_name.css')</style>";
}


?>