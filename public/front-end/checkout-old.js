// const { indexOf } = require("lodash")

// validation for form
$('#seats-form').validate()
/* ===== SEAT NUMBER CLICK ===== */
$(document).on('click', '.select-seat', function () {
  var dataSeat = $(this).attr('data-id')

  var findClass = $('.view-person-info').find('.info-html-' + dataSeat).length
  var html = ''
  html += '<div class="seats-form member-info info-html-' + dataSeat + ' ">'
  html += '<div class="seats-number">'
  html +=
    '<span class="seat-number-id" data-seat-id="' +
    dataSeat +
    '">' +
    dataSeat +
    '</span>'
  html += '<input type="hidden" name="seat_number[]" value="' + dataSeat + '">'
  html += '</div>'
  html += '<div class="seat-form-group">'
  html +=
    '<input type="text" name="first_name[]" data-rule-required="true" autocomplete="off" class="form-control alpha first_name" data-msg-required="Please enter first name" placeholder="First Name">'
  html += '</div>'
  html += '<div class="seat-form-group">'
  html +=
    '<input type="text" name="last_name[]" data-rule-required="true" autocomplete="off" data-msg-required="Please enter last name" placeholder="Last Name" class="form-control alpha last_name">'
  html += '</div>'
  html += '</div>'
  if ($('.view-person-info').find('.member-info').length) {
    var htmlFlag = true
    $('.view-person-info')
      .find('.member-info')
      .each(function (index, value) {
        var seatId = $(this).find('.seat-number-id').data('seat-id')

        if (seatId == dataSeat) {
          $('.info-html-' + seatId).remove()
          $('#select-seat-' + seatId).css('background-color', '#fff')
          htmlFlag = false
          return false
        } else {
          if (seatId > dataSeat) {
            $('.info-html-' + seatId).before(html)
            $('#select-seat-' + dataSeat).css('background-color', '#37b679')
            htmlFlag = false
            return false
          }
        }
      })
    if (htmlFlag) {
      $('#select-seat-' + dataSeat).css('background-color', '#37b679')
      $('.view-person-info').append(html)
    }
  } else {
    $('.view-person-info').append(html)
    $('.no-seat-avaialvle').remove()
    $('.no-seat-data').hide()
    $('.next-button').prop('disabled', false)
    $(this).closest('.select-seat').css('background-color', '#37b679')
  }

  if ($('.view-person-info').find('.member-info').length == 0) {
    $('.info-html-' + dataSeat).remove()
    $('.no-seat-data').show()
    $('.no-seat-data').html(
      '<p class="text-center no-seat-avaialvle">No seats selected yet</p>',
    )
    $(this).closest('.select-seat').css('background-color', '#fff')
    $('.next-button').prop('disabled', true)
  }
})

// next button for go to address section
$(document).on('click', '.next', function () {
  next_fs = $(this).closest('fieldset')
  var memberNameArray = []
  var validateFlag = true
  if (next_fs.data('set') == '1') {
    $('.error').remove()
    if ($('.view-person-info').find('.member-info').length > 0) {
      $('.view-person-info')
        .find('.member-info')
        .each(function (index, value) {
          var f_name = $(this).find('.first_name').val()
          var l_name = $(this).find('.last_name').val()
          if (f_name && l_name) {
            memberNameArray.push({
              f_name: f_name,
              l_name: l_name,
            })
          } else {
            f_name
              ? ''
              : $(this)
                  .find('.first_name')
                  .after('<span class="error">first name is required.</span>')
            l_name
              ? ''
              : $(this)
                  .find('.last_name')
                  .after('<span class="error">last name is required.</span>')
            validateFlag = false
          }
        })
    } else {
      validateFlag = false
    }
  }

  if (next_fs.data('set') == '2') { 
    var addressValidate = 0
    $('.error').remove()
    $('.addressFormField')
      .find('input')
      .each(function (index, value) {

        var input_value = $(this).val()
        var input_name = $(this).attr('name')
        var arr = ['shipping_address2','billing_address2'];
        var arr = ['shipping_address2','billing_address2'];
        if($.inArray(input_name,arr) == -1 ) {
          input_value ? addressValidate++ : $(this).after('<span class="error">this field is required.</span>')
        }
        validateFlag = false
      })
    $('.addressFormField').find('input').length == addressValidate+2
      ? $('#address-form').submit()
      : ''
  }
  if (validateFlag) {
    next_fs.hide()
    next_fs.next().show()
  }
})

$(document).on('click', '.previous', function () {
  current_fs = $(this).closest('fieldset')
  current_fs.hide()
  current_fs.prev().show()
})

// check address and same for the billing address
$(document).on('change', '#address_type', function () {
  var shippingAddress1 = $('#shipping_address1').val()
  var shippingAddress2 = $('#shipping_address2').val()
  var shippingCountry = $('#shipping_country').val()
  var shippingState = $('#shipping_state').val()
  var shippingCity = $('#shipping_city').val()
  var shippingZipCode = $('#shipping_zip_code').val()

  if ($('#address_type').is(':checked')) {
    if (
      shippingAddress1 != '' &&
      shippingCountry != '' &&
      shippingState != '' &&
      shippingCity != '' &&
      shippingZipCode != ''
    ) {
      $('#billing_address1').val(shippingAddress1)
      $('#billing_address1').prop('disabled', true)
      $('#billing_address2').val(shippingAddress2)
      $('#billing_address2').prop('disabled', true)
      $('#billing_country').val(shippingCountry)
      $('#billing_country').prop('disabled', true)
      $('#billing_state').val(shippingState)
      $('#billing_state').prop('disabled', true)
      $('#billing_city').val(shippingCity)
      $('#billing_city').prop('disabled', true)
      $('#billing_zip_code').val(shippingZipCode)
      $('#billing_zip_code').prop('disabled', true)
    } else {
      toastr.error("Please Enter Shipping Address", 'Error!', {
        timeOut: '4000',
      })
      $('#address_type').prop('checked', false)
    }
  } else {
    // alert("Check box is Unchecked");
    $('#billing_address1').val('')
    $('#billing_address1').prop('disabled', false)
    $('#billing_address2').val('')
    $('#billing_address2').prop('disabled', false)
    $('#billing_country').val('')
    $('#billing_country').prop('disabled', false)
    $('#billing_state').val('')
    $('#billing_state').prop('disabled', false)
    $('#billing_city').val('')
    $('#billing_city').prop('disabled', false)
    $('#billing_zip_code').val('')
    $('#billing_zip_code').prop('disabled', false)
  }
})
