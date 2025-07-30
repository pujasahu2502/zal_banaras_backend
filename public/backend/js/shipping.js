/* =============== ADD SHIPPING MODAL =============== */
$(document).on('click', '.add-shipping-modal', function () {
    var id = '#shippingModal'
    var url = $(this).attr('data-url')
    if ($('.modal').hasClass('modal-create')) {
        $(id).modal('show')
        renderSelect2('.stateSelect2','data');
    } else {
        $.ajax({
            url: url,
            method: 'get',
            beforeSend: function () {
                $('.loader').fadeIn(300)
            },
            success: function (response) {
                if (response.status == 'success') {
                    modelRender(response.output, id);
                    renderSelect2('.stateSelect2','data');
                    $('#addShippingForm').validate({
                        onfocusout: function (element) {
                            this.element(element)
                        },
                        errorClass: 'error_validate',
                        errorElement: 'span',
                        errorPlacement: function(error, element) {
                            var placement = $(element).attr('name');
                            console.log($(element).attr('name'),error.text());
                            if (placement) {
                                $('.'+($(element).attr('name'))).closest('.shipping-input').find('.'+$(element).attr('name')+'-error').html(error.text())
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
                    $('.loader').fadeOut(100)
                }, 500)
            },
        })
    }
})

/* =============== EDIT SHIPPING MODAL =============== */
$(document).on('click', '.edit-shipping-modal', function () {
    var id = $(this).attr('data-id')
    var url = $(this).attr('data-url')
    $.ajax({
        url: url,
        method: 'get',
        beforeSend: function () {
            $('.loader').fadeIn(300)
        },
        success: function (response) {
            if (response.status == 'success') {
                id = '#editShippingModal';
                modelRender(response.output, id);
                renderSelect2('.stateSelect2','state');
                $('#editShippingForm').validate({
                    onfocusout: function (element) {
                        this.element(element)
                    },
                    errorClass: 'error_validate',
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        var placement = $(element).attr('name');
                        if (placement) {
                            $('.'+($(element).attr('name'))).closest('.shipping-input').find('.'+$(element).attr('name')+'-error').html(error.text())
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

/* =============== SAVE SHIPPING MODAL =============== */
$(document).on('submit', '.save-shipping', function (e) {
    e.preventDefault();
    var formId = '#addShippingForm';
    var url = $(this).attr('action');
    saveShipping(formId, url)
})

/* =============== UPDATE SHIPPING MODAL =============== */
$(document).on('submit', '.update-shipping', function (e) {
    e.preventDefault();
    var formId = '#editShippingForm';
    var url = $(this).attr('action');
    saveShipping(formId, url)
})

/* =============== COMMON SAVE/UPDATE SHIPPING FUNCTION =============== */
function saveShipping(formId, url) {
   
    method = 'POST'
    if($(formId).valid()) {
        $("textarea.statedata").val(JSON.stringify($('.stateSelect2').val()));
        $.ajax({
            url: url,
            method: method,
            // contentType: "application/json; charset=utf-8",
            data: $(formId).serializeArray(),
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
                    $(formId)[0].reset()
                    $('.admin-table').html(response.output)
                    $('.btn-close').trigger('click')
                    feather.replace()
                    toastr.success(response.message, 'Success!', {
                        timeOut: '4000',
                    })
                    $('.error').html('')
                    tooltipInitialize();
                }
            },
            complete: function () {
                setTimeout(function () {
                    $('.loader').fadeOut(300)
                }, 700)
            },
            error: function(response) {
                if(response.responseJSON) {
                    $.each(response.responseJSON.errors,function (index, value) {
                        $('.' + index + '-error').html(value);
                    });
                }
            }
        });
    }
}


/* =============== SHIPPING DELETE WITH SWEET ALERT =============== */
$(document).on('click', '.delete-shipping', function (e) {
    e.preventDefault();
    let url = $(this).data('url');

    Swal.fire({
        //title: 'Are you sure?',
        text: "Do you want to delete this shipping?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Confirm it!'
    }).then((result) => {
        if (result.isConfirmed) {
            let _method = 'DELETE';
            $.ajax({
                url: url,
                method: _method,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function () {
                    $('.loader').fadeIn(300)
                },
                success: function (response) {
                    if (response.status == 'error') {
                        toastr.error(response.message, 'Error!', {
                            timeOut: '4000',
                        })
                    } else if (response.status == 'success') {
                        $('.shipping-table').html(response.output)
                        feather.replace()
                        toastr.success(response.message, 'Success!', {
                            timeOut: '4000',
                        })
                        $('.error').html('')
                        tooltipInitialize();
                    }
                },
                complete: function () {
                    setTimeout(function () {
                        $('.loader').fadeOut(300)
                    }, 700)
                },
                error: function(response) {
                    if(response.responseJSON) {
                        $.each(response.responseJSON.errors,function (index, value) {
                            $('.' + index + '-error').html(value);
                        });
                    }
                }
            });
        }
    });
})

/* =============== SHIPPING STATUS WITH SWEET ALERT =============== */
$(document).on('click', '.shipping-status', function () {
    var dataId = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    var url = $(this).attr('data-url');
    var text =
    dataId == '1' ? "Do you want to inactive shipping?" : "Do you want to active shipping?"
    var htmlOutPut = $(this).closest('tr').find('.status-render');
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
                    console.log(response.message);
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