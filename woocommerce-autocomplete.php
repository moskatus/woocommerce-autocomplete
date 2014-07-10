<?php
/*
Plugin Name: WooCommerce Autocomplete
Plugin URI: http://www.moskatus.com.br/
Description: WooCommerce Autocomplete
Author: Moskatus
Author URI: http://www.moskatus.com.br
Version: 1.0.0

*/

/**
 * Check if WooCommerce is active
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
	if ( ! class_exists( 'WC_Complete' ) ) {
		
		/**
		 * Localisation
		 **/
		load_plugin_textdomain( 'wc_complete', false, dirname( plugin_basename( __FILE__ ) ) . '/' );

		class WC_Complete {
			public function __construct() {
				// called only after woocommerce has finished loading
				add_action( 'woocommerce_init', array( &$this, 'woocommerce_loaded' ) );
				
				// called after all plugins have loaded
				add_action( 'plugins_loaded', array( &$this, 'plugins_loaded' ) );
				
				
                                // Load public-facing style sheet and JavaScript.
                                add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
                                add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
 
				// indicates we are running the admin
				if ( is_admin() ) {
					// ...
				}
				
				// indicates we are being served over ssl
				if ( is_ssl() ) {
					// ...
				}
    
				// take care of anything else that needs to be done immediately upon plugin instantiation, here in the constructor
			}
			
			/**
			 * Take care of anything that needs woocommerce to be loaded.  
			 * For instance, if you need access to the $woocommerce global
			 */
			public function woocommerce_loaded() {
				// ...
			}
			
			/**
			 * Take care of anything that needs all plugins to be loaded
			 */
			public function plugins_loaded() {
				// ...
			}
			
			
                        public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'assets/css/autocomplete.css', __FILE__ ), array() );
		wp_enqueue_style( $this->plugin_slug . '-plugin-styles2', plugins_url( 'assets/css/jquery.coolautosuggest.css', __FILE__ ), array() );

                }

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
                wp_enqueue_script( $this->plugin_slug . '-plugin-script2', plugins_url( 'assets/js/jquery.coolautosuggest.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'assets/js/autocomplete.js', __FILE__ ), array( 'jquery' ) );
                        
        
        }       

		}

		// finally instantiate our plugin class and add it to the set of globals
		$GLOBALS['wc_complete'] = new WC_Complete();
	}
}
