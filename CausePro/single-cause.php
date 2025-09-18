<?php
/**
 * The template for displaying all single Cause posts
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
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('cause-single'); ?>>
				<div class="container">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="cause-featured-image">
							<?php the_post_thumbnail('large'); ?>
						</div>
					<?php endif; ?>

					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php
						the_content(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'causepro' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								get_the_title()
							)
						);
						?>
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<div class="donate-to-cause-wrapper">
							<a href="<?php echo esc_url( get_theme_mod( 'causepro_donation_link', '#' ) ); ?>" class="button donate-button-large">
								<?php esc_html_e( 'Donate to this Cause', 'causepro' ); ?>
							</a>
							<p class="donation-prompt"><?php esc_html_e( 'Your contribution can make a real difference.', 'causepro' ); ?></p>
						</div>
					</footer><!-- .entry-footer -->

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
