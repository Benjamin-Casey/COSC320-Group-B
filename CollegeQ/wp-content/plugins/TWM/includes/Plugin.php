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
 * @subpackage Plugin
 */
class Plugin {

	/**
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 * 
	 * @var      string
	 */
	protected $plugin_slug = 'TWM';

	/**
	 * Instance of this class.
	 * 
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Setup instance attributes
	 */
	private function __construct() {
		$this->plugin_version = TWM_VERSION;
	}

	/**
	 * Return the plugin slug.
	 * 
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return the plugin version.
	 * 
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_version() {
		return $this->plugin_version;
	}

	/**
	 * Fired when the plugin is activated.
	 */
	public static function activate() {
		add_option( 'twm_example_setting' );
	}

	/**
	 * Fired when the plugin is deactivated.
	 */
	public static function deactivate() {
	}


	/**
	 * Return an instance of this class.
	 * 
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
}
