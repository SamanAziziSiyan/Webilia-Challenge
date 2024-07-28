<?php
/**
 * Plugin Name:       WP Movie List
 * Plugin URI:        https://example.com
 * Description:       A plugin to manage and display movies.
 * Version:           1.0.0
 * Author:            Saman Azizi
 * Author URI:        https://example.com
 * Text Domain:       wp-movie-list
 * Domain Path:       /languages
 */

if (!defined('WPINC')) {
    die;
}

// Autoload Composer dependencies
require plugin_dir_path(__FILE__) . 'vendor/autoload.php';

// Include the core plugin class
require plugin_dir_path(__FILE__) . 'includes/class-wp-movie-list.php';

// Run the plugin
function run_wp_movie_list() {
    $plugin = new WPMovieList\WPMovieList();
    $plugin->Webilia_run();
}
run_wp_movie_list();


register_activation_hook(__FILE__, 'wp_movie_list_activate');

function wp_movie_list_activate() {
    $plugin = new WPMovieList\WPMovieList();
    $plugin->Webilia_create_challenge_page();
}