<?php
/**
 * Tree Water Monitor Plugin Bootstrap File
 * 
 * @package   TWM
 * @author    ICT International / University of New England
 * @license   GPL-3.0
 * @link      http://www.ictinternational.com.au
 * @since     1.0.0
 *
 *
 * @wordpress-plugin
 * Plugin Name:       Tree Water Monitor
 * Plugin URI:        https://github.com/Benjamin-Casey/COSC320-Group-B
 * Description:       A WordPress plugin to allow access to data and statistics 
 *                    relating to the monitoring of tree water usage.
 * Version:           1.0.0
 * Author:            ICT International / University of New England
 * Author URI:        http://www.ictinternational.com.au
 * License:           GPL-3.0
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       TWM
 * Domain Path:       /languages
 */


namespace CollegeQ\TWM;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'TWM_VERSION', '1.0.0' );


/**
 * Autoloader
 *
 * @param string $class The fully-qualified class name.
 * @return void
 *
 *  * @since 1.0.0
 */
spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = __NAMESPACE__;

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/includes/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

/**
 * Initialize Plugin
 *
 * @since 1.0.0
 */
function init() {
	$twm = Plugin::get_instance();
	$twm_shortcode = Shortcode::get_instance();
	$twm_admin = Admin::get_instance();
	$twm_rest = Endpoint\Example::get_instance();
}
add_action( 'plugins_loaded', 'CollegeQ\\TWM\\init' );



/**
 * Register the widget
 *
 * @since 1.0.0
 */
function widget_init() {
	return register_widget( new Widget );
}
add_action( 'widgets_init', 'CollegeQ\\TWM\\widget_init' );

/**
 * Register activation and deactivation hooks
 */
register_activation_hook( __FILE__, array( 'CollegeQ\\TWM\\Plugin', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'CollegeQ\\TWM\\Plugin', 'deactivate' ) );

