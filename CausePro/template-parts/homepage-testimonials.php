<?php
/**
 * Template part for displaying the Testimonials section on the homepage.
 *
 * @package CausePro
 */

$headline = get_theme_mod( 'causepro_testimonials_headline', __( 'What People Are Saying', 'causepro' ) );
$count = get_theme_mod( 'causepro_testimonials_count', 3 );

// Generate background styles
$bg_style = '';
$bg_type = get_theme_mod( 'causepro_testimonials_bg_type', 'color' );
if ($bg_type === 'color') {
    $bg_style = 'style="background-color: ' . esc_attr(get_theme_mod('causepro_testimonials_bg_color')) . ';"';
} elseif ($bg_type === 'gradient') {
    $grad1 = esc_attr(get_theme_mod('causepro_testimonials_bg_gradient_1'));
    $grad2 = esc_attr(get_theme_mod('causepro_testimonials_bg_gradient_2'));
    $bg_style = 'style="background-image: linear-gradient(to right, ' . $grad1 . ', ' . $grad2 . ');"';
} elseif ($bg_type === 'image') {
    $bg_image_url = get_theme_mod('causepro_testimonials_bg_image');
    if (!empty($bg_image_url)) {
        $bg_style = 'style="background-image: url(' . esc_url($bg_image_url) . ');"';
    }
}

$args = array(
	'post_type'      => 'testimonial',
	'posts_per_page' => absint( $count ),
	'orderby'        => 'date',
	'order'          => 'DESC',
);
$testimonials_query = new WP_Query( $args );
?>

<?php if ( $testimonials_query->have_posts() ) : ?>
<section id="testimonials-section" class="homepage-section testimonials-section" <?php echo $bg_style; ?>>
	<div class="container">
		<?php if ( ! empty( $headline ) ) : ?>
			<h2 class="section-title"><?php echo esc_html( $headline ); ?></h2>
		<?php endif; ?>

		<div class="testimonials-grid">
			<?php while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post();
                $subtitle = get_post_meta( get_the_ID(), '_testimonial_subtitle', true );
            ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('testimonial-item'); ?>>
                    <div class="testimonial-content">
                        <?php the_content(); ?>
                    </div>
                    <footer class="testimonial-author">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="author-image">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="author-info">
                            <h4 class="author-name"><?php the_title(); ?></h4>
                            <?php if ( ! empty( $subtitle ) ) : ?>
                                <p class="author-subtitle"><?php echo esc_html( $subtitle ); ?></p>
                            <?php endif; ?>
                        </div>
                    </footer>
				</article>
			<?php endwhile; ?>
		</div>
		<?php wp_reset_postdata(); ?>
	</div>
</section>
<?php endif; ?>
