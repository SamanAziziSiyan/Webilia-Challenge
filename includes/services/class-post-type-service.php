<?php

namespace WPMovieList\Services;

class PostTypeService {

    public function Webilia_register() {
        add_action('init', array($this, 'Webilia_register_post_type'));
    }

    public function Webilia_register_post_type() {
        $labels = array(
            'name'               => _x('Movies', 'post type general name', 'wp-movie-list'),
            'singular_name'      => _x('Movie', 'post type singular name', 'wp-movie-list'),
            'menu_name'          => _x('Movies', 'admin menu', 'wp-movie-list'),
            'name_admin_bar'     => _x('Movie', 'add new on admin bar', 'wp-movie-list'),
            'add_new'            => _x('Add New', 'movie', 'wp-movie-list'),
            'add_new_item'       => __('Add New Movie', 'wp-movie-list'),
            'new_item'           => __('New Movie', 'wp-movie-list'),
            'edit_item'          => __('Edit Movie', 'wp-movie-list'),
            'view_item'          => __('View Movie', 'wp-movie-list'),
            'all_items'          => __('All Movies', 'wp-movie-list'),
            'search_items'       => __('Search Movies', 'wp-movie-list'),
            'parent_item_colon'  => __('Parent Movies:', 'wp-movie-list'),
            'not_found'          => __('No movies found.', 'wp-movie-list'),
            'not_found_in_trash' => __('No movies found in Trash.', 'wp-movie-list')
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'movie'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array('title', 'editor', 'thumbnail'),
        );

        register_post_type('movie', $args);
    }
}
