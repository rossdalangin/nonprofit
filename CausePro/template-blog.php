<?php
/**
 * Template Name: Blog Masonry
 *
 * The template for displaying a masonry blog layout.
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
        $paged = 1;
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 9,
            'paged'          => $paged,
        );
        $blog_query = new WP_Query( $args );
        ?>

        <?php if ( $blog_query->have_posts() ) : ?>
            <div id="masonry-grid" class="masonry-grid">
                <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('masonry-item'); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium_large' ); ?>
                            </a>
                            </div>
                        <?php endif; ?>
                        <div class="masonry-content">
                            <header class="entry-header">
                                <?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
                                <div class="entry-meta">
                                    <?php causepro_posted_on(); ?>
                                </div><!-- .entry-meta -->
                            </header>
                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="load-more-container">
                <button id="load-more-posts" class="button" data-page="1" data-max-pages="<?php echo $blog_query->max_num_pages; ?>">
                    <?php esc_html_e( 'Load More', 'causepro' ); ?>
                </button>
            </div>

            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <p><?php esc_html_e( 'Sorry, no posts found.', 'causepro' ); ?></p>
        <?php endif; ?>
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();
