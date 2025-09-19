<?php
/**
 * Template Name: Events Page
 *
 * The template for displaying all upcoming Event posts, with filtering.
 *
 * @package CausePro
 */

get_header();

// Determine the current view: 'upcoming' or 'past'
$current_view = isset( $_GET['view'] ) && $_GET['view'] === 'past' ? 'past' : 'upcoming';
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
            <div class="page-subtitle">
                <?php esc_html_e( 'Join us at our events. Get involved, meet our community, and support our cause.', 'causepro' ); ?>
            </div>
        </header><!-- .page-header -->

        <div class="event-filters">
            <!-- View switcher -->
            <div class="event-view-switcher">
                <a href="<?php echo esc_url( add_query_arg( 'view', 'upcoming', get_permalink() ) ); ?>" class="<?php echo ( $current_view === 'upcoming' ? 'active' : '' ); ?>"><?php esc_html_e( 'Upcoming Events', 'causepro' ); ?></a>
                <a href="<?php echo esc_url( add_query_arg( 'view', 'past', get_permalink() ) ); ?>" class="<?php echo ( $current_view === 'past' ? 'active' : '' ); ?>"><?php esc_html_e( 'Past Events', 'causepro' ); ?></a>
            </div>
        </div>

        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type'      => 'event',
            'posts_per_page' => 9,
            'paged'          => $paged,
            'meta_key'       => '_event_date_time',
            'orderby'        => 'meta_value',
        );

        if ( $current_view === 'upcoming' ) {
            $args['order'] = 'ASC';
            $args['meta_query'] = array(
                array(
                    'key'     => '_event_date_time',
                    'value'   => date( 'Y-m-d H:i:s' ),
                    'compare' => '>=',
                    'type'    => 'DATETIME',
                ),
            );
        } else { // past events
            $args['order'] = 'DESC';
            $args['meta_query'] = array(
                array(
                    'key'     => '_event_date_time',
                    'value'   => date( 'Y-m-d H:i:s' ),
                    'compare' => '<',
                    'type'    => 'DATETIME',
                ),
            );
        }

        $events_query = new WP_Query( $args );
        ?>

        <?php if ( $events_query->have_posts() ) : ?>
            <div class="events-grid events-archive-grid">
                <?php while ( $events_query->have_posts() ) : $events_query->the_post(); ?>
                     <article id="post-<?php the_ID(); ?>" <?php post_class('event-item'); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="event-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium_large' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="event-item-content">
                            <header class="entry-header">
                                <?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
                                <?php
                                $event_date_time = get_post_meta( get_the_ID(), '_event_date_time', true );
                                if ( ! empty( $event_date_time ) ) {
                                    $date = new DateTime( $event_date_time );
                                    echo '<p class="event-date">' . esc_html( $date->format( 'F j, Y \a\t g:i a' ) ) . '</p>';
                                }
                                ?>
                            </header>
                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>
                             <footer class="entry-footer">
                                <a href="<?php the_permalink(); ?>" class="button"><?php esc_html_e( 'View Event', 'causepro' ); ?></a>
                            </footer>
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
                'add_args' => array( 'view' => $current_view ),
                'prev_text' => __('&laquo; Previous'),
                'next_text' => __('Next &raquo;'),
            ) );
            ?>

            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <div class="no-posts-found">
                <p>
                    <?php
                    if ($current_view === 'upcoming') {
                        esc_html_e( 'There are no upcoming events at the moment. Please check back soon!', 'causepro' );
                    } else {
                        esc_html_e( 'There are no past events to display.', 'causepro' );
                    }
                    ?>
                </p>
            </div>
        <?php endif; ?>
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();
