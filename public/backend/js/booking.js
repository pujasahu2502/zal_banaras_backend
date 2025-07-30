$(document).on('click', '.booking-detail', function () {
  var url = $(this).attr('data-url')
  var booking_id = $(this).attr('data-id')
  var id = '#bookingModal'
  $.ajax({
  url: url,
  method: 'get',
  data: { id: booking_id },
  beforeSend: function () {
    $('.loader').fadeIn(300)
  },
  success: function (response) {
    if (response.status == 'success') {
    modelRender(response.output, id)
    }
  },
  complete: function () {
    setTimeout(function () {
    $('.loader').fadeOut(300)
    }, 700)
  },
  })
})
