// @codekit-prepend "_icon.js"

jQuery(document).ready(function($) {
	
	
	$('body').on('hamburger_open', function() {
		$('#hamburger-button').addClass('close');
		console.log('open menu');
	});
	
	
	$('body').on('hamburger_close', function() {
		$('#hamburger-button').removeClass('close');
		console.log('close menu');
	});
	
		
});