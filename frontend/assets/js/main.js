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

$(document).on('click', '#create-new-gallery-btn', function () {
    $.ajax({
        url: "/gallery/create",
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#modal-placeholder').html(data);
            $('#create-gallery-modal').modal('toggle');
        }
    });
    return false;
});

$(document).on('click', '#create-new-event-btn', function () {
    $.ajax({
        url: "/event/create",
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#modal-placeholder').html(data);
            $('#create-event-modal').modal('toggle');
        }
    });
    return false;
});

$('#menu-toggle').click(function () {

    if ($(this).hasClass('open')) {
        $(this).removeClass('open');
    } else {
        $(this).addClass('open');
    }

    var leftMenu = $('#left-menu');
    if (leftMenu.hasClass('open')) {
        leftMenu.removeClass('open');
    } else {
        leftMenu.addClass('open');
    }
});


function onToggle(element) {
    $(element).parent().toggleClass('expanded');
}




