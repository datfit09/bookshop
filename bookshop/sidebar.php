<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package finazi
 */

if ( ! is_active_sidebar( 'main-sidebar' ) || ! is_active_sidebar( 'shop-widget' ) || ( class_exists( 'woocommerce' ) && is_checkout() ) ) {
	return;
}
?>

<div id="sidebar" class="col-md-3 side-bar">
    <?php

        if ( class_exists( 'woocommerce' ) && is_active_sidebar( 'shop-widget' ) & ( is_shop() || is_product_category() || is_product_tag() || is_product() )  ) {
            dynamic_sidebar( 'shop-widget' );
        } else {
            dynamic_sidebar( 'main-sidebar' );
        }
    ?>
</div>
