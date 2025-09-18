<?php
/**
 * Template part for displaying the Causes section on the homepage.
 *
 * @package CausePro
 */

$headline = get_theme_mod( 'causepro_causes_headline', __( 'Join a Cause', 'causepro' ) );
$count = get_theme_mod( 'causepro_causes_count', 3 );

$args = array(
	'post_type'      => 'cause',
	'posts_per_page' => absint( $count ),
	'orderby'        => 'date',
	'order'          => 'DESC',
);
$causes_query = new WP_Query( $args );
?>

<?php if ( $causes_query->have_posts() ) : ?>
<section id="causes-section" class="homepage-section causes-section">
	<div class="container">
		<?php if ( ! empty( $headline ) ) : ?>
			<h2 class="section-title"><?php echo esc_html( $headline ); ?></h2>
		<?php endif; ?>

		<div class="causes-grid">
			<?php while ( $causes_query->have_posts() ) : $causes_query->the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('cause-item'); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="cause-thumbnail">
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
                        <a href="<?php the_permalink(); ?>" class="button"><?php esc_html_e( 'Learn More', 'causepro' ); ?></a>
                    </footer>
				</article>
			<?php endwhile; ?>
		</div>
		<?php wp_reset_postdata(); ?>
	</div>
</section>
<?php endif; ?>
