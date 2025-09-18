<?php
/**
 * Registers Custom Post Types and Taxonomies
 *
 * @package CausePro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register Cause CPT
 */
function causepro_register_cause_cpt() {
	$labels = array(
		'name'                  => _x( 'Causes', 'Post Type General Name', 'causepro' ),
		'singular_name'         => _x( 'Cause', 'Post Type Singular Name', 'causepro' ),
		'menu_name'             => __( 'Causes', 'causepro' ),
		'name_admin_bar'        => __( 'Cause', 'causepro' ),
		'archives'              => __( 'Cause Archives', 'causepro' ),
		'attributes'            => __( 'Cause Attributes', 'causepro' ),
		'parent_item_colon'     => __( 'Parent Cause:', 'causepro' ),
		'all_items'             => __( 'All Causes', 'causepro' ),
		'add_new_item'          => __( 'Add New Cause', 'causepro' ),
		'add_new'               => __( 'Add New', 'causepro' ),
		'new_item'              => __( 'New Cause', 'causepro' ),
		'edit_item'             => __( 'Edit Cause', 'causepro' ),
		'update_item'           => __( 'Update Cause', 'causepro' ),
		'view_item'             => __( 'View Cause', 'causepro' ),
		'view_items'            => __( 'View Causes', 'causepro' ),
		'search_items'          => __( 'Search Cause', 'causepro' ),
		'not_found'             => __( 'Not found', 'causepro' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'causepro' ),
		'featured_image'        => __( 'Featured Image', 'causepro' ),
		'set_featured_image'    => __( 'Set featured image', 'causepro' ),
		'remove_featured_image' => __( 'Remove featured image', 'causepro' ),
		'use_featured_image'    => __( 'Use as featured image', 'causepro' ),
		'insert_into_item'      => __( 'Insert into cause', 'causepro' ),
		'uploaded_to_this_item' => __( 'Uploaded to this cause', 'causepro' ),
		'items_list'            => __( 'Causes list', 'causepro' ),
		'items_list_navigation' => __( 'Causes list navigation', 'causepro' ),
		'filter_items_list'     => __( 'Filter causes list', 'causepro' ),
	);
	$args = array(
		'label'                 => __( 'Cause', 'causepro' ),
		'description'           => __( 'Post Type for Causes', 'causepro' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-heart',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'causes',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'cause', $args );
}
add_action( 'init', 'causepro_register_cause_cpt', 0 );

/**
 * Register Event CPT
 */
function causepro_register_event_cpt() {
	$labels = array(
		'name'                  => _x( 'Events', 'Post Type General Name', 'causepro' ),
		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'causepro' ),
		'menu_name'             => __( 'Events', 'causepro' ),
		'name_admin_bar'        => __( 'Event', 'causepro' ),
		'archives'              => __( 'Event Archives', 'causepro' ),
		'attributes'            => __( 'Event Attributes', 'causepro' ),
		'parent_item_colon'     => __( 'Parent Event:', 'causepro' ),
		'all_items'             => __( 'All Events', 'causepro' ),
		'add_new_item'          => __( 'Add New Event', 'causepro' ),
		'add_new'               => __( 'Add New', 'causepro' ),
		'new_item'              => __( 'New Event', 'causepro' ),
		'edit_item'             => __( 'Edit Event', 'causepro' ),
		'update_item'           => __( 'Update Event', 'causepro' ),
		'view_item'             => __( 'View Event', 'causepro' ),
		'view_items'            => __( 'View Events', 'causepro' ),
		'search_items'          => __( 'Search Event', 'causepro' ),
		'not_found'             => __( 'Not found', 'causepro' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'causepro' ),
		'featured_image'        => __( 'Featured Image', 'causepro' ),
		'set_featured_image'    => __( 'Set featured image', 'causepro' ),
		'remove_featured_image' => __( 'Remove featured image', 'causepro' ),
		'use_featured_image'    => __( 'Use as featured image', 'causepro' ),
		'insert_into_item'      => __( 'Insert into event', 'causepro' ),
		'uploaded_to_this_item' => __( 'Uploaded to this event', 'causepro' ),
		'items_list'            => __( 'Events list', 'causepro' ),
		'items_list_navigation' => __( 'Events list navigation', 'causepro' ),
		'filter_items_list'     => __( 'Filter events list', 'causepro' ),
	);
	$args = array(
		'label'                 => __( 'Event', 'causepro' ),
		'description'           => __( 'Post Type for Events', 'causepro' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'menu_icon'             => 'dashicons-calendar-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'events',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'event', $args );
}
add_action( 'init', 'causepro_register_event_cpt', 0 );

/**
 * Register Event Type Taxonomy
 */
function causepro_register_event_type_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Event Types', 'Taxonomy General Name', 'causepro' ),
		'singular_name'              => _x( 'Event Type', 'Taxonomy Singular Name', 'causepro' ),
		'menu_name'                  => __( 'Event Types', 'causepro' ),
		'all_items'                  => __( 'All Event Types', 'causepro' ),
		'parent_item'                => __( 'Parent Event Type', 'causepro' ),
		'parent_item_colon'          => __( 'Parent Event Type:', 'causepro' ),
		'new_item_name'              => __( 'New Event Type Name', 'causepro' ),
		'add_new_item'               => __( 'Add New Event Type', 'causepro' ),
		'edit_item'                  => __( 'Edit Event Type', 'causepro' ),
		'update_item'                => __( 'Update Event Type', 'causepro' ),
		'view_item'                  => __( 'View Event Type', 'causepro' ),
		'separate_items_with_commas' => __( 'Separate event types with commas', 'causepro' ),
		'add_or_remove_items'        => __( 'Add or remove event types', 'causepro' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'causepro' ),
		'popular_items'              => __( 'Popular Event Types', 'causepro' ),
		'search_items'               => __( 'Search Event Types', 'causepro' ),
		'not_found'                  => __( 'Not Found', 'causepro' ),
		'no_terms'                   => __( 'No event types', 'causepro' ),
		'items_list'                 => __( 'Event types list', 'causepro' ),
		'items_list_navigation'      => __( 'Event types list navigation', 'causepro' ),
	);
	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_in_rest'      => true,
	);
	register_taxonomy( 'event_type', array( 'event' ), $args );
}
add_action( 'init', 'causepro_register_event_type_taxonomy', 0 );

