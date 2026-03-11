<?php
// Add a metabox class to the postbox class
foreach($metaboxes as $metabox){
    $post_types = $metabox['post_type'];
    foreach( $post_types as $post_type ){
        $filter_name = 'postbox_classes_' . $post_type . '_' . $metabox['id'];
        add_filter( $filter_name , function( $classes ) {
            array_push( $classes, 'metabox');
            return $classes;
        });
    }
}
?>