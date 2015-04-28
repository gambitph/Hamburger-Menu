// @codekit-append "_images-loaded.js"
// @codekit-append "_icon.js"
// @codekit-append "_menu.js"
// @codekit-append "_overlay.js"

jQuery(document).ready(function($) {
	
	// Create a container for the whole page
	$('body > *').wrapAll('<div id="hamburger-content-wrapper"></div>');
	
	// State whether the menu should be static
	if ( hamburger_vars.is_fixed === '1' ) {
		$('html').addClass('hamburger_fixed');
	}
	$('html').addClass( 'slide-' + hamburger_vars.menu_slide_type )
		.addClass( 'hamburger-' + hamburger_vars.menu_location );
	
	
	$('body').on('hamburger_open', function() {
		$('#hamburger-button').addClass('close');
		$('#hamburger-menu-container').addClass('open');
		$('html').addClass('hamburger_open');
		console.log('open menu');
	});
	
	
	$('body').on('hamburger_close', function() {
		$('#hamburger-button').removeClass('close');
		$('#hamburger-menu-container').removeClass('open');
		$('html').removeClass('hamburger_open');
		console.log('close menu');
	});
	
		
});