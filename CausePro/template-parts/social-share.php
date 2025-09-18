<?php
/**
 * Template part for displaying social sharing buttons.
 *
 * @package CausePro
 */

$show_twitter = get_theme_mod( 'causepro_social_twitter_show', true );
$show_facebook = get_theme_mod( 'causepro_social_facebook_show', true );
$show_linkedin = get_theme_mod( 'causepro_social_linkedin_show', true );

if ( ! $show_twitter && ! $show_facebook && ! $show_linkedin ) {
    return;
}

$post_url = get_permalink();
$post_title = get_the_title();
$twitter_handle = get_theme_mod( 'causepro_social_twitter_handle', '' );
?>

<div class="social-share-wrapper">
    <h3 class="social-share-title"><?php esc_html_e( 'Share This Post', 'causepro' ); ?></h3>
    <ul class="social-share-list">
        <?php if ( $show_twitter ) : ?>
            <li>
                <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( $post_url ); ?>&text=<?php echo esc_attr( $post_title ); ?>&via=<?php echo esc_attr( $twitter_handle ); ?>" target="_blank" rel="noopener noreferrer" class="social-share-link twitter">
                    <span class="dashicons dashicons-twitter"></span>
                    <span class="screen-reader-text"><?php esc_html_e( 'Share on Twitter', 'causepro' ); ?></span>
                </a>
            </li>
        <?php endif; ?>
        <?php if ( $show_facebook ) : ?>
            <li>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $post_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-share-link facebook">
                    <span class="dashicons dashicons-facebook-alt"></span>
                    <span class="screen-reader-text"><?php esc_html_e( 'Share on Facebook', 'causepro' ); ?></span>
                </a>
            </li>
        <?php endif; ?>
        <?php if ( $show_linkedin ) : ?>
            <li>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( $post_url ); ?>&title=<?php echo esc_attr( $post_title ); ?>" target="_blank" rel="noopener noreferrer" class="social-share-link linkedin">
                    <span class="dashicons dashicons-linkedin"></span>
                    <span class="screen-reader-text"><?php esc_html_e( 'Share on LinkedIn', 'causepro' ); ?></span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>
