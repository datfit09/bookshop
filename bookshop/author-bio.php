<div class="athour-box">
    <div class="comment-item">
        <div class="comment-avatar">            
            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) , get_the_author_meta( 'user_nicename' ) ); ?>">
                <?php echo get_avatar( get_the_author_meta( 'ID' ), $size = 100, $default = '', $alt = '', $args = null ); ?>
            </a>
        </div>
        <div class="comment-content">
            <div class="comment-info">
                <strong class="comment-author">
                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) , get_the_author_meta( 'user_nicename' ) ); ?>">
                        <?php echo get_the_author_link(); ?>
                    </a>
                </strong>
            </div>
            <p class="comment-text">
                <?php echo get_the_author_meta( 'description' ); ?>
            </p>
            <?php echo finazi_social_author(); ?>
        </div>
    </div>
</div>