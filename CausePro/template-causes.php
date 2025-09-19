<?php
/**
 * Template Name: Causes Page
 *
 * The template for displaying all Cause posts.
 *
 * @package CausePro
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
            <div class="page-subtitle">
                <?php esc_html_e( 'Find a cause that speaks to you. Your contribution, big or small, can make a world of difference.', 'causepro' ); ?>
            </div>
        </header><!-- .page-header -->

        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type'      => 'cause',
            'posts_per_page' => 9, // Adjust as needed
            'paged'          => $paged,
        );
        $causes_query = new WP_Query( $args );
        ?>

        <?php if ( $causes_query->have_posts() ) : ?>
            <div class="causes-grid causes-archive-grid">
                <?php while ( $causes_query->have_posts() ) : $causes_query->the_post();
                    $goal   = get_post_meta( get_the_ID(), '_cause_goal', true );
                    $raised = get_post_meta( get_the_ID(), '_cause_raised', true );
                    $percentage = 0;
                    if ( ! empty( $goal ) && $goal > 0 ) {
                        $percentage = ( $raised / $goal ) * 100;
                    }
                    $percentage = min( $percentage, 100 );
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('cause-item'); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="cause-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium_large' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="cause-item-content">
                            <header class="entry-header">
                                <?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
                            </header>
                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>

                            <?php if ( ! empty( $goal ) ) : ?>
                            <div class="cause-progress">
                                <div class="progress-bar-wrapper">
                                    <div class="progress-bar-inner" style="width: <?php echo esc_attr( $percentage ); ?>%;">
                                    </div>
                                </div>
                                <div class="progress-bar-labels">
                                    <span class="amount-raised"><?php echo esc_html( '$' . number_format( $raised ) ); ?></span>
                                    <span class="goal-amount"><?php esc_html_e( 'Goal:', 'causepro' ); ?> <?php echo esc_html( '$' . number_format( $goal ) ); ?></span>
                                </div>
                            </div>
                            <?php endif; ?>

                            <footer class="entry-footer">
                                <a href="<?php the_permalink(); ?>" class="button"><?php esc_html_e( 'Donate Now', 'causepro' ); ?></a>
                            </footer>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            // Pagination
            $big = 999999999; // need an unlikely integer
            echo paginate_links( array(
                'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'  => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total'   => $causes_query->max_num_pages,
                'prev_text' => __('&laquo; Previous'),
                'next_text' => __('Next &raquo;'),
            ) );
            ?>

            <?php wp_reset_postdata(); ?>
        <?php else : ?>
             <div class="no-posts-found">
                <p><?php esc_html_e( 'It seems there are no active causes at the moment. Please check back soon!', 'causepro' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button"><?php esc_html_e( 'Return to Homepage', 'causepro' ); ?></a>
            </div>
        <?php endif; ?>
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();
