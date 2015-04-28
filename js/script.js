// @codekit-append "_images-loaded.js"
// @codekit-append "_icon.js"
// @codekit-append "_menu.js"
// @codekit-append "_overlay.js"

jQuery(document).ready(function($) {
	
	$('body > *').wrapAll('<div id="hamburger-content-wrapper"></div>');
	
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