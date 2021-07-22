<?php
/**
 * Plugin Name: Hello World React Plugin
 */

function helloworld_shortcode() {

	return '<div id="hello-world-react" ></div>';
}

add_shortcode('hello-world-react', 'helloworld_shortcode');

function helloworld_load_assets() {
	
	$react_app_js  = plugin_dir_url( __FILE__ ) . 'helloworldreactapp/build/static/js/all_in_one_file.js';
    $react_app_css = plugin_dir_url( __FILE__ ) . 'helloworldreactapp/build/static/css/all_in_one_file.css';	
      
    // time stops stylesheet/js caching while in development, might want to remove later  
    $version = time();	
    wp_enqueue_script( 'hello-world-react', $react_app_js, array(), $version, true );         
    wp_enqueue_style( 'hello-world-react', $react_app_css, array(), $version );
}

add_action( 'wp_enqueue_scripts', 'helloworld_load_assets' );