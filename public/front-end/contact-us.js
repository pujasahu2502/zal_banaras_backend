/* ============== Add ContactUs Form ============== */
$('#contactUsForm').validate({
    rules: {
        mobile: {
            validIndNumber: true,
        },
    },
    onfocusout: function (element) {
        this.element(element)
    },
    errorClass: 'error_validate',
    errorElement: 'span',
})

$(document).on('click', '#save-contact', function () {
    var form_action = $('#contactUsForm').attr('action')
    if ($('#contactUsForm').valid()) {  //&& validationCapcha() == true
        ;(url = form_action), (method = 'POST')
        $.ajax({
            url: url,
            method: method,
            data: $('#contactUsForm').serialize(),
            beforeSend: function () {
                $('.main-loader-page').fadeIn(300)
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                if (response.status == 'success') {
                    $('#contactUsForm')[0].reset()
                    // grecaptcha.reset();
                    toastr.success(response.message, 'Success!', {
                        timeOut: '4000',
                    });
                    $('.error').html('');
                    // location.reload();
                }
                else if(response.status == 'error') {
                    $.each(response.error, function (index, value) {
                        $('.' + index + '-errors').html(value)
                        $('.' + index + '-errors').show()
                    })
                }
            },
            complete: function () {
                setTimeout(function () {
                    $('.main-loader-page').fadeOut(300)
                }, 700)
            },
            error: function(response) {
                if(response.responseJSON) {
                    $.each(response.responseJSON.errors,function (index, value) {
                        console.log(value);
                        $('.' + index + '-errors').html(value);
                    });
                }
            }
        })
    }
})

/* email Validation for 25 char */ 
$(document).on('keypress',".email",function(event){
    var name = $(this).val();
    if(name.length > 60){
        event.preventDefault();
        return false;
    }
});