/**
 * Adds a meta box for event details.
 */
function causepro_add_event_details_meta_box() {
	add_meta_box(
		'causepro_event_details',
		__( 'Event Details', 'causepro' ),
		'causepro_render_event_details_meta_box',
		'event',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'causepro_add_event_details_meta_box' );

/**
 * Renders the meta box for event details.
 *
 * @param WP_Post $post The post object.
 */
function causepro_render_event_details_meta_box( $post ) {
	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'causepro_save_event_details', 'causepro_event_details_nonce' );

	$date_time = get_post_meta( $post->ID, '_event_date_time', true );
	$location  = get_post_meta( $post->ID, '_event_location', true );
	$link      = get_post_meta( $post->ID, '_event_link', true );
	?>
	<p>
		<label for="causepro_event_date_time"><?php esc_html_e( 'Event Date & Time', 'causepro' ); ?></label>
		<input type="datetime-local" id="causepro_event_date_time" name="causepro_event_date_time" value="<?php echo esc_attr( $date_time ); ?>" style="width:100%;">
	</p>
	<p>
		<label for="causepro_event_location"><?php esc_html_e( 'Location', 'causepro' ); ?></label>
		<input type="text" id="causepro_event_location" name="causepro_event_location" value="<?php echo esc_attr( $location ); ?>" style="width:100%;">
	</p>
	<p>
		<label for="causepro_event_link"><?php esc_html_e( 'Registration/Info Link', 'causepro' ); ?></label>
		<input type="url" id="causepro_event_link" name="causepro_event_link" value="<?php echo esc_attr( $link ); ?>" style="width:100%;">
	</p>
	<?php
}

/**
 * Saves the event details meta box data.
 *
 * @param int $post_id The post ID.
 */
