<?php
/**
 * Template part for displaying the Blog section on the homepage.
 *
 * @package CausePro
 */

$headline = get_theme_mod( 'causepro_blog_headline', __( 'From Our Blog', 'causepro' ) );
$count = get_theme_mod( 'causepro_blog_count', 3 );

// Generate background styles
$bg_style = '';
$bg_type = get_theme_mod( 'causepro_blog_bg_type', 'none' );
if ($bg_type === 'color') {
    $bg_style = 'style="background-color: ' . esc_attr(get_theme_mod('causepro_blog_bg_color')) . ';"';
} elseif ($bg_type === 'gradient') {
    $grad1 = esc_attr(get_theme_mod('causepro_blog_bg_gradient_1'));
    $grad2 = esc_attr(get_theme_mod('causepro_blog_bg_gradient_2'));
    $bg_style = 'style="background-image: linear-gradient(to right, ' . $grad1 . ', ' . $grad2 . ');"';
} elseif ($bg_type === 'image') {
    $bg_image_url = get_theme_mod('causepro_blog_bg_image');
    if (!empty($bg_image_url)) {
        $bg_style = 'style="background-image: url(' . esc_url($bg_image_url) . ');"';
    }
}

$args = array(
	'post_type'      => 'post',
	'posts_per_page' => absint( $count ),
	'orderby'        => 'date',
	'order'          => 'DESC',
    'ignore_sticky_posts' => 1,
);
$blog_query = new WP_Query( $args );
?>

<?php if ( $blog_query->have_posts() ) : ?>
<section id="blog-section" class="homepage-section blog-section" <?php echo $bg_style; ?>>
	<div class="container">
		<?php if ( ! empty( $headline ) ) : ?>
			<h2 class="section-title"><?php echo esc_html( $headline ); ?></h2>
		<?php endif; ?>

		<div class="blog-grid">
			<?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('blog-item'); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="blog-thumbnail">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'medium_large' ); ?>
							</a>
						</div>
					<?php endif; ?>
					<header class="entry-header">
						<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
					</header>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div>
                    <footer class="entry-footer">
                        <a href="<?php the_permalink(); ?>" class="button"><?php esc_html_e( 'Read More', 'causepro' ); ?></a>
                    </footer>
				</article>
			<?php endwhile; ?>
		</div>
		<?php wp_reset_postdata(); ?>
	</div>
</section>
<?php endif; ?>
