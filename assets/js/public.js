jQuery(document).ready(function ($) {
    $('#movie-filter').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: wpMovieList.ajax_url,
            type: 'POST',
            data: jQuery(this).serialize() + '&action=filter_movies',
            beforeComplete: function () {
                jQuery('.movie-grid').html('<div style="width:100%;font-size:100px;text-align:center">....</div>');
            },
            success: function (response) {
                jQuery('.movie-grid').html(response.data);
            }

        });
    });
});
