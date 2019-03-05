<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package finazi
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'finazi' ); ?></a>

	<header id="masthead" class="site-header">
        <div class="top">
            <div class="container">
                <div class="top-bar">
                    <?php
                    $left = get_option( 'topbar_left' );
                    $right = get_option( 'topbar_right' );
                    $hotline = get_option( 'hotline' );
                    if ( ! empty( $left ) ) {
                        ?>
                        <div class="header-language topbar-item"><?php echo wp_kses_post( $left ); ?></div>
                        <?php
                    }
                    if ( ! empty( $right ) ) {
                        ?>
                        <div class="header-contact topbar-item"><?php echo wp_kses_post( $right ); ?></div>
                        <?php
                    }
                    if ( ! empty( $hotline ) ) {
                        ?>
                        <div class="header-content topbar-item"><?php echo wp_kses_post( $hotline ); ?></div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        

    	<div class="container container_header">
            <div class="site-branding">
                <?php
                the_custom_logo();
                if ( is_front_page() && is_home() ) :
                    ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php
                else :
                    ?>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php
                endif;
                $finazi_description = get_bloginfo( 'description', 'display' );
                if ( $finazi_description || is_customize_preview() ) :
                    ?>
                    <p class="site-description"><?php echo $finazi_description; /* WPCS: xss ok. */ ?></p>
                <?php endif; ?>
            </div>

            <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'container'      => 'nav',
                'menu_class'     => 'primary-menu menu',
            ) );
            ?>

            <button id="pull"><a href="#menu" id="toggle"><span></span></a></button>


            <div class="cart-view">
                <?php
                if ( class_exists( 'woocommerce' ) ) {
                ?>
                <a class="fa fa-shopping-bag shop-cart-count cart-count" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
                    <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                </a>
                <div class="mini-cart">
                    <?php woocommerce_mini_cart(); ?>
                </div>
                <?php } ?>
            </div>

            
            <div class="search-btn">
                <button class="fa fa-search search-button demo-btn"></button>
            </div>
        </div>

        <?php if ( ! is_front_page() ) {?>
            <div class="banner" style="<?php finazi_page_header_background(); ?>">
                <div class="container">
                    <?php finazi_title_blog(); ?>
                    <?php 
                    if ( class_exists( 'woocommerce' ) ) {
                        woocommerce_breadcrumb();
                    } ?>
                </div>
            </div>
        <?php
        }
        ?>
	</header>

	<div id="content" class="site-content">
