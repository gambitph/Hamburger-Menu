jQuery(document).ready(function($) {

	$('body').prepend( '<div id="hamburger-overlay"></div>' );
	$('body').prepend( wp.template( 'hamburger-menu' ) );
	
	
	// Flick the menu left/right to close it
	$('#hamburger-menu-container').on('flick', function(e) {
		if ( $('html').hasClass('hamburger-left') ) {
			if ( e.direction === -1 ) {
				$('body').trigger('hamburger_close');
			}
		} else {
			if ( e.direction === 1 ) {
				$('body').trigger('hamburger_close');
			}
		}
	});


	// Always make sure that the main menu is in the middle of the page
	function hamburger_compute_margins() {
		var $ = jQuery;
		var totalHeight = 0;
		$('#hamburger-menu-wrapper > *').each(function() {
			totalHeight += $(this).height() + parseInt( $(this).css('paddingTop') ) + parseInt( $(this).css('paddingBottom') );
		});
		var margin = ( $('#hamburger-menu-wrapper').height() - totalHeight ) / 2;
		if ( margin < 0 ) {
			margin = 0;
		}
		$('#hamburger-menu').css('marginTop', margin).css('marginBottom', margin);
	}
	
	
	// Every time an image gets loaded, adjust the margins
	$('#hamburger-menu-container')
		.imagesLoaded(hamburger_compute_margins)
		.always(hamburger_compute_margins);

	
	/**
	 * Vertical align the menu
	 */
	hamburger_compute_margins();
	$(window).resize(hamburger_compute_margins);
	
	
	/**
	 * Add dark/light class in the menu
	 */
	
	// From http://24ways.org/2010/calculating-color-contrast
	function getContrastYIQ(hexcolor){
		
		// Use hex color in case rgb was given
        hexcolor = hexcolor.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
        function hex(x) {
            return ("0" + parseInt(x).toString(16)).slice(-2);
        }
        hexcolor = "#" + hex(hexcolor[1]) + hex(hexcolor[2]) + hex(hexcolor[3]);
		
		hexcolor = hexcolor.substr(1);
		var r = parseInt(hexcolor.substr(0,2),16);
		var g = parseInt(hexcolor.substr(2,2),16);
		var b = parseInt(hexcolor.substr(4,2),16);
		var yiq = ((r*299)+(g*587)+(b*114))/1000;
		return (yiq >= 128) ? 'light' : 'dark';
	}
	
	$('#hamburger-menu-container').addClass( getContrastYIQ( $('#hamburger-menu-container').css('backgroundColor') ) );
	
});