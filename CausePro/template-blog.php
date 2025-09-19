<?php
/**
 * Template Name: Blog Page
 *
 * The template for displaying all blog posts.
 *
 * @package CausePro
 */

get_header();

$current_cat_id = isset( $_GET['category'] ) ? (int) $_GET['category'] : 0;
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
            <div class="page-subtitle">
                <?php esc_html_e( 'Stay up to date with our latest news, stories, and articles.', 'causepro' ); ?>
            </div>
        </header><!-- .page-header -->

        <div class="category-filters">
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="<?php echo ( $current_cat_id === 0 ? 'active' : '' ); ?>"><?php esc_html_e( 'All Posts', 'causepro' ); ?></a>
            <?php
            $categories = get_categories( array(
                'orderby' => 'name',
                'order'   => 'ASC',
                'hide_empty' => true,
            ) );
            foreach ( $categories as $category ) {
                $class = ( $current_cat_id === $category->term_id ) ? 'active' : '';
                echo '<a href="' . esc_url( add_query_arg( 'category', $category->term_id, get_permalink() ) ) . '" class="' . esc_attr( $class ) . '">' . esc_html( $category->name ) . '</a>';
            }
            ?>
        </div>

        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 9,
            'paged'          => $paged,
        );

        if ( $current_cat_id > 0 ) {
            $args['cat'] = $current_cat_id;
        }

        $blog_query = new WP_Query( $args );
        ?>

        <?php if ( $blog_query->have_posts() ) : ?>
            <div class="blog-grid">
                <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-item'); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="blog-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium_large' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="blog-item-content">
                            <header class="entry-header">
                                <?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
                                <div class="entry-meta">
                                    <span class="posted-on"><?php echo get_the_date(); ?></span>
                                </div><!-- .entry-meta -->
                            </header>
                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>
                            <footer class="entry-footer">
                                <a href="<?php the_permalink(); ?>" class="button"><?php esc_html_e( 'Read More', 'causepro' ); ?></a>
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
                'total'   => $blog_query->max_num_pages,
                'add_args' => array( 'category' => $current_cat_id ),
                'prev_text' => __('&laquo; Previous'),
                'next_text' => __('Next &raquo;'),
            ) );
            ?>

            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <div class="no-posts-found">
                <p><?php esc_html_e( 'Sorry, no posts found in this category.', 'causepro' ); ?></p>
            </div>
        <?php endif; ?>
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();
