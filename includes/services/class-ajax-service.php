<?php

namespace WPMovieList\Services;

class AjaxService {
    public function Webilia_register() {
        add_action('wp_ajax_filter_movies', [$this, 'Webilia_filter_movies']);
        add_action('wp_ajax_nopriv_filter_movies', [$this, 'Webilia_filter_movies']);
    }

    public function Webilia_filter_movies() {
        $genre = isset($_POST['genre']) ? sanitize_text_field($_POST['genre']) : '';
        $artists = isset($_POST['artists']) ? array_map('sanitize_text_field', $_POST['artists']) : [];

        $query_args = [
            'post_type' => 'movie',
            'posts_per_page' => 6,
        ];

        if (!empty($genre)) {
            $query_args['tax_query'][] = [
                'taxonomy' => 'genre',
                'field'    => 'term_id',
                'terms'    => $genre,
            ];
        }

        if (!empty($artists)) {
            $query_args['tax_query'][] = [
                'taxonomy' => 'artist',
                'field'    => 'term_id',
                'terms'    => $artists,
            ];
        }

        $query = new \WP_Query($query_args);

        if ($query->have_posts()) :
            ob_start();
            while ($query->have_posts()) : $query->the_post();
                ?>
                <div class="movie-item">
                    <?php the_post_thumbnail(); ?>
                    <h2><?php the_title(); ?></h2>
                    <div><?php the_excerpt(); ?></div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            $output = ob_get_clean();
        else :
            $output = '<p>No movies found.</p>';
        endif;

        wp_send_json_success($output);
    }
}
