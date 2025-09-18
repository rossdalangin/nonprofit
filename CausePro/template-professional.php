<?php
/**
 * Template Name: Professional Page
 *
 * This template provides a clean, professional layout with a full-width page header.
 *
 * @package CausePro
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();
        $subtitle = get_post_meta( get_the_ID(), '_page_subtitle', true );
        ?>

        <header class="professional-page-header">
            <div class="container">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                <?php if ( ! empty( $subtitle ) ) : ?>
                    <p class="page-subtitle"><?php echo esc_html( $subtitle ); ?></p>
                <?php endif; ?>
            </div>
        </header>

        <div class="entry-content-wrapper">
            <div class="container">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div><!-- .entry-content -->
                </article><!-- #post-<?php the_ID(); ?> -->
            </div>
        </div>

    <?php endwhile; // End of the loop. ?>

</main><!-- #main -->

<?php
get_footer();
