/* =============== EDIT ORDER MODAL =============== */
$(document).on('click', '.edit-order-modal', function () {
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
                id = '#editOrderModal';
                modelRender(response.output, id);
                renderSelect2('.stateSelect2','data');
                $('#editOrderForm').validate({
                    onfocusout: function (element) {
                        this.element(element);
                    },
                    errorClass: 'error_validate',
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        var placement = $(element).attr('name');
                        if (placement) {
                            $('.'+($(element).attr('name'))).closest('.tax-input').find('.'+$(element).attr('name')+'-error').html(error.text())
                        }
                    },
                    success: function (error) {
                        error.remove();
                    }
              });
            }
        },
        complete: function () {
            setTimeout(function () {
                $('.loader').fadeOut(300)
            }, 700)
        },
    })
})

/* =============== CHANGE ORDER STATUS =============== */
$(document).on('change', '.admin-order-status', function () {
    var orderVal = $(this).val();
    var url = $(this).attr('data-url');
    if(orderVal){
        $.ajax({
            url: url,
            method: 'get',
            data: {'orderVal': orderVal},
            beforeSend: function () {
                $('.loader').fadeIn(300)
            },
            success: function (response) {
                if (response.status == 'success') {
                    $('.order-table').html(response.output);
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
})