/* =============== ADD ATTRIBUTE MODAL =============== */
$(document).on('click', '.add-attribute-modal', function () {
    var id = '#addAttributeModal'
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
                    $('#addAttributeForm').validate({
                        onfocusout: function (element) {
                            this.element(element)
                        },
                        errorClass: 'error_validate',
                        errorElement: 'span',
                        errorPlacement: function(error, element) {
                            var placement = $(element).attr('name');
                            if (placement) {
                                $('.'+($(element).attr('name'))).closest('.attribute-input').find('.'+$(element).attr('name')+'-error').html(error.text())
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

/* =============== EDIT ATTRIBUTE MODAL =============== */
$(document).on('click', '.edit-attribute-modal', function () {
    var url = $(this).attr('data-url')
    $.ajax({
        url: url,
        method: 'get',
        beforeSend: function () {
            $('.loader').fadeIn(300)
        },
        success: function (response) {
            if (response.status == 'success') {
                id = '#editAttributeModal';
                modelRender(response.output, id);
                tooltipInitialize();
                $('#editAttributeForm').validate({
                    onfocusout: function (element) {
                        this.element(element)
                    },
                    errorClass: 'error_validate',
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        var placement = $(element).attr('name');
                        if (placement) {
                            $('.'+($(element).attr('name'))).closest('.attribute-input').find('.'+$(element).attr('name')+'-error').html(error.text())
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

/* =============== SAVE ATTRIBUTE MODAL =============== */
$(document).on('click', '.save-attribute', function () {
    var formId = "#addAttributeForm";
    var url = $(this).attr('data-url')
    saveAttribute(formId, url)
})

/* =============== UPDATE attribute MODAL =============== */
$(document).on('click', '.update-attribute', function () {
    var formId = "#editAttributeForm";
    var url = $(this).attr('data-url')
    saveAttribute(formId, url)
})

/* =============== COMMON SAVE/UPDATE attribute FUNCTION =============== */
function saveAttribute(formId, url) {
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
                    $('.attribute-table').html(response.output);
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

/* =============== ATTRIBUTE STATUS WITH SWEET ALERT =============== */
$(document).on('click', '.attribute-status', function () {
    var dataId = $(this).attr('data-id')
    var name = $(this).attr('data-name')
    var url = $(this).attr('data-url')
    var text =
    dataId == '1' ? "Do you want to inactive attribute?" : "Do you want to active attribute?"
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

/* =============== ATTRIBUTE DELETE WITH SWEET ALERT =============== */
$(document).on('click', '.delete', function () {
    var htmlOutput = $(this).closest('tr')
    Swal.fire({
        // title: 'Are you sure?',
        text: 'Do you want to delete this attribute?',
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
                        $('.attribute-table').html(response.output)
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