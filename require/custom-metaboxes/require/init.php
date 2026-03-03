
<?php
// Add metaboxes for posts
add_action('add_meta_boxes', 'add_custom_metaboxes');
function add_custom_metaboxes(){
    // Get post id to separate metaboxes for posts
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;

    // $metaboxes data is in metaboxes.php 
    global $metaboxes;
    
    // Add all metaboxes from the array of metaboxes -  $metaboxes
    foreach($metaboxes as $metabox){
        
        // If the metabox has post_id key it means to show the metabox only for the post with the id 
        // Use post_name instead post_id to compare???
        // post_id works if post_type has only one value !!!
        if( isset( $metabox['post_id'] ) && $metabox['post_id'] != $post_id ) continue;

        add_meta_box( 
            // metabox unique name - an id attribute
            $metabox['id'],
            // metabox title display in the admin panel
            $metabox['title'],
            
            // callback function - return html using in metabox
            function ( $post, $args ) {
                // Function args from last argument of the add_meta_box()
                $fields = $args['args']['fields'];
                foreach( $fields as $field ){
                    // Set all field props with default values if doesn't exist specific value
                    foreach( CMB_FIELD_PROPS as $prop_name => $prop_value ){
                        $field[$prop_name] = $field[$prop_name] ?? $prop_value;
                    }
                    // Get current field value from DB
                    // Add additional data for each field data
                    $field['value'] = get_post_meta( $post->ID, $field['name'], true );
                    // Pass post id for the repeater to get sub filed values
                    $field['post_id'] = $post->ID;
                    // Get html template for metabox field
                    get_template_part( CMB_DIR . '/fields/parts/container', null, $field );
                }
            },
            
            // Which post type will use the metabox
            // Can be a string or as an array
            $metabox['post_type'],
            // context - normal, advanced(default), side           
            'side',
            // Priority - high, low, core, default
            'default',
            // Pass args(fields) to callback function to displaying the field in the metabox
            [ 'fields'    => $metabox['fields'], ]
        );

    }
}


// Add metaboxes when create new category
add_action( 'category_add_form_fields', function( $taxonomy ) {
    global $metaboxes;
    foreach( $metaboxes as $metabox ){
        if( isset( $metabox['taxonomy'] ) && in_array( 'category', $metabox['taxonomy'] ) ){
            get_template_part(CMB_DIR . '/metabox-term', null, $metabox);
        }
    }
});


// Add metaboxes to edit a category
add_action( 'category_edit_form_fields', 'metabox_edit_term_fields', 10, 2 );
function metabox_edit_term_fields( $term, $taxonomy ) {
    global $metaboxes;
    foreach( $metaboxes as $metabox ){
        if( isset( $metabox['taxonomy'] ) && in_array( 'category', $metabox['taxonomy'] ) ){
            $metabox['term_in_edit'] = TRUE;
            $metabox['term'] = $term;
            ?>
            <tr class="form-field">
                <th></th><td><?php get_template_part(CMB_DIR . '/metabox-term', null, $metabox); ?></td>
            </tr>
            <?php
        }
    }
}

?>