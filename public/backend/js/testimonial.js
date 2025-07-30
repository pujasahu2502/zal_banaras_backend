/* =============== ADD TESTIMONIAL MODAL =============== */
$(document).on('click', '.add-testimonial-modal', function () {
    var id = '#addTestimonialModal'
    if ($('.modal').hasClass('modal-create')) {
        $(id).modal('show')
    } else {
        var url = $(this).attr('data-url')
        $.ajax({
            url: url,
            method: 'get',
            beforeSend: function () {
                $('.loader').fadeIn(300)
            },
            success: function (response) {
                if (response.status == 'success') {
                    modelRender(response.output, id);
                    tooltipInitialize();
                    $('#addTestimonialForm').validate({
                        onfocusout: function (element) {
                            this.element(element)
                        },
                        errorClass: 'error_validate',
                        errorElement: 'span',
                        errorPlacement: function(error, element) {
                            var placement = $(element).attr('name');
                            if (placement) {
                                $('.'+($(element).attr('name'))).closest('.testimonial-input').find('.'+$(element).attr('name')+'-error').html(error.text())
                            } 
                        },
                        success: function (error) {
                            error.remove();
                        }
                    })
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

/* =============== EDIT TESTIMONIAL MODAL =============== */
$(document).on('click', '.edit-testimonial-modal', function () {
    var url = $(this).attr('data-url')
    $.ajax({
        url: url,
        method: 'get',
        beforeSend: function () {
            $('.loader').fadeIn(300)
        },
        success: function (response) {
            if (response.status == 'success') {
                id = '#editTestimonialModal';
                modelRender(response.output, id);
                tooltipInitialize();
                $('#editTestimonialForm').validate({
                    onfocusout: function (element) {
                        this.element(element)
                    },
                    errorClass: 'error_validate',
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        var placement = $(element).attr('name');
                        if (placement) {
                            $('.'+($(element).attr('name'))).closest('.testimonial-input').find('.'+$(element).attr('name')+'-error').html(error.text())
                        } 
                    },
                    success: function (error) {
                        error.remove();
                    }
                })
            }
        },
        complete: function () {
            setTimeout(function () {
                $('.loader').fadeOut(300)
            }, 700)
        },
    })
})

/* =============== SAVE TESTIMONIAL MODAL =============== */
$(document).on('click', '.save-testimonial', function () {
    var formId = "#addTestimonialForm";
    var url = $(this).attr('data-url')
    saveTestimonial(formId, url)
})

/* =============== UPDATE TESTIMONIAL MODAL =============== */
$(document).on('click', '.update-testimonial', function () {
    var formId = "#editTestimonialForm";
    var url = $(this).attr('data-url')
    saveTestimonial(formId, url)
})

/* =============== COMMON SAVE/UPDATE TESTIMONIAL FUNCTION =============== */
function saveTestimonial(formId, url) {
    if($(formId).valid()) {
        method = 'POST'
        $.ajax({
            url: url,
            method: method,
            data: $(formId).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            beforeSend: function () {
                $('.loader').fadeIn(300)
            },
            success: function (response) {
                if (response.status == 'error') {
                    $.each(response.error, function (index, value) {
                        $('.' + index + '-error').html(value)
                        $('.' + index + '-error').show()
                    })
                } else if (response.status == 'success') {
                    $(formId)[0].reset();
                    $('.testimonial-table').html(response.output);
                    $('.btn-close').trigger('click');
                    feather.replace();
                    toastr.success(response.message, 'Success!', {
                        timeOut: '4000',
                    });
                    $('.error').html('');
                    $('.search').val('');
                    tooltipInitialize();
                }
            },
            complete: function () {
                setTimeout(function () {
                    $('.loader').fadeOut(300)
                }, 700)
            },
        })
    }
}

/* =============== TESTIMONIAL STATUS WITH SWEET ALERT =============== */
$(document).on('click', '.testimonial-status', function () {
    var dataId = $(this).attr('data-id')
    var name = $(this).attr('data-name')
    var url = $(this).attr('data-url')
    var text =
    dataId == '1' ? "Do you want to inactive testimonial?" : "Do you want to active testimonial?"
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

/* =============== TESTIMONIAL DELETE WITH SWEET ALERT =============== */
$(document).on('click', '.delete', function () {
    var htmlOutput = $(this).closest('tr')
    Swal.fire({
        // title: 'Are you sure?',
        text: 'Do you want to delete this testimonial?',
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
                        $('.testimonial-table').html(response.output)
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