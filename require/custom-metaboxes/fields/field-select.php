<?php
    $name    = $args['name'];
    // Second arg is true to get checked attr as 'selected' for the select option
    // Default checked attr is 'checked' for radio, checkbox
    $options = cmb_field_options($args, TRUE);
?>

<select
    class="metabox-field"
    name="<?php echo $name; ?>">

    <option value="">- Wybierz z listy -</option>
    
    <?php foreach( $options as $option ) { ?>
        <option value="<?php echo $option['value']; ?>" <?php echo $option['checked']; ?>>
            <?php echo $option['label']; ?>
        </option>
    <?php } ?>
</select>