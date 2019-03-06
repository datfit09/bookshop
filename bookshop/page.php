<?php
finazi_col();
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
