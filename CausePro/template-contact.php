<?php
/**
 * Template Name: Contact Page
 *
 * This template provides a professional layout for a contact page.
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
        <header class="professional-page-header">
            <div class="container">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </div>
        </header>
    <?php endwhile; ?>

    <div class="contact-page-wrapper">
        <div class="container">
            <div class="contact-layout-grid">

                <div class="contact-details-section">
                    <?php
                    $address = get_theme_mod( 'causepro_contact_address' );
                    $phone   = get_theme_mod( 'causepro_contact_phone' );
                    $email   = get_theme_mod( 'causepro_contact_email' );
                    ?>
                    <h3><?php esc_html_e( 'Our Information', 'causepro' ); ?></h3>
                    <p><?php esc_html_e( 'Get in touch with us using the details below, or fill out the form.', 'causepro' ); ?></p>

                    <ul class="contact-details-list">
                        <?php if ( ! empty( $address ) ) : ?>
                            <li class="contact-detail-item address">
                                <span class="dashicons dashicons-location"></span>
                                <span><?php echo esc_html( $address ); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if ( ! empty( $phone ) ) : ?>
                            <li class="contact-detail-item phone">
                                <span class="dashicons dashicons-phone"></span>
                                <a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a>
                            </li>
                        <?php endif; ?>
                         <?php if ( ! empty( $email ) ) : ?>
                            <li class="contact-detail-item email">
                                <span class="dashicons dashicons-email-alt"></span>
                                <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="contact-form-section">
                    <?php
                    $form_content = get_theme_mod( 'causepro_contact_form' );
                    if ( ! empty( $form_content ) ) {
                        echo do_shortcode( wp_kses_post( $form_content ) );
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>

    <?php
    $map_url = get_theme_mod( 'causepro_contact_map_url' );
    if ( ! empty( $map_url ) ) :
    ?>
    <div class="contact-map-section">
        <iframe
            width="100%"
            height="450"
            style="border:0"
            loading="lazy"
            allowfullscreen
            src="<?php echo esc_url( $map_url ); ?>">
        </iframe>
    </div>
    <?php endif; ?>

</main><!-- #main -->

<?php
get_footer();
