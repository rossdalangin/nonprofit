<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CausePro
 */

?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
        <div class="footer-widgets">
            <div class="footer-widget-area">
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-1' ); ?>
                <?php endif; ?>
            </div>
            <div class="footer-widget-area">
                <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-2' ); ?>
                <?php endif; ?>
            </div>
            <div class="footer-widget-area">
                <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-3' ); ?>
                <?php endif; ?>
            </div>
        </div><!-- .footer-widgets -->

		<div class="site-info">
            <div class="footer-copyright">
			    <?php echo wp_kses_post( get_theme_mod( 'causepro_copyright_text', sprintf( 'Copyright &copy; %s %s', date( 'Y' ), get_bloginfo( 'name' ) ) ) ); ?>
            </div>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'causepro' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Powered by %s', 'causepro' ), 'WordPress' );
				?>
			</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
