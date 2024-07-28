<?php

namespace WPMovieList\Services;

class TemplateLoader {
    public function Webilia_register() {
        add_filter('template_include', [$this, 'Webilia_load_movie_template']);
    }

    public function Webilia_load_movie_template($template) {
        if (is_singular('movie')) {
            $plugin_template = plugin_dir_path(__FILE__) . '../templates/single-movie.php';
            if (file_exists($plugin_template)) {
                return $plugin_template;
            }
        }
        return $template;
    }
}
