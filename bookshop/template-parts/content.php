<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package finazi
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <span class="post-format">
            <?php echo get_post_format(); ?>
        </span>
		<?php
		if ( is_singular() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
    	} elseif ( ! is_front_page() ) {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        }

        finazi_post_thumbnail();

        ?>
        
	</header>	

	<div class="entry-content">
		<?php
		if ( is_singular() ) {
            the_content( sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'finazi' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ) );

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'finazi' ),
                'after'  => '</div>',
            ) );
        } else {
            the_excerpt();
            ?>
            <a class="read-more" href="<?php the_permalink(); ?>">
                <?php esc_html_e( 'CONTINUE READING', 'finazi' ); ?>
            </a>
            <?php
        }
		?>
	</div>

    <?php if ( 'post' === get_post_type() ) :
        ?>
        <div class="entry-meta">
            <?php
            /**
            *finazi_posted_on', 10
            *finazi_posted_by', 20
            *finazi_posted_comment', 30
            *finazi_posted_social', 40
            */
            ?>
            <?php do_action( 'finazi_posted' ); ?>
        </div>

        <?php if ( is_singular( 'post' ) ) {
            get_template_part( 'author-bio' );
        } ?>
    <?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
