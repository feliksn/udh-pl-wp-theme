<?php 
    $fields = $args;
?>

<td class="metabox-repeater-cell">
    <?php foreach( $fields as $field ){ ?>
    <div class="metabox-repeater-subrow">
        <?php 
            get_template_part(CMB_DIR . '/fields/parts/title', null, $field['title']);
            get_template_part(CMB_DIR . '/fields/parts/description', null, $field['description']);
            get_template_part(CMB_DIR . '/fields/field', $field['type'], $field);
            get_template_part(CMB_DIR . '/fields/parts/dev-label', null, $field['name']);
        ?>
    </div>
    <?php } ?>
</td>