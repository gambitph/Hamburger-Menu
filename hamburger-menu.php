<?php
/**
* Plugin Name: Hamburger Menu by Gambit
* Plugin URI: https://github.com/gambitph/Hamburger-Menu
* Description: A mobile hamburger menu that displays a cool side menu. This can serve as a replacement menu for your theme.
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
defined( 'HAMBURGER_VERSION' ) or define( 'HAMBURGER_VERSION', '1.0' );

// Used for file includes
defined( 'HAMBURGER_PATH' ) or define( 'HAMBURGER_PATH', trailingslashit( dirname( __FILE__ ) ) );
defined( 'HAMBURGER_URL' ) or define( 'HAMBURGER_URL', plugin_dir_url( __FILE__ ) );
defined( 'HAMBURGER_FILE' ) or define( 'HAMBURGER_FILE', __FILE__ );
defined( 'HAMBURGER_STORE_URL' ) or define( 'HAMBURGER_STORE_URL', 'http://wphamburgermenu.com' );

require_once( 'titan-options.php' );
require_once( 'titan-framework-checker.php' );

if ( ! class_exists('GambitHamburgerMenu') ) {

	class GambitHamburgerMenu {
	
		public $menuClassToHide = '';
	
		/**
		 * Some themes may have some compatibility issues, specify those here so we can add body classes
		 */
		public $compatibilityThemes = array(
			'Twenty Fifteen',
			'Twenty Fourteen',
		);
	
		function __construct() {
			add_action( 'after_setup_theme', array( $this, 'registerMenu' ) );
			add_filter( 'wp_nav_menu', array( $this, 'hideFrontendMenu' ), 10, 2 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueueFrontendScripts' ) );
			add_action( 'wp_footer', array( $this, 'includeTemplates' ) );
			add_action( 'wp_footer', array( $this, 'passScriptVariables' ) );
			add_action( 'widgets_init', array( $this, 'initWidgets' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'initCustomizer' ) );
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'includeCustomizerTemplate' ) );
			add_filter( 'body_class', array( $this, 'addThemeClass' ) );
		
			add_filter( 'titan_checker_installation_notice', array( $this, 'titanInstallNotice' ) );
			add_filter( 'titan_checker_activation_notice', array( $this, 'titanActivateNotice' ) );
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
		
			if ( ! class_exists( 'TitanFramework' ) ) {
				return;
			}
		
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
		
			// Enqueue Genericons
			if ( ! wp_script_is( 'genericons', 'registered' ) ) {
				wp_enqueue_style( 'genericons', HAMBURGER_URL . 'fonts/genericons.css' );
			}
		}
	
		public function initCustomizer() {
			// Needed by templates
			wp_enqueue_script( 'wp-util' );
		
			wp_enqueue_script( 'hamburger-customizer', HAMBURGER_URL . 'js/min/customizer-min.js', array( 'jquery' ), HAMBURGER_VERSION, true );
		}
	
		public function passScriptVariables() {
		
			if ( ! class_exists( 'TitanFramework' ) ) {
				return;
			}
		
			$titan = TitanFramework::getInstance( 'hamburger_menu' );
		
			$themeName = '';
			$currentTheme = wp_get_theme();
			if ( in_array( $currentTheme->get( 'Name' ), $this->compatibilityThemes ) ) {
				$themeName = 'hamburger-' . str_replace( ' ', '-', strtolower( $currentTheme->get( 'Name' ) ) );
			}
		
	 		wp_localize_script( 'hamburger', 'hamburger_vars', array(
				'menu_hide_class' => $this->menuClassToHide,
				'show_below_width' => $titan->getOption( 'show_below_width' ),
				'hide_selectors' => $titan->getOption( 'hide_selectors' ),
				'is_fixed' => $titan->getOption( 'menu_type' ) ? ( stripos( $titan->getOption( 'menu_type' ), '-fixed' ) !== false ? true : false ) : false,
				'menu_slide_type' => $titan->getOption( 'menu_slide_type' ),
				'menu_location' => $titan->getOption( 'menu_location' ),
				'is_customize_preview' => is_customize_preview(),
				'theme_name' => $themeName,
				'compatibility_mode' => $titan->getOption( 'menu_slide_type_compat' ),
			) );
		
		}
	
		public function includeTemplates() {
			if ( ! class_exists( 'TitanFramework' ) ) {
				return;
			}
		
			include_once( HAMBURGER_PATH . 'templates/icon.php' );
			include_once( HAMBURGER_PATH . 'templates/menu.php' );
		}
	
		public function includeCustomizerTemplate() {
			include_once( HAMBURGER_PATH . 'templates/go-pro.php' );
		}
	
		public function initWidgets() {
			register_sidebar( array(
				'name' => __( 'Hamburger Menu Bottom Widgets', 'hamburgermenu' ),
				'id' => 'hamburger-bottom-widgets',
				'description' => __( 'Widgets here appear in the bottom area of the hamburger menu.', 'hamburgermenu' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h4 class="widget-title">',
				'after_title' => '</h4>',
			) );
			register_sidebar( array(
				'name' => __( 'Hamburger Menu Top Widgets', 'hamburgermenu' ),
				'id' => 'hamburger-top-widgets',
				'description' => __( 'Widgets here appear in the top area of the hamburger menu.', 'hamburgermenu' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h4 class="widget-title">',
				'after_title' => '</h4>',
			) );
		}
	
	
		/**
		 * Some themes may have some compatibility issues, we add the classes to support them here
		 */
		public function addThemeClass( $classes ) {
			$currentTheme = wp_get_theme();
		
			if ( in_array( $currentTheme->get( 'Name' ), $this->compatibilityThemes ) ) {
				$classes[] = 'hamburger-' . str_replace( ' ', '-', strtolower( $currentTheme->get( 'Name' ) ) );
			}
		
			return $classes;
		}
	
	
		public function titanInstallNotice( $notice ) {
			return __( 'Hamburger Menu needs Titan Framework to be installed to work.', 'hamburgermenu' );
		}
	
		public function titanActivateNotice( $notice ) {
			return __( 'Hamburger Menu needs Titan Framework to be activated to work.', 'hamburgermenu' );
		}
	
	}

	new GambitHamburgerMenu();
}