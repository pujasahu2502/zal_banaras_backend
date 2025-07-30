/* =============== ADD COUPON MODAL =============== */
$(document).on('click', '.add-coupon-modal', function () {
    var id = '#addCouponModal'
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
                    assignDatePick();
                    $('#addCouponForm').validate({
                        onfocusout: function (element) {
                            this.element(element);
                        },
                        errorClass: 'error_validation',
                        errorElement: 'span',
                        errorPlacement: function (error, element) {
                            var placement = $(element).attr('name');
                            placement = placement.replace("[]", "");
                            if (placement) {
                                $('.' + (placement)).closest('.coupon-input').find('.' + placement + '-error').html(error.text())
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
    }
})

/* =============== EDIT COUPON MODAL =============== */
$(document).on('click', '.edit-coupon-modal', function () {
    var url = $(this).attr('data-url')
    $.ajax({
        url: url,
        method: 'get',
        beforeSend: function () {
            $('.loader').fadeIn(300)
        },
        success: function (response) {
            if (response.status == 'success') {
                id = '#editCouponModal';
                modelRender(response.output, id);
                renderSelect2('.apply_on_value', 'data');
                assignDatePick();
                $('#editCouponForm').validate({
                    onfocusout: function (element) {
                        this.element(element);
                    },
                    errorClass: 'error_validation',
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        var placement = $(element).attr('name');
                        placement = placement.replace("[]", "");
                        if (placement) {
                            $('.' + (placement)).closest('.coupon-input').find('.' + placement + '-error').html(error.text())
                        }
                    },
                    success: function (error) {
                        error.remove();
                    }
                });
                productType();
            }
        },
        complete: function () {
            setTimeout(function () {
                $('.loader').fadeOut(300)
            }, 700)
        },
    })
})

/* =============== SAVE COUPON MODAL =============== */
$(document).on('click', '.save-coupon', function () {
    var url = $(this).attr('data-url')
    if ($('#addCouponForm').valid()) {
        method = 'POST';
        $.ajax({
            url: url,
            method: method,
            data: $('#addCouponForm').serialize(),
            beforeSend: function () {
                $('.loader').fadeIn(300)
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                if (response.status == 'error') {
                    $.each(response.error, function (index, value) {
                        $('.' + index + '-error').html(value)
                        $('.' + index + '-error').show()
                    })
                } else if (response.status == 'success') {
                    $('#addCouponForm')[0].reset()
                    $('.coupon-table').html(response.output)
                    $('.btn-close').trigger('click')
                    feather.replace()
                    toastr.success(response.message, 'Success!', {
                        timeOut: '4000',
                    })
                    $('.error').html('');
                    $('.search').val('');
                    
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

/* =============== UPDATE COUPON MODAL =============== */
$(document).on('click', '.update-coupon', function () {
    var url = $(this).attr('data-url')
    if ($('#editCouponForm').valid()) {
        method = 'POST'
        $.ajax({
            url: url,
            method: method,
            data: $('#editCouponForm').serialize(),
            beforeSend: function () {
                $('.loader').fadeIn(300)
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                if (response.status == 'error') {
                    $.each(response.error, function (index, value) {
                        $('.' + index + '-error').html(value)
                        $('.' + index + '-error').show()
                    })
                } else if (response.status == 'success') {
                    $('#editCouponForm')[0].reset()
                    $('.coupon-table').html(response.output)
                    $('.btn-close').trigger('click')
                    feather.replace()
                    toastr.success(response.message, 'Success!', {
                        timeOut: '4000',
                    })
                    $('.error').html('');
                    $('.search').val('');
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

/* =============== SWEET ALERT FOR STATUS COUPON MODAL =============== */
$(document).on('click', '.coupon-status', function () {
    var dataId = $(this).attr('data-id')
    var url = $(this).attr('data-url')
    var text =
        dataId == '1' ? "Do you want to inactive coupon?" : "Do you want to active coupon?"
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
            ; (url = url), (method = 'get')
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

/* =============== COUPON APPLY ON =============== */
$(document).on('change', '.apply_on', function () {
    var applyOn = $(this).val();
    if (applyOn != '') {
        var url = $(this).attr('data-url');
        var method = 'POST';
        $.ajax({
            url: url,
            method: method,
            data: { 'applyOn': applyOn },
            beforeSend: function () {
                $('.loader').fadeIn(300)
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                if (response.status == 'error') {
                    $.each(response.error, function (index, value) {
                        $('.' + index + '-error').html(value);
                        $('.' + index + '-error').show();
                    })
                } else if (response.status == 'success') {
                    $('.applyon-html').html(response.output);
                    renderSelect2('.apply_on_value', response.applied);
                }
            },
            complete: function () {
                setTimeout(function () {
                    $('.loader').fadeOut(300)
                }, 700)
            },
        })
    }
});
function productType(){
    var typeVal = $('#type').val();
    $(".amount-dollar-sign").html('');
    $(".amount-percent-sign").html('');
    if (typeVal == 1) {
        $(".amount-percent-sign").html('<i class="fa fa-percent p-1"></i>');
        $('.amount-percent-sign').addClass('input-group-text');
        $('.amount-dollar-sign').removeClass('input-group-text');

        $('.product').addClass('d-none');
        $('.coupon-amount').removeClass('d-none');
        $('#product_id').attr("data-rule-required", "false");
    } else if(typeVal == 2) {
        $(".amount-dollar-sign").html('<i class="fa fa-rupee p-1"></i>');
        $('.amount-dollar-sign').addClass('input-group-text');
        $('.amount-percent-sign').removeClass('input-group-text');

        $('.product').addClass('d-none');
        $('.coupon-amount').removeClass('d-none');
        $('#product_id').attr("data-rule-required", "false");
    }else{
        $('.product').removeClass('d-none');
        $('.coupon-amount').addClass('d-none');
        $('#product_id').attr("data-rule-required", "true");
    }
}

/* =============== ON CHANGE COUPON TYPE AMOUNT SIGN =============== */
$(document).on('change', '#type', function () {
    if( this.value == 3) {
        $(".apply_on option[value=1]").prop('disabled','disabled');
        $(".apply_on option[value=3]").prop('disabled','disabled');
    }else{
        $(".apply_on option[value=1]").removeAttr('disabled');
        $(".apply_on option[value=3]").removeAttr('disabled');
    }
  

    
  

    productType();
})

/* =============== ON DTAE CHANGE ASSIGN DATEPICKER =============== */
function assignDatePick() {
    var dateFormat = "yyyy-mm-dd",
        from = $("#start_date").datepicker({
            format: dateFormat,
            startDate: new Date(),
            autoclose: true,
        }).on("change", function (selected) {
            var toMinDate = $("#start_date").datepicker().val();
            var dateDate = toMinDate.split('-');

            var startDate = new Date(dateDate[0], (parseInt(dateDate[1]) - 1), (parseInt(dateDate[2]) + 1));
            to.datepicker("setStartDate", startDate);
        }),

        to = $("#end_date").datepicker({
            format: dateFormat,
            startDate: new Date(),
            autoclose: true,
        }).on("change", function () {
            var fromMaxDate = $("#end_date").datepicker().val();
            var dateDate = fromMaxDate.split('-');
            var startDate = new Date(dateDate[0], (parseInt(dateDate[1]) - 1), (parseInt(dateDate[2]) - 1));
            from.datepicker("setEndDate", startDate);
        });
}
// function freeProduct(){
//     let value = $('input[name="free_product_status"]:checked').val();;
//     if (value == 1) {
//         $('.product').removeClass('d-none');
//         $('#product_id').attr("data-rule-required", "true");
//     } else {
//         $('.product').addClass('d-none');
//         $('#product_id').attr("data-rule-required", "false");
//     }
// }
// $(document).on('click', '.free_product', function () {
//     freeProduct();
// });
