<?php

namespace WPMovieList\Services;

class i18n {

    public function Webilia_load_plugin_textdomain() {
        load_plugin_textdomain('wp-movie-list', false, dirname(plugin_basename(__FILE__)) . '/../languages');
    }
}
