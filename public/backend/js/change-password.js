/* ========== ADD CHANGE PASSWORD MODAL ========== */
$(document).on('click', '#change-password', function () {
    url = $(this).attr('data-url');
    $.ajax({
        url: url,
        method: 'get',
        beforeSend: function () {
            $('.loader').fadeIn(300)
        },
        success: function (response) {
            if (response.status == 'success') {
                id = '#changePassword';
                modelRender(response.output, id);

                $('#change-password-form').validate({
                    onfocusout: function (element) {
                        this.element(element)
                    },
                    // errorClass: 'error_validate',
                    errorElement: 'span',
                })
            }
        },
        complete: function () {
            setTimeout(function () {
                $('.loader').fadeOut(300)
            }, 700)
        },
    })
})

/* ========== UPDATE CHANGE PASSWORD MODAL ========== */
$(document).ready(function () {
    $(document).on('click', '.change-password-update', function () {
        var form_action = $("#change-password-form").attr("action");
        if ($('#change-password-form').valid()) {
            $.ajax({
                url: form_action,
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: $('#change-password-form').serialize(),
                beforeSend: function () {
                    $('.loader').fadeIn(300)
                },
                success: function (response) {
                    if (response.status == 'error') {
                        $.each(response.error, function (index, value) {
                            $('.' + index + '-error').html(value)
                            $('.' + index + '-error').show()
                        })
                    } else if (response.status == 'success') {
                        $('#change-password-form')[0].reset();
                        $('.close').trigger('click')
                        toastr.success(response.message, 'Success!', {
                            timeOut: '4000',
                        })
                        $('.error').html('')
                    }
                },
                complete: function () {
                    setTimeout(function () {
                        $('.loader').fadeOut(300)
                    }, 700)
                },
            })
        }
    })
})