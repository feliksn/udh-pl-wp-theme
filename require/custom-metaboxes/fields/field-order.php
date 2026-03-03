<?php
    $name = $args['name'] . '[]';
    $options = cmb_field_options( $args );
?>

<ul class="metabox-order-list">
    <?php foreach( $options as $option ){?>
        <?php $label = $option['label']; ?>
        <?php $value = $option['value'] . ';' . $option['label']; ?>
        <li class="metabox-order-item">
            <?php echo $label; ?>
            <input
                type="hidden"
                name="<?php echo $name; ?>"
                value="<?php echo $value; ?>">
        </li>
    <?php } ?>
</ul>