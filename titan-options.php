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
		'default' => '',
		'placeholder' => 'Example: .class, #id',
	) );
	

	
	$section = $titan->createThemeCustomizerSection( array(
		'panel' => __( 'Hamburger Menu', 'hamburgermenu' ),
	    'name' => __( 'Icon Location', 'hamburgermenu' ),
	) );
	
	$section->createOption( array(
		'name' => __( 'Icon Top Offset', 'hamburger' ),
		'id' => 'icon_top',
		'type' => 'number',
		'desc' => __( 'In pixels', 'hamburger' ),
		'default' => '30',
		'min' => '0',
		'max' => '300',
		'step' => '1',
	) );
	
	$section->createOption( array(
		'name' => __( 'Icon Left Offset', 'hamburger' ),
		'id' => 'icon_left',
		'type' => 'number',
		'desc' => __( 'In pixels', 'hamburger' ),
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
	
}