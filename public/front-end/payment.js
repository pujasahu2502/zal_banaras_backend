$(document).on('change','#filladdress',function() {
    var row = '';
    row += '<div class="order-payment-form">';
    row += '    <div class="payment-heading mb-4">';
    row += '        <h4 class="text-uppercase">Shipping Details</h4>';
    row += '    </div>';
    row += '    <div class="pb-3">';
                 if((JSON.parse(addresses)).length) {
                    row += '        <div class="form-group">';
                    row += '            <div class="custom_select">';
                    row += '            <select class="form-control bill bill_state placeholder-select w-100 mb-4 fillDataOnAddress" name="shipping_address_type" data-location="shipping">';
                    row += '                <option disabled="" selected="">Select address</option>';
                                            if((JSON.parse(addresses)).length) {
                                                $.each(JSON.parse(addresses),function(addressKey,address) { 
                    row += '                       <option value="'+fillAddressUrl.replace("DNZTEMPDATA",address.id)+'" data-value="'+addressKey+'" data-state="'+address+'">'+address.first_name+' '+address.last_name+' '+address.email+' '+address.mobile+' '+address.address+' '+address.city+' '+address.state+' '+address.zipcode +'</option>';
                                                });                    
                                            }else{
                    row += '                <option value="" disabled=""> No Address Found!</option>';
                                            }
                    row += '            </select>';
                    row += '            </div>';
                    row += '        </div>';
                }
   
    row += '        <div class="form-group">';
    row += '            <input type="text" required="" class="form-control alpha bill shipping_first_name" name="shipping_first_name" id="first_name" placeholder="First Name *">';
    row += '            <label class="text-danger error shipping_first_name-error"></label>';
    row += '        </div>';
    row += '        <div class="form-group">';
    row += '            <input type="text" required="" class="form-control bill alpha shipping_last_name" name="shipping_last_name" id="last_name"  placeholder="Last Name *">';
    row += '            <label class="text-danger error shipping_last_name-error"></label>';
    row += '        </div>';
    row += '        <div class="form-group">';
    row += '            <input class="form-control bill shipping_mobile mobile numberonly"  required="" type="text" name="shipping_phone_number" id="phone_number" placeholder="Mobile *">';
    row += '            <label class="text-danger error shipping_phone_number-error"></label>';
    row += '        </div>';
    row += '        <div class="form-group">';
    row += '            <input class="form-control bill shipping_email" required="" type="email" name="shipping_email" id="email"  placeholder="Email *">';
    row += '            <label class="text-danger error shipping_email-error"></label>';
    row += '        </div>';
    row += '    ';
    row += '        <div class="form-group">';
    row += '            <input type="text" class="form-control bill shipping_address" name="shipping_address" id="address" required="" placeholder="Address *">';
    row += '            <label class="text-danger error shipping_address-error"></label>';
    row += '        </div>';
    row += '    ';
    row += '        <div class="form-group">';
    row += '            <div class="custom_select">';   
    row += '                <select class="form-control niceselsecr bill bill_state placeholder-select shipping_state w-100" id="state" name="shipping_state" data-state="shipping">';
    row += '                    <option disabled="" selected="">Select state*</option>';
    row += '    ';
                                $.each(JSON.parse(states),function(key,state) { 
    row += '                          <option value="'+state+'" data-value="'+key+'" data-state="'+state+'">'+state +' - '+key+' </option>';
                                });
    row += '                </select>';
    row += '                <label class="text-danger error shipping_state-error"></label>';
    row += '            </div>';
    row += '        </div>';
    row += '        <div class="form-group">';
    row += '            <input class="form-control bill shipping_city alpha" required="" type="text" id="city" name="shipping_city" placeholder="City / Town *">';
    row += '            <label class="text-danger error shipping_city-error"></label>';
    row += '        </div>';
    row += '        <div class="form-group">';
    row += '            <input class="form-control bill shipping_zipcode" required="" type="text" name="shipping_zipcode"  placeholder="Zipcode *">';
    row += '            <label class="text-danger error shipping_zipcode-error"></label>';
    row += '        </div>';
    row += '    </div>';
    row += '</div>';


    let value = $('#filladdress').is(':checked');

    if(value) {
        $('.shipping-form').html('');
    }else{
        $('.shipping-form').html(row);
    }
    $('select').niceSelect();

})

