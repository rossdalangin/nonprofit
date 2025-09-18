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
                <?php while ( $causes_query->have_posts() ) : $causes_query->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('cause-item'); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="cause-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium_large' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <header class="entry-header">
                            <?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
                        </header>
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                        <footer class="entry-footer">
                            <a href="<?php the_permalink(); ?>" class="button"><?php esc_html_e( 'Learn More', 'causepro' ); ?></a>
                        </footer>
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
                'total'   => $causes_query->max_num_pages
            ) );
            ?>

            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <p><?php esc_html_e( 'Sorry, no causes found.', 'causepro' ); ?></p>
        <?php endif; ?>
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();
