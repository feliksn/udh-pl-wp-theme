<?php
    $errors = $args;
?>

<?php if( $errors ){?>
    <ul class="metabox-field-error">
        <?php echo $errors; ?>
    </ul>
<?php } ?>