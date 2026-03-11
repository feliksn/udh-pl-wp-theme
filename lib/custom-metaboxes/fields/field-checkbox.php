<?php
    $args['name'] = $args['name'] . '[]';
    get_template_part(CMB_DIR . '/fields/field-radio', null, $args );
?>