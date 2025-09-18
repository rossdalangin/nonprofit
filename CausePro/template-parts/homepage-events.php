<?php
/**
 * Template part for displaying the Events section on the homepage.
 *
 * @package CausePro
 */

// Get section settings
$headline = get_theme_mod( 'causepro_events_headline', __( 'Upcoming Events', 'causepro' ) );
$count = get_theme_mod( 'causepro_events_count', 3 );

// Generate background styles
$bg_style = '';
$bg_type = get_theme_mod( 'causepro_events_bg_type', 'none' );
if ($bg_type === 'color') {
    $bg_style = 'style="background-color: ' . esc_attr(get_theme_mod('causepro_events_bg_color')) . ';"';
} elseif ($bg_type === 'gradient') {
    $grad1 = esc_attr(get_theme_mod('causepro_events_bg_gradient_1'));
    $grad2 = esc_attr(get_theme_mod('causepro_events_bg_gradient_2'));
    $bg_style = 'style="background-image: linear-gradient(to right, ' . $grad1 . ', ' . $grad2 . ');"';
} elseif ($bg_type === 'image') {
    $bg_image_url = get_theme_mod('causepro_events_bg_image');
    if (!empty($bg_image_url)) {
        $bg_style = 'style="background-image: url(' . esc_url($bg_image_url) . ');"';
    }
}

// First, try to get upcoming events
$args_upcoming = array(
	'post_type'      => 'event',
	'posts_per_page' => absint( $count ),
	'meta_key'       => '_event_date_time',
	'orderby'        => 'meta_value',
	'order'          => 'ASC',
	'meta_query'     => array(
		array(
			'key'     => '_event_date_time',
			'value'   => date( 'Y-m-d H:i' ),
			'compare' => '>=',
			'type'    => 'DATETIME',
		),
	),
);
$events_query = new WP_Query( $args_upcoming );

// If no upcoming events, get past events as a fallback
if ( ! $events_query->have_posts() ) {
    $headline = __( 'Past Events', 'causepro' ); // Change headline for context
    $args_past = array(
        'post_type'      => 'event',
        'posts_per_page' => absint( $count ),
        'meta_key'       => '_event_date_time',
        'orderby'        => 'meta_value',
        'order'          => 'DESC', // Show most recent past events
        'meta_query'     => array(
            array(
                'key'     => '_event_date_time',
                'value'   => date( 'Y-m-d H:i' ),
                'compare' => '<',
                'type'    => 'DATETIME',
            ),
        ),
    );
    $events_query = new WP_Query( $args_past );
}
?>

<?php if ( $events_query->have_posts() ) : ?>
<section id="events-section" class="homepage-section events-section" <?php echo $bg_style; ?>>
	<div class="container">
		<?php if ( ! empty( $headline ) ) : ?>
			<h2 class="section-title"><?php echo esc_html( $headline ); ?></h2>
		<?php endif; ?>

		<div class="events-list">
			<?php while ( $events_query->have_posts() ) : $events_query->the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('event-item'); ?>>
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
				</article>
			<?php endwhile; ?>
		</div>
		<?php wp_reset_postdata(); ?>
	</div>
</section>
<?php endif; ?>
