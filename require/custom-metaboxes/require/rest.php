<?php
// Register post meta fileds for REST API endpoints
foreach( $metaboxes as $metabox ){

    $post_types = $metabox['post_type'];
    
    // Register metabox fields in the rest for every post type
    foreach( $post_types as $post_type ){
        
        $metabox_fields = $metabox['fields'];

        // Get every metabox field in the loop
        foreach( $metabox_fields as $field ){
            
            // Set post meta type by field type
            // Only checkbox has multiple values
            // Post meta type will be as an array for the checkbox and as a string for others
            $post_meta_type = $field['type'] == 'checkbox' ? 'array' : 'string';
            
            // Get every metabox post type and register post meta field in rest api
            register_post_meta( $post_type, $field['name'],
                [
                    'show_in_rest' => array(
                        'schema' => array(
                            'type' => $post_meta_type,
                        )
                    ),
                    // return metabox value as a single value
                    'single' => true,
                ]
            );
            
            // check metabox sub fields
            if( isset( $field['sub_fields'] ) ){
                
                // If metabox field has sub fields like in a repeater
                // Get every sub field name and register in rest api 
                foreach( $field['sub_fields'] as $sub_field ){
                    register_post_meta( $post_type, $sub_field['name'],
                        [
                            'show_in_rest' => array(
                                'schema' => array(
                                    'type' => 'array',
                                )
                            ),
                            'single' => true,
                        ]
                    );
                }
            }
        }
    }
}
?>