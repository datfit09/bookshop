<?php
/**
 * finazi functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package finazi
 */

/**
*THEME_URI = theme.
*/
define( 'THEME_URI', get_template_directory_uri() . '/' );
define( 'THEME_DIR', get_template_directory() . '/' );

// link do_action to Hooks.
require_once THEME_DIR . 'inc/template-hooks.php';

// link do_action to Template hooks.
require_once THEME_DIR . 'inc/widgets/class-widget-recent-post-thumbnail.php';

if ( class_exists( 'woocommerce' ) ) {
    require_once THEME_DIR . 'inc/template-woocommerce-functions.php';
}

// Customize.
function finazi( $wp_customize ) {
    $dir = glob( THEME_DIR . 'inc/customizer/*.php' );
    foreach ( $dir as $file ) {
        if ( file_exists( $file ) ) {
            require_once $file;
        }
    }
}
add_action( 'customize_register', 'finazi' );

if ( ! function_exists( 'finazi_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function finazi_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on finazi, use a find and replace
		 * to change finazi to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'finazi', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'finazi' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'finazi_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );


        // Add Widget Autos_Recent_Post_Thumnbail for user.
        function wpb_load_widget() {
            register_widget( 'Autos_Recent_Post_Thumnbail' );
        }
        add_action( 'widgets_init', 'wpb_load_widget' );


        // Post formats.
        add_theme_support( 'post-formats' , array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'status',
            'audio',
            'chat',
        ) );  
        

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'finazi_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function finazi_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'finazi_content_width', 640 );
}
add_action( 'after_setup_theme', 'finazi_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function finazi_widgets_init() {
	register_sidebar( 
        array(
    		'name'          => esc_html__( 'Sidebar', 'finazi' ),
    		'id'            => 'main-sidebar',
    		'description'   => esc_html__( 'Add widgets here.', 'finazi' ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title">',
    		'after_title'   => '</h2>',
	) );

    register_sidebar(
        array(
            'name'          => __( 'Footer Widget', 'finazi' ),
            'id'            => 'footer-widget',
            'description'   => __( 'Widgets in this area will be shown on footer.', 'finazi' ),
            'before_widget' => '<ul id="%1$s" class="widget %2$s col-md-3">',
            'after_widget'  => '</ul>',
            'before_title'  => '<h2 class="widgettitle">',
            'after_title'   => '</h2>',
        )
    );

    // Add shop widget.
    if ( class_exists( 'woocommerce' ) ) {
        register_sidebar(
            array(
                'name'          => __( 'Shop Widget', 'finazi' ),
                'id'            => 'shop-widget',
                'description'   => __( 'Widgets for Shop page', 'finazi' ),
                'before_widget' => '<ul id="%1$s" class="widget %2$s">',
                'after_widget'  => '</ul>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }

}
add_action( 'widgets_init', 'finazi_widgets_init' );



/**
 * Enqueue scripts and styles.
 */
function finazi_scripts() {
	wp_enqueue_style( 'finazi-style', get_stylesheet_uri() );

    wp_enqueue_style( 'video', get_template_directory_uri() . '/assets/css/modal-video.min.css', array(), null );

    wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', array(), null );

    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', array(), null );

    wp_enqueue_style( 'ionicons-font', get_template_directory_uri() . '/assets/css/ionicons.min.css', array(), null );

	wp_enqueue_script( 'finazi-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'finazi-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    // General scripts.
    wp_enqueue_script(
        'finazi-general',
        THEME_URI . '/js/general.js',
        array( 'jquery' ),
        null,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'finazi_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Quote after footer style.
if ( ! function_exists( 'finazi_quote_footer_style' ) ) {
    function finazi_quote_footer_style() {
        $color    = get_option( 'finazi_quote_footer_color' );
        $bg_color = get_option( 'finazi_quote_footer_background' );

        $style = 'color: ' . $color . ';';
        $style .= 'background-image: url(' . $bg_color . ')';

        echo $style;
    }
}

// Footer style.
if ( ! function_exists( 'finazi_footer_style' ) ) {
    function finazi_footer_style() {
        $color1    = get_option( 'footer_color' );
        $bg_color1 = get_option( 'footer_background' );

        $style1 = 'color: ' . $color1 . ';';
        $style1 .= 'background-color: ' . $bg_color1;

        echo $style1;
    }
}

// Footer End style.
if ( ! function_exists( 'finazi_footer_end_style' ) ) {
    function finazi_footer_end_style() {
        $color    = get_option( 'footer_end_color', '#000' );
        $bg_color = get_option( 'footer_end_background', '#f5f5f5' );

        $style = 'color: ' . $color . ';';
        $style .= 'background-color: ' . $bg_color;

        echo $style;
    }
}

// Rename title page single for page category.
if ( ! function_exists( 'finazi_title_blog' ) ) {
    function finazi_title_blog() {
        $title     = get_option( 'finazi_title_blog' );
        if ( ( is_home() && ! is_front_page() ) || ( is_page() && ! is_front_page() ) ) {
            $title = single_post_title( '', false );
        } elseif ( is_category() ) {
            $title = sprintf( __( 'Category: %s' ), single_cat_title( '', false ) );
        } else {
            $title = "Shop";
        }
        ?>
        <div class="block">
            <h1 class="blog-title" style="<?php finazi_blog_title_style(); ?>">
                <span class="blog-title-text"><?php echo wp_kses_post( $title ); ?></span>
            </h1>
        </div>
        <?php
    }
}

// Add description 
if ( ! function_exists( 'finazi_description_blog' ) ) {
    function finazi_description_blog() {
        $title     = get_option( 'description_blog' );
        if ( is_singular( 'post' ) ) {
            $title = get_the_title();
        }
        ?>
            <h2 class="description-blog" style="<?php finazi_blog_title_style(); ?>">
                <?php echo wp_kses_post( $title ); ?>
            </h2>
        <?php
    }
}

// Color Blog Title.
if ( ! function_exists( 'finazi_blog_title_style' ) ) {
    function finazi_blog_title_style() {
        $color    = get_option( 'blog_color', '#000' );

        $style = 'color: ' . $color . ';';
        echo $style;
    }
}


// Replace image background Header.
if ( ! function_exists( 'finazi_page_header_background' ) ) {
    function finazi_page_header_background() {
        $bg_header = get_option( 'page_header_background' );
        $color     = get_option( 'background_header_image', '#303030' );
        $style     = 'background-color: ' . $color . ';';

        if ( false != $bg_header ) {
            $style .= 'background-image: url(' . $bg_header . ')';
        }

        echo $style;
    }
}

// Replace image background Quote Footer.
if ( ! function_exists( 'finazi_quote_footer_background' ) ) {
    function finazi_quote_footer_background() {
        $bg_quote = get_option( 'finazi_quote_footer_background' );
        $color     = get_option( 'background_footer_image' );
        $style     = 'background-color: ' . $color . ';';

        if ( false != $bg_quote ) {
            $style .= 'background-image: url(' . $bg_quote . ')';
        }

        echo $style;
    }
}

// Replace image background Footer.
if ( ! function_exists( 'finazi_page_footer_background' ) ) {
    function finazi_page_footer_background() {
        $bg_header = get_option( 'page_footer_background' );
        $color     = get_option( 'background_footer_image' );
        $style     = 'background-color: ' . $color . ';';

        if ( false != $bg_header ) {
            $style .= 'background-image: url(' . $bg_header . ')';
        }

        echo $style;
    }
}

// function pagination.
if ( ! function_exists( 'finazi_pagination' ) ) {
    function finazi_pagination() {
    ?>
    <div class="pagination-button">
        <?php
            $args = array(
                'prev_text'          => __( '<', 'finazi' ),
                'next_text'          => __( '>', 'finazi' ),
            );

            the_posts_pagination( $args );
        ?>
    </div>
    <?php
    }
}

// Function col.
if ( ! function_exists( 'finazi_col' ) ) {
    function finazi_col() {
        $col = '';
        $is_elementor_page = get_post_meta( get_the_ID(), '_elementor_edit_mode', true ); 
        if ( class_exists( 'woocommerce' ) && is_active_sidebar( 'shop-widget' ) & ( is_shop() || is_product_category() || is_product_tag() || is_product() ) ) { 
            $col = 'col-md-8';
        } elseif ( class_exists( 'woocommerce' ) && is_checkout() ) {
            $col = '';
        } elseif ( 'builder' === $is_elementor_page ) {
            $col = '';
        } elseif ( is_active_sidebar( 'main-sidebar' ) ) { 
            $col = 'col-md-8';
        }
    }
}

if ( defined( 'ELEMENTOR_VERSION' ) ) {
    require_once THEME_DIR . 'inc/elementor.php';
}

