<?php
/*
Plugin Name: Hamburger Menu by Gambit
Plugin URI: http://www.gambit.ph/downloads/hamburger-menu-by-gambit/
Description: A mobile hamburger menu that displays a cool side menu. This can serve as a replacement menu for your theme.
Version: 2.0
Author: Benjamin Intal - Gambit Technologies Inc
Author URI: http://gambit.ph
License: GPL2
Text Domain: hamburger-menu
Domain Path: /languages
SKU: HAMBURGER
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Used for tracking the version used
defined( 'HAMBURGER_VERSION' ) or define( 'HAMBURGER_VERSION', '2.0' );

defined( 'GAMBIT_HAMBURGER_PLUGIN' ) or define( 'GAMBIT_HAMBURGER_PLUGIN', 'hamburger-menu' );

// Used for file includes
defined( 'HAMBURGER_PATH' ) or define( 'HAMBURGER_PATH', trailingslashit( dirname( __FILE__ ) ) );
defined( 'HAMBURGER_URL' ) or define( 'HAMBURGER_URL', plugin_dir_url( __FILE__ ) );
defined( 'HAMBURGER_FILE' ) or define( 'HAMBURGER_FILE', __FILE__ );
defined( 'HAMBURGER_STORE_URL' ) or define( 'HAMBURGER_STORE_URL', 'http://wphamburgermenu.com' );

require_once( 'class-admin-license.php' );
require_once( 'class-hamburger-menu.php' );
require_once( 'titan-options.php' );
require_once( 'titan-framework-checker.php' );

if ( ! class_exists('GambitHamburgerMenu') ) {

	class GambitHamburgerMenu {
	
		function __construct() {

			// Admin pointer reminders for automatic updates
			require_once( 'class-admin-pointers.php' );
			if ( class_exists( 'GambitAdminPointers' ) ) {
				new GambitAdminPointers( array (
					'pointer_name' => 'gambithamburger', // This should also be placed in uninstall.php
					'header' => __( 'Automatic Updates', GAMBIT_HAMBURGER_PLUGIN ),
					'body' => __( 'Keep your Hamburger Menu by Gambit plugin updated by entering your purchase code here.', GAMBIT_HAMBURGER_PLUGIN ),
				) );
			}
					
			add_filter( 'titan_checker_installation_notice', array( $this, 'titanInstallNotice' ) );
			add_filter( 'titan_checker_activation_notice', array( $this, 'titanActivateNotice' ) );
			
			// Gambit links
			add_filter( 'plugin_row_meta', array( $this, 'pluginLinks' ), 10, 2 );
			
			// Our translations
			add_action( 'plugins_loaded', array( $this, 'loadTextDomain' ), 1 );
		}


		/**
		 * Loads the translations
		 *
		 * @return	void
		 * @since	1.0
		 */
		public function loadTextDomain() {
			load_plugin_textdomain( GAMBIT_HAMBURGER_PLUGIN, false, basename( dirname( __FILE__ ) ) . '/languages/' );
		}
	
	
		/**
		 * Adds plugin links
		 *
		 * @access	public
		 * @param	array $plugin_meta The current array of links
		 * @param	string $plugin_file The plugin file
		 * @return	array The current array of links together with our additions
		 * @since	1.0
		 **/
		public function pluginLinks( $plugin_meta, $plugin_file ) {
			if ( $plugin_file == plugin_basename( __FILE__ ) ) {
				$pluginData = get_plugin_data( __FILE__ );

				$plugin_meta[] = sprintf( "<a href='%s' target='_blank'>%s</a>",
					"http://support.gambit.ph?utm_source=" . urlencode( $pluginData['Name'] ) . "&utm_medium=plugin_link",
					__( "Get Customer Support", GAMBIT_TEMPLATE_PLUGIN )
				);
				$plugin_meta[] = sprintf( "<a href='%s' target='_blank'>%s</a>",
					"https://gambit.ph/plugins?utm_source=" . urlencode( $pluginData['Name'] ) . "&utm_medium=plugin_link",
					__( "Get More Plugins", GAMBIT_TEMPLATE_PLUGIN )
				);
			}
			return $plugin_meta;
		}
		
		
		public function titanInstallNotice( $notice ) {
			return __( 'Hamburger Menu needs Titan Framework to be installed to work.', GAMBIT_HAMBURGER_PLUGIN );
		}
	
	
		public function titanActivateNotice( $notice ) {
			return __( 'Hamburger Menu needs Titan Framework to be activated to work.', GAMBIT_HAMBURGER_PLUGIN );
		}
	}
}

new GambitHamburgerMenu();