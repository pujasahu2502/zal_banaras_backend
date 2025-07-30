//===================== Js For Price range Filter====================
$(function () {
  var parent = document.querySelector('.range-slider')
  if (!parent) return
  var rangeS = parent.querySelectorAll('input[type=range]'),
    numberS = parent.querySelectorAll('input[type=number]')
  rangeS.forEach(function (el) {
    el.oninput = function () {
      var slide1 = parseFloat(rangeS[0].value),
        slide2 = parseFloat(rangeS[1].value)

      if (slide1 > slide2) {
        ;[slide1, slide2] = [slide2, slide1]
      }
      numberS[0].value = slide1
      numberS[1].value = slide2
    }
  })
  numberS.forEach(function (el) {
    el.oninput = function () {
      var number1 = parseFloat(numberS[0].value),
        number2 = parseFloat(numberS[1].value)
      // if (number1 > number2) {
      //     var tmp = number1;
      //     numberS[0].value = number2;
      //     numberS[1].value = tmp;
      // }
      rangeS[0].value = number1
      rangeS[1].value = number2
    }
  })
})

$(document).on('change', '#range', function () {
  var min_price = $('.min_price').val()
  $('.min_price').val(min_price)
  console.log(min_price)
})

$(document).on('change', '.max_price', function () {
  var max_price = $('.max_price').val()
  $('.max_price').val(max_price)
  console.log(max_price)
})

//===================== Search Form Reset Js====================
$(document).on('click', '.filtter-reset', function () {
  location.reload()
})

var webinarFilter = function (id, form_action) {
  console.log($('#search-form').serialize())
  var form_action = $('#search-form').attr('action')
  $.ajax({
    data: $('#search-form').serialize(),
    beforeSend: function () {
      $('.main-loader-page').fadeIn(300)
    },
    url: form_action,
    method: 'get',
    dataType: 'json',
    success: function (data) {
      $('.layout-productsgrid').html(data.webinarData)
      $('.webinarCount').html(data.webinarsCount)
    },
    complete: function () {
      setTimeout(function () {
        $('.main-loader-page').fadeOut(300)
      }, 700)
    },
  })
}
// $(document).on('click', '.category-filter', function () {
//   webinarFilter()
// })
$(document).on('change', '#priceRange', function () {
  webinarFilter()
})
$(document).on('change', '#range', function () {
  webinarFilter()
})
$(document).on('change', '#status_id', function () {
  webinarFilter()
})
$(document).on('change', '#sortBy', function () {
  webinarFilter()
})

//===================== Search Js For Webinar And Upcoming Webinar ====================
var webinarFilter = function (id, form_action) {
  console.log($('#search-form').serialize())
  var form_action = $('#search-form').attr('action')
  $.ajax({
    data: $('#search-form').serialize(),
    beforeSend: function() {
      $(".main-loader-page").fadeIn(300);
  },
    url: form_action,
    method: 'get',
    dataType: 'json',
    success: function (data) {
      $('.layout-productsgrid').html(data.webinarData)
      $('.webinarCount').html(data.webinarsCount)
    },
    complete: function() {
      setTimeout(function() {
          $('.main-loader-page').fadeOut(300)
      }, 700)
  },
  })
}
$(document).on('click', '.category-filter', function () {
  webinarFilter()
})
$(document).on('change', '#priceRange', function () {
  webinarFilter()
})
$(document).on('change', '#range', function () {
  webinarFilter()
})
$(document).on('change', '#status_id', function () {
  webinarFilter()
})
$(document).on('change', '#sortBy', function () {
  webinarFilter()
})
