$.ajaxSetup({
    headers   : {
        'X-CSRF-TOKEN': window.laravel.csrf
    },
    beforeSend: function () {
        App.blockUI({
            boxed: true
        });
    },
    complete  : function () {
        App.unblockUI();
    }
});

initSummernote($('.summernote'));

function initSummernote(tag) {
    tag.summernote({
        minHeight: 200,
        callbacks: {
            onMediaDelete: function (image) {
                deleteImage(image[0], $(this));
            },
            onImageUpload: function (image) {
                uploadImage(image[0], $(this));
            }
        }
    });
}

$('.summernote-d').each(function () {
    $(this).summernote('disable');
});

function uploadImage(image, $summernote) {
    var data = new FormData();
    data.append("uploadedFile", image);
    data.append("_token", window.laravel.csrf);
    $.ajax({
        url        : window.laravel.url + '/api/files/upload',
        cache      : false,
        contentType: false,
        processData: false,
        data       : data,
        type       : "post",
        success    : function (data) {
            var image = $('<img>').attr('src', data.url);
            image.attr('image-id', data.id);
            $summernote.summernote("insertNode", image[0]);
        },
        error      : function (data) {
            console.error(data);
        }
    });
}

/**
 *
 * @param image
 * @param $summernote
 */
function deleteImage(image, $summernote) {
    if (!image.getAttribute('image-id')) {
        return;
    }
    var data = new FormData();
    data.append("id", image.getAttribute('image-id'));
    data.append("_token", window.laravel.csrf);
    $.ajax({
        url        : window.laravel.url + '/api/files/delete',
        cache      : false,
        contentType: false,
        processData: false,
        data       : data,
        type       : "post",
        success    : function (data) {
        },
        error      : function (data) {
            console.error(data);
        }
    });
}
