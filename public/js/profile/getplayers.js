$(document).on('click', '#pagination-container .pagination a', function(e) {
    e.preventDefault();

    var page = $(this).attr('href').split('page=')[1];

    $.ajax({
        url: '/profile/getplayers?page=' + page,
        success: function(data) {
            $('#pagination-container').html(data);
        }
    });
});
