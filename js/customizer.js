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

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// change color settings
	wp.customize( 'nav_text_color', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation a' ).css( {
				'color': to
			} );
		} );
	} );

	wp.customize( 'nav_hover_color', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation a:hover' ).css( {
				'color': to
			} );
		} );
	} );

	wp.customize( 'nav_hover_bg_color', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation ul ul ul, .main-navigation li:hover > a, .main-navigation li.focus > a, .main-navigation li:hover > a,.main-navigation li.focus > a, .main-navigation ul ul :hover > a, .main-navigation ul ul .focus > a, .main-navigation ul ul a:hover, .main-navigation ul ul a.focus' ).css( {
				'background': to
			} );
		} );
	} );

	wp.customize( 'site_text_color', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation a:hover' ).css( {
				'color': to
			} );
		} );
	} );

	wp.customize( 'site_text_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-content' ).css( {
				'color': to
			} );
		} );
	} );

	wp.customize( 'site_link_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-content a' ).css( {
				'color': to
			} );
		} );
	} );
} )( jQuery );
