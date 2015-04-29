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
	    'name' => __( 'Menu Colors', 'hamburgermenu' ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Background Color', 'hamburgermenu' ),
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