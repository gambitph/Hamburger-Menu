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
	
	$section->createOption( array(
		'name' => __( 'The Type of Menu to Display', 'hamburger' ),
		'id' => 'menu_type',
		'type' => 'select',
		'desc' => __( 'Choose your menu flavor:<br>Basic - Plain menu<br>Basic Fixed - Basic & fixed on the side<br>Designed (PRO) - With descriptions & icons<br>Designed Fixed (PRO) - Designed & fixed on the side<br>Full Screen (PRO) - A full screen basic menu', 'hamburger' ),
		'options' => array(
			'basic' => __( 'Basic', 'hamburger' ),
			'basic-fixed' => __( 'Basic Fixed', 'hamburger' ),
			'!designed' => __( 'Designed (PRO)', 'hamburger' ),
			'!designed-fixed' => __( 'Designed Fixed (PRO)', 'hamburger' ),
			'!fullscreen' => __( 'Full Screen (PRO)', 'hamburger' ),
		),
		'default' => 'basic',
	) );
	
	$options = array( '' => '- Select -' );
	foreach ( get_registered_nav_menus() as $menuSlug => $menuName ) {
		if ( $menuSlug !== 'hamburger' ) {
			$options[ $menuSlug ] = $menuName;
		}
	}
	
	$section->createOption( array(
		'name' => __( 'Show Menu When Below Width', 'hamburger' ),
		'id' => 'show_below_width',
		'type' => 'number',
		'desc' => __( 'Only show the hamburger menu when the screen is below this width. Leave as 0 to always show the menu.', 'hamburger' ),
		'default' => '0',
		'min' => '0',
		'max' => '2000',
		'step' => '1',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hide Primary Menu When Hamburger is Visible', 'hamburger' ),
		'id' => 'hide_menu',
		'type' => 'select',
		'desc' => __( 'If you intend to replace your main menu with Hamburger Menu, select the menu that you want hidden from your frontend. This works in conjuction with the above setting, the menu here will only get hidden if the hamburger is visible.', 'hamburger' ),
		'options' => $options,
		'default' => '',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hide These Elements When Hamburger is Visible (Put Selectors)', 'hamburger' ),
		'id' => 'hide_selectors',
		'type' => 'text',
		'desc' => __( 'Sometimes, the above setting for hiding menus won\'t be enough and you might still see a menu button that should be hidden. If that is the case, inspect your website and put the css selectors of the elements to hide here.', 'hamburger' ),
		'default' => 'header .secondary-toggle',
	) );
	


	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', 'hamburgermenu' ),
	    'name' => __( 'Icon Location', 'hamburgermenu' ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Icon Top Offset', 'hamburger' ),
		'id' => 'icon_top',
		'type' => 'number',
		'desc' => __( 'The vertical offset of the location of the icon from the top of the site, in pixels', 'hamburger' ),
		'default' => '30',
		'min' => '0',
		'max' => '300',
		'step' => '1',
	) );
	
	$section->createOption( array(
		'name' => __( 'Icon Left Offset', 'hamburger' ),
		'id' => 'icon_left',
		'type' => 'number',
		'desc' => __( 'The horizontal offset of the location of the icon from the left of the site, in pixels', 'hamburger' ),
		'default' => '30',
		'min' => '0',
		'max' => '300',
		'step' => '1',
	) );
	
	$titan->createCSS( '
		.hamburger-button-container {
			top: #{$icon_top}px;
			left: #{$icon_left}px;
		}
	' );
	

	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', 'hamburgermenu' ),
	    'name' => __( 'Icon Colors', 'hamburgermenu' ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Hamburger Bar Thickness', 'hamburger' ),
		'id' => 'icon_bar_thickness',
		'type' => 'number',
		'default' => '4',
		'min' => '0',
		'max' => '10',
		'step' => '1',
		'css' => '.hamburger-button-container .hamburger-button-icon { height: valuepx; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hamburger Bar Color', 'hamburger' ),
		'id' => 'icon_bar_color',
		'type' => 'color',
		'default' => '#333333',
		'css' => '.hamburger-button-container { .hamburger-button-icon { &, &:before, &:after { background-color: value; } } }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hamburger Icon Size', 'hamburger' ),
		'id' => 'icon_size',
		'type' => 'number',
		'default' => '30',
		'min' => '10',
		'max' => '100',
		'step' => '1',
		'css' => '.hamburger-button-container { width: valuepx; height: valuepx; .hamburger-button-icon { width: valuepx; } }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hamburger Icon Padding', 'hamburger' ),
		'id' => 'icon_padding',
		'type' => 'number',
		'default' => '20',
		'min' => '0',
		'max' => '100',
		'step' => '1',
		'css' => '.hamburger-button-container { padding: valuepx; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Background Color', 'hamburger' ),
		'id' => 'icon_bg_color',
		'type' => 'color',
		'default' => '#ffffff',
		'css' => '.hamburger-button-container { background-color: value; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Border Thickness', 'hamburger' ),
		'id' => 'icon_border_thickness',
		'type' => 'number',
		'default' => '4',
		'min' => '0',
		'max' => '10',
		'step' => '1',
		'css' => '.hamburger-button-container { border-width: valuepx; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Border Color', 'hamburger' ),
		'id' => 'icon_border_color',
		'type' => 'color',
		'default' => '#333333',
		'css' => '.hamburger-button-container { border-color: value; }',
	) );
	
	$section->createOption( array(
		'name' => __( 'Hamburger Icon Opacity', 'hamburger' ),
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
	    'name' => __( 'Menu Colors', 'hamburgermenu' ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Background Color', 'hamburger' ),
		'id' => 'menu_bg_color',
		'type' => 'color',
		'default' => '#34495E',
		'css' => '#hamburger-menu-container { background: value; }',
	) );

	
	
	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', 'hamburgermenu' ),
	    'name' => __( 'Menu Logo', 'hamburgermenu' ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Top Logo', 'hamburger' ),
		'id' => 'logo_image',
		'type' => 'upload',
		'desc' => __( 'Select a logo here if you want to display a logo on the top part of your menu.', 'hamburger' ),
		'default' => '',
	) );
	
	$section->createOption( array(
		'name' => __( 'Logo Width', 'hamburger' ),
		'id' => 'logo_width',
		'type' => 'number',
		'desc' => __( 'Your logo will be resized to this width in pixels.', 'hamburger' ),
		'default' => '150',
		'min' => '0',
		'max' => '350',
		'step' => '1',
	) );
	
}