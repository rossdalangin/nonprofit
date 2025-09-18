<?php
/**
 * The template for displaying all single Event posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CausePro
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			$event_date_time = get_post_meta( get_the_ID(), '_event_date_time', true );
			$location        = get_post_meta( get_the_ID(), '_event_location', true );
			$link            = get_post_meta( get_the_ID(), '_event_link', true );
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('event-single'); ?>>
				<div class="container">

					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->

					<div class="event-details">
						<?php if ( ! empty( $event_date_time ) ) : ?>
							<div class="event-detail event-date">
								<strong><?php esc_html_e( 'When:', 'causepro' ); ?></strong>
								<?php
									$date = new DateTime( $event_date_time );
									echo esc_html( $date->format( 'l, F j, Y \a\t g:i a' ) );
								?>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $location ) ) : ?>
							<div class="event-detail event-location">
								<strong><?php esc_html_e( 'Where:', 'causepro' ); ?></strong>
								<?php echo esc_html( $location ); ?>
							</div>
						<?php endif; ?>
						<?php
							$event_types = get_the_term_list( get_the_ID(), 'event_type', '<div class="event-detail event-types"><strong>' . esc_html__( 'Event Type:', 'causepro' ) . '</strong> ', ', ', '</div>' );
							if ( ! is_wp_error( $event_types ) && ! empty( $event_types ) ) {
								echo $event_types;
							}
						?>
					</div>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="event-featured-image">
							<?php the_post_thumbnail('large'); ?>
						</div>
					<?php endif; ?>

					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->

					<?php if ( ! empty( $link ) ) : ?>
						<footer class="entry-footer">
							<div class="event-registration-wrapper">
								<a href="<?php echo esc_url( $link ); ?>" class="button event-registration-button" target="_blank" rel="noopener noreferrer">
									<?php esc_html_e( 'Register or Learn More', 'causepro' ); ?>
								</a>
							</div>
						</footer><!-- .entry-footer -->
					<?php endif; ?>

				</div><!-- .container -->
			</article><!-- #post-<?php the_ID(); ?> -->

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
