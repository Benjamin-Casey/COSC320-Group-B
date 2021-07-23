<?php
/**
 * Tree Water Monitor Plugin
 * 
 * @package   TWM
 * @author    ICT International / University of New England
 * @license   GPL-3.0
 * @link      http://www.ictinternational.com.au
 * @since     1.0.0
 *
 */

namespace CollegeQ\TWM;

/**
 * @since 1.0.0
 * @package TWM
 * @subpackage Shortcode
 */
class Shortcode {

	/**
	 * Instance of this class.
	 * 
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Return an instance of this class.
	 * 
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
			self::$instance->do_hooks();
		}

		return self::$instance;
	}

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 */
	private function __construct() {
		$plugin = Plugin::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();
		$this->version = $plugin->get_plugin_version();

		add_shortcode( 'tree-water-monitor', array( $this, 'shortcode' ) );
	}


	/**
	 * Handle WP actions and filters.
	 */
	private function do_hooks() {
		add_action( 'wp_enqueue_scripts', array( $this, 'register_frontend_scripts' ) );
	}

	/**
	 * Register frontend-specific javascript
	 */
	public function register_frontend_scripts() {
		wp_register_script( $this->plugin_slug . '-shortcode-script', plugins_url( 'dist/js/shortcode.js', dirname( __FILE__ ) ), array( 'jquery' ), $this->version );
		wp_register_style( $this->plugin_slug . '-shortcode-style', plugins_url( 'dist/css/shortcode.css', dirname( __FILE__ ) ), $this->version );
	}

	public function shortcode( $atts ) {
		wp_enqueue_script( $this->plugin_slug . '-shortcode-script' );
		wp_enqueue_style( $this->plugin_slug . '-shortcode-style' );

		$object_name = 'twm_object_' . uniqid();

		$object = shortcode_atts( array(
			'title'       => 'Tree Water Monitor',
			'api_nonce'   => wp_create_nonce( 'wp_rest' ),
			'api_url'	  => rest_url( $this->plugin_slug . '/v1/' ),
		), $atts, 'twm' );

		wp_localize_script( $this->plugin_slug . '-shortcode-script', $object_name, $object );

		$shortcode = '<div class="twm-shortcode" data-object-id="' . $object_name . '"></div>';
		return $shortcode;
	}
}
