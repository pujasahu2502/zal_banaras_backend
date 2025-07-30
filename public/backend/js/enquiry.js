/* ========== Detail Model Show ========== */
$(document).on('click', '.contactUsDetail', function() {
    var url = $(this).attr('data-url');
    var button = $(this);
    button.removeClass('contactUsDetail');
    $.ajax({
        url: url,
        method: 'get',
        success: function(response) {
            if (response.status == 'success') {
                id = '#contactUs'
                modelRender(response.output, id)
                button.addClass('contactUsDetail');
            }
        },
    })
})

/* ========== sweetalert for delete ========== */
$(document).on('click', '.delete-enquiry', function () {
    var htmlOutput = $(this).closest('tr')
    Swal.fire({
        //title: 'Are you sure?',
        text: 'Do you want to delete this enquiry?',
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
                        $('.enquiry-table').html(response.output)
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