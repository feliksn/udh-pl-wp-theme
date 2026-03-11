<?php
    $type                   = $args['type'];
    $name                   = $args['name'];
    $options                = cmb_field_options($args);
    $scroll_box_class       = count( $options ) > 10 ? 'metabox-field-scroll-box' : '';
?>

<div class="<?php echo $scroll_box_class; ?>">
    <?php
        $scroll_counter = 0;
        foreach( $options as $option ) {
            $scroll_counter = $option['checked'] ? ++$scroll_counter : $scroll_counter;
            $field_data = [
                'type'          => $type,
                'name'          => $name,
                'value'         => $option['value'],
                'label'         => $option['label'],
                'checked'       => $option['checked'],
                'placeholder'   => $args['placeholder']
            ];
            get_template_part(CMB_DIR . '/fields/field', null, $field_data );
        }
    ?>
</div>

<?php if( $scroll_box_class ){ ?>
    <div class="metabox-field-scroll-controls">
        <button id="metabox-field-scroll-up">
            <span class="dashicons dashicons-arrow-up-alt2"></span>
        </button>
        <button id="metabox-field-scroll-down">
            <span class="dashicons dashicons-arrow-down-alt2"></span>
        </button>
    </div>
    <div class="metabox-field-scroll-counter">
        Wybrano:<span><?php echo $scroll_counter; ?></span>
    </div>
<?php } ?>
