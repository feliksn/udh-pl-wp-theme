<?php
    $field_name  = $args['name'];
    $field_type  = $args['type'];
    $value       = cmb_field_value_media( $args['value'] );
    $field_value = $value['id'];
    $file_url    = $value['url'];
    $file_name   = $value['name'];
    $file_type   = $value['type'];

?>

<a  href="#"
    data-field-type="<?php echo $field_type; ?>" 
    class="<?php echo ( ! $field_value ? 'button' : ''); ?> metabox-button metabox-button-upload">
    <?php if( $field_value ){ ?>
        
        <?php if( $field_type == 'image' ) { ?>
            <img class="metabox-image" src="<?php echo esc_url( $file_url ) ?>"/>
        <?php } else { ?>
            <div class="metabox-file">
                <span class="metabox-file-icon dashicons dashicons-media-<?php echo $field_type; ?>"></span><br>
                <span class="metabox-file-name">
                    Nazwa: <strong><?php echo $file_name; ?></strong>
                </span><br>
                <span class="metabox-file-type">
                    Typ: <strong><?php echo $file_type; ?></strong>
                </span>
            </div>
        <?php } ?>

    <?php } else { ?>
        Wybierz plik
    <?php } ?>
</a>

<a  href="#"
    class="metabox-button metabox-button-remove"
    style="<?php echo ( ! $field_value ? 'display: none' : '') ?>">
    Usuń plik
</a>
        
<input
    type="hidden"
    name="<?php echo $field_name; ?>"
    value="<?php echo $field_value; ?>">
