<?php
/**
 * Plugin Name: WooCommerce Autocomplete
 * Plugin URI: http://www.moskatus.com.br/
 * Description: WooCommerce Autocomplete
 * Author: Moskatus
 * Author URI: http://www.moskatus.com.br
 * Version: 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Prevent direct access.
}

if ( ! class_exists( 'WC_Complete' ) ) :

class WC_Complete {

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	const VERSION = '1.0.0';

	/**
	 * Instance of this class.
	 *
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin actions
	 */
	private function __construct() {
		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Check if WooCommerce is activated
		if ( class_exists( 'WooCommerce' ) ) {

			// Load public-facing style sheet and JavaScript.
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
		}
	}

	/**
	 * Return an instance of this class.
	 *
	 * @return object A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @return void
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'wc_complete', false, dirname( plugin_basename( __FILE__ ) ) . '/' );
	}

	/**
	 * Plugin scripts.
	 *
	 * @return void
	 */
	public function scripts() {
		// Styles.
		wp_enqueue_style( 'wc-complete-plugin-styles', plugins_url( 'assets/css/autocomplete.css', __FILE__ ), array() );
		wp_enqueue_style( 'wc-complete-plugin-styles2', plugins_url( 'assets/css/jquery.coolautosuggest.css', __FILE__ ), array() );

		// Scripts
		wp_enqueue_script( 'wc-complete-plugin-script2', plugins_url( 'assets/js/jquery.coolautosuggest.js', __FILE__ ), array( 'jquery' ), self::VERSION, true );
		wp_enqueue_script( 'wc-complete-plugin-script', plugins_url( 'assets/js/autocomplete.js', __FILE__ ), array( 'jquery' ), self::VERSION, true );
	}
}

add_action( 'plugins_loaded', array( 'WC_Complete', 'get_instance' ), 0 );

endif;
