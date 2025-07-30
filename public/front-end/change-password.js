$(document).ready(function () {
    $('#change-password-form').validate({
        onfocusout: function (element) {
            this.element(element)
        },
        errorClass: 'error_validate',
        errorElement: 'lable',
    })

    $(document).on('click', '.change-password-update', function () {
        url = $(this).attr('data-url')
        if ($('#change-password-form').valid()) {
            $.ajax({
                url: url,
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: $('#change-password-form').serialize(),
                beforeSend: function () {
                    $('.main-loader-page').fadeIn(300)
                },
                success: function (response) {
                    console.log(response)
                    if (response.status == 'error') {
                        $.each(response.error, function (index, value) {
                            console.log(index)
                            $('.' + index + '-error').html(value)
                            $('.' + index + '-error').show()
                        })
                    } else if (response.status == 'success') {
                        $('#change-password-form')[0].reset()
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
            })
        }
    })
})