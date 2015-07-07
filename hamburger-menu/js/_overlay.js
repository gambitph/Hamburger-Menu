jQuery(document).ready(function($) {
	$('body').on('click', '#hamburger-overlay', function() {
		$('body').trigger('hamburger_close');
	});
});