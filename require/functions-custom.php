<?php

// Display data in the var
function _var( $_var ){
    echo '<pre>' . print_r( $_var, true ) . '</pre>';
}

/**
 * Get template functions for dedicated place
 */
function _get_template_fn($_name){
    require_once THEME_PATH . "/templates/$_name/$_name-fn.php";
}

/**
 * Get template styles for dedicated place
 */
function _get_template_css($_name){
    $theme_uri = THEME_URI;
    echo "\n<style>@import url('$theme_uri/templates/$_name/$_name.css')</style>";
}


?>