<?php

// Save metabox data in DB
add_action( 'save_post', 'cmb_save_post_fields', 10, 2 );
function cmb_save_post_fields ( $post_id, $post ) {
    
    // Check current user rights to editing
    if( ! current_user_can( 'edit_post', $post_id ) ) return;
    
    // If autosave in action do nothing
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    // Get an access to the global var with metaboxes data
    global $metaboxes;
    
    // Get each metabox data in the loop
    foreach( $metaboxes as $metabox ){
        
        // If exists the metabox post_id check this with the current $post_id
        // Continue the loop if metabox post_id not equal with the current $post_id 
        if( isset( $metabox['post_id'] ) && $metabox['post_id'] != $post_id ) continue;

        // Check a current post type before data saving
        if( in_array( $post->post_type, $metabox['post_type'] ) ){
            
            // Get each metabox field data in the loop
            foreach ( $metabox['fields'] as $metabox_field ){
                
                // If a field type is a repeater get sub fields
                if( $metabox_field['type'] == 'repeater' ){
                    
                    // Get access every sub field of the repeater
                    foreach( $metabox_field['sub_fields'] as $sub_field ){

                        // Verify nonce fields.
                        if ( ! wp_verify_nonce(
                            $_POST[ $sub_field['name'] . '_nonce_name' ],
                            $sub_field['name'] . '_nonce_action'
                        )) return;

                        // Get the sub field values as array
                        $sub_field_values = $_POST[ $sub_field['name'] ];
                        
                        // Start from 1 index. 0 index is a template field value in the template row
                        $sub_field_values_sliced = array_slice( $sub_field_values, 1);
                        
                        // Prepare sub field values
                        $sub_field_values_prepared = cmb_field_value_prepared(
                            $sub_field_values_sliced,
                            $sub_field['type']
                        );
                        
                        // Count sub field values 
                        // It needs to the metabox_have_rows() to know how much records/rows has a repeater
                        $repeater_len = count( $sub_field_values_prepared );
                        
                        if( $repeater_len ){
                            // Write field values in the DB
                            update_post_meta( $post_id, $sub_field['name'], $sub_field_values_prepared );
                        } else {
                            delete_post_meta( $post_id, $sub_field['name']);
                        }

                    }

                    if( $repeater_len ){
                        update_post_meta( $post_id, $metabox_field['name'], $repeater_len );
                    } else {
                        delete_post_meta( $post_id, $metabox_field['name']);
                    }

                } else {
                    cmb_field_save( $metabox_field, $post_id );
                }
            }
        }
    }
}

// Save metabox fields in taxonomy
add_action( 'created_category', 'cmb_save_term_fields' );
add_action( 'edited_category' , 'cmb_save_term_fields' );
function cmb_save_term_fields( $term_id ) {
    global $metaboxes;
    foreach( $metaboxes as $metabox ){
        if( isset( $metabox['taxonomy'] ) ){
            foreach( $metabox['fields'] as $metabox_field ){
                // 3 arg
                // TRUE             - save values on terms pages (category, post_tag);
                // FALSE(default)   - save values on post pages (post, page, custom_post_type);
                cmb_field_save( $metabox_field, $term_id, TRUE );
            }
        }
    }
}
?>