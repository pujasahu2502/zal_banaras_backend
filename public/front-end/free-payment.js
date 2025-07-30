
countdown("ten-countdown", countMinutes, countSeconds);

function countdown(elementName, minutes, seconds) {
    var element, endTime, hours, mins, msLeft, time;

    function twoDigits(n) {
        return (n <= 9 ? "0" + n : n);
    }

    function updateTimer() {
        msLeft = endTime - (+new Date);
        if (msLeft < 1000) {
            window.location.href = redirect;
        } else {
            time = new Date(msLeft);
            hours = time.getUTCHours();
            mins = time.getUTCMinutes();
            element.innerHTML = (hours ? hours + ':' + twoDigits(mins) : mins) + ':' + twoDigits(time
            .getUTCSeconds());
            setTimeout(updateTimer, time.getUTCMilliseconds() + 500);
        }
    }

    element = document.getElementById(elementName);
    endTime = (+new Date) + 1000 * (60 * minutes + seconds) + 500;
    updateTimer();
}

$(document).on('click', '.free', function() {
    url = $(this).attr('data-url');
    method = 'POST'
    $.ajax({
        url: url,
        method: method,
        data: $('#payment-form').serialize(),
        beforeSend: function() {
            $(".main-loader-page").fadeIn(300);
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(response) {
            if (response.status == 'success') {
                // $('#contactUsForm')[0].reset()
                setTimeout(function() {
                    window.location.href = response.url;
                }, 2000);
                toastr.success(response.message, 'Success!', {
                    timeOut: '4000',
                })
                $('.error').html('')
            }
        },
        complete: function() {
            setTimeout(function() {
                $('.main-loader-page').fadeOut(300)
            }, 700)
        },
    })
});
