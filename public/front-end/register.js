$('#registerForm').validate({
    onfocusout: function (element) {
        this.element(element);
    },
    errorClass: 'error_validate',
    errorElement: 'span',
    errorPlacement: function(error, element) {
        var placement = $(element).attr('name');
        if (placement) {
            $('.'+($(element).attr('name'))).closest('.form-input-register').find('.'+$(element).attr('name')+'-error').html(error.text())
        }
    },
    success: function (error) {
        error.remove();
    }
})

$(document).on('click', '.register-form', function () {
    var url = $(this).attr('data-url')
    if ($('#registerForm').valid()) {
        ;(url = url), (method = 'POST')
        $.ajax({
            url: url,
            method: method,
            data: $('#registerForm').serialize(),
            beforeSend: function () {
                $('.main-loader-page').fadeIn(300)
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                if (response.status == 'error') {
                    $.each(response.errors, function (index, value) {
                        $('#registerModal').find('.' + index + '-error').html(value)
                        $('#registerModal').find('.' + index + '-error').show()
                    })
                } else {
                    toastr.success(response.message, 'Success!', {
                        timeOut: '4000',
                    })
                    $('.close').trigger('click');
                    // setTimeout(function () {
                    //     location.reload();
                    // }, 700)
                    
                    location.href = response.url;
                    $('.error').html('');
                }
            },
            complete: function () {
                setTimeout(function () {
                    $('.main-loader-page').fadeOut(300)
                }, 700)
            },
            error: function (response) {
                var errorData = $.parseJSON(response.responseText)
                var errors = errorData.errors
                if (ObjectLength(errors)) {
                    $.each(errors, function (index, value) {
                        $('#registerModal').find('.' + index + '-error').html(value)
                        $('#registerModal').find('.' + index + '-error').show()
                    })
                }
            },
        })
    }
})

$(document).on('click', '.sign-in', function () {
    $('.close').trigger('click')
})