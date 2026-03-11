<?php
// а если была бы подключена  в function-custom.php навено не нужно было бы ее подключать ???
_init_template_fn('single-product');
$related_products = _get_related_products();

?>


<div class="d-flex">
    <?php foreach ($related_products as $related_product) { ?>
        <a class="mx-2 px-2" href="<?php echo $related_product['link']; ?>">
            <img
                src="<?php echo $related_product['image_url'] ?>"
                alt="...">
        </a>
    <?php } ?>
</div>