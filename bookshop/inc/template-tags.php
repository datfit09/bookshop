<?php
/**
 * Custom template tags for this theme
 *
 * finaziually, some of the functionality here could be replaced by core features.
 *
 * @package finazi
 */

if ( ! function_exists( 'finazi_posted_on' ) ) :
	function finazi_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

        $date_icon = apply_filters( 'finazi_posted_on_icon', THEME_URI . 'assets/images/date.png' );
		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'finazi' ),
			'<span class="meta-reply"><img src="' . $date_icon . '" class="icon-comment"></span> <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<strong class="posted-on">' . $posted_on . '</strong>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'finazi_posted_by' ) ) :
	function finazi_posted_by() {
        $edit_icon = apply_filters( 'finazi_posted_on_icon', THEME_URI . 'assets/images/edit.png' );
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'finazi' ),
			'<span class="meta-reply"><img src="' . $edit_icon . '" class="icon-comment"></span><span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<strong class="byline"> ' . $byline . '</strong>'; // WPCS: XSS OK.

	}
endif;

// function post meta : comment. 
if ( ! function_exists( 'finazi_posted_comment' ) ) {
    function finazi_posted_comment() {
        if ( 'link' == get_post_format() || 'quote' == get_post_format() ) {
            return;
        }
        ?>
            <?php
            $comment_icon = apply_filters( 'finazi_posted_on_icon', THEME_URI . 'assets/images/comment.png' );
            if ( comments_open() ):
                echo '<strong class="bycomment"><span class="meta-reply"><img src="' . $comment_icon . '" class="icon-comment"></span>';
                    comments_popup_link(
                        __( 'Leave a comment', 'autos' ),
                        __( 'One comment', 'autos' ),
                        __( '% comments', 'autos' ),
                        __( 'Read all comments', 'autos' )
                    );
                echo '</strong>';
            endif;
        ?>
    <?php }
}

if ( ! function_exists( 'finazi_posted_social' ) ) {
    function finazi_posted_social() {
        ?>
        <strong class="social-posted">
            <li>
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
                    <span class="fa fa-facebook social-button-content"></span>
                </a>
            </li>
            <li>
                <a target="_blank" href="https://twitter.com/home?status=<?php the_permalink(); ?>">
                    <span class="fa fa-twitter social-button-content"></span>
                </a>
            </li>
            <li>
                <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>">
                    <span class="fa fa-linkedin-square social-button-content"></span>
                </a>
            </li>
        </strong>
        <?php 
    }
}


if ( ! function_exists( 'finazi_social_author' ) ) {
    function finazi_social_author() {
        ?>
        <ul class="social-posted">
            <li>
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) , get_the_author_meta( 'user_nicename' ) ); ?>">
                    <span class="fa fa-facebook social-button-content"></span>
                </a>
            </li>
            <li>
                <a target="_blank" href="https://twitter.com/home?status=<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) , get_the_author_meta( 'user_nicename' ) ); ?>">
                    <span class="fa fa-twitter social-button-content"></span>
                </a>
            </li>
            <li>
                <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) , get_the_author_meta( 'user_nicename' ) ); ?>&title=<?php the_title(); ?>">
                    <span class="fa fa-linkedin-square social-button-content"></span>
                </a>
            </li>
        </ul>
        <?php 
    }
}


if ( ! function_exists( 'finazi_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function finazi_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'finazi' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'finazi' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'finazi' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'finazi' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'finazi' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'finazi' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'finazi_post_thumbnail' ) ) :
	function finazi_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;