$(document).on('change',".fillDataOnAddress",function() {
    let location = $(this).attr("data-location");
    let addressFilterURL = $(this).val();
    if(addressFilterURL) {
        $.ajax({
            url:addressFilterURL,
            method:'GET',
            beforeSend: function () {
                $('.main-loader-page').fadeIn(300)
            },
            success: function(response) {
                console.log(response);
                if(response.status == "success") {
                    $.each(response.address,function(key,value) {
                        if(key == 'state') {
                            // $((location == 'shipping' ? ".shipping_" : ".")+key+' option').attr("disabled","disabled");
                            $((location == 'shipping' ? ".shipping_" : ".")+key+' option[value="'+value+'"').attr("selected","selected").prop("disabled",false);
                            $('select').niceSelect('update');
                            $('.state').trigger('change');
                        } else {
                            $((location == 'shipping' ? ".shipping_" : ".")+key).val(value);
                            // $((location == 'shipping' ? ".shipping_" : ".")+key).attr("readOnly",true);
                            $('.shipping_state').trigger('change');
                        }
                    });
                    $(".error").html('');
                }
            },
            complete: function () {
                setTimeout(function () {
                    $('.main-loader-page').fadeOut(300)
                }, 700)
            },
        });
    }
   
});


$(document).ready(function() {
    if($('select.fillDataOnAddress option').is(':selected')) {
        $('.fillDataOnAddress').trigger('change');
    }
});



// coupon 
$(document).on("click",".apply-coupon",function() {
    if($('.promo-inner-block').find('.alert.alert-success').length == 0){
        var url = $(this).attr('data-url');
        var couponCode = $(".coupon-code").val();
        // var subTotalAmount = $(".subtotal .sb-value").text().replace('₹','');

        if(couponCode) {
            $('.coupon-error').html(" ");
            $.ajax({
                type:'POST',
                url:url, 
                data:{couponCode:couponCode},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    $('.main-loader-page').fadeIn(300)
                },
                success:function(data){
                    
                    if (data.error) {
                        $('.coupon-error').text(data.error);
                    } else {
                        $('.promo-code').removeClass("d-none");
                        $(".payment-price .amount").text('₹'+data.totalAmount);

                        if($('.promo-inner-block').find('.alert.alert-success').length == 0){
                            $(".promo-inner-block").after().append(data.alertOutput);
                        };

                        if(data.freeProduct.status) {
                            $('.outer-order-card-block').append(data.freeProduct.output);
                            $('.order-payment-price .discount').html(data.discount);
                        }else {
                            $('.order-payment-price .discount').html('-$'+data.discount);
                        }
                    }
                },
                complete: function () {
                    setTimeout(function () {
                        $('.main-loader-page').fadeOut(300)
                    }, 700)
                },
                
            });
        }else{
            $('.coupon-error').html("Please enter Promo code.")
        }
    }else{
        toastr.success('Promo code is already applied.');
    }
});



$(document).on("change",".shipping_state,.state",function() {
    let state = null
    if($("#filladdress").is(":checked")) {
        state = $('.state').val();
    }else {
        state = $('.shipping_state').val();
    }
    if(state) {
        $.ajax({
            url:taxShippingCalculation,
            method:"GET",
            data: {state:state},
            success:function(response) {
                if(response.status == "success") {
                    $('.order-payment-field.shipping,.order-payment-field.tax').remove();
                    $('.order-payment-field.subtotal').after(response.shippingOutput);
                    $('.order-payment-field.shipping').last().after(response.taxOutput);
                    $('.payment-price .amount').html('₹'+response.total);
                }
            }
        });
    } else {
        console.log('error');
    }
});