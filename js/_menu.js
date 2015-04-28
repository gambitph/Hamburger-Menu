jQuery(document).ready(function($) {

	$('body').prepend( '<div id="hamburger-overlay"></div>' );
	$('body').prepend( wp.template( 'hamburger-menu' ) );


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
	
});