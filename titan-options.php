<?php

/*
 * Titan Framework options sample code. We've placed here some
 * working examples to get your feet wet
 * @see	http://www.titanframework.net/get-started/
 */


add_action( 'tf_create_options', 'hamburger_create_options' );

/**
 * Initialize Titan & options here
 */
function hamburger_create_options() {

	$titan = TitanFramework::getInstance( 'hamburger_menu' );
	
	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', GAMBIT_HAMBURGER_PLUGIN ),
	    'name' => __( 'General', GAMBIT_HAMBURGER_PLUGIN ),
		'panel_desc' => '',
	) );
	
	$options = array( '' => '- Select -' );
	foreach ( get_registered_nav_menus() as $menuSlug => $menuName ) {
		if ( $menuSlug !== 'hamburger' ) {
			$options[ $menuSlug ] = $menuName;
		}
	}
	
	$section->createOption( array(
		'name' => __( 'Show Menu When Below Width', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'show_below_width',
		'type' => 'number',
		'desc' => __( 'Only show the hamburger menu when the screen is below this width. Leave as 0 to always show the menu.', GAMBIT_HAMBURGER_PLUGIN ),
		'default' => '0',
		'min' => '0',
		'max' => '2000',
		'step' => '1',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hide Primary Menu When Hamburger is Visible', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'hide_menu',
		'type' => 'select',
		'desc' => __( 'If you intend to replace your main menu with Hamburger Menu, select the menu that you want hidden from your frontend. This works in conjuction with the above setting, the menu here will only get hidden if the hamburger is visible.', GAMBIT_HAMBURGER_PLUGIN ),
		'options' => $options,
		'default' => '',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hide These Elements When Hamburger is Visible (Put Selectors)', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'hide_selectors',
		'type' => 'text',
		'desc' => __( 'Sometimes, the above setting for hiding menus won\'t be enough and you might still see a menu button that should be hidden. If that is the case, inspect your website and put the css selectors of the elements to hide here.', GAMBIT_HAMBURGER_PLUGIN ),
		'default' => 'header .secondary-toggle',
	) );
	


	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', GAMBIT_HAMBURGER_PLUGIN ),
	    'name' => __( 'Icon & Menu Location', GAMBIT_HAMBURGER_PLUGIN ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Menu Location', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_location',
		'type' => 'select',
		'options' => array(
			'left' => __( 'Left', GAMBIT_HAMBURGER_PLUGIN ),
			'right' => __( 'Right', GAMBIT_HAMBURGER_PLUGIN ),
		),
		'default' => 'left',
	) );
	
	$section->createOption( array(
		'name' => __( 'Icon Top Offset', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'icon_top',
		'type' => 'number',
		'desc' => __( 'The vertical offset of the location of the icon from the top of the site, in pixels', GAMBIT_HAMBURGER_PLUGIN ),
		'default' => '30',
		'min' => '0',
		'max' => '300',
		'step' => '1',
		'css' => '.hamburger-button-container { top: valuepx; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Icon Left/Right Offset', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'icon_left',
		'type' => 'number',
		'desc' => __( 'The horizontal offset of the location of the icon from the left/right of the site, in pixels', GAMBIT_HAMBURGER_PLUGIN ),
		'default' => '30',
		'min' => '0',
		'max' => '300',
		'step' => '1',
		'css' => '.hamburger-button-container { left: valuepx; right: valuepx; }',
	) );
	
	

	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', GAMBIT_HAMBURGER_PLUGIN ),
	    'name' => __( 'Icon Colors', GAMBIT_HAMBURGER_PLUGIN ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Hamburger Bar Thickness', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'icon_bar_thickness',
		'type' => 'number',
		'default' => '4',
		'min' => '0',
		'max' => '10',
		'step' => '1',
		'css' => '.hamburger-button-container .hamburger-button-icon { height: valuepx; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hamburger Bar Color', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'icon_bar_color',
		'type' => 'color',
		'default' => '#333333',
		'css' => '.hamburger-button-container { .hamburger-button-icon { &, &:before, &:after { background-color: value; } } }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hamburger Icon Size', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'icon_size',
		'type' => 'number',
		'default' => '30',
		'min' => '10',
		'max' => '100',
		'step' => '1',
		'css' => '.hamburger-button-container { width: valuepx; height: valuepx; .hamburger-button-icon { width: valuepx; } }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hamburger Icon Padding', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'icon_padding',
		'type' => 'number',
		'default' => '20',
		'min' => '0',
		'max' => '100',
		'step' => '1',
		'css' => '.hamburger-button-container { padding: valuepx; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Background Color', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'icon_bg_color',
		'type' => 'color',
		'default' => '',
		'css' => '.hamburger-button-container { background-color: value; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Border Thickness', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'icon_border_thickness',
		'type' => 'number',
		'default' => '4',
		'min' => '0',
		'max' => '10',
		'step' => '1',
		'css' => '.hamburger-button-container { border-width: valuepx; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Border Color', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'icon_border_color',
		'type' => 'color',
		'default' => '#333333',
		'css' => '.hamburger-button-container { border-color: value; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hamburger Icon Opacity', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'icon_opacity',
		'type' => 'number',
		'default' => '1',
		'min' => '0.0',
		'max' => '1.0',
		'step' => '0.01',
		'css' => '.hamburger-button-container { opacity: value; }',
	) );

	
	
	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', GAMBIT_HAMBURGER_PLUGIN ),
	    'name' => __( 'Overlay Colors', GAMBIT_HAMBURGER_PLUGIN ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Overlay Color', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'overlay_color',
		'type' => 'color',
		'default' => '#000000',
		'css' => '#hamburger-overlay { background: value; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Overlay Opacity', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'overlay_opacity',
		'type' => 'number',
		'default' => '0.3',
		'min' => '0.0',
		'max' => '1.0',
		'step' => '0.01',
		'css' => '.hamburger_open #hamburger-overlay { opacity: value; }',
	) );

	
	
	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', GAMBIT_HAMBURGER_PLUGIN ),
	    'name' => __( 'Menu Style', GAMBIT_HAMBURGER_PLUGIN ),
	) );
	
	$section->createOption( array(
		'name' => __( 'The Type of Menu to Display', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_type',
		'type' => 'select',
		'desc' => __( 'Choose your menu flavor:<br>Basic - Plain menu<br>Basic Fixed - Basic & fixed on the side<br>Designed (PRO) - With descriptions & icons<br>Designed Fixed (PRO) - Designed & fixed on the side<br>Full Screen (PRO) - A full screen basic menu', GAMBIT_HAMBURGER_PLUGIN ),
		'options' => array(
			'basic' => __( 'Basic', GAMBIT_HAMBURGER_PLUGIN ),
			'basic-fixed' => __( 'Basic Fixed', GAMBIT_HAMBURGER_PLUGIN ),
			'!designed' => __( 'Designed (PRO)', GAMBIT_HAMBURGER_PLUGIN ),
			'!designed-fixed' => __( 'Designed Fixed (PRO)', GAMBIT_HAMBURGER_PLUGIN ),
			'!fullscreen' => __( 'Full Screen (PRO)', GAMBIT_HAMBURGER_PLUGIN ),
		),
		'default' => 'basic',
	) );
	
	$section->createOption( array(
		'name' => __( 'Menu Slide-In Type', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_slide_type',
		'type' => 'select',
		'options' => array(
			'move-whole' => __( 'Move Whole Page', GAMBIT_HAMBURGER_PLUGIN ),
			'move-partial' => __( 'Move Page Partially', GAMBIT_HAMBURGER_PLUGIN ),
			'fixed' => __( 'Page is Fixed', GAMBIT_HAMBURGER_PLUGIN ),
		),
		'default' => 'fixed',
	) );
	
	$section->createOption( array(
		'name' => __( 'Slide-In Compatibility Mode', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_slide_type_compat',
		'type' => 'select',
		'options' => array(
			'normal' => __( 'Use normal hardware accelerated methods', GAMBIT_HAMBURGER_PLUGIN ),
			'compat' => __( 'Use non-hardware accelerated methods (COMPATIBILITY MODE)', GAMBIT_HAMBURGER_PLUGIN ),
		),
		'desc' => __( 'Sites that have <code>position: fixed</code> elements might have problems regarding the slide-in effects above. If some major elements in your site display incorrectly, select compatibility mode.', GAMBIT_HAMBURGER_PLUGIN ),
		'default' => 'normal',
	) );
	
	$section->createOption( array(
		'name' => __( 'Menu Open Method', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_open_method',
		'type' => 'select',
		'options' => array(
			'click' => __( 'Open on Click', GAMBIT_HAMBURGER_PLUGIN ),
			'!hover' => __( 'Open on Hover (PRO)', GAMBIT_HAMBURGER_PLUGIN ),
		),
		'default' => 'click',
	) );

	
	
	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', GAMBIT_HAMBURGER_PLUGIN ),
	    'name' => __( 'Menu Colors & Styles', GAMBIT_HAMBURGER_PLUGIN ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Background Color', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_bg_color',
		'type' => 'color',
		'default' => '#212121',
		'css' => '#hamburger-menu-container { background: value; }
		#hamburger-menu-container {
			button, input[type="button"], input[type="submit"], input[type="reset"] {
				color: value;
			}
		}
		',
	) );
	
	$section->createOption( array(
		'name' => __( 'Border Color', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_border_color',
		'type' => 'color',
		'default' => '#161616',
		'css' => '#hamburger-menu-container .hamburger-menu { li, li:last-child { border-color: value; } }',
	) );

	
	$section->createOption( array(
		'name' => __( 'Menu Top Level Background Color', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_topmenu_bg_color',
		'type' => 'color',
		'default' => '#212121',
		'css' => '#hamburger-menu-container #hamburger-menu ul { background-color: value }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Title Text Color', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_title_color',
		'type' => 'color',
		'default' => '#939393',
		'css' => '#hamburger-menu-container { h1, h2, h3, h4, h5, h6, th { span, em, strong, & { color: value } } }
			#hamburger-menu-container #hamburger-menu { a, a:link, a:visited { span { color: value } } }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Normal Text Color', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_text_color',
		'type' => 'color',
		'default' => '#939393',
		'css' => '#hamburger-menu-container { li, ol, span, div, td, & { color: value } }
		#hamburger-menu-container {
			input[type="reset"] {
				background-color: value;
			}
		}
		',
	) );
	
	$section->createOption( array(
		'name' => __( 'Text Link Color', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_link_color',
		'type' => 'color',
		'default' => '#22a7f0',
		'css' => '#hamburger-menu-container { &, h1, h2, h3, h4, h5, h6 { a, a:visited, a:link { color: value } } }
		#hamburger-menu-container {
			button, input[type="button"], input[type="submit"] {
				background-color: value;
			}
		}
		',
	) );
	
	$section->createOption( array(
		'name' => __( 'Text Link Hover Color', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_link_hover_color',
		'type' => 'color',
		'default' => '#19b5fe',
		'css' => '#hamburger-menu-container { &, h1, h2, h3, h4, h5, h6 { a, a:visited, a:link { &:hover { color: value } } } }
		#hamburger-menu-container {
			button, input[type="button"], input[type="submit"], input[type="reset"] {
				&:hover {
					background-color: value;
				}
			}
		}
		',
	) );
	
	$section->createOption( array(
		'name' => __( 'Submenu Arrow Color', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_arrow_color',
		'type' => 'color',
		'default' => '#22a7f0',
		'css' => '#hamburger-menu-container #hamburger-menu { a, a:visited, a:link { &:after { color: value } } }',
	) );
	
	
	if ( ! apply_filters( 'hamburger_menu_hover_options', false, $section ) ) {
		$section->createOption( array(
			'name' => __( 'Menu Link Hover Style', GAMBIT_HAMBURGER_PLUGIN ),
			'id' => 'menu_link_highlight_style',
			'type' => 'select',
			'default' => 'glow',
			'options' => array(
				'none' => __( 'None', GAMBIT_HAMBURGER_PLUGIN ),
				'fadein' => __( 'Highlight fade in', GAMBIT_HAMBURGER_PLUGIN ),
				'tab' => __( 'Highlight tab', GAMBIT_HAMBURGER_PLUGIN ),
				'grow-left' => __( 'Highlight grow from the left', GAMBIT_HAMBURGER_PLUGIN ),
				'grow-right' => __( 'Highlight grow from the right ', GAMBIT_HAMBURGER_PLUGIN ),
				'grow-top' => __( 'Highlight grow from the top', GAMBIT_HAMBURGER_PLUGIN ),
				'grow-bottom' => __( 'Highlight grow from the bottom', GAMBIT_HAMBURGER_PLUGIN ),
			),
		) );
	}
	
	$section->createOption( array(
		'name' => __( 'Menu Link Hover Highlight', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_link_highlight_color',
		'type' => 'color',
		'default' => '#2f2f2f',
		'css' => '#hamburger-menu-container #hamburger-menu li { a, a:visited, a:link { &:before { background-color: value; } } }',
	) );

	$section->createOption( array(
		'name' => __( 'Menu Link Accordion-Like Grow Effect', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_link_highlight_grow_style',
		'type' => 'select',
		'default' => 'none',
		'options' => array(
			'none' => __( 'None', GAMBIT_HAMBURGER_PLUGIN ),
			'grow' => __( 'Grow Taller', GAMBIT_HAMBURGER_PLUGIN ),
		),
	) );
	
	$section->createOption( array(
		'name' => __( 'Menu Link Paddings', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_link_padding',
		'type' => 'number',
		'default' => '15',
		'css' => '#hamburger-menu-container { #hamburger-menu, .widget { li a { padding-top: valuepx; padding-bottom: valuepx; } } }
			#hamburger-menu-container.highlight-grow #hamburger-menu li {
				a, a:link, a:visited {
					&:hover {
						padding-top: valuepx + 12px;
						padding-bottom: valuepx + 12px;
					}
				}
			}
		',
		'min' => '0',
		'max' => '30',
		'step' => '1',
	) );

	
	
	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', GAMBIT_HAMBURGER_PLUGIN ),
	    'name' => __( 'Submenu Colors & Styles', GAMBIT_HAMBURGER_PLUGIN ),
	) );

	
	$section->createOption( array(
		'name' => __( 'Submenu Display Type', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_submenu_type',
		'type' => 'select',
		'default' => 'in-menu',
		'options' => array(
			'in-menu' => __( 'Inside the main menu', GAMBIT_HAMBURGER_PLUGIN ),
			'!side-menu' => __( 'On a new panel on the side (PRO)', GAMBIT_HAMBURGER_PLUGIN ),
		),
	) );

	
	$section->createOption( array(
		'name' => __( 'Submenu Level 1 Background Color', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_submenu1_bg_color',
		'type' => 'color',
		'default' => '#1c1c1c',
		'css' => '#hamburger-menu-container #hamburger-menu ul ul { background-color: value }',
	) );

	
	$section->createOption( array(
		'name' => __( 'Submenu Level 2 Background Color', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_submenu2_bg_color',
		'type' => 'color',
		'default' => '#141414',
		'css' => '#hamburger-menu-container #hamburger-menu ul ul ul { background-color: value }',
	) );

	
	$section->createOption( array(
		'name' => __( 'Submenu Level 3+ Background Color', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_submenu3_bg_color',
		'type' => 'color',
		'default' => '#111111',
		'css' => '#hamburger-menu-container #hamburger-menu ul ul ul ul { background-color: value }',
	) );

	
	
	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', GAMBIT_HAMBURGER_PLUGIN ),
	    'name' => __( 'Menu Fonts', GAMBIT_HAMBURGER_PLUGIN ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Menu & Headings Font', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_headings_font',
		'type' => 'font',
		'show_color' => false,
		'default' => array(
			'font-family' => 'Roboto Condensed',
	        'line-height' => '1.1em',
	        'font-size' => '17px',
			'font-weight' => '300',
	    ),
		'css' => '#hamburger-menu-container { li { a, a:visited, a:link { value } } }
			#hamburger-menu-container { h1, h2, h3, h4, h5, h6 { value } }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Normal Text Font', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'menu_text_font',
		'type' => 'font',
		'show_color' => false,
		'default' => array(
			'font-family' => 'Roboto',
	        'line-height' => '1.6em',
	        'font-size' => '14px',
			'font-weight' => '300',
	    ),
		'css' => '#hamburger-menu-container { div, li, ol, span, td, & { value } }',
	) );
	
	
	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', GAMBIT_HAMBURGER_PLUGIN ),
	    'name' => __( 'Menu Logo', GAMBIT_HAMBURGER_PLUGIN ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Top Logo', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'logo_image',
		'type' => 'upload',
		'desc' => __( 'Select a logo here if you want to display a logo on the top part of your menu.', GAMBIT_HAMBURGER_PLUGIN ),
		'default' => '',
	) );
	
	$section->createOption( array(
		'name' => __( 'Logo Width', GAMBIT_HAMBURGER_PLUGIN ),
		'id' => 'logo_width',
		'type' => 'number',
		'desc' => __( 'Your logo will be resized to this width in pixels. This is useful for retina devices, upload a large image above, then display them in a smaller size here.', GAMBIT_HAMBURGER_PLUGIN ),
		'default' => '150',
		'min' => '0',
		'max' => '350',
		'step' => '1',
	) );
	
	

	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', GAMBIT_HAMBURGER_PLUGIN ),
	    'name' => __( 'Social Icons', GAMBIT_HAMBURGER_PLUGIN ),
		'desc' => __( 'Display your social links as icons that appear on the bottom of your hamburger menu. Enter your social links in the fields below.', GAMBIT_HAMBURGER_PLUGIN ),
	) );
	
}