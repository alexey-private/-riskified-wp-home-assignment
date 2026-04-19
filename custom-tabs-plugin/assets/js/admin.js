/**
 * Custom Tabs Plugin - Admin page media uploader
 */

jQuery( document ).ready( function( $ ) {
	let currentField = null;
	let currentRow = null;

	// Add Tab Row
	$( '#add-tab-row' ).on( 'click', function( e ) {
		e.preventDefault();
		const repeater = $( '#tabs-repeater tbody' );
		const index = repeater.find( '.custom-tabs-row' ).length;
		const template = $( '#tmpl-tab-row' ).html().replace( /{{ index }}/g, index );
		repeater.append( template );
		attachRowHandlers();
	} );

	// Remove Tab Row
	$( document ).on( 'click', '.remove-tab-row', function( e ) {
		e.preventDefault();
		$( this ).closest( '.custom-tabs-row' ).remove();
	} );

	// Add Logo Row
	$( '#add-logo-row' ).on( 'click', function( e ) {
		e.preventDefault();
		const container = $( '#trusted-logos-container' );
		const index = container.find( '.custom-logo-row' ).length;
		const template = $( '#tmpl-logo-row' ).html().replace( /{{ index }}/g, index );
		container.append( template );
		attachLogoHandlers();
	} );

	// Remove Logo Row
	$( document ).on( 'click', '.remove-logo-row', function( e ) {
		e.preventDefault();
		$( this ).closest( '.custom-logo-row' ).remove();
	} );

	// Media Upload for Tab Fields (avatar, logo, bg_image)
	$( document ).on( 'click', '.upload-media', function( e ) {
		e.preventDefault();
		currentRow = $( this ).closest( '.custom-tabs-row' );
		currentField = $( this ).data( 'field' );

		openMediaUploader( currentField, currentRow );
	} );

	// Media Upload for Logo Field
	$( document ).on( 'click', '.upload-logo-media', function( e ) {
		e.preventDefault();
		currentRow = $( this ).closest( '.custom-logo-row' );

		openLogoMediaUploader( currentRow );
	} );

	/**
	 * Open media uploader for tab image fields
	 */
	function openMediaUploader( field, row ) {
		if ( wp.media === undefined ) {
			return;
		}

		const frame = wp.media( {
			title: 'Select Image',
			button: {
				text: 'Use this image',
		},
			multiple: false,
		} );

		frame.on( 'select', function() {
			const attachment = frame.state().get( 'selection' ).first().toJSON();
			const input = row.find( 'input[name*="[' + field + ']"]' );
			input.val( attachment.url );
		} );

		frame.open();
	}

	/**
	 * Open media uploader for logo field
	 */
	function openLogoMediaUploader( row ) {
		if ( wp.media === undefined ) {
			return;
		}

		const frame = wp.media( {
			title: 'Select Logo',
			button: {
				text: 'Use this logo',
		},
			multiple: false,
		} );

		frame.on( 'select', function() {
			const attachment = frame.state().get( 'selection' ).first().toJSON();
			const urlInput = row.find( 'input[name*="[url]"]' );
			const altInput = row.find( 'input[name*="[alt]"]' );

			urlInput.val( attachment.url );

			// Set alt text from attachment title if available
			if ( attachment.alt ) {
				altInput.val( attachment.alt );
			} else if ( attachment.title ) {
				altInput.val( attachment.title );
			}
		} );

		frame.open();
	}

	/**
	 * Attach event handlers to dynamically added rows
	 */
	function attachRowHandlers() {
		// Handlers will be attached via document.on() events
	}

	function attachLogoHandlers() {
		// Handlers will be attached via document.on() events
	}
} );
