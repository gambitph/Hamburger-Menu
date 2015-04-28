/**
 * This deals with previewing the menu.
 *
 * When in the customizer, when the menu is open, keep it open
 */ 
jQuery(document).ready(function($) {
	
	if ( hamburger_vars.is_customize_preview === '' ) {
		return;
	}
	
	function localStorageSupported() {
		var mod = 'localstorage_testing';
	    try {
	        localStorage.setItem(mod, mod);
	        localStorage.removeItem(mod);
	        return true;
	    } catch(e) {
	        return false;
	    }
	}
	
	if ( ! localStorageSupported() ) {
		return;
	}
	
	var startOpen = localStorage.getItem( 'hamburger_start_open' );
	if ( startOpen === 'true' ) {
		$('#hamburger-button').trigger('click');
		$('html').addClass('hamburger-stop-animation');
	}
	
	$('body').on('hamburger_open', function() {
		$('html').removeClass('hamburger-stop-animation');
		localStorage.setItem( 'hamburger_start_open', 'true' );
	});
	
	$('body').on('hamburger_close', function() {
		$('html').removeClass('hamburger-stop-animation');
		localStorage.setItem( 'hamburger_start_open', 'false' );
	});
	
});