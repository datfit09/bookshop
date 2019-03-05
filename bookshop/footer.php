<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package finazi
 */

// cai nay co lay data moi ko co

?>

	</div><!-- #content -->
    

    <div class="quote-footer" style="<?php finazi_quote_footer_style(); ?>">
        <div class="container">
            <?php
            $left_quote = get_option( 'quote_left' );
            $right_quote = get_option( 'quote_right' );
            if ( ! empty( $left_quote )  ) {
                ?>
                <p class="quote-item" >
                    <?php echo wp_kses_post( $left_quote ); ?>
                </p>
                <?php
            }
            if ( ! empty( $right_quote ) ) {
                ?>
                <button class="quote-btn quote-item">
                    <?php echo wp_kses_post( get_option( 'quote_right' ) ); ?>
                </button>
                <?php
            }
            ?>
        </div>
    </div>

	<footer id="colophon" class="site-footer" style="<?php finazi_footer_style(); ?>">
		<div class="site-info">
            <div class="join-now" style="<?php finazi_page_footer_background(); ?>">
                <div class="footer-widget">
                    <div class="container">
                        <?php
                        if ( is_active_sidebar( 'footer-widget' ) ) {
                            dynamic_sidebar( 'footer-widget' );
                        }
                        ?>
                    </div>
                </div>
            </div>

			<div class="ft-end" style="<?php finazi_footer_end_style(); ?>">
                <div class="container">
                    <div class="ft-copyright">
                        <div class="copyright">
                            <?php echo wp_kses_post( get_option( 'footer_left', 'Copyright © 2016 ConsultWP, Designed by FelixDG.' ) ); ?>
                        </div>
                        <div class="FAQ">
                            <?php echo wp_kses_post( get_option( 'footer_right', 'Back to top' ) ); ?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</footer>
</div>

<div class="menu-overlay"></div>
<div class="modal">
    <div class="modal-view">
        <div class="modal-header">
            <div class="modal-title"><?php echo wp_kses_post( 'Search Page' , 'finazi' ); ?></div>
            <button class="modal-close">x</button>
        </div>
        <div class="modal-content">
            
        </div>
        <div class="modal-action">
            <button class="btn modal-close"><?php echo wp_kses_post( 'Close' , 'finazi' ); ?></button>
            <button class="btn modal-close modal-save"><?php echo wp_kses_post( 'Search' , 'finazi' ); ?></button>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>
