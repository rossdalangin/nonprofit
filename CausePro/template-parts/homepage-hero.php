<?php
/**
 * Template part for displaying the Hero section on the homepage.
 *
 * @package CausePro
 */

$headline = get_theme_mod( 'causepro_hero_headline', __( 'Your Support Changes Lives. See How.', 'causepro' ) );
$button_text = get_theme_mod( 'causepro_hero_button_text', __( 'Donate Now', 'causepro' ) );
$button_link = get_theme_mod( 'causepro_donation_link', '#' );
$bg_image_url = get_theme_mod( 'causepro_hero_bg_image', '' );

$style = '';
if ( ! empty( $bg_image_url ) ) {
	$style = 'style="background-image: url(' . esc_url( $bg_image_url ) . ');"';
}

?>

<section id="hero-section" class="homepage-section hero-section" <?php echo $style; ?>>
	<div class="section-overlay"></div>
	<div class="container">
		<div class="hero-content">
			<h1 class="hero-headline"><?php echo esc_html( $headline ); ?></h1>
			<?php if ( ! empty( $button_text ) && ! empty( $button_link ) ) : ?>
				<a href="<?php echo esc_url( $button_link ); ?>" class="button hero-button">
					<?php echo esc_html( $button_text ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</section>
