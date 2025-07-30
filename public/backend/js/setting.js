$(document).on('click', '#admin-setting', function () {
    url = $(this).attr('data-url');
    $.ajax({
        url: url,
        method: 'get',
        beforeSend: function () {
            $('.loader').fadeIn(300)
        },
        success: function (response) {
            if (response.status == 'success') {
                id = '#adminSetting';
                modelRender(response.output, id);
                $('#admin-setting-form').validate({
                    onfocusout: function (element) {
                        this.element(element)
                    },
                    errorClass: 'error_validate',
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

$(document).ready(function () {
    $('#admin-setting-form').validate({
        onfocusout: function (element) {
            this.element(element)
        },
        errorClass: 'error_validate',
        errorElement: 'span',
    })

    $(document).on('click', '.admin-setting-update', function () {
        var form_action = $("#admin-setting-form").attr("action");
        if ($('#admin-setting-form').valid()) {
            $.ajax({
                url: form_action,
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: $('#admin-setting-form').serialize(),
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
                        $('#admin-setting-form')[0].reset();
                        $('.close').trigger('click')
                        toastr.success(response.message, 'Success!', {
                            timeOut: '4000',
                        })
                        $('.error').html('');
                    }
                },
                complete: function () {
                    setTimeout(function () {
                        $('.loader').fadeOut(300)
                    }, 700)
                },
                error: function(response) {
                    if(response.responseJSON) {
                        $.each(response.responseJSON.errors,function (index, value) {
                            $('.' + index + '-error').html(value);
                        });
                    }
                }
            });
        }
    })
})