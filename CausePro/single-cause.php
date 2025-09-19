<?php
/**
 * The template for displaying all single Cause posts
 *
 * @package CausePro
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('cause-single'); ?>>

            <header class="cause-single-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>');">
                <div class="section-overlay"></div>
                <div class="container">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </div>
            </header>

            <div class="cause-single-content-area">
                <div class="container">
                    <div class="cause-single-layout-grid">
                        <div class="cause-main-content">
                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div><!-- .entry-content -->
                        </div><!-- .cause-main-content -->

                        <aside class="cause-sidebar">
                            <div class="cause-sidebar-widget">
                                <?php
                                $goal   = get_post_meta( get_the_ID(), '_cause_goal', true );
                                $raised = get_post_meta( get_the_ID(), '_cause_raised', true );
                                $percentage = 0;
                                if ( ! empty( $goal ) && $goal > 0 ) {
                                    $percentage = ( $raised / $goal ) * 100;
                                }
                                $percentage = min( $percentage, 100 );
                                ?>

                                <?php if ( ! empty( $goal ) ) : ?>
                                <div class="cause-progress-widget">
                                    <div class="progress-bar-labels">
                                        <span class="amount-raised"><?php echo esc_html( '$' . number_format( $raised ) ); ?></span>
                                        <span class="goal-amount"><?php esc_html_e( 'raised of', 'causepro' ); ?> <?php echo esc_html( '$' . number_format( $goal ) ); ?></span>
                                    </div>
                                    <div class="progress-bar-wrapper">
                                        <div class="progress-bar-inner" style="width: <?php echo esc_attr( $percentage ); ?>%;"></div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <div class="donate-to-cause-wrapper">
                                    <a href="<?php echo esc_url( get_theme_mod( 'causepro_donation_link', '#' ) ); ?>" class="button donate-button-large">
                                        <?php esc_html_e( 'Donate to this Cause', 'causepro' ); ?>
                                    </a>
                                </div>

                                <?php get_template_part( 'template-parts/social-share' ); ?>
                            </div>
                        </aside><!-- .cause-sidebar -->
                    </div><!-- .cause-single-layout-grid -->
                </div><!-- .container -->
            </div><!-- .cause-single-content-area -->

        </article><!-- #post-<?php the_ID(); ?> -->

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            echo '<div class="container">';
            comments_template();
            echo '</div>';
        endif;
        ?>

    <?php endwhile; // End of the loop. ?>
</main><!-- #main -->

<?php
get_footer();
