<?php

namespace WPMovieList\Admin;

class AdminService {

    public function Webilia_register() {
        add_action('admin_enqueue_scripts', array($this, 'Webilia_enqueue_styles'));
        add_action('admin_enqueue_scripts', array($this, 'Webilia_enqueue_scripts'));
    }

    public function Webilia_enqueue_styles() {
        wp_enqueue_style('wp-movie-list-admin', plugin_dir_url(__FILE__) . 'css/admin.css', array(), '1.0.0', 'all');
    }

    public function Webilia_enqueue_scripts() {
        wp_enqueue_script('wp-movie-list-admin', plugin_dir_url(__FILE__) . 'js/admin.js', array('jquery'), '1.0.0', true);
    }
}
