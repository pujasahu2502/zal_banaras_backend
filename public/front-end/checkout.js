$(function() {
    $('#card-number').validateCreditCard(function(result) {
        $('.log').html(result.card_type == null ? '-' : result.card_type.name.toLowerCase());
    });
});

$(document).on("click",".paynow",function(e){
    let urlCheckout = $(this).attr('data-url-checkout');
    let url = $(this).attr('data-url');
    e.preventDefault();
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: urlCheckout,
        type:'POST',
        data: $('#checkout-form').serialize(),
        beforeSend: function () {
            $('.main-loader-page').fadeIn(300)
        },
        success: function(response) {
            if(response.status == 'timeout') {
                // When page exceed its time or cart is empty
                toastr.success(response.reload);
                setTimeout(function () {
                    window.location = url;
                }, 4000);
            }
            if (response.status == 'error') {
                if(response.message) {
                    toastr.error(response.message,"Error!");
                }
                $.each(response.errors, function (index, value) {
                    $("#checkout-form").find('.' + index + '-error').html(value);
                    $('.' + index + '-error').show();
                });
            } else if (response.status == 'success') {
                // toastr.success(response.message);
                // setTimeout(function () {
                    window.location = url;
                // }, 4000);
            }
        },
        complete: function () {
            setTimeout(function () {
                $('.main-loader-page').fadeOut(300)
            }, 700)
        },
    });
}); 

 