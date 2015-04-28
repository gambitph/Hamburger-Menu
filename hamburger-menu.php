<?php
/**
* Plugin Name: Hamburger Menu by Gambit
* Plugin URI: https://github.com/gambitph/Hamburger-Menu
* Description: 
* Version: 1.0
* Author: Benjamin Intal - Gambit Technologies Inc
* Author URI: http://gambit.ph
* License: GPL2
* Text Domain: hamburgermenu
* Domain Path: /languages
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Used for tracking the version used
defined( 'HAMBURGER_VERSION' ) or define( 'HAMBURGER_VERSION', '1.1' );

// Used for file includes
defined( 'HAMBURGER_PATH' ) or define( 'HAMBURGER_PATH', trailingslashit( dirname( __FILE__ ) ) );
defined( 'HAMBURGER_URL' ) or define( 'HAMBURGER_URL', plugin_dir_url( __FILE__ ) );
defined( 'HAMBURGER_FILE' ) or define( 'HAMBURGER_FILE', __FILE__ );
defined( 'HAMBURGER_STORE_URL' ) or define( 'HAMBURGER_STORE_URL', 'http://wphamburgermenu.com' );

require_once( 'titan-framework/titan-framework-embedder.php' );
require_once( 'titan-options.php' );

class GambitHamburgerMenu {
	
	public $menuClassToHide = '';
	
	function __construct() {
		add_action( 'after_setup_theme', array( $this, 'registerMenu' ) );
		add_filter( 'wp_nav_menu', array( $this, 'hideFrontendMenu' ), 10, 2 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueueFrontendScripts' ) );
		add_action( 'wp_footer', array( $this, 'includeTemplates' ) );
		add_action( 'wp_footer', array( $this, 'passScriptVariables' ) );
		add_action( 'widgets_init', array( $this, 'initWidgets' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'initCustomizer' ) );
		add_action( 'customize_controls_print_footer_scripts', array( $this, 'includeCustomizerTemplate' ) );
	}
	
	public function registerMenu() {
		register_nav_menus( array(
			'hamburger' => __( 'Hamburger Menu', 'hamburgermenu' ),
		) );
	}
	
	
	/**
	 * Get the class of the menu to hide and remember it. We're going to pass this on
	 * to JS to hide it.
	 */
	public function hideFrontendMenu( $navMenu, $args ) {
		
		$titan = TitanFramework::getInstance( 'hamburger_menu' );
		$menuSlug = $titan->getOption( 'hide_menu' );
		if ( ! empty( $menuSlug ) ) {
			if ( $args->theme_location == $menuSlug ) {
				
				preg_match( "/class=['\"]([^'\"]+)['\"]/", $navMenu, $matches );
				if ( count( $matches ) > 1 ) {
					$this->menuClassToHide = $matches[1];
				}
				
			}
		}
		
		return $navMenu;
	}
	
	public function enqueueFrontendScripts() {
		// Needed by templates
		wp_enqueue_script( 'wp-util' );
		
		wp_enqueue_style( 'hamburger', HAMBURGER_URL . 'css/style.css', array(), HAMBURGER_VERSION );
		wp_enqueue_script( 'hamburger', HAMBURGER_URL . 'js/min/script-min.js', array( 'jquery' ), HAMBURGER_VERSION, true );
	}
	
	public function initCustomizer() {
		// Needed by templates
		wp_enqueue_script( 'wp-util' );
		
		wp_enqueue_script( 'hamburger-customizer', HAMBURGER_URL . 'js/min/customizer-min.js', array( 'jquery' ), HAMBURGER_VERSION, true );
	}
	
	public function passScriptVariables() {
		$titan = TitanFramework::getInstance( 'hamburger_menu' );
		
 		wp_localize_script( 'hamburger', 'hamburger_vars', array(
			'menu_hide_class' => $this->menuClassToHide,
			'show_below_width' => $titan->getOption( 'show_below_width' ),
			'hide_selectors' => $titan->getOption( 'hide_selectors' ),
		) );
	}
	
	public function includeTemplates() {
		include_once( HAMBURGER_PATH . 'templates/icon.php' );
		include_once( HAMBURGER_PATH . 'templates/menu.php' );
	}
	
	public function includeCustomizerTemplate() {
		include_once( HAMBURGER_PATH . 'templates/go-pro.php' );
	}
	
	public function initWidgets() {
		register_sidebar( array(
			'name' => __( 'Hamburger Menu Top Widgets', 'hamburgermenu' ),
			'id' => 'hamburger-top-widgets',
			'description' => __( 'Widgets here appear in the hamburger menu.', 'hamburgermenu' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		) );
	}
	
}

new GambitHamburgerMenu();