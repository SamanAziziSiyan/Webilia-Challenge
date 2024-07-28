<?php

namespace WPMovieList\Frontend;

class PublicService {

    public function Webilia_register() {
        add_action('wp_enqueue_scripts', array($this, 'Webilia_enqueue_styles'));
        add_action('wp_enqueue_scripts', array($this, 'Webilia_enqueue_scripts'));
    }

    public function Webilia_enqueue_styles() {
        wp_enqueue_style('wp-movie-list', plugin_dir_url(__FILE__) . '../../assets/css/style.css', array(), '1.0.0', 'all');
    }

    public function Webilia_enqueue_scripts() {
        wp_enqueue_script('wp-movie-list', plugin_dir_url(__FILE__) . '../../assets/js/public.js', array('jquery'), '1.0.0', true);
        wp_localize_script('wp-movie-list', 'wpMovieList', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));
    }
}
