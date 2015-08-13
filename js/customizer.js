/**
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
				$( '.site-title,  .site-description' ).css( {
					'clip': 'auto',
					'position': 'static'
				} );

				$( '.site-title a' ).css( {
					'color': to
				} );
			}
		} );
	} );
	
	
	wp.customize( 'metro-creativex_logo', function( value ) {
		value.bind( function( to ) {
			if( to != '' ) {
				$( '.site-logo' ).removeClass( 'metro_creativex_only_customizer' );
				$( '.header-logo-wrap' ).addClass( 'metro_creativex_only_customizer' );
			}
			else {
				$( '.site-logo' ).addClass( 'metro_creativex_only_customizer' );
				$( '.header-logo-wrap' ).removeClass( 'metro_creativex_only_customizer' );
			}
				
            $(".site-logo img").attr( "src", to );
		} );
	} );
	
	
} )( jQuery );