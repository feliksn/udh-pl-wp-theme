<?php
// Connect metabox styles and script to the wp-admin panel
add_action( 'admin_enqueue_scripts', 'cmb_css_js' );
function cmb_css_js() {
	// I recommend to add additional conditions here
	// because we probably do not need the scripts on every admin page, right?
	
    // Get post type list from global $metaboxes!!!
	
    // WordPress media uploader scripts
	if ( ! did_action( 'wp_enqueue_media' ) ) { wp_enqueue_media(); }
    // Metabox uploader style and script
    wp_enqueue_style('metabox',  get_stylesheet_directory_uri() . CMB_DIR . '/metaboxes.css');
    // wp_enqueue_script( 'metabox-jq-ui', get_stylesheet_directory_uri() . CMB_DIR . '/libs/jquery-ui-1.14.2.sortable/jquery-ui.min.js', ['metabox-jq']);
    // wp_enqueue_script( 'metabox-jq', get_stylesheet_directory_uri() . CMB_DIR . '/libs/jquery-ui-1.14.2.sortable/external/jquery/jquery.js');
 	wp_enqueue_script( 'metabox', get_stylesheet_directory_uri() . CMB_DIR . '/metaboxes.js', ['jquery'] );

}
?>