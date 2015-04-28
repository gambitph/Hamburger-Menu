// @codekit-prepend "_images-loaded.js"
// @codekit-prepend "_icon.js"
// @codekit-prepend "_menu.js"
// @codekit-prepend "_overlay.js"

jQuery(document).ready(function($) {
	
	
	$('body').on('hamburger_open', function() {
		$('#hamburger-button').addClass('close');
		$('#hamburger-menu-container').addClass('open');
		$('body').addClass('hamburger_open');
		console.log('open menu');
	});
	
	
	$('body').on('hamburger_close', function() {
		$('#hamburger-button').removeClass('close');
		$('#hamburger-menu-container').removeClass('open');
		$('body').removeClass('hamburger_open');
		console.log('close menu');
	});
	
		
});