<?php
/**
 * Template part for displaying the Impact section on the homepage.
 *
 * @package CausePro
 */

$headline = get_theme_mod( 'causepro_impact_headline', __( 'Our Impact', 'causepro' ) );
?>

<section id="impact-section" class="homepage-section impact-section">
	<div class="container">
		<?php if ( ! empty( $headline ) ) : ?>
			<h2 class="section-title"><?php echo esc_html( $headline ); ?></h2>
		<?php endif; ?>

		<div class="impact-stats-grid">
			<?php for ( $i = 1; $i <= 4; $i++ ) :
				$number = get_theme_mod( "causepro_impact_stat_{$i}_number", "10,000+" );
				$label  = get_theme_mod( "causepro_impact_stat_{$i}_label", "People Helped" );
				$icon   = get_theme_mod( "causepro_impact_stat_{$i}_icon", "dashicons-groups" );
				?>
				<div id="impact-stat-<?php echo $i; ?>" class="impact-stat">
					<?php if ( ! empty( $icon ) ) : ?>
						<div class="stat-icon-wrapper">
							<span class="stat-icon dashicons-before <?php echo esc_attr( $icon ); ?>"></span>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $number ) ) : ?>
						<p class="stat-number"><?php echo esc_html( $number ); ?></p>
					<?php endif; ?>
					<?php if ( ! empty( $label ) ) : ?>
						<p class="stat-label"><?php echo esc_html( $label ); ?></p>
					<?php endif; ?>
				</div>
			<?php endfor; ?>
		</div>
	</div>
</section>
