<?php

/**
 * Create the rating & help notices
 *
 * To disable this, use the following line anywhere in the main script:
 * define( 'GAMBIT_DISABLE_RATING_NOTICE', 1 );
 **/

	
if ( ! class_exists( 'GambitRateNotice' ) ) {
	
	class GambitRateNotice {
		
		public $settings;


		/**
		 * Create the rating & help notices
		 *
		 * @return	void
		 * @since	2.0
		 **/
		function __construct( $settings ) {
			
			$defaults = array(
			    'file' => '', // __FILE__ of the calling main script
			    'class' => '', // __CLASS__ of the calling main script
				'help_message' => '', 
				'marketplace' => 'CodeCanyon',
				'marketplace_domain' => 'codecanyon.net',
				'rate_days' => 7,
			);
			$this->settings = array_merge( $defaults, $settings );
			
			if ( empty( $this->settings['file'] ) || empty( $this->settings['class'] ) ) {
				return;
			}

			if ( $this->isGlobalDisabled() ) {
				return;
			}

			// Display the help message on activation for a short period of time
			register_activation_hook( $this->settings['file'], array( $this, 'justActivatedDisplayHelp' ) );
			register_deactivation_hook( $this->settings['file'], array( $this, 'justActivatedDisplayHelp' ) );
			add_action( 'admin_notices', array( $this, 'displayHelp' ) );
			
			// Display the rating notice after a few days
			register_activation_hook( $this->settings['file'], array( $this, 'justActivatedRemindRate' ) );
			register_deactivation_hook( $this->settings['file'], array( $this, 'justDectivatedRemindRate' ) );
			add_action( 'admin_notices', array( $this, 'displayRateReminder' ) );
			
			// Rating notice button handlers
			add_action( 'wp_ajax_' . $this->settings['class'] . '-remind-stop', array( $this, 'ajaxRemindStop' ) );
			add_action( 'wp_ajax_' . $this->settings['class'] . '-remind-again', array( $this, 'ajaxRemindAgain' ) );
		}



		/**
		 * The checker whether or not to create rating notices
		 *
		 * @return	void
		 * @since	2.0
		 **/
		public function isGlobalDisabled() {
			return defined( 'GAMBIT_DISABLE_RATING_NOTICE' );
		}



		/**
		 * Create help transients
		 *
		 * @return	void
		 * @since	2.0
		 **/
		public function justActivatedDisplayHelp() {

			if ( $this->isGlobalDisabled() ) {
				return;
			}
			
			set_transient( $this->settings['class'] . '-activated-help', time(), MINUTE_IN_SECONDS * 1 );
		}



		/**
		 * Delete help transients
		 *
		 * @return	void
		 * @since	2.0
		 **/
		public function justDeactivatedDisplayHelp() {

			if ( $this->isGlobalDisabled() ) {
				return;
			}
			
			delete_transient( $this->settings['class'] . '-activated-help' );
		}
		

		/**
		 * Displays the notice that we have a support site and additional instructions
		 *
		 * @return	void
		 * @since	1.0
		 **/
		public function displayHelp() {

			if ( $this->isGlobalDisabled() ) {
				return;
			}
			
			if ( ! get_transient( $this->settings['class'] . '-activated-help' ) ) {
				return;
			}

			$pluginData = get_plugin_data( $this->settings['file'] );

			echo '<div class="updated" style="border-left-color: #3498db">
					<p>
						<img src="' . plugins_url( 'gambit-logo.png', $this->settings['file'] ) . '" style="display: block; margin-bottom: 10px"/>
						<strong>' . sprintf( __( 'Thank you for activating %s!', GAMBIT_TEMPLATE_PLUGIN ), $pluginData['Name'] ) . '</strong><br>' .

						$this->settings['help_message'] . '<br>' .

						__( 'If you need any support, you can leave us a ticket in our support site. The link to our support site is listed in the plugin details for future reference.', GAMBIT_TEMPLATE_PLUGIN ) . '<br>' .
						'<a href="http://support.gambit.ph?utm_source=' . urlencode( $pluginData['Name'] ) . '&utm_medium=activation_notice" class="gambit_ask_rate button button-default" style="margin: 10px 0;" target="_blank">' . __( 'Visit our support site', GAMBIT_TEMPLATE_PLUGIN ) . '</a>' .
						'<br>' .
						'<em style="color: #999">' . __( 'This notice will go away in a moment', GAMBIT_TEMPLATE_PLUGIN ) . '</em><br>
					</p>
				</div>';
		}



		/**
		 * Create reminder transients, but if we have rated/no-thanked before, don't create the transients
		 *
		 * @return	void
		 * @since	2.0
		 **/
		public function justActivatedRemindRate() {

			if ( $this->isGlobalDisabled() ) {
				return;
			}
			
			if ( get_option( $this->settings['class'] . '-activated-remind-done' ) ) {
				return;
			}
			
			delete_transient( $this->settings['class'] . '-activated-remind-rate' );
			set_transient( $this->settings['class'] . '-activated-remind-rate', time(), DAY_IN_SECONDS * $this->settings['rate_days'] );
		}



		/**
		 * Delete reminder transients
		 *
		 * @return	void
		 * @since	2.0
		 **/
		public function justDectivatedRemindRate() {

			if ( $this->isGlobalDisabled() ) {
				return;
			}
			
			delete_transient( $this->settings['class'] . '-activated-remind-rate' );
		}



		/**
		 * Displays the notice for reminding the user to rate our plugin
		 *
		 * @return	void
		 * @since	1.0
		 **/
		public function displayRateReminder() {

			if ( $this->isGlobalDisabled() ) {
				return;
			}
			
			// Don't ask if we already asked before, even after a deactivation
			if ( get_option( $this->settings['class'] . '-activated-remind-done' ) ) {
				return;
			}
			// Don't ask if we we're not within the lime limit yet
			if ( get_transient( $this->settings['class'] . '-activated-remind-rate' ) ) {
				return;
			}

			$pluginData = get_plugin_data( $this->settings['file'] );
			$nonce = wp_create_nonce( $this->settings['class'] );

			echo '<div class="updated gambit-ask-rating-' . $this->settings['class'] . '" style="border-left-color: #3498db">
					<p>
						<img src="' . plugins_url( 'gambit-logo.png', $this->settings['file'] ) . '" style="display: block; margin-bottom: 10px"/>
						<strong>' . sprintf( __( 'Enjoying %s?', GAMBIT_TEMPLATE_PLUGIN ), $pluginData['Name'] ) . '</strong><br>' .
						sprintf( __( 'Help us out by rating our plugin 5 stars in %s! This will allow us to create more awesome products and provide top notch customer support.', GAMBIT_TEMPLATE_PLUGIN ), $this->settings['marketplace'] ) . '<br>' .
						'<button data-href="http://' . $this->settings['marketplace_domain'] . '/downloads?utm_source=' . urlencode( $pluginData['Name'] ) . '&utm_medium=rate_notice" class="button button-primary" style="margin: 10px 10px 10px 0;">' . sprintf( __( 'Rate us 5 stars in %s :)', GAMBIT_TEMPLATE_PLUGIN ), $this->settings['marketplace'] ) . '</button>' .
						'<button class="button button-secondary remind" style="margin: 10px 10px 10px 0;">' . __( 'Remind me tomorrow', GAMBIT_TEMPLATE_PLUGIN ) . '</button>' .
						'<button class="button button-secondary nothanks" style="margin: 10px 0;">' . __( 'I&apos;ve already rated!', GAMBIT_TEMPLATE_PLUGIN ) . '</button>' .
						'<script>
						jQuery(document).ready(function($) {
							"use strict";

							$(".gambit-ask-rating-' . $this->settings['class'] . ' button").click(function() {
								if ( $(this).is(".button-primary") ) {
									var $this = $(this);

									var data = {
										"_nonce": "' . $nonce . '",
										"action": "' . $this->settings['class'] . '-remind-stop",
										"type": "remove"
									};

									$.post(ajaxurl, data, function(response) {
										$this.parents(".updated:eq(0)").fadeOut();
										window.open($this.attr("data-href"), "_blank");
									});

								} else if ( $(this).is(".remind") ) {
									var $this = $(this);

									var data = {
										"_nonce": "' . $nonce . '",
										"action": "' . $this->settings['class'] . '-remind-again",
										"type": "remind"
									};

									$.post(ajaxurl, data, function(response) {
										$this.parents(".updated:eq(0)").fadeOut();
									});

								} else if ( $(this).is(".nothanks") ) {
									var $this = $(this);

									var data = {
										"_nonce": "' . $nonce . '",
										"action": "' . $this->settings['class'] . '-remind-stop",
										"type": "remove"
									};

									$.post(ajaxurl, data, function(response) {
										$this.parents(".updated:eq(0)").fadeOut();
									});
								}
								return false;
							});
						});
						</script>
					</p>
				</div>';
		}



		/**
		 * Set the do-not-ask-ever-again flag when the no thanks or the rate button is clicked
		 *
		 * @return	void
		 * @since	2.0
		 **/
		public function ajaxRemindStop() {
			check_ajax_referer( $this->settings['class'], '_nonce' );

			update_option( $this->settings['class'] . '-activated-remind-done', time() );

			die();
		}



		/**
		 * Recreate the transient when the remind me later button is clicked
		 *
		 * @return	void
		 * @since	2.0
		 **/
		public function ajaxRemindAgain() {
			check_ajax_referer( $this->settings['class'], '_nonce' );

			set_transient( $this->settings['class'] . '-activated-remind-rate', time(), DAY_IN_SECONDS * $this->settings['rate_days'] );

			die();
		}
		
	}
	
}