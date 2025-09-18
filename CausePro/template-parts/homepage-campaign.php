<?php
/**
 * Template part for displaying the Campaign Feature section on the homepage.
 *
 * @package CausePro
 */

$headline    = get_theme_mod( 'causepro_campaign_headline', __( 'Featured Campaign', 'causepro' ) );
$text        = get_theme_mod( 'causepro_campaign_text', __( 'Help us reach our goal to build a new community center. Every contribution makes a difference!', 'causepro' ) );
$goal        = get_theme_mod( 'causepro_campaign_goal', 50000 );
$raised      = get_theme_mod( 'causepro_campaign_raised', 21000 );
$button_text = get_theme_mod( 'causepro_campaign_button_text', __( 'Contribute to Campaign', 'causepro' ) );
$button_link = get_theme_mod( 'causepro_campaign_button_link', '#' );

$percentage = 0;
if ( $goal > 0 ) {
	$percentage = ( $raised / $goal ) * 100;
}
$percentage = min( $percentage, 100 ); // Cap at 100%

?>

<section id="campaign-section" class="homepage-section campaign-section">
	<div class="container">
		<?php if ( ! empty( $headline ) ) : ?>
			<h2 class="section-title"><?php echo esc_html( $headline ); ?></h2>
		<?php endif; ?>

		<div class="campaign-content">
			<?php if ( ! empty( $text ) ) : ?>
				<div class="campaign-text"><?php echo wp_kses_post( $text ); ?></div>
			<?php endif; ?>

			<div class="campaign-progress">
				<div class="progress-bar-wrapper">
					<div class="progress-bar-inner" style="width: <?php echo esc_attr( $percentage ); ?>%;">
						<span class="progress-bar-percentage"><?php echo round( $percentage ); ?>%</span>
					</div>
				</div>
				<div class="progress-bar-labels">
					<span class="amount-raised"><?php echo esc_html( '$' . number_format( $raised ) ); ?> <?php esc_html_e( 'raised', 'causepro' ); ?></span>
					<span class="goal-amount"><?php esc_html_e( 'Goal:', 'causepro' ); ?> <?php echo esc_html( '$' . number_format( $goal ) ); ?></span>
				</div>
			</div>

			<?php if ( ! empty( $button_text ) && ! empty( $button_link ) ) : ?>
				<a href="<?php echo esc_url( $button_link ); ?>" class="button campaign-button">
					<?php echo esc_html( $button_text ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</section>
