/* =============== Add subscription Form =============== */
$('#subscriptionForm').validate({
    onfocusout: function (element) {
        this.element(element)
    },
    errorClass: 'error_validate',
    errorElement: 'span',
})
$(document).on('click', '#subscription-store', function () {
    var url = $(this).attr('data-url');
    if ($('#subscriptionForm').valid()) {
        method = 'POST';
        $.ajax({
            url: url,
            method: method,
            data: $('#subscriptionForm').serialize(),
            beforeSend: function () {
                $('.main-loader-page').fadeIn(300)
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                if (response.status == 'success') {
                    $('.error').html(' ');
                    $('#subscriptionForm')[0].reset()
                    toastr.success(response.message, 'Success!', {
                        timeOut: '4000',
                    })
                    $('.error').html(' ');
                }else if(response.status == 'error') {
                    $.each(response.error, function (index, value) {
                        $('.' + index + '-error').html(value)
                        $('.' + index + '-error').show()
                    })
                }
            },
            complete: function () {
                setTimeout(function () {
                    $('.main-loader-page').fadeOut(300);
                    // location.reload();
                }, 700)   
            },
            error: function (response) {
                var errorData = $.parseJSON(response.responseText)
                var errors = errorData.errors
                if (ObjectLength(errors)) {
                    $.each(errors, function (index, value) {
                        $('.' + index + '-error').html(value)
                        $('.' + index + '-error').show()
                    })
                }
            },
        })
    }
})

// Only except Alphabets
function testInput(event) {
    var value = String.fromCharCode(event.which);
    var pattern = new RegExp(/[a-zåäö ]/i);
    return pattern.test(value);
}

$(document).on('keypress','.alpha', testInput);

/* email Validation for 25 char */ 
$(document).on('keypress',".subscription-email",function(event){
    var name = $(this).val();
    if(name.length > 60){
        event.preventDefault();
        return false;
    }
});