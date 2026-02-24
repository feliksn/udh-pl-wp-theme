<?php

    function _get_related_products(){
        
        $query = new WP_Query([
            'post_type' => 'product',
            'cat' => 3 // beer
        ]);
        
        $related_products = [];

        if( $query->have_posts() ){
            while( $query->have_posts() ){
                $query->the_post();

                $product_id = get_the_ID();
                
                $related_products[] = [
                    'id'        => $product_id,
                    'link'      => get_the_permalink(),
                    'image_url' => get_the_post_thumbnail_url( $product_id, 'thumbnail' ),
                ];
            }
            wp_reset_postdata();
        }

        return $related_products;
    }
    

?>