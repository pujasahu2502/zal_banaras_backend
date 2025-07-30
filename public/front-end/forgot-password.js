$(document).ready(function () {
    $('#passwordReset').validate({
        onfocusout: function (element) {
            this.element(element)
        },
        errorClass: 'error_validate',
        errorElement: 'label',
        errorPlacement: function(error, element) {
            var placement = $(element).attr('name');
            console.log( error.text());
            if (placement) {
                $('.'+($(element).attr('name'))).closest('.form-input-forgot').find('.'+$(element).attr('name')+'-error').html(error.text())
            }
        }
    });
    $(document).on('click', '.reset-password-send', function () {
        var url = $(this).attr('data-url')
        if ($('#passwordReset').valid()) {
            ;(url = url), (method = 'POST')
            $.ajax({
                url: url,
                method: method,
                data: $('#passwordReset').serialize(),
                beforeSend: function () {
                    $('.main-loader-page').fadeIn(300)
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if (response.status == 'error') {
                        $.each(response.errors, function (index, value) {
                            $('#forgotModal').find('.' + index + '-error').html(value)
                            $('#forgotModal').find('.' + index + '-error').show()
                        })
                    } else if (response.status == 'success') {
                        $('.close').trigger('click')
                        toastr.success(response.message, 'Success!', {
                            timeOut: '4000',
                        })
                        $('.error').html('')
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
                            $('#forgotModal').find('.' + index + '-error').html(value)
                            $('#forgotModal').find('.' + index + '-error').show()
                        })
                    }
                },
            })
        }
    })
})

$(document).on('click', '.sign-up', function () {
    $('.close').trigger('click')
})

$(document).on('click', '.forgot-password', function () {
    $('.close').trigger('click')
})

function ObjectLength(object) {
    var length = 0
    for (var key in object) {
        if (object.hasOwnProperty(key)) {
            ++length
        }
    }
    return length;
}