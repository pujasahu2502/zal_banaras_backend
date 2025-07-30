$(document).ready(function () {
  $('#address-add-form').validate({
    //ignore: [],
    onfocusout: function (element) {
      this.element(element)
    },
    errorClass: 'error_validate',
    errorElement: 'lable',
  })

  $('#address-edit-form').validate({
    //ignore: [],
    onfocusout: function (element) {
      this.element(element)
    },
    errorClass: 'error_validate',
    errorElement: 'lable',
  })

  $(document).on('click', '.contact-btn', function () {
    var form_action = $(this).attr('data-url');
    var addressUrl = $(this).attr('data-addressUrl');
    var data_id = $(this).attr('data-id');
    var method = '';
    if ($('#address-add-form').valid()) {
      var url = form_action;
      if (data_id == ' ') {
        method = 'POST'
      } else {
        method = 'PUT'
      };
      $.ajax({
        url: url,
        method: method,
        data: $('#address-add-form').serialize(),
        beforeSend: function () {
          $('.main-loader-page').fadeIn(300)
        },
        success: function (response) {
          if (response.status == 'success') {
            $('#address-add-form')[0].reset()
            window.location.replace(addressUrl);
            $('.error').html('')
          }
          else if (response.status == 'error') {
            $.each(response.errors, function (index, value) {
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
      })
    }
  })
})

/* email Validation for 25 char */
$(document).on('keypress', ".email", function (event) {
  var name = $(this).val();
  if (name.length > 60) {
    event.preventDefault();
    return false;
  }
});


/* =============== DELETE FAQ SWEET ALERT =============== */
$(document).on('click', '.address-delete', function () {
  var htmlOutput = $(this).closest('.address-card-block')
  Swal.fire({
    // title: 'Are you sure?',
    text: 'Do you want to delete this Address?',
    icon: 'error',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Confirm it!',
  }).then((result) => {
    if (result.isConfirmed) {
      var url = $(this).attr('data-url')
      method = 'POST'
      $.ajax({
        url: url,
        method: method,
        data: {
          _method: 'DELETE',
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
          htmlOutput.remove()
          if (response.status == 'error') {
            toastr.error(response.message, 'Error!', {
              timeOut: '4000',
            })
          } else if (response.status == 'success') {
            // if (response.output == 0) {
              // console.log('PASSS');
              $('.address-table').html(response.addressData);
              sliderAddress();

            // }
            feather.replace();
            toastr.success(response.message, 'Success!', {
              timeOut: '4000',
            })
          }
        },
      })
    }
  })
})


// <!-- ------------order-address-slider-js----------------- -->
sliderAddress();
function sliderAddress() {
  $(".order-address-carousel").slick({
    slidesToShow: 2,
    speed: 500,
    infinite: false,
    autoplay: false,
    autoplaySpeed: 2000,
    // dots: false, Boolean
    // arrows: false, Boolean
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
    ]
});
}