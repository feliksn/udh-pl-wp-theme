<?php
    $title       = $args['title'];
    $description = $args['description'];
    $type        = $args['type'];
    $name        = $args['name'];
    $errors      = $args['errors'];
    $field_data  = $args;
?>

<div class="metabox-field-container">
    <?php 
        get_template_part( CMB_DIR . '/fields/parts/title'       , null , $title       );
        get_template_part( CMB_DIR . '/fields/parts/description' , null , $description );
        get_template_part( CMB_DIR . '/fields/field'             , $type, $field_data  ); 
        // Add wp nonce field for verification if the field type is not repeater
        if( $type !== 'repeater' ) wp_nonce_field( $name . '_nonce_action', $name . '_nonce_name' ); 
        // Dev label with a field name for comfortable developing
        get_template_part( CMB_DIR . '/fields/parts/dev-label', null, $name );
        // Error message 
        get_template_part( CMB_DIR . '/fields/parts/errors', null, $errors );
    ?>
</div>