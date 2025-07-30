//=====================stripe js ======================================
// defining variable for design in card elements 
var style = {
  base: {
    iconColor: '#666EE8',
    color: '#bcbcbc',
    lineHeight: '20px',
    fontWeight: 400,                      
    fontSize: '16px',
    '::placeholder': {
      color: '#525252',
    },
  },
};
const elements = stripe.elements();
// Mount Card Number
const cardElement = elements.create('cardNumber', {
  style: style,
  classes: {
    base: 'form-control'
  },
  showIcon: true,
});
cardElement.mount('#card-number');

// Mount Card Expiry
const cardExpiry = elements.create('cardExpiry', {
  style: style,
  
  classes: {
    base: 'form-control'
  },

});
cardExpiry.mount('#card-expiry');

// Mount Card CVC
const cardCvc = elements.create('cardCvc', {
  style: style,
  classes: {
    base: 'form-control'
  },
});
cardCvc.mount('#card-cvc');
// =====================================================
let paymentMethod = null
//======================================================

const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');
// const clientSecret = cardButton.dataset.secret;

//Validation And create Card Token
cardButton.addEventListener('click', async (e) => {
  $('#card-button').prop('disabled', true);
  $('.spinner-border').fadeIn('fast');
  stripe.createToken(cardElement).then(function(result) {
    $("#overlay").fadeIn(300);
    var name = $('#card-holder-name').val();
    // var email = $('#card-holder-email').val();
    $('.error').html(' ');
    if (result.error) {
      // Inform the user if there was an error.
      // var errorElement = document.getElementById('card-errors');
      // errorElement.textContent = result.error.message;

      $('.card-error').html(result.error.message);
      name == '' ? $('.account-holder-error').html('Card Holder Name is required.') : '';
      // email == '' ? $('.email-error').html('Card Holder Email is required.') : ( !validateEmail(email) ? $('.email-error').html('Card Holder Email is not valid.') : "" );
      buttonDisabledFalse();
      $("#overlay").fadeOut(300);

    } else {

      $('.card-error').html('');
      if (!name) {
        !name ? $('.name-error').html('Card Holder Name is required.') : '';
        buttonDisabledFalse();
        $("#overlay").fadeOut(300);
      } else {
        // Send the token to your server.
        stripeTokenHandler(result.token.id);
      }
    }
  });

  function stripeTokenHandler(paymentMethod) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'paymentMethod');
    hiddenInput.setAttribute('value', paymentMethod);
    form.appendChild(hiddenInput);

    var hiddenButton = document.createElement('button');
    hiddenButton.setAttribute('type', 'button');
    hiddenButton.setAttribute('class', 'd-none card-payment');
    form.appendChild(hiddenButton);
     
    $('.card-payment').trigger('click');
  }
});

function buttonDisabledFalse() {
  $('#card-button').prop('disabled', false);
  $('.spinner-border').fadeOut('fast');
}


/* ===== Payment in ajax ===== */
$(document).on('click', '.card-payment', function() {
  $.ajax({
    url: stripe_required_info.stripe_url,
    method: 'POST',
    data: $('#payment-form').serializeArray(),
    beforeSend: function() {
      $(".main-loader-page").fadeIn(300);
    },
    success: function(data) {
    if(data.status == 'booked') {
        $('.card-error').html(data.message);
        buttonDisabledFalse();
        return false;
      }
      if (data.status == 'error') {
        if(data.errors){
          
          $.each(data.errors, function(index, value) {
            console.log(value)
            $('.' + index + '-error').html(value[0]);
          });
        }else{
         
            $('.card-error').html('');
            $('.card-error').html(data.message);
         
        }

        buttonDisabledFalse();
      } else {
        toastr.success(data.message, "Success!", {
          timeOut: "4000"
        });
        setTimeout(function() {
          window.location.href = data.url;
        }, 2000);
      }
      $("body").tooltip({
        selector: '[data-toggle="tooltip"]'
      });
      feather.replace();
    },
    complete: function() {
      setTimeout(function() {
        $(".main-loader-page").fadeOut(150);
      }, 400);
    },
  })
});

/* ===== APPLY GIFTCARD AJAX ===== */
$(document).on('click', '.apply-code-btn', function() {
  var couponCode = $('.gift_code').val();
  var url = $(this).attr('data-url');
  if (couponCode == '') {
    $('.coupon_code-error').css('display', 'block');
    $('.code_not_apply-error').html('');
    $('.code_apply-success-div').css('display', 'none');
    $('.promocode_discount_value').val('');
    $('.promocode_discount_type').val('');
  } else {
    $('.coupon_code-error').css('display', 'none');
  }
   
  if (couponCode != '') {
    $.ajax({
      url: url,
      method: 'get',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        couponCode: couponCode
      },
      beforeSend: function() {
        $(".main-loader-page").fadeIn(300);
      },
      success: function(data) {
     
        if (data.status == 'error') {
          $('.code_not_apply-error').html('');
          $('.code_not_apply-error').html(data.message);
        } else if (data.status == 'success') {
          $('.code_not_apply-error').html('');
          $('.gift-card-render').html(data.output)
        
          if(data.total_price <= 0){

            $('.payment-details').html(data.paymentPage)
          }
          feather.replace();
          toastr.success(data.message, "Success!", {
            timeOut: "4000"
          });
        } else if (data.status == 'already') {
          toastr.error(data.message, "Error!", {
            timeOut: "4000"
          });
        }
      },
      complete: function() {
        setTimeout(function() {
          $('.main-loader-page').fadeOut(300)
        }, 700)
      },
    })
  }
});

countdown( "ten-countdown", countMinutes, countSeconds );

function countdown( elementName, minutes, seconds )
{
    var element, endTime, hours, mins, msLeft, time;

    function twoDigits( n )
    {
        return (n <= 9 ? "0" + n : n);
    }

    function updateTimer()
    {
        msLeft = endTime - (+new Date);
        if ( msLeft < 1000 ) {
          window.location.href = redirect;
        } else {
            time = new Date( msLeft );
            hours = time.getUTCHours();
            mins = time.getUTCMinutes();
            element.innerHTML = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );
            setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );
        }
    }

    element = document.getElementById( elementName );
    endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
    updateTimer();
}


