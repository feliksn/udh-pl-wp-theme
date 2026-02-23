<?php
// constants
// THEME_URI - https://localhost/wp-content/...
define('THEME_URI', get_template_directory_uri());
// THEME_PATH - /Users/Name/Projects/site.com/site-com-wp/wp-content/... (full path on local PC)
define('THEME_PATH' , get_template_directory());

require_once THEME_PATH . '/require/functions-custom.php';
require_once THEME_PATH . '/require/customizer.php';
require_once THEME_PATH . '/require/cpt.php'; 

// Add a menu in an admin panel
add_theme_support("menus");

// Add a title tag support in a browser tab
add_theme_support('title-tag');

// Add post thumbnails support to the theme
add_theme_support('post-thumbnails');

// Change a class for a nav item
add_filter( 'nav_menu_css_class', 'change_menu_item_css_classes', 10, 1 );
function change_menu_item_css_classes( $classes ) {
	$classes = ['nav-item'];
	return $classes;
}

// Change a class for a nav link
add_filter( 'nav_menu_link_attributes', 'filter_nav_menu_link_attributes', 10, 1 );
function filter_nav_menu_link_attributes( $atts ) {
	$atts['class'] = 'nav-link';
	return $atts;
}

// styles and scripts
add_action('wp_enqueue_scripts', 'add_scripts');
function add_scripts() {
	// Theme sytles
	// BS version 5.3.3
	wp_enqueue_style( 'bs'      , get_template_directory_uri() . '/lib/bootstrap/bootstrap.min.css'       );
	wp_enqueue_style( 'bs-icons', get_template_directory_uri() . '/lib/bootstrap/bootstrap-icons.min.css' );
	wp_enqueue_style( 'main'    , get_template_directory_uri() . '/css/main.css'                          );
	// Theme scripts
	wp_enqueue_script('jq'       , get_template_directory_uri() . '/lib/jquery/jquery-3.7.1.min.js'       , [], '', true);
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/lib/bootstrap/bootstrap.bundle.min.js', [], '', true);
	wp_enqueue_script('main'     , get_template_directory_uri() . '/js/main.js'                           , [], '', true);
}

// Disable comments for media files
add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );
function filter_media_comment_status( $open, $post_id ) {
   $post = get_post( $post_id );
   if( $post->post_type == 'attachment' ) return false;
   return $open;
}

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
	remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');
});

// Disable support for comments and trackbacks in post types
add_action('admin_init', 'disable_comments_post_types_support');
function disable_comments_post_types_support() {
   $post_types = get_post_types();
   foreach ($post_types as $post_type) {
       if(post_type_supports($post_type, 'comments')) {
           remove_post_type_support($post_type, 'comments');
           remove_post_type_support($post_type, 'trackbacks');
       }
   }
}

// Remove comments metabox from dashboard
add_action('admin_init', 'disable_comments_dashboard');
function disable_comments_dashboard() {
   remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}

// Remove comments links from admin bar
add_action('admin_init', function () {
   if (is_admin_bar_showing()) {
       remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
   }
});

// Redirect any user trying to access comments page
add_action('admin_init', 'disable_comments_admin_menu_redirect');
function disable_comments_admin_menu_redirect() {
   	global $pagenow;
   	if ($pagenow === 'edit-comments.php') {
   		wp_redirect(admin_url());
		exit;
   	}
}


add_filter( 'the_excerpt', 'limit_excerpt_length' );
function limit_excerpt_length( $post_excerpt ) {
	// Ограничиваем длину отрывка 100 символами
	return strlen($post_excerpt) > 100 ? substr( $post_excerpt, 0, 100 ) . '...' : $post_excerpt;
}
// фильтр, который убирает обёртку тегом <p> функцию the_excerpt()
remove_filter('the_excerpt', 'wpautop');

// Отключаем генерацию некоторых размеров изображений, которые не нужны для нашего сайта. Это поможет сэкономить место на сервере и ускорить загрузку страниц.
function disable_image_sizes($sizes){
	unset($sizes['medium_large']); // disable medium-large size
	unset($sizes['1536x1536']);    // disable 2x medium-large size
	unset($sizes['2048x2048']);    // disable 2x large size
	return $sizes;
}
add_action('intermediate_image_sizes_advanced', 'disable_image_sizes');

// Ограничение максимального размера изображений до 1536 пикселей.
add_filter( 'big_image_size_threshold', function( $size, $imagesize, $file, $attachment_id ){
	return 1536;
}, 10, 4 );

add_action( 'pre_get_posts' , 'add_product_to_main_query');
function add_product_to_main_query($query){
	if( ! is_admin() && $query->is_main_query() ){
		$query->set( 'post_type', ['page', 'product', 'brand' ] );
	}
}
?>