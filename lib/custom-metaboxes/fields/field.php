<?php
    // Template - text, number, password, email, radio, checkbox
    $type          = $args['type'];
    $name          = $args['name'];
    $value         = $args['value'];
    $label         = $args['label'];
    $checked       = $args['checked'];
    $placeholder   = $args['placeholder'];
?>

<label class="metabox-field-label">
    
    <input <?php echo $checked; ?>
        class      ="metabox-field"
        type       ="<?php echo $type; ?>"
        name       ="<?php echo $name ?>"
        value      ="<?php echo $value; ?>"
        placeholder="<?php echo $placeholder; ?>"> 
    
    <?php echo $label; ?>

</label>