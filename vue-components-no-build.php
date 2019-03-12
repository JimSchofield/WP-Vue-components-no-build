<?php
/**
 * Plugin Name: Vue Components No Build
 * Description: Examples of implementing vue components in WordPress
 * Version: 1.0.0
 * Author: Jim Schofield
 * Text Domain: no_build_vue
 *
 * @package no_build_vue
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 
/**
 * Enqueue block JavaScript and CSS for the editor
 */
function no_build_vue_scripts() {
 
    //enqueue Vue
    wp_enqueue_script(
        'no_build_vue/vue',
        plugins_url( 'node_modules/vue/dist/vue.js', __FILE__ ),
        [ 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ],
        filemtime( plugin_dir_path( __FILE__ ) . 'node_modules/vue/dist/vue.js' ) 
    );

    // Register htm example
    wp_enqueue_script(
        'no_build_vue/main',
        plugins_url( 'main.js', __FILE__ ),
        [ 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ],
        filemtime( plugin_dir_path( __FILE__ ) . 'main.js' ) 
    );
 
    // Enqueue block styles
    wp_enqueue_style(
        'no_build_vue/stylesheet',
        plugins_url( 'style.css', __FILE__ ),
        [ 'wp-edit-blocks' ],
        filemtime( plugin_dir_path( __FILE__ ) . 'style.css' ) 
    );
 
}
// Hook the enqueue functions into the editor
add_action( 'wp_enqueue_scripts', 'no_build_vue_scripts' );


/**
 * enqueue other scripts as modules
 */
function add_module_attribute($tag, $handle, $src) {
    // add script handles to the array below if the enqueued script needs to be a module
    $script_modules = [ 'no_build_vue/thingy', 'no_build_vue/main' ];
    
    foreach($script_modules as $module) {

        error_log( '$tag = ' . print_r( $tag, true ) );

        if ($module === $handle) {
          return str_replace('type=\'text/javascript\'', 'type=\'module\'', $tag);
       }
    }
    return $tag;
 }
 add_filter('script_loader_tag', 'add_module_attribute', 10, 3);


function no_build_vue_module_scripts() {
    wp_enqueue_script(
        'no_build_vue/thingy',
        plugins_url( 'thingy.js', __FILE__ ),
        Array(),
        filemtime( plugin_dir_path( __FILE__ ) . 'thingy.js' ) 
    );
}

add_action('wp_enqueue_scripts', 'no_build_vue_module_scripts');
