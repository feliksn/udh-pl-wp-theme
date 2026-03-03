<?php
    $fields = $args;
?>

<?php foreach( $fields as $field ) { ?>
    <td class="metabox-repeater-cell">
        <?php get_template_part( CMB_DIR . '/fields/field', $field['type'],  $field); ?>
    </td>
<?php } ?>