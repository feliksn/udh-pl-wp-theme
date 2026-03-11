<?php
    $title        = $args['title'];
    $fields       = $args['fields'];
    $term_in_edit = $args['term_in_edit'];
    $term         = $args['term'];
?>

<div class="postbox metabox metabox-term">              
    <div class="postbox-header postbox-header-term">
        <h2 class="metabox-title-term"><?php echo $title; ?></h2>
    </div>
    <div class="inside">
    <?php foreach( $fields as $field ){
        // metabox_is_prop() !!!
        if( isset( $term_in_edit ) && $term_in_edit ){
            $field['value'] = get_term_meta( $term->term_id, $field['name'], 1 );
        }
        get_template_part(CMB_DIR . '/fields/parts/container', null, $field);
    } ?>
    </div>
</div>