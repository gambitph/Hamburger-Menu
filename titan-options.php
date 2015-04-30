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
		'panel' => __( 'Hamburger Menu', 'hamburgermenu' ),
	    'name' => __( 'General', 'hamburgermenu' ),
		'panel_desc' => '',
	) );
	
	$options = array( '' => '- Select -' );
	foreach ( get_registered_nav_menus() as $menuSlug => $menuName ) {
		if ( $menuSlug !== 'hamburger' ) {
			$options[ $menuSlug ] = $menuName;
		}
	}
	
	$section->createOption( array(
		'name' => __( 'Show Menu When Below Width', 'hamburgermenu' ),
		'id' => 'show_below_width',
		'type' => 'number',
		'desc' => __( 'Only show the hamburger menu when the screen is below this width. Leave as 0 to always show the menu.', 'hamburgermenu' ),
		'default' => '0',
		'min' => '0',
		'max' => '2000',
		'step' => '1',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hide Primary Menu When Hamburger is Visible', 'hamburgermenu' ),
		'id' => 'hide_menu',
		'type' => 'select',
		'desc' => __( 'If you intend to replace your main menu with Hamburger Menu, select the menu that you want hidden from your frontend. This works in conjuction with the above setting, the menu here will only get hidden if the hamburger is visible.', 'hamburgermenu' ),
		'options' => $options,
		'default' => '',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hide These Elements When Hamburger is Visible (Put Selectors)', 'hamburgermenu' ),
		'id' => 'hide_selectors',
		'type' => 'text',
		'desc' => __( 'Sometimes, the above setting for hiding menus won\'t be enough and you might still see a menu button that should be hidden. If that is the case, inspect your website and put the css selectors of the elements to hide here.', 'hamburgermenu' ),
		'default' => 'header .secondary-toggle',
	) );
	


	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', 'hamburgermenu' ),
	    'name' => __( 'Icon & Menu Location', 'hamburgermenu' ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Menu Location', 'hamburgermenu' ),
		'id' => 'menu_location',
		'type' => 'select',
		'options' => array(
			'left' => __( 'Left', 'hamburgermenu' ),
			'right' => __( 'Right', 'hamburgermenu' ),
		),
		'default' => 'left',
	) );
	
	$section->createOption( array(
		'name' => __( 'Icon Top Offset', 'hamburgermenu' ),
		'id' => 'icon_top',
		'type' => 'number',
		'desc' => __( 'The vertical offset of the location of the icon from the top of the site, in pixels', 'hamburgermenu' ),
		'default' => '30',
		'min' => '0',
		'max' => '300',
		'step' => '1',
		'css' => '.hamburger-button-container { top: valuepx; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Icon Left/Right Offset', 'hamburgermenu' ),
		'id' => 'icon_left',
		'type' => 'number',
		'desc' => __( 'The horizontal offset of the location of the icon from the left/right of the site, in pixels', 'hamburgermenu' ),
		'default' => '30',
		'min' => '0',
		'max' => '300',
		'step' => '1',
		'css' => '.hamburger-button-container { left: valuepx; right: valuepx; }',
	) );
	
	

	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', 'hamburgermenu' ),
	    'name' => __( 'Icon Colors', 'hamburgermenu' ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Hamburger Bar Thickness', 'hamburgermenu' ),
		'id' => 'icon_bar_thickness',
		'type' => 'number',
		'default' => '4',
		'min' => '0',
		'max' => '10',
		'step' => '1',
		'css' => '.hamburger-button-container .hamburger-button-icon { height: valuepx; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hamburger Bar Color', 'hamburgermenu' ),
		'id' => 'icon_bar_color',
		'type' => 'color',
		'default' => '#333333',
		'css' => '.hamburger-button-container { .hamburger-button-icon { &, &:before, &:after { background-color: value; } } }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hamburger Icon Size', 'hamburgermenu' ),
		'id' => 'icon_size',
		'type' => 'number',
		'default' => '30',
		'min' => '10',
		'max' => '100',
		'step' => '1',
		'css' => '.hamburger-button-container { width: valuepx; height: valuepx; .hamburger-button-icon { width: valuepx; } }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hamburger Icon Padding', 'hamburgermenu' ),
		'id' => 'icon_padding',
		'type' => 'number',
		'default' => '20',
		'min' => '0',
		'max' => '100',
		'step' => '1',
		'css' => '.hamburger-button-container { padding: valuepx; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Background Color', 'hamburgermenu' ),
		'id' => 'icon_bg_color',
		'type' => 'color',
		'default' => '',
		'css' => '.hamburger-button-container { background-color: value; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Border Thickness', 'hamburgermenu' ),
		'id' => 'icon_border_thickness',
		'type' => 'number',
		'default' => '4',
		'min' => '0',
		'max' => '10',
		'step' => '1',
		'css' => '.hamburger-button-container { border-width: valuepx; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Border Color', 'hamburgermenu' ),
		'id' => 'icon_border_color',
		'type' => 'color',
		'default' => '#333333',
		'css' => '.hamburger-button-container { border-color: value; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hamburger Icon Opacity', 'hamburgermenu' ),
		'id' => 'icon_opacity',
		'type' => 'number',
		'default' => '1',
		'min' => '0.0',
		'max' => '1.0',
		'step' => '0.01',
		'css' => '.hamburger-button-container { opacity: value; }',
	) );

	
	
	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', 'hamburgermenu' ),
	    'name' => __( 'Overlay Colors', 'hamburgermenu' ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Overlay Color', 'hamburgermenu' ),
		'id' => 'overlay_color',
		'type' => 'color',
		'default' => '#000000',
		'css' => '#hamburger-overlay { background: value; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Overlay Opacity', 'hamburgermenu' ),
		'id' => 'overlay_opacity',
		'type' => 'number',
		'default' => '0.3',
		'min' => '0.0',
		'max' => '1.0',
		'step' => '0.01',
		'css' => '.hamburger_open #hamburger-overlay { opacity: value; }',
	) );

	
	
	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', 'hamburgermenu' ),
	    'name' => __( 'Menu Style', 'hamburgermenu' ),
	) );
	
	$section->createOption( array(
		'name' => __( 'The Type of Menu to Display', 'hamburgermenu' ),
		'id' => 'menu_type',
		'type' => 'select',
		'desc' => __( 'Choose your menu flavor:<br>Basic - Plain menu<br>Basic Fixed - Basic & fixed on the side<br>Designed (PRO) - With descriptions & icons<br>Designed Fixed (PRO) - Designed & fixed on the side<br>Full Screen (PRO) - A full screen basic menu', 'hamburgermenu' ),
		'options' => array(
			'basic' => __( 'Basic', 'hamburgermenu' ),
			'basic-fixed' => __( 'Basic Fixed', 'hamburgermenu' ),
			'!designed' => __( 'Designed (PRO)', 'hamburgermenu' ),
			'!designed-fixed' => __( 'Designed Fixed (PRO)', 'hamburgermenu' ),
			'!fullscreen' => __( 'Full Screen (PRO)', 'hamburgermenu' ),
		),
		'default' => 'basic',
	) );
	
	$section->createOption( array(
		'name' => __( 'Menu Slide-In Type', 'hamburgermenu' ),
		'id' => 'menu_slide_type',
		'type' => 'select',
		'options' => array(
			'move-whole' => __( 'Move Whole Page', 'hamburgermenu' ),
			'move-partial' => __( 'Move Page Partially', 'hamburgermenu' ),
			'fixed' => __( 'Page is Fixed', 'hamburgermenu' ),
		),
		'default' => 'fixed',
	) );
	
	$section->createOption( array(
		'name' => __( 'Menu Open Method', 'hamburgermenu' ),
		'id' => 'menu_open_method',
		'type' => 'select',
		'options' => array(
			'click' => __( 'Open on Click', 'hamburgermenu' ),
			'!hover' => __( 'Open on Hover (PRO)', 'hamburgermenu' ),
		),
		'default' => 'click',
	) );

	
	
	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', 'hamburgermenu' ),
	    'name' => __( 'Menu Colors & Styles', 'hamburgermenu' ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Background Color', 'hamburgermenu' ),
		'id' => 'menu_bg_color',
		'type' => 'color',
		'default' => '#212121',
		'css' => '#hamburger-menu-container { background: value; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Border Color', 'hamburgermenu' ),
		'id' => 'menu_border_color',
		'type' => 'color',
		'default' => '#161616',
		'css' => '#hamburger-menu-container .hamburger-menu { li, li:last-child { border-color: value; } }',
	) );

	
	$section->createOption( array(
		'name' => __( 'Menu Top Level Background Color', 'hamburgermenu' ),
		'id' => 'menu_topmenu_bg_color',
		'type' => 'color',
		'default' => '#212121',
		'css' => '#hamburger-menu-container #hamburger-menu ul { background-color: value }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Title Text Color', 'hamburgermenu' ),
		'id' => 'menu_title_color',
		'type' => 'color',
		'default' => '#939393',
		'css' => '#hamburger-menu-container { h1, h2, h3, h4, h5, h6, th { span, em, strong, & { color: value } } }
			#hamburger-menu-container #hamburger-menu { a, a:link, a:visited { span { color: value } } }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Normal Text Color', 'hamburgermenu' ),
		'id' => 'menu_text_color',
		'type' => 'color',
		'default' => '#939393',
		'css' => '#hamburger-menu-container { li, ol, span, div, td, & { color: value } }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Text Link Color', 'hamburgermenu' ),
		'id' => 'menu_link_color',
		'type' => 'color',
		'default' => '#22a7f0',
		'css' => '#hamburger-menu-container { &, h1, h2, h3, h4, h5, h6 { a, a:visited, a:link { color: value } } }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Text Link Hover Color', 'hamburgermenu' ),
		'id' => 'menu_link_hover_color',
		'type' => 'color',
		'default' => '#19b5fe',
		'css' => '#hamburger-menu-container { &, h1, h2, h3, h4, h5, h6 { a, a:visited, a:link { &:hover { color: value } } } }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Submenu Arrow Color', 'hamburgermenu' ),
		'id' => 'menu_arrow_color',
		'type' => 'color',
		'default' => '#22a7f0',
		'css' => '#hamburger-menu-container #hamburger-menu { a, a:visited, a:link { &:after { color: value } } }',
	) );
	
	
	if ( ! apply_filters( 'hamburger_menu_hover_options', false, $section ) ) {
		$section->createOption( array(
			'name' => __( 'Menu Link Hover Style', 'hamburgermenu' ),
			'id' => 'menu_link_highlight_style',
			'type' => 'select',
			'default' => 'glow',
			'options' => array(
				'none' => __( 'None', 'hamburgermenu' ),
				'fadein' => __( 'Highlight fade in', 'hamburgermenu' ),
				'tab' => __( 'Highlight tab', 'hamburgermenu' ),
				'!grow-left' => __( 'Highlight grow from the left (PRO)', 'hamburgermenu' ),
				'!grow-right' => __( 'Highlight grow from the right (PRO)', 'hamburgermenu' ),
				'!grow-top' => __( 'Highlight grow from the top (PRO)', 'hamburgermenu' ),
				'!grow-bottom' => __( 'Highlight grow from the bottom (PRO)', 'hamburgermenu' ),
			),
		) );
	}
	
	$section->createOption( array(
		'name' => __( 'Menu Link Hover Highlight', 'hamburgermenu' ),
		'id' => 'menu_link_highlight_color',
		'type' => 'color',
		'default' => '#2f2f2f',
		'css' => '#hamburger-menu-container #hamburger-menu li { a, a:visited, a:link { &:before { background-color: value; } } }',
	) );

	$section->createOption( array(
		'name' => __( 'Menu Link Accordion-Like Grow Effect', 'hamburgermenu' ),
		'id' => 'menu_link_highlight_grow_style',
		'type' => 'select',
		'default' => 'none',
		'options' => array(
			'none' => __( 'None', 'hamburgermenu' ),
			'grow' => __( 'Grow Taller', 'hamburgermenu' ),
		),
	) );
	
	$section->createOption( array(
		'name' => __( 'Menu Link Paddings', 'hamburgermenu' ),
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
		'panel' => __( 'Hamburger Menu', 'hamburgermenu' ),
	    'name' => __( 'Submenu Colors & Styles', 'hamburgermenu' ),
	) );

	
	$section->createOption( array(
		'name' => __( 'Submenu Display Type', 'hamburgermenu' ),
		'id' => 'menu_submenu_type',
		'type' => 'select',
		'default' => 'in-menu',
		'options' => array(
			'in-menu' => __( 'Inside the main menu', 'hamburgermenu' ),
			'!side-menu' => __( 'On a new panel on the side (PRO)', 'hamburgermenu' ),
		),
	) );

	
	$section->createOption( array(
		'name' => __( 'Submenu Level 1 Background Color', 'hamburgermenu' ),
		'id' => 'menu_submenu1_bg_color',
		'type' => 'color',
		'default' => '#1c1c1c',
		'css' => '#hamburger-menu-container #hamburger-menu ul ul { background-color: value }',
	) );

	
	$section->createOption( array(
		'name' => __( 'Submenu Level 2 Background Color', 'hamburgermenu' ),
		'id' => 'menu_submenu2_bg_color',
		'type' => 'color',
		'default' => '#141414',
		'css' => '#hamburger-menu-container #hamburger-menu ul ul ul { background-color: value }',
	) );

	
	$section->createOption( array(
		'name' => __( 'Submenu Level 3+ Background Color', 'hamburgermenu' ),
		'id' => 'menu_submenu3_bg_color',
		'type' => 'color',
		'default' => '#111111',
		'css' => '#hamburger-menu-container #hamburger-menu ul ul ul ul { background-color: value }',
	) );

	
	
	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', 'hamburgermenu' ),
	    'name' => __( 'Menu Fonts', 'hamburgermenu' ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Menu & Headings Font', 'hamburgermenu' ),
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
		'name' => __( 'Normal Text Font', 'hamburgermenu' ),
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
		'panel' => __( 'Hamburger Menu', 'hamburgermenu' ),
	    'name' => __( 'Menu Logo', 'hamburgermenu' ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Top Logo', 'hamburgermenu' ),
		'id' => 'logo_image',
		'type' => 'upload',
		'desc' => __( 'Select a logo here if you want to display a logo on the top part of your menu.', 'hamburgermenu' ),
		'default' => '',
	) );
	
	$section->createOption( array(
		'name' => __( 'Logo Width', 'hamburgermenu' ),
		'id' => 'logo_width',
		'type' => 'number',
		'desc' => __( 'Your logo will be resized to this width in pixels. This is useful for retina devices, upload a large image above, then display them in a smaller size here.', 'hamburgermenu' ),
		'default' => '150',
		'min' => '0',
		'max' => '350',
		'step' => '1',
	) );
	
	

	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', 'hamburgermenu' ),
	    'name' => __( 'Social Icons', 'hamburgermenu' ),
		'desc' => __( 'Display your social links as icons that appear on the bottom of your hamburger menu. Enter your social links in the fields below.', 'hamburgermenu' ),
	) );
	
	if ( ! apply_filters( 'hamburger_social_links_options', false, $section ) ) {
		$section->createOption( array(
			'id' => 'social_dummy',
			'hidden' => true,
			'type' => 'note',
			'desc' => __( 'This feature is only available in the PRO version', 'hamburgermenu' ) . '<br><a href="' . HAMBURGER_STORE_URL . '" class="button button-primary" target="_blank" style="margin-top: 5px">' . __( 'Go PRO now to enable social icons', 'hamburgermenu' ) . '</a>',
			'default' => '',
		) );
	}
	
}