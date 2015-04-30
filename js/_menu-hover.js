/**
 * Animates the height animation of submenus
 *
 * Since we can't normally animate height from 0 to auto, we need to compute the actual height first and record it
 */
jQuery(document).ready(function($) {	
	
	function computeMenuHeights() {
		$('#hamburger-menu-container #hamburger-menu li').each(function() {
			var ul = $(this).find('ul:eq(0)');
			if ( ul.length === 0 ) {
				return;
			}
			if ( typeof ul.attr('data-height') !== "undefined" ) {
				return;
			}
			ul.attr('data-height', ul.height());
			ul.css({
				'height': 0,
				'position': 'relative',
				'zIndex': 1
			});
		});
	}

	computeMenuHeights();
	
	$('#hamburger-menu-container #hamburger-menu li').hover(function() {
		$(this).find('ul:eq(0)').height( $(this).find('ul:eq(0)').attr('data-height') );
	}, function() {
		$(this).find('ul:eq(0)').height(0);
	});
	
});