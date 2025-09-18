<?php
/**
 * Template part for displaying the Hero section on the homepage.
 *
 * @package CausePro
 */

// Get section settings
$headline = get_theme_mod( 'causepro_hero_headline', __( 'Your Support Changes Lives. See How.', 'causepro' ) );
$subtitle = get_theme_mod( 'causepro_hero_subtitle', __( 'Join our community of donors and make a real impact. Every contribution, big or small, helps us create positive change.', 'causepro' ) );
$button_text = get_theme_mod( 'causepro_hero_button_text', __( 'Donate Now', 'causepro' ) );
$button_link = get_theme_mod( 'causepro_donation_link', '#' );

// Generate background styles
$bg_style = '';
$bg_type = get_theme_mod( 'causepro_hero_bg_type', 'image' ); // Default to image for hero
if ($bg_type === 'color') {
    $bg_style = 'style="background-color: ' . esc_attr(get_theme_mod('causepro_hero_bg_color')) . ';"';
} elseif ($bg_type === 'gradient') {
    $grad1 = esc_attr(get_theme_mod('causepro_hero_bg_gradient_1'));
    $grad2 = esc_attr(get_theme_mod('causepro_hero_bg_gradient_2'));
    $bg_style = 'style="background-image: linear-gradient(to right, ' . $grad1 . ', ' . $grad2 . ');"';
} elseif ($bg_type === 'image') {
    $bg_image_url = get_theme_mod('causepro_hero_bg_image');
    if (!empty($bg_image_url)) {
        $bg_style = 'style="background-image: url(' . esc_url($bg_image_url) . ');"';
    }
}
?>

<section id="hero-section" class="homepage-section hero-section" <?php echo $bg_style; ?>>
	<div class="section-overlay"></div>
	<div class="container">
		<div class="hero-content">
			<h1 class="hero-headline"><?php echo esc_html( $headline ); ?></h1>
			<?php if ( ! empty( $subtitle ) ) : ?>
				<p class="hero-subtitle"><?php echo esc_html( $subtitle ); ?></p>
			<?php endif; ?>
			<?php if ( ! empty( $button_text ) && ! empty( $button_link ) ) : ?>
				<a href="<?php echo esc_url( $button_link ); ?>" class="button hero-button">
					<?php echo esc_html( $button_text ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</section>
