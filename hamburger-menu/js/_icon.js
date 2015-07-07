jQuery(document).ready(function($) {

	$('body').append( wp.template( 'hamburger-button' ) );
	
	
	/**
	 * Click handler for the hamburger button
	 */
	$('body').on('click', '#hamburger-button', function() {
		if ( $(this).hasClass('close') ) {
			$('body').trigger('hamburger_close');
		} else {
			$('body').trigger('hamburger_open');
		}
	});


	/**
	 * Shows / hides the hamburger depending on the General settings
	 */
	function hamburger_show_icon() {
		var menuSelector;
		
		// Show the hamburger depending on screen width
		if ( hamburger_vars.show_below_width !== '0' && hamburger_vars.show_below_width !== '' ) {
			
			if ( $(window).width() < hamburger_vars.show_below_width ) {
				$('#hamburger-button').show();
			} else {
				$('#hamburger-button').hide();
			}
		
			// When burger is shown, hide the hamburger_vars.menu_hide_class
			if ( hamburger_vars.menu_hide_class !== '' ) {
				menuSelector = $('.' + hamburger_vars.menu_hide_class);
				if ( $(window).width() < hamburger_vars.show_below_width ) {
					menuSelector.attr( 'style', menuSelector.attr('style') + ';display: none !important' );
				} else {
					menuSelector.css( 'display', '' );
				}
			}
			
			if ( hamburger_vars.hide_selectors !== '' ) {
				menuSelector = $(hamburger_vars.hide_selectors);
				if ( $(window).width() < hamburger_vars.show_below_width ) {
					menuSelector.attr( 'style', menuSelector.attr('style') + ';display: none !important' );
				} else {
					menuSelector.css( 'display', '' );
				}
			}
			
		} else {
			$('#hamburger-button').show();
			
			// When burger is shown, hide the hamburger_vars.menu_hide_class
			if ( hamburger_vars.menu_hide_class !== '' ) {
				$('.' + hamburger_vars.menu_hide_class).hide();
			}
			if ( hamburger_vars.hide_selectors !== '' ) {
				$(hamburger_vars.hide_selectors).hide();
			}
		}
	}

	
	/**
	 * Show/hide hamburger icon
	 */
	hamburger_show_icon();
	$(window).resize(hamburger_show_icon);	
	
	
});