$(document).on('click', '.addToCart', function () {
    // let flag = false;
    // let checkedOption = 0;
    // if($(selector).hasClass(classname)) {
    //     $('select.variationFilter option:selected').each(function (key, value) {
    //         if (!$(this).is(':first-child')) {
    //             if ($(this).is(':selected') && $(this).val() != null) {
    //                 checkedOption++;
    //             }
    //             if ($('select.variationFilter').length == checkedOption) {
    //                 flag = true;
    //             }
    //         }
    //     });
    // }else{
    //     flag = true;
    // }
    // if (flag) {
        let url = $(this).attr('data-url');
        $.ajax({
            url: url,
            method: "POST",
            data: $('#form-add-to-cart-id').serializeArray(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                if (response.status == "success") {
                    $('.cart-info').html('<span class="cart-count">' + response.cart + '</span>');
                    $('.cart-error').html(' ');
                    if(response.url) {
                        location.href = response.url;
                    }else{
                        $('#toast-container').remove();
                        toastr.success(response.message, 'Success!', {
                            timeOut: '4000',
                            positionClass: 'toast-bottom-right',
                        });
                    }
                } else if (response.status == "error") {
                    $('.cart-error').html(response.message);
                    // toastr.error(response.message, 'Oops!', {
                    //     timeOut: '4000',
                    //     positionClass: 'toast-bottom-right',
                    // });
                }
            }
        });
    // }
});

// sortByPaginate

$(document).on("change", ".sortByPaginate", function () {
    // console.log($(this).val());
    $('.submit-filter').val($(this).val());
    $('.submit-filter').click();
});


$(document).on("change", ".variationFilter", function () {
    let url = $(this).attr('data-url');
    $.ajax({
        url: url,
        method: "GET",
        data: $('#form-add-to-cart-id').serializeArray(),
        // data: {name:name, value:value,qty:qty},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        beforeSend: function () {
            $('.variation-loading').fadeIn(300);
        },
        success: function (response) {
            if (response.filter) {
                $('.product-detail-inner-block').html(response.output);
                $('select').niceSelect();
            }
            $('.input-qty').attr('value', (1));
            if (response.status == "success") {
                $('.price-total-data').html('₹' + response.price);
                $('.cart-error').html(' ');
            } else if (response.status == "error") {
                $('.price-total-data').html(response.price != 0 ? '₹' + response.price : response.price);
                $('.cart-error').html(response.message);
            }
            if (response.price != 0 && response.price != undefined) {
                $('.price-parent').removeClass('d-none');
            }
            if (response.sku) {
                $('.sku-code').html(response.sku)
            }
            $('#product-qty').attr("data-price", response.price);
        },
        complete: function () {
            setTimeout(function () {
              $('.variation-loading').fadeOut(300)
            },
         )
         },
        
    });
});

$(document).ready(function () {
    $('.0-variationFilter').trigger("change");
});

$(document).on("click", ".quantity-button", function () {
    var activeClass = $(this).attr("data-class");
    var check = activeClass == 'add' ? true : false;
    let count = $(this).closest('.qty-container').find('.input-qty').val();
    let price = $(this).closest('.qty-container').find('.input-qty').attr('data-price');
    price = price ? price : null;
    let priceCount = count;
    console.log(priceCount);
    if (price) {
        console.log(price, check, priceCount);

        if (check) {
            console.log(parseInt(count) + 1);

            $(this).closest('.qty-container').find('.input-qty').attr('value', (parseInt(count) + 1));
            priceCount = parseInt(count) + 1;
            console.log(priceCount);
        } else {
            count != 1 ? $(this).closest('.qty-container').find('.input-qty').attr('value', (parseInt(count) - 1)) : '';
            priceCount == 1 ? 1 : priceCount = parseInt(count) - 1;
        }
        $('.price-total-data').text('₹' + (parseFloat(priceCount) * parseFloat(price)).toFixed(2));
    }
})




$(document).on("change", "#product-qty", function (e) {
    if ($(this).val() > 0) {
        $('#product-qty').attr('value', $(this).val());
        let price = $(this).attr('data-price');
        $('.price-total-data').text('₹' + (parseFloat(price) * ($(this).val())));
    } else {
        $(this).val(1);
    }
});

$(document).on('click', '.clear-filter', function () {
    let url = $(this).attr('data-url');
    $.ajax({
        url: url,
        method: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
         beforeSend: function () {
            $('.variation-loading').fadeIn(300);
        },
        success: function (response) {
            if (response.status == "success") {
                console.log('asdsadas');
                $('.product-detail-inner-block').html(response.output);
                $('select').niceSelect();
                $('.input-qty').removeAttr('data-price');
                $('.price-parent').addClass('d-none');
                $('#product-qty').attr('value', '1');
            } else if (response.status == "error") {
                window.location.replace(response.url);
            }
        },
        complete: function () {
           setTimeout(function () {
             $('.variation-loading').fadeOut(300)
           },
        )
        },
    });
});

