<?php

namespace WPMovieList\Services;

class TaxonomyService {

    public function Webilia_register() {
        add_action('init', array($this, 'Webilia_register_taxonomies'));
    }

    public function Webilia_register_taxonomies() {
        $labels = array(
            'name'              => _x('Genres', 'taxonomy general name', 'wp-movie-list'),
            'singular_name'     => _x('Genre', 'taxonomy singular name', 'wp-movie-list'),
            'search_items'      => __('Search Genres', 'wp-movie-list'),
            'all_items'         => __('All Genres', 'wp-movie-list'),
            'parent_item'       => __('Parent Genre', 'wp-movie-list'),
            'parent_item_colon' => __('Parent Genre:', 'wp-movie-list'),
            'edit_item'         => __('Edit Genre', 'wp-movie-list'),
            'update_item'       => __('Update Genre', 'wp-movie-list'),
            'add_new_item'      => __('Add New Genre', 'wp-movie-list'),
            'new_item_name'     => __('New Genre Name', 'wp-movie-list'),
            'menu_name'         => __('Genre', 'wp-movie-list'),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'genre'),
        );

        register_taxonomy('genre', array('movie'), $args);

        $labels = array(
            'name'              => _x('Artists', 'taxonomy general name', 'wp-movie-list'),
            'singular_name'     => _x('Artist', 'taxonomy singular name', 'wp-movie-list'),
            'search_items'      => __('Search Artists', 'wp-movie-list'),
            'all_items'         => __('All Artists', 'wp-movie-list'),
            'parent_item'       => __('Parent Artist', 'wp-movie-list'),
            'parent_item_colon' => __('Parent Artist:', 'wp-movie-list'),
            'edit_item'         => __('Edit Artist', 'wp-movie-list'),
            'update_item'       => __('Update Artist', 'wp-movie-list'),
            'add_new_item'      => __('Add New Artist', 'wp-movie-list'),
            'new_item_name'     => __('New Artist Name', 'wp-movie-list'),
            'menu_name'         => __('Artist', 'wp-movie-list'),
        );

        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'has_archive'        => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'artist'),
        );

        register_taxonomy('artist', array('movie'), $args);
    }
}
