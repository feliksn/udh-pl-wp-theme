<?php
    $name        = $args['name'];
    $value       = $args['value'];
    $placeholder = $args['placeholder'];
    $rows        = $args['rows'];
?>

<textarea
    rows       ="<?php echo $rows; ?>"
    class      ="metabox-field"
    placeholder="<?php echo $placeholder; ?>"
    name       ="<?php echo $name ?>"><?php echo $value; ?>
</textarea> 