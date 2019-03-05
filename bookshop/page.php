<?php
$col = '';
if ( class_exists( 'woocommerce' ) && is_active_sidebar( 'shop-widget' ) & ( is_shop() || is_product_category() || is_product_tag() || is_product() ) ) { 
    $col = 'col-md-8';
} elseif ( class_exists( 'woocommerce' ) && is_checkout() ) {
    $col = '';
} elseif ( is_active_sidebar( 'main-sidebar' ) ) {
    $col = 'col-md-8';
}

get_header();
?>

    <div class="container">
        <div class="row">
            <div id="primary" class="<?php echo esc_attr( $col ); ?> content-area">
                <main id="main" class="site-main">
            	<?php
            		while ( have_posts() ) :
            			the_post();

            			get_template_part( 'template-parts/content', 'page' );

            			// If comments are open or we have at least one comment, load up the comment template.
            			if ( comments_open() || get_comments_number() ) :
            				comments_template();
            			endif;

            		endwhile; // End of the loop.
        		?>
        		</main>
            </div>

           <?php get_sidebar(); ?>
        </div>
    </div>

<?php
get_footer();
