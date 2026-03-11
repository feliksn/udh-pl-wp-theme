<?php

function cmb_field_save( $field, $id, $is_term=false ){
    if( ! isset( $_POST[ $field['name'] ] ) ) return;
    
    // Verify nonce fields. If it falses don't countinue 
    if ( ! wp_verify_nonce(
        $_POST[ $field['name'] . '_nonce_name' ],
        $field['name'] . '_nonce_action' )
    ) return;

    // if( $is_term ){
    //     if ( ! wp_verify_nonce( $_POST['_wpnonce_add-tag'], 'add-tag' ) ) {
    //         return;
    //     }
    // }

    $field_value = $_POST[ $field['name'] ];
                    
    // If a metabox field type is a checkbox
    // and any checkbox doesn't choose
    // field doesn't exists in the global var $_POST
    // To fix it set empty string for the checkbox field value
    $field_value =
        $field['type'] == 'checkbox'
        && ! isset( $field_value )
            ? ''
            : $field_value;

    // Check a value.
    if ( ! isset( $field_value ) ) return; 
    
    // Prepare value before insert into DB.
    $field_value_prepared = cmb_field_value_prepared(
        $field_value,
        $field['type'],
        $field['sanitize']
    );
    
    // If metabox field has a return_json prop
    // Convert the field value to json as a string
    // Metabox value has be as an id
    if( isset( $field['return_json'] ) && $field['return_json'] ){
        $field_value_prepared = cmb_field_value_json($field_value_prepared);
    } 
    
    // Write the field value is not empty
    if( ! empty( $field_value_prepared ) ){
        // Add the field value in the DB
        if( $is_term )  update_term_meta( $id, $field['name'], $field_value_prepared );
        else            update_post_meta( $id, $field['name'], $field_value_prepared );
    } else {
        // Otherwise delete the value from the DB
        if( $is_term )  delete_term_meta( $id, $field['name'] );
        else            delete_post_meta( $id, $field['name'] );
    }
}


function cmb_field_value_media( $input_value ){
    if( ! $input_value ) {
        return [ 'id' => '', 'url' => '', 'name' => '', 'type' => '', ];
    }
    $value               = json_decode( $input_value, 1 );
    $thumbnail_size_name = 'thumbnail';
    if( gettype( $value ) == 'array' ){
        $id   = $value['id'];
        $url  = $value['sizes'][$thumbnail_size_name] ?? $value['sizes']['full'];
        $name =           pathinfo( $value['sizes']['full'], PATHINFO_FILENAME  );
        $type = 'image/'. pathinfo( $value['sizes']['full'], PATHINFO_EXTENSION );
    } else {
        $id  = $value;
        $url = wp_get_attachment_image_src( $id, $thumbnail_size_name )[0] ?? '';
        // Check if an image have an url
        if( $url ){
            $name =            pathinfo( $url, PATHINFO_FILENAME  );
            $type = 'image/' . pathinfo( $url, PATHINFO_EXTENSION );
        // otherwise it is a file(not an image)
        } else {
            $file = get_post( $id );
            $name = $file->post_title;
            $type = $file->post_mime_type;
            $url  = $file->guid;
        }
    }
    return [ 
        'id'   => $id,
        'url'  => $url,
        'name' => $name,
        'type' => $type
    ];
}


function cmb_field_options( $args, $is_select=FALSE ){
    $field_value = $args['value'];
    $field_type  = $args['type'];
    $post_type   = $args['post_type'];
    // show_related_posts by related relation field name !!!
    $meta_key    = $args['relation_field_name'] ?? '';
    $meta_value  = $meta_key ? $args['post_id'] : '';
    $order       = $args['order'] ?? 'ASC';
    $orderby     = $args['orderby'] ?? 'title';

    if( $post_type ){
        $options = get_posts( array(
            'post_type'      => $post_type,
            'posts_per_page' => -1,
            'post_status'    => 'any',
            'order'          => $order,
            'orderby'        => $orderby,
            'meta_key'       => $meta_key,
            'meta_value'     => $meta_value
        ) );
    } else {
        $options = $args['options'];
    }

    // Verify order values  
    $options = 
        $field_type == 'order'
        && ! empty( $field_value )
        && count( $options ) == count( $field_value )
            ? $field_value
            : $options;

    $result = [];
    foreach( $options as $option ){
        if( $post_type ) setup_postdata($option);
        
        $option_label = cmb_field_option_data($option)['label'];
        $option_value = cmb_field_option_data($option)['value'];
        $checked      = cmb_field_option_checked_attr( $option_value, $field_value, $is_select );
        
        $result[] = [
            'label'   => $option_label,
            'value'   => $option_value,
            'checked' => $checked
        ];
    }
    if( $post_type ) wp_reset_postdata();
    return $result;
}


function cmb_field_option_checked_attr( $option_value, $value, $is_select ){
    $text = $is_select ? 'selected' : 'checked';
    if( is_array( $value ) ){
        $attr = in_array( $option_value, $value ) ? $text : '';
    } else {
        $attr = $value == $option_value ? $text : ''; 
    }
    return $attr;
}


/**
 * cmb_field_option_data
 *
 * Get a value and a label option
 * @param  mixed $option
 * @return void Array
 */
