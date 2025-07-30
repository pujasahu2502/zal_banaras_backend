jQuery(document).ready(function() {
    feather.replace();
});

/* =============== REVIEW DETAIL MODEL =============== */
$(document).on('click', '.reviewDetail', function() {
    var url = $(this).attr('data-url');
    var button = $(this);
    button.removeClass('reviewDetail');
    $.ajax({
        url: url,
        method: 'get',
        success: function(response) {
            if (response.status == 'success') {
                id = '#review'
                modelRender(response.output, id)
                button.addClass('reviewDetail');
            }
        },
    })
})

/* =============== REVIEW STATUS WITH SWEET ALERT =============== */
$(document).on('click', '.review-status', function () {
    var dataId = $(this).attr('data-id')
    var name = $(this).attr('data-name')
    var url = $(this).attr('data-url')
    var text =
    dataId == '1' ? "Do you want to pending review?" : "Do you want to approved review?"
    var htmlOutPut = $(this).closest('tr').find('.status-render')
    Swal.fire({
        // title: 'Are you sure?',
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Confirm it!',
    }).then((result) => {
        if (result.isConfirmed) {
            ;(url = url), (method = 'get')
            $.ajax({
                url: url,
                method: method,
                data: {
                    _token: '{{ csrf_token() }}',
                    status: dataId,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if (response.status == 'error') {
                        toastr.error(response.message, 'Error!', {
                            timeOut: '4000',
                        })
                    } else if (response.status == 'success') {
                        htmlOutPut.html(response.output)
                        toastr.success(response.message, 'Success!', {
                            timeOut: '4000',
                        })
                    }
                },
            })
        }
    })
})