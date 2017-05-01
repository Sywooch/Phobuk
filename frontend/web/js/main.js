/**
 * Created by ewa on 05.04.17.
 */

$(document).on('click', '#create-new-post-btn', function () {
    $.ajax({
        url: "/post/create",
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#modal-placeholder').html(data);
            $('#create-post-modal').modal('toggle');
        }
    });
    return false;
});

$(document).on('click', '#create-new-photo-btn', function () {
    $.ajax({
        url: "/photo/create",
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#modal-placeholder').html(data);
            $('#create-photo-modal').modal('toggle');
        }
    });
    return false;
});
