$(document).ready(function () {
    $(document).on('click', '[delete-url]', function () {
        let deleteUrl = $(this).attr('delete-url');
        let modelName = $(this).attr('model-name');

        swal({
            title: "Are you sure?",
            //text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: 'Delete',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function (result) {
            if(!result){
                return;
            }
            $.ajax({
                method: "POST",
                url: deleteUrl,
                data: {
                    '_method': 'delete'
                },
                success: function (data) {
                    swal({title: data, text: '', type: "success"}, function () {
                        location.reload();
                    });
                },
                error: function (data) {
                    var message = '';
                    if (typeof(data) == 'object'){
                        if (typeof(data.responseJSON) == 'object'){
                            message = data.responseJSON.message;
                        } else {
                            message = data.responseJSON;
                        }

                    } else {
                        message = data;
                    }
                    swal(message, "" , "error");
                }
            });
        });
    });

    $(document).on('switchChange.bootstrapSwitch', '[active-url]', function (event, state) {
        let $bootstrapSwitch =$(this);
        let activeUrl = $bootstrapSwitch.attr('active-url');
        let modelName = $bootstrapSwitch.attr('model-name');
        swal({
            title: "Are you sure?",
            //text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: state ? 'Activate' : 'Deactivate',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function (result) {
            if(!result){
                $bootstrapSwitch.bootstrapSwitch('state', !state, true);
                return;
            }
            $.ajax({
                method: "POST",
                url: activeUrl,
                data: {
                    'is_active': state ? 1 : 0
                },
                success: function (data) {
                    swal({
                        title: `${modelName} ${state ? 'Activated' : 'Deactivated'} successfully`,
                        text: '',
                        type: "success"
                    }, function () {
                        //location.reload();
                    });
                },
                error: function (data) {
                    swal("Error!", 'Error while deactivating ' + modelName, "error");
                    $bootstrapSwitch.bootstrapSwitch('state', !state, true);
                }
            });
        });
    });

    $(".lang_translate").change(function () {
        var lang_code = $(this).val();
        var url = $(this).attr("trans_url");
        if (lang_code == 'en')
            return;
        location.href = url + (url.includes("?")?"&":"?")+'lang=' + lang_code;
    });
});
