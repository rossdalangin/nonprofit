/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// --- Theme Options ---
	wp.customize( 'causepro_copyright_text', function( value ) {
		value.bind( function( to ) {
			$( '.footer-copyright' ).html( to );
		} );
	} );

	// --- Homepage Sections ---

	// Hero Section
	wp.customize( 'causepro_hero_headline', function( value ) {
		value.bind( function( to ) {
			$( '#hero-section .hero-headline' ).text( to );
		} );
	} );
	wp.customize( 'causepro_hero_button_text', function( value ) {
		value.bind( function( to ) {
			$( '#hero-section .hero-button' ).text( to );
		} );
	} );

	// Impact Section
	wp.customize( 'causepro_impact_headline', function( value ) {
		value.bind( function( to ) {
			$( '#impact-section .section-title' ).text( to );
		} );
	} );
	for ( let i = 1; i <= 4; i++ ) {
		wp.customize( `causepro_impact_stat_${i}_number`, function( value ) {
			value.bind( function( to ) {
				$( `#impact-stat-${i} .stat-number` ).text( to );
			} );
		} );
		wp.customize( `causepro_impact_stat_${i}_label`, function( value ) {
			value.bind( function( to ) {
				$( `#impact-stat-${i} .stat-label` ).text( to );
			} );
		} );
		wp.customize( `causepro_impact_stat_${i}_icon`, function( value ) {
			value.bind( function( to ) {
                // This is harder to preview as it requires changing a class.
                // A full refresh might be better unless we write more complex JS.
                // For now, we just update the class attribute.
				$( `#impact-stat-${i} .stat-icon` ).attr('class', 'stat-icon dashicons-before ' + to );
			} );
		} );
	}

	// Causes Section
	wp.customize( 'causepro_causes_headline', function( value ) {
		value.bind( function( to ) {
			$( '#causes-section .section-title' ).text( to );
		} );
	} );

	// Campaign Section
	wp.customize( 'causepro_campaign_headline', function( value ) {
		value.bind( function( to ) {
			$( '#campaign-section .section-title' ).text( to );
		} );
	} );
	wp.customize( 'causepro_campaign_text', function( value ) {
		value.bind( function( to ) {
			$( '#campaign-section .campaign-text' ).html( to );
		} );
	} );
	wp.customize( 'causepro_campaign_button_text', function( value ) {
		value.bind( function( to ) {
			$( '#campaign-section .campaign-button' ).text( to );
		} );
	} );
    // Progress bar updates
    const updateProgressBar = () => {
        const raised = wp.customize( 'causepro_campaign_raised' ).get();
        const goal = wp.customize( 'causepro_campaign_goal' ).get();
        const percentage = goal > 0 ? ( raised / goal ) * 100 : 0;
        $( '#campaign-section .progress-bar-inner' ).css( 'width', percentage + '%' );
        $( '#campaign-section .progress-bar-percentage' ).text( Math.round(percentage) + '%' );
    };
    wp.customize( 'causepro_campaign_raised', function( value ) {
		value.bind( updateProgressBar );
	} );
    wp.customize( 'causepro_campaign_goal', function( value ) {
		value.bind( updateProgressBar );
	} );


	// Events Section
	wp.customize( 'causepro_events_headline', function( value ) {
		value.bind( function( to ) {
			$( '#events-section .section-title' ).text( to );
		} );
	} );

	// --- Typography ---
	const fontSelectors = {
		'p': 'p, body',
		'h1': 'h1, .hero-headline',
		'h2': 'h2, .section-title',
		'h3': 'h3',
		'h4': 'h4',
		'h5': 'h5',
		'h6': 'h6'
	};
	for (const [slug, selector] of Object.entries(fontSelectors)) {
		wp.customize( `causepro_fontsize_${slug}`, function( value ) {
			value.bind( function( to ) {
				$( selector ).css( 'font-size', to + 'rem' );
			} );
		} );
	}

} )( jQuery );
