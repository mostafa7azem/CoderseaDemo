$('.ajax-form').submit(function (event) {
    event.preventDefault();
    let form       = $(this).context,
        inputs     = form.elements,
        successUrl = form.getAttribute('success-url'),
        data       = new FormData();
    for (let input of inputs) {
        if (!input.name) {
            continue;
        }
        if (input.type === 'radio' || input.type === 'checkbox') {
            if (input.checked) {
                data.append(input.name, input.value);
            }
        } else if (input.files) {
            for (let file of input.files) {
                data.append(input.name, file, file.name);
            }
        } else if (input.hasAttribute('multiple')) {
            $(input).find("option:selected").each((index, element) => {
                data.append(input.name, element.value);
            });
        } else {
            data.append(input.name, input.value);
        }
    }
    swal({
        title              : dashboard.ajaxForm.please_wait,
        type               : 'info',
        confirmButtonText  : dashboard.ajaxForm.ok,
        closeOnConfirm     : false,
        showLoaderOnConfirm: true
    }, function () {
    });
    clearErrors(form);
    $.ajax({
        url        : form.action,
        data       : data,
        processData: false,
        contentType: false,
        type       : form.method,
        success    : function (data) {
            swal({
                title            : dashboard.ajaxForm.success_message,
                type             : 'success',
                confirmButtonText: dashboard.ajaxForm.ok,
            }, function () {
                if (successUrl) {
                    window.location.href = successUrl;
                }
            });
        },
        error      : function (response) {
            response = response.responseJSON;
            if (!response || !response.message || !response.errors) {
                swal({
                    title            : dashboard.ajaxForm.error_message,
                    type             : 'error',
                    confirmButtonText: dashboard.ajaxForm.ok
                });
                return;
            }
            swal({
                title            : response.message,
                type             : 'error',
                confirmButtonText: dashboard.ajaxForm.ok
            });
            showErrors(form, inputs, response.errors);
        }
    });
    return false;
});

/**
 *
 * @param {HTMLFormElement} form
 * @param {HTMLFormControlsCollection} inputs
 * @param {Object} errors
 */
function showErrors(form, inputs, errors) {
    let hasFormHorizontal = $(form).hasClass('form-horizontal');
    for (let input of inputs) {
        let parent = $(input).parents('.form-group');
        if (!parent.length) {
            continue;
        }
        let inputErrorName = input.name.split(']').join('').split('[').join('.').replace(/\.+$/, '');
        let inputErrors = errors[inputErrorName];
        delete errors[inputErrorName];
        if (inputErrors) {
            parent.addClass('has-error');
            let appendElement = parent;
            if (hasFormHorizontal) {
                appendElement = appendElement.children().last();
            }
            appendElement.append('<span class="help-block">' + inputErrors[0] + '</span>')
        }
    }
    if (!Object.keys(errors).length) {
        return;
    }
    let errorDiv = $([
        '<div class="col-xs-12 form-error">',
        '   <div class="alert alert-danger">',
        '       <h5><strong>' + dashboard.ajaxForm.fix_message + '</strong></h5>',
        '       <ul class="error-list"></ul>',
        '   </div>',
        '</div>'
    ].join(''));
    let errorList = errorDiv.find('.error-list');
    for (let key in errors) {
        for (let error of errors[key]) {
            errorList.append('<li>' + error + '</li>')
        }
    }
    $(form).prepend(errorDiv);
}

/**
 * Clear form errors.
 *
 * @param {HTMLFormElement} form
 */
function clearErrors(form) {
    $(form).find('.form-error').remove();
    $(form).find('.form-group').removeClass('has-error');
    $(form).find('.help-block').remove();
}
