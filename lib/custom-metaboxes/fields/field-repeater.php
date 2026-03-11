<?php
    
    $sub_fields = $args['sub_fields'];
    $post_id    = $args['post_id'];
    $in_col     = $args['in_col'];

    $values = [];
    foreach( $sub_fields as $sub_field_i => $sub_field ) {
        // Verify fields value by wp nonce
        wp_nonce_field( $sub_field['name'] . '_nonce_action', $sub_field['name'] . '_nonce_name' );
        
        // Add verification about emtpy sub field values
        $sub_field_values = get_post_meta( $post_id, $sub_field[ 'name' ], 1 ) ?: [];
        
        // Change current sub field name in the loop.
        // It needs to use the sub field name with '[]' in the $values
        $sub_field['name'] = $sub_field['name'] . '[]';

        // Change every sub field name in the original $sub_fields array.
        // It needs to use in the template row of the repeater
        $sub_fields[$sub_field_i]['name'] = $sub_field['name']; 

        foreach ( $sub_field_values as $vi => $v ) {
            $sub_field['value'] = $v;
            $values[$vi]['fields'][] = $sub_field ;
        }
    }

?>

<?php
    // Style for hcells when show fields in one column
    $class_hide_in_col = isset( $in_col ) && $in_col ? 'metabox-repeater-hcell-hide-in-col': '';
?>

<table class="metabox-repeater-table">

    <thead>
        <tr class="metabox-repeater-hrow">
            <th class="metabox-repeater-hcell <?php echo $class_hide_in_col; ?>"></th>
            
            <?php if( isset( $in_col ) && $in_col ) { ?>
                <th class="metabox-repeater-hcell <?php echo $class_hide_in_col; ?>"></th>
            <?php } else { ?> 
                <?php foreach ( $sub_fields as $sub_field ) { ?>
                <th class="metabox-repeater-hcell <?php echo $class_hide_in_col; ?>">
                    <?php
                        get_template_part(CMB_DIR . '/fields/parts/title', null, $sub_field['title']);
                        get_template_part(CMB_DIR . '/fields/parts/description', null, $sub_field['description']);
                        get_template_part(CMB_DIR . '/fields/parts/dev-label', null, $sub_field['name'] );
                    ?>                        
                </th>
                <?php } ?>
            <?php } ?>
            
            <th class="metabox-repeater-hcell <?php echo $class_hide_in_col; ?>"></th>
        </tr>
    </thead>
    

    <tbody class="metabox-repeater-tbody">
        
        <!-- A template row -->
        <tr class="metabox-repeater-row-template">
            <!-- First cell -->
            <td class="metabox-repeater-cell"></td>
            
            <!-- Middle cells -->
            <?php if( isset( $in_col ) && $in_col ) { ?>
                <!-- Display in a col -->
                <?php get_template_part(CMB_DIR . '/fields/parts/cells-in-col', null, $sub_fields); ?>
            <?php } else { ?>
                <!-- Display in a row -->
                <?php get_template_part(CMB_DIR . '/fields/parts/cells-in-row', null, $sub_fields); ?>
                    
            <?php } ?>
            
            <!-- Last cell -->
            <td class="metabox-repeater-cell">
                <button class="button metabox-repeater-button-delete">-</button>
            </td>
        </tr>
        
        <?php if( ! empty( $values ) ) { ?>
            <!-- DB rows -->
            <?php foreach( $values as $value_i => $value ){ ?>
                <?php $row_index = ++$value_i; ?>
                
                <tr class="metabox-repeater-row">
                    <!-- first cell -->
                    <td class="metabox-repeater-cell"><?php echo $row_index; ?></td>
                    
                    <!-- middle cells -->
                    <?php if( isset( $in_col ) && $in_col ) {?> 
                        <?php get_template_part(CMB_DIR . '/fields/parts/cells-in-col', null, $value['fields']); ?>
                    <?php } else { ?>
                        <?php get_template_part(CMB_DIR . '/fields/parts/cells-in-row', null, $value['fields']); ?>
                    <?php } ?>

                    <!-- last cell -->
                    <td class="metabox-repeater-cell">
                        <button class="button metabox-repeater-button-delete">-</button>
                    </td>
                </tr>
                
            <?php } ?>
        <?php } ?>
        <!-- JS rows -->
    </tbody>

</table>


<div class="metabox-repeater-controls">
    <button class="button metabox-repeater-button-add">+</button>
</div>