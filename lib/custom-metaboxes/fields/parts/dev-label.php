<?php
    $name = $args;
?>

<!-- Use user id to show a dev label below -->
<?php if( get_current_user_id() == 7 ) {?>
    <span class="metabox-field-tooltip"><?php echo $name; ?></span>
<?php } ?>