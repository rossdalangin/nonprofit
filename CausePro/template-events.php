<?php
/**
 * Template Name: Events Page
 *
 * The template for displaying all upcoming Event posts, with filtering.
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

        <div class="event-filters">
            <form method="get" action="<?php echo esc_url( get_permalink() ); ?>">
                <?php
                $terms = get_terms( array(
                    'taxonomy'   => 'event_type',
                    'hide_empty' => true,
                ) );
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                    echo '<select name="event_type_filter" onchange="this.form.submit()">';
                    echo '<option value="">' . esc_html__( 'All Event Types', 'causepro' ) . '</option>';
                    $current_filter = isset( $_GET['event_type_filter'] ) ? sanitize_text_field( $_GET['event_type_filter'] ) : '';
                    foreach ( $terms as $term ) {
                        echo '<option value="' . esc_attr( $term->slug ) . '"' . selected( $current_filter, $term->slug, false ) . '>' . esc_html( $term->name ) . '</option>';
                    }
                    echo '</select>';
                }
                ?>
                <noscript><button type="submit"><?php esc_html_e( 'Filter', 'causepro' ); ?></button></noscript>
            </form>
        </div>

        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type'      => 'event',
            'posts_per_page' => 10,
            'paged'          => $paged,
            'meta_key'       => '_event_date_time',
            'orderby'        => 'meta_value',
            'order'          => 'ASC',
            'meta_query'     => array(
                'relation' => 'AND',
                array(
                    'key'     => '_event_date_time',
                    'value'   => date( 'Y-m-d H:i:s' ),
                    'compare' => '>=',
                    'type'    => 'DATETIME',
                ),
            ),
        );

        // Check if a filter is applied
        if ( ! empty( $_GET['event_type_filter'] ) ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'event_type',
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field( $_GET['event_type_filter'] ),
                ),
            );
        }

        $events_query = new WP_Query( $args );
        ?>

        <?php if ( $events_query->have_posts() ) : ?>
            <div class="events-list events-archive-list">
                <?php while ( $events_query->have_posts() ) : $events_query->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('event-card'); ?>>
                        <?php
                        $event_date_time = get_post_meta( get_the_ID(), '_event_date_time', true );
                        if ( ! empty( $event_date_time ) ) :
                            $date = new DateTime( $event_date_time );
                        ?>
                        <div class="event-date-box">
                            <span class="event-month"><?php echo esc_html( $date->format( 'M' ) ); ?></span>
                            <span class="event-day"><?php echo esc_html( $date->format( 'd' ) ); ?></span>
                        </div>
                        <?php endif; ?>

                        <div class="event-card-content">
                            <header class="entry-header">
                                <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                                <div class="event-meta">
                                    <?php if ( ! empty( $event_date_time ) ) : ?>
                                        <span class="event-time"><?php echo esc_html( $date->format( 'g:i a' ) ); ?></span>
                                    <?php endif; ?>
                                    <?php
                                    $location = get_post_meta( get_the_ID(), '_event_location', true );
                                    if ( ! empty( $location ) ) : ?>
                                        <span class="event-location"><?php echo esc_html( $location ); ?></span>
                                    <?php endif; ?>
                                </div>
                            </header>
                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            // Pagination
            $big = 999999999;
            echo paginate_links( array(
                'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'  => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total'   => $events_query->max_num_pages,
                'add_args' => array( 'event_type_filter' => ( ! empty( $_GET['event_type_filter'] ) ? sanitize_text_field( $_GET['event_type_filter'] ) : '' ) ),
            ) );
            ?>

            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <p><?php esc_html_e( 'Sorry, no upcoming events found matching your criteria.', 'causepro' ); ?></p>
        <?php endif; ?>
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();
