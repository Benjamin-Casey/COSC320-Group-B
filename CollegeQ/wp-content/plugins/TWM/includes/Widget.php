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
 * @subpackage Widget
 */
class Widget extends \WP_Widget {

	/**
	 * Initialize the widget
	 */
	public function __construct() {
		$plugin = Plugin::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();
		$this->version = $plugin->get_plugin_version();

		$widget_ops = array(
			'description' => esc_html__( 'Tree Water Monitor Widget.', $this->plugin_slug ),
		);

		parent::__construct( 'twm-widget', esc_html__( 'Tree Water Monitor', $this->plugin_slug ), $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 * 
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		wp_enqueue_script( $this->plugin_slug . '-widget-script', plugins_url( 'dist/js/widget.js', dirname( __FILE__ ) ), array( 'jquery' ), $this->version );
		wp_enqueue_style( $this->plugin_slug . '-widget-style', plugins_url( 'dist/css/widget.css', dirname( __FILE__ ) ), $this->version );

		$object_name = 'wpr_object_' . uniqid();

		$object = array(
			'title'       => $instance['title'],
			'api_nonce'   => wp_create_nonce( 'wp_rest' ),
			'api_url'	  => rest_url( $this->plugin_slug . '/v1/' ),
		);

		wp_localize_script( $this->plugin_slug . '-widget-script', $object_name, $object );

		echo $args['before_widget'];

		?><div class="twm-widget" data-object-id="<?php echo $object_name ?>"></div><?php

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance
	 * @return string|void
	 */
	public function form( $instance ) {
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php esc_html_e( 'Title:', 'TWM' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		return $instance;
	}
}
