<?php

namespace WPMovieList\Services;

class ShortcodeService {
    public function Webilia_register() {
        add_shortcode('movies', [$this, 'Webilia_display_movies']);
    }

    public function Webilia_display_movies($atts) {
        $atts = shortcode_atts([
            'genre' => '',
            'artists' => '',
            'paged' => 1
        ], $atts, 'movies');
    
        if (get_query_var('paged')) {
            $atts['paged'] = get_query_var('paged');
        } elseif (isset($atts['paged'])) {
            $atts['paged'] = $atts['paged'];
        } else {
            $atts['paged'] = 1;
        }
    
        ob_start();
        ?>
        <form id="movie-filter" method="post" action="">
            <select name="genre">
                <option value="">ژانر</option>
                <?php $genres = get_terms(['taxonomy' => 'genre', 'hide_empty' => false]); ?>
                <?php foreach ($genres as $genre) : ?>
                    <option value="<?php echo $genre->term_id; ?>"><?php echo $genre->name; ?></option>
                <?php endforeach; ?>
            </select>
            <select name="artists[]" multiple>
                <option value="">آرتیست</option>
                <?php $artists = get_terms(['taxonomy' => 'artist', 'hide_empty' => false]); ?>
                <?php foreach ($artists as $artist) : ?>
                    <option value="<?php echo $artist->term_id; ?>"><?php echo $artist->name; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">فیلتر فیلم‌ها</button>
        </form>
        <div id="movie-grids">
            <?php
            $query_args = [
                'post_type' => 'movie',
                'posts_per_page' => 6,
                'paged' => $atts['paged'],
            ];
    
            if (!empty($atts['genre'])) {
                $query_args['tax_query'][] = [
                    'taxonomy' => 'genre',
                    'field'    => 'term_id',
                    'terms'    => explode(',', $atts['genre']),
                ];
            }
    
            if (!empty($atts['artists'])) {
                $query_args['tax_query'][] = [
                    'taxonomy' => 'artist',
                    'field'    => 'term_id',
                    'terms'    => explode(',', $atts['artists']),
                ];
            }
    
            $query = new \WP_Query($query_args);
    
            if ($query->have_posts()) :
                echo '<div class="movie-grid">';
                while ($query->have_posts()) : $query->the_post();
                    ?>
                    <div class="movie-item">
                        <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(); ?>
                        <h2><?php the_title(); ?></h2>
                        <div><?php the_excerpt(); ?></div>
                    </a>
                    </div>
                    <?php
                endwhile;
                echo '</div>';
                
                $total_pages = $query->max_num_pages;
    
                if ($total_pages > 1) {
                    $current_page = max(1, get_query_var('paged'));
    
                    echo '<div class="pagination">';
                    echo paginate_links(array(
                        'base' => get_pagenum_link(1) . '%_%',
                        'format' => 'page/%#%',
                        'current' => $current_page,
                        'total' => $total_pages,
                        'prev_text' => __('« قبلی'),
                        'next_text' => __('بعدی »'),
                    ));
                    echo '</div>';
                }
    
                wp_reset_postdata();
            else :
                echo '<p>هیچ فیلمی یافت نشد.</p>';
            endif;
            ?>
        </div>
        <?php
        return ob_get_clean();
    }
    
}
