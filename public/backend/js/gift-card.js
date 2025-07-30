$(document).on('click', '.add-gift-card-modal', function () {
  var id = '#addGiftCardModal'
  if ($(".modal").hasClass('modal-create')){
  $(id).modal('show');
  } else {  
  
  var url = $(this).attr('data-url');
  // alert(url);
  $.ajax({
    url: url,
    method: 'get',
    beforeSend: function () {
    $('.loader').fadeIn(300)
    },
    success: function (response) {
    
    if (response.status == 'success') {
      modelRender(response.output, id)
      // $('#update-profile').modal('show');
    }
    },
    complete: function () {
    setTimeout(function () {
      $('.loader').fadeOut(300)
    }, 700)
    },
  })
  }
  })


  // ======================edit modal get====================
$(document).on('click', '.edit-gift-card-modal', function () {
  var url = $(this).attr('data-url');
  $.ajax({
  url: url,
  method: 'get',
  success: function (response) {
    if (response.status == 'success') {
    id = '#editGiftCardModal'
    modelRender(response.output, id);
    tooltipInitialize();
    // $('#update-profile').modal('show');
    }
  },
  })
})  

  // ============================add gift card data ==========================
$(document).ready(function () {
  $('#addGiftCardForm').validate({
    //ignore: [], 
    onfocusout: function (element) {
    this.element(element)
    },
    errorClass: 'error_validate',
    errorElement: 'lable',
  })
  
  $(document).on('click', '.save-gift-card', function () {
    var url = $(this).attr('data-url')
  
    if ($('#addGiftCardForm').valid()) {
    url = url,
    method = 'POST'
    $.ajax({
      url: url,
      method: method,
      data: $('#addGiftCardForm').serialize(),
      beforeSend: function () {
      $('.loader').fadeIn(300)
      },
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      success: function (response) {
      if (response.status == 'error') {
        $.each(response.error, function (index, value) {
        console.log(index)
        $('.' + index + '-error').html(value)
        $('.' + index + '-error').show()
        })
      } else if (response.status == 'success') {
        // console.log(response.status)
        // $('#addGiftCardForm')[0].reset()
        //close model
        // $('.warehouseTable').
        
        $('.gift-card-table').html(response.output);
        $('.btn-close').trigger('click');   
        feather.replace();
        toastr.success(response.message, 'Success!', {
        timeOut: '4000',
        })
        $('.error').html('')
      }
      },
      complete: function () {
      setTimeout(function () {
        $('.loader').fadeOut(300)
      }, 700)
      },
    })
    }
  })
  })

//=======================update Category===============
$(document).ready(function () {
  $('#editGiftCardForm').validate({
  //ignore: [],
  onfocusout: function (element) {
    this.element(element)
  },
  errorClass: 'error_validate',
  errorElement: 'lable',
  })

  $(document).on('click', '.update-gift-card', function () {
  var url = $(this).attr('data-url')
  if ($('#editGiftCardForm').valid()) {
    
    method = 'POST'
    $.ajax({
    url: url,
    method: method,
    data: $('#editGiftCardForm').serialize(),
    beforeSend: function () {
      $('.loader').fadeIn(300)
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    success: function (response) {
      if (response.status == 'error') {
      $.each(response.error, function (index, value) {
        console.log(index)
        $('.' + index + '-error').html(value)
        $('.' + index + '-error').show()
      })
      } else if (response.status == 'success') {
      $('#editGiftCardForm')[0].reset()
      //close model
      $('.gift-card-table').html(response.output);
      $('.btn-close').trigger('click');
      feather.replace();
      toastr.success(response.message, 'Success!', {
        timeOut: '4000',
      })
      
      $('.error').html('')
      }
    },
    complete: function () {
      setTimeout(function () {
      $('.loader').fadeOut(300)
      }, 700)
    },
    })
  }
  })
})

  // ==========================category status ======================
  // ===========================SWEET ALERT FOR STATUS ======================

// $(document).on('click', '.category-status', function () {
//   var dataId = $(this).attr('data-id')
//   var name = $(this).attr('data-name');
//   var url = $(this).attr('data-url');
//   var text = dataId == '1' ? "Want's to inactivate  !" : "Want's to activate  !"
// //  alert(text);
//   var htmlOutPut = $(this).closest('tr').find('.status-render')
//   Swal.fire({
//     title: 'Are you sure?',
//     text: text,
//     icon: 'warning',
//     showCancelButton: true,
//     confirmButtonColor: '#3085d6',
//     cancelButtonColor: '#d33',
//     confirmButtonText: 'Yes, Confirm it!',
//   }).then((result) => {
//     if (result.isConfirmed) {
//       url = url,
//       method = 'get'
//       $.ajax({
//         url: url,
//         method: method,
//         data: {
//           _token: '{{ csrf_token() }}',
//           status: dataId,
//         },
//         headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
//         },
//         success: function (response) {
//           if (response.status == 'error') {
//             toastr.error(response.message, 'Error!', {
//               timeOut: '4000',
//             })
//           } else if (response.status == 'success') {
//             htmlOutPut.html(response.output)
//             toastr.success(response.message, 'Success!', {
//               timeOut: '4000',
//             })
//           }
//         },
//       })
//     }
//   })
// })


  //=======================assign gift card ===============
  $(document).on('click', '.assign-winner', function() {
  var htmlOutput = $(this).closest('tr');
  Swal.fire({
    title: 'Are you sure?',
    text: "Once Assign, you will not be able to Change Customer!",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Confirm it!'
  }).then((result) => {
    if (result.isConfirmed) {
      var url = $(this).attr('data-url');
      var userId = $(this).attr('data-userId');
      var giftId = $(this).attr('data-giftId');
      var webinar_id = $('#purchase_webinar_id');
      var webinarId = $(webinar_id, 'option:selected').val();
      method = 'Put'
      $.ajax({
        url: url,
        method: method,
        data: {
          user_id: userId,
          gift_card_id: giftId,
          purchase_webinar_id: webinarId
        },
        beforeSend: function() {
          $('.loader').fadeIn(300)
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(response) {
        
          if (response.status == 'error') {
            if(response.giftCardError){
              $(".gift-card-price-error").removeClass("d-none");
            }
            $.each(response.error, function(index, value) {
              console.log(index)
              $('.' + index + '-error').html(value)
              $('.' + index + '-error').show()
            })
          } else if (response.status == 'success') {
            //close model
            $('#gift-assign-data').html(response.output);
            feather.replace();
            toastr.success(response.message, 'Success!', {
              timeOut: '4000',
            })
            location.reload();
            $('.btn-close').trigger('click')
          $('.error').html('')
          }
        },
        complete: function() {
          setTimeout(function() {
            $('.loader').fadeOut(300)
          }, 700)
        },
      })
    }
  })
  });

   
