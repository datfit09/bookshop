<?php get_header(); ?>

    <div class="container">
        <div class="row">
            <div id="primary" class="col-md-8 content-area">
                <main id="main" class="site-main">

                <?php
                if ( have_posts() ) :

                    if ( is_home() && ! is_front_page() ) :
                        ?>
                        <header>
                            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                        </header>
                        <?php
                    endif;

                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();

                        get_template_part( 'template-parts/content', get_post_type() );

                    endwhile;

                    finazi_pagination();

                else :

                    get_template_part( 'template-parts/content', 'none' );
                    

                endif;
                ?>

                </main>
            </div>

            <div id="sidebar" class="col-md-3 side-bar">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>

<?php
get_footer();
