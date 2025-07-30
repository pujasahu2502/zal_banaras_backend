// var buttonPlus  = $(".qty-btn-plus");
// var buttonMinus = $(".qty-btn-minus");

// var incrementPlus = buttonPlus.click(function() {
// var n = $(this)
// .parent(".qty-container")
// .find(".input-qty");
// //console.log(n);
// n.val(Number(n.val())+1 ); 
// });

// var incrementMinus = buttonMinus.click(function() {
// var n = $(this).parent(".qty-container").find(".input-qty");
// var amount = Number(n.val());
//     if (amount > 0) {
//         var minus =  amount-1;
//         if(minus != 0){
//             n.val(minus);
//         }
//     }
// });

$(document).on("click", ".quantity-button", function () {
  var output = $(this).closest('tr').find('.amount.sub-product-amount bdi');
  var url = $(this).attr('data-url');
  var activeClass = $(this).attr("data-class");
  var check = activeClass == 'add' ? true : false;
  let count = $(this).closest('.qty-container').find('.input-qty').val();
  let qty = 0, statusChange = false;
  if (check) {
    $(this).closest('.qty-container').find('.input-qty').val(parseInt(count) + 1);
    qty = parseInt(count) + 1;
    statusChange = true;
  } else {
    count != 1 ? $(this).closest('.qty-container').find('.input-qty').val(parseInt(count) - 1) : '';
    qty = count != 1 ? (parseInt(count) - 1) : '';
    statusChange = count != 1 ? true : false;
  }
  if (statusChange) {
    var productId = $(this).attr("data-key");
    var method = 'get';
    $.ajax({
      url: url,
      method: method,
      data: {
        active_class: activeClass,
        count: qty,
        product_id: productId
      },
      success: function (response) {
        if (response.status == 'success') {
          output.html('<span>$</span>' + response.price);
          $('.sb-value').html('<span>$</span>' + response.totalPrice);
        }
      },
    })
  }
})

//   $(document).on("click", ".quantity-button", function () {
//     var activeClass = $(this).attr("data-class");
//     var check = activeClass == 'add' ? true : false;
//     let count = $(this).closest('.qty-container').find('.input-qty').val();
//     if (check) {
//       $(this).closest('.qty-container').find('.input-qty').val(parseInt(count) + 1);
//     } else {
//       count != 1 ? $(this).closest('.qty-container').find('.input-qty').val(parseInt(count) - 1) : '';
//     }
//   })

$(document).on("change", "#product-qty", function (e) {
  if ($(this).val() > 0) {
    console.log('1 ', $(this).val());
  } else {
    console.log('2 ', $(this).val());
    $(this).val(1);
    // e.preventdefault();

  }
});

$(document).on("click", ".view-more", function () {
  let view = $(this).closest('.product-name').find('.product-details');
  if (view.hasClass('d-none')) {
    console.log('pass');
    view.removeClass('d-none');
  } else {
    console.log('fail');
    view.addClass('d-none');
  }
});