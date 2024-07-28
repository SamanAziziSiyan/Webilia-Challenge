<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <div class="single-movie">
            <h1><?php the_title(); ?></h1>
            <div class="movie-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div>
            <div class="movie-content">
                <?php the_content(); ?>
            </div>
            <div class="movie-meta">
                <p><strong>Genre:</strong> <?php echo get_the_term_list(get_the_ID(), 'genre', '', ', '); ?></p>
                <p><strong>Artists:</strong> <?php echo get_the_term_list(get_the_ID(), 'artist', '', ', '); ?></p>
            </div>
        </div>
    <?php endwhile;
endif;

get_footer();
?>