function cmb_field_option_data( $option ){
    if( is_object( $option ) ){
        $status = $option->post_status !== 'publish' ? ' -- ('. $option->post_status . ')' : '';
        $label = $option->post_title . $status;
        $value = $option->ID;
    } else {
        $label = $option;
        $value = $option;
        // Use a few separators - ; or :
        if( strpos( $option, ';' ) ){
            $value = trim( explode( ';', $option )[0] );
            $label = trim( explode( ';', $option )[1] );
        }
    }
    return [ 'value' => $value, 'label' => $label ];
}


/**
 * cmb_field_value_json
 *
 * Get attachment metadata and convert to json to save into DB
 * @param  mixed $id
 * @return json as string
 */
function cmb_field_value_json( $id ){
    $metadata       = wp_get_attachment_metadata( $id );
    $upload_dir     = wp_get_upload_dir()['baseurl'];
    $file_url       = $metadata['file'];
    $file_dir       = pathinfo( $file_url, PATHINFO_DIRNAME );
    $file_name      = pathinfo( $file_url, PATHINFO_FILENAME );
    $file_extention = pathinfo( $file_url, PATHINFO_EXTENSION );
    $sizes          = [];
    
    // Add additional sizes data to $sizes;
    foreach($metadata['sizes'] as $size_name => $size ){
        $sizes[$size_name] =
            $upload_dir
            . '/' . $file_dir
            . '/' . $file_name
            . '-' . $size['width'] . 'x' . $size['height']
            . '.' . $file_extention;
    }

    // Add full size of the image to other sizes
    $sizes['full'] = $upload_dir . '/' .$file_url;

    // Write all data to an array
    $result = [
        'id' => $id,
        'sizes' => $sizes
    ];

    // Convert array data to json data
    return json_encode($result);
}


function cmb_field_value_prepared( $value, $type, $sanitize=true ){
    // if( ! $sanitize ) return $value;
    if( $type == 'textarea' ) {
        $prepared_value = map_deep( $value, function( $val ){
            return sanitize_textarea_field( $val );
        });
    } else {
        $prepared_value = map_deep( $value, function( $val ){
            return sanitize_text_field( $val );
        });
    }
    return $prepared_value;
}

// function metabox_clean_db_values( $metabox_meta ){
//     $post_metas         = get_post_custom_keys();
//     $post_metabox_metas = [];
   
//     foreach( $post_metas as $post_meta ) {
//         if( strpos( $post_meta, 'metabox' ) !== false ){
//             $post_metabox_metas[] = $post_meta;
//         }
//     };
    
//     if( ! in_array( $metabox_meta, $post_metabox_metas ) ){
//         // delete for single post
//         // delete_post_meta( $post_id, $post_meta_key );
//         // deleta post meta for all post with the same meta key
//         // deleta_post_meta_by_key( $post_meta_key );
//     };

// }

// Create a global array for row indexes of the repeater
$repeaters_row_indexes = [];
foreach( $metaboxes as $metabox ){
    $metabox_fields = $metabox['fields'] ?? [];
    foreach( $metabox_fields as $metabox_field ){
        if( $metabox_field['type'] == 'repeater' ){
            $repeaters_row_indexes[ $metabox_field['name'] ] = 0;
        }
    }
}

// Get a value of a post meta by a name
function cmb_get_field( $field_name, $post_id=0 ){
    $id = $post_id ?: get_the_ID();
    return get_post_meta( $id, $field_name, 1 );
}

// Global var with repeater name for using in different functions
$repeater_name_current;

// Check if a repeater has any rows. Pass a repeater name as a function arg
function cmb_have_rows( $repeater_name ){
    // Get an access of the current repeater name
    global $repeater_name_current;
    // Get an access of the repeaters row indexes
    global $repeaters_row_indexes;
    // Set current repeater name
    // It will be need for other fucntions below - metabox_the_row(), metabox_get_sub_field() 
    $repeater_name_current = $repeater_name;
    // Get a current row index from the array $repeaters_row_indexes
    $repeater_row_i = $repeaters_row_indexes[ $repeater_name ];
    // Get repeater rows length
    $repeater_len = cmb_get_field( $repeater_name );
    // Check the condition for using in a while loop
    return $repeater_row_i < $repeater_len;
}

// Change the repeater row index by increasing 1 in the $repeaters_row_indexes
function cmb_the_row(){
    // Get an access to $repeaters_row_indexes
	global $repeaters_row_indexes;
    // Get an access to the current repeater name
    global $repeater_name_current;
    // Using current repeater name in the $repeaters_row_indexes change the row index by increasing 1
    $repeaters_row_indexes[ $repeater_name_current ] += 1;
}

// Get a repeater field value passing a field name
function cmb_get_sub_field( $sub_field_name ){
    // Get an access to the current repeater name
	global $repeater_name_current;
    // Get an access to the $repeaters_row_indexes
    global $repeaters_row_indexes;
    // Get a field value index using current row index from $repeaters_row_indexes
    // The field value index is less by 1 from the row index.
    // The row index starts from 1, but field values are in an arrray and start from 0 
    $sub_field_value_i = $repeaters_row_indexes[ $repeater_name_current ] - 1;
    // Return sub field value by the value indes. Repeater have multiple values
	return cmb_get_field( $sub_field_name )[$sub_field_value_i];
}

?>