$(document).ready(function() {
    //Login form validation
    $('#loginFormId').validate({
        onfocusout: function (element) {
            this.element(element);
        },
        errorClass: 'error_validate',
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var placement = $(element).attr('name');
            if (placement) {
                $('.'+($(element).attr('name'))).closest('.form-input-login').find('.'+$(element).attr('name')+'-error').html(error.text())
            }
        },
        success: function (error) {
            error.remove();
        }
    });
});

$(document).on('click', '.login-form-submit', function () {
    var url = $(this).attr('data-url')
    console.log($('#loginFormId').valid());
    if ($('#loginFormId').valid()) {
        url = url,
        method = 'POST'
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            method: method,
            data: $('#loginFormId').serialize(),
            beforeSend: function() {
                $(".main-loader-page").fadeIn(300);
            },
            success: function(response) {
                if (response.status == 'error') {
                    $.each(response.errors, function(index, value) {
                        $('#loginModal').find('.' + index + '-error').html(value)
                        $('#loginModal').find('.' + index + '-error').show()
                    })
                } else if (response.status == 'success') {
                    // toastr.success(response.message, 'Success!', {
                    //     timeOut: '4000',
                    // })
                    $('#loginFormId')[0].reset();
                    setTimeout(function() {
                        $('.close').trigger('click');
                        location.href = response.url;
                    });
                    $('.error').html('');
                }
            },
            complete: function() {
                setTimeout(function() {
                    $('.main-loader-page').fadeOut(300)
                }, 700)
            },
            error: function(response) {
                var errorData = $.parseJSON(response.responseText);
                var errors = errorData.errors;
                if (ObjectLength(errors)) {
                    $.each(errors, function(index, value) {
                        $('#loginModal').find('.' + index + '-error').html(value)
                        $('#loginModal').find('.' + index + '-error').show()
                    });
                }
            }
        })
    }
});

$(document).on('click','.sign-in-close',function() {
    $('.close').trigger('click');
});

$(document).on('click','.sign-up',function() {
    $('.close').trigger('click');
});


  

$(document).on("focus","input",function() {
    $(this).closest(".form-group").find('.error').html(' ');
})