function causepro_save_event_details( $post_id ) {
	// Check if our nonce is set.
	if ( ! isset( $_POST['causepro_event_details_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['causepro_event_details_nonce'], 'causepro_save_event_details' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'event' === $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	// Sanitize and save the fields.
	if ( isset( $_POST['causepro_event_date_time'] ) ) {
		update_post_meta( $post_id, '_event_date_time', sanitize_text_field( $_POST['causepro_event_date_time'] ) );
	}
	if ( isset( $_POST['causepro_event_location'] ) ) {
		update_post_meta( $post_id, '_event_location', sanitize_text_field( $_POST['causepro_event_location'] ) );
	}
	if ( isset( $_POST['causepro_event_link'] ) ) {
		update_post_meta( $post_id, '_event_link', esc_url_raw( $_POST['causepro_event_link'] ) );
	}
}
add_action( 'save_post', 'causepro_save_event_details' );

/**
 * Register Testimonial CPT
 */
function causepro_register_testimonial_cpt() {
    $labels = array(
        'name'                  => _x( 'Testimonials', 'Post Type General Name', 'causepro' ),
        'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'causepro' ),
        'menu_name'             => __( 'Testimonials', 'causepro' ),
        'name_admin_bar'        => __( 'Testimonial', 'causepro' ),
		'all_items'             => __( 'All Testimonials', 'causepro' ),
		'add_new_item'          => __( 'Add New Testimonial', 'causepro' ),
		'add_new'               => __( 'Add New', 'causepro' ),
		'new_item'              => __( 'New Testimonial', 'causepro' ),
		'edit_item'             => __( 'Edit Testimonial', 'causepro' ),
		'update_item'           => __( 'Update Testimonial', 'causepro' ),
		'view_item'             => __( 'View Testimonial', 'causepro' ),
    );
    $args = array(
        'label'                 => __( 'Testimonial', 'causepro' ),
        'description'           => __( 'Post Type for Testimonials', 'causepro' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 7,
        'menu_icon'             => 'dashicons-format-quote',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'testimonial', $args );
}
add_action( 'init', 'causepro_register_testimonial_cpt', 0 );

/**
 * Adds a meta box for testimonial subtitle.
 */
function causepro_add_testimonial_subtitle_meta_box() {
    add_meta_box(
        'causepro_testimonial_subtitle',
        __( 'Author Subtitle', 'causepro' ),
        'causepro_render_testimonial_subtitle_meta_box',
        'testimonial',
        'side',
        'low'
    );
}
add_action( 'add_meta_boxes', 'causepro_add_testimonial_subtitle_meta_box' );

/**
 * Renders the meta box.
 */
function causepro_render_testimonial_subtitle_meta_box( $post ) {
    wp_nonce_field( 'causepro_save_testimonial_subtitle', 'causepro_testimonial_subtitle_nonce' );
    $subtitle = get_post_meta( $post->ID, '_testimonial_subtitle', true );
    echo '<input type="text" id="causepro_testimonial_subtitle" name="causepro_testimonial_subtitle" value="' . esc_attr( $subtitle ) . '" style="width:100%;" placeholder="' . esc_attr__('e.g. CEO, Example Inc.', 'causepro') . '">';
}

/**
 * Saves the meta box data.
 */
function causepro_save_testimonial_subtitle( $post_id ) {
    if ( ! isset( $_POST['causepro_testimonial_subtitle_nonce'] ) || ! wp_verify_nonce( $_POST['causepro_testimonial_subtitle_nonce'], 'causepro_save_testimonial_subtitle' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( isset( $_POST['post_type'] ) && 'testimonial' === $_POST['post_type'] && ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( isset( $_POST['causepro_testimonial_subtitle'] ) ) {
        update_post_meta( $post_id, '_testimonial_subtitle', sanitize_text_field( $_POST['causepro_testimonial_subtitle'] ) );
    }
}
add_action( 'save_post', 'causepro_save_testimonial_subtitle' );

/**
 * Adds a meta box for page subtitle.
 */
function causepro_add_page_subtitle_meta_box() {
    add_meta_box(
        'causepro_page_subtitle',
        __( 'Page Subtitle', 'causepro' ),
        'causepro_render_page_subtitle_meta_box',
        'page', // Target the 'page' post type
        'side',
        'low'
    );
}
add_action( 'add_meta_boxes', 'causepro_add_page_subtitle_meta_box' );

/**
 * Renders the meta box for page subtitle.
 */
function causepro_render_page_subtitle_meta_box( $post ) {
    wp_nonce_field( 'causepro_save_page_subtitle', 'causepro_page_subtitle_nonce' );
    $subtitle = get_post_meta( $post->ID, '_page_subtitle', true );
    echo '<input type="text" id="causepro_page_subtitle" name="causepro_page_subtitle" value="' . esc_attr( $subtitle ) . '" style="width:100%;" placeholder="' . esc_attr__('Enter an optional subtitle.', 'causepro') . '">';
}

/**
 * Saves the page subtitle meta box data.
 */
function causepro_save_page_subtitle( $post_id ) {
    if ( ! isset( $_POST['causepro_page_subtitle_nonce'] ) || ! wp_verify_nonce( $_POST['causepro_page_subtitle_nonce'], 'causepro_save_page_subtitle' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] && ! current_user_can( 'edit_page', $post_id ) ) {
        return;
    }
    if ( isset( $_POST['causepro_page_subtitle'] ) ) {
        update_post_meta( $post_id, '_page_subtitle', sanitize_text_field( $_POST['causepro_page_subtitle'] ) );
    }
}
add_action( 'save_post', 'causepro_save_page_subtitle' );
