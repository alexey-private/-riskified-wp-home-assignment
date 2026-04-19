/**
 * Custom Tabs Plugin - Tab switching functionality
 */

document.addEventListener( 'DOMContentLoaded', function() {
	const tabsWrappers = document.querySelectorAll( '.custom-tabs-wrapper' );

	tabsWrappers.forEach( function( wrapper ) {
		const tabs = wrapper.querySelectorAll( '[role="tab"]' );
		const panels = wrapper.querySelectorAll( '[role="tabpanel"]' );

		// Handle tab click events
		tabs.forEach( function( tab ) {
			tab.addEventListener( 'click', function() {
				activateTab( tab, tabs, panels );
			} );

			// Keyboard navigation: Arrow keys
			tab.addEventListener( 'keydown', function( event ) {
				let targetTab = null;

				if ( event.key === 'ArrowRight' || event.key === 'ArrowDown' ) {
					event.preventDefault();
					targetTab = tab.nextElementSibling?.querySelector( '[role="tab"]' ) || tabs[ 0 ];
				} else if ( event.key === 'ArrowLeft' || event.key === 'ArrowUp' ) {
					event.preventDefault();
					targetTab = tab.previousElementSibling?.querySelector( '[role="tab"]' ) || tabs[ tabs.length - 1 ];
				} else if ( event.key === 'Home' ) {
					event.preventDefault();
					targetTab = tabs[ 0 ];
				} else if ( event.key === 'End' ) {
					event.preventDefault();
					targetTab = tabs[ tabs.length - 1 ];
				}

				if ( targetTab ) {
					activateTab( targetTab, tabs, panels );
					targetTab.focus();
				}
			} );
		} );
	} );

	/**
	 * Activate a tab and show its corresponding panel
	 *
	 * @param {HTMLElement} activeTab - The tab to activate
	 * @param {NodeList} tabs - All tabs in the group
	 * @param {NodeList} panels - All panels in the group
	 */
	function activateTab( activeTab, tabs, panels ) {
		// Deactivate all tabs
		tabs.forEach( function( tab ) {
			tab.setAttribute( 'aria-selected', 'false' );
		} );

		// Hide all panels
		panels.forEach( function( panel ) {
			panel.setAttribute( 'hidden', '' );
		} );

		// Activate the selected tab
		activeTab.setAttribute( 'aria-selected', 'true' );

		// Show the corresponding panel
		const panelId = activeTab.getAttribute( 'aria-controls' );
		const activePanel = document.getElementById( panelId );

		if ( activePanel ) {
			activePanel.removeAttribute( 'hidden' );
		}
	}
} );
