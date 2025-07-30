/* =============== FOR AUTO GENERATE USERNAME =============== */
var firstName = '';
var lastName = '';
$(document).on('change', '#first_name,#last_name', function () {
    var firstName = $('#first_name').val();
    var lastName = $('#last_name').val();
    customUsername(firstName, lastName);
});

function customUsername(firstName, lastName){
    var username = firstName+ ( lastName ? lastName : '');
    $('#username').val(username);
}

/* =============== ADD USER MODAL =============== */
$(document).on('click', '.add-user-modal', function () {
    var id = '#addUserModal'
    $('.error').html('')
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
                    $('#addUserForm').validate({
                        onfocusout: function (element) {
                            this.element(element)
                        },
                        // errorClass: 'error_validate',
                        errorElement: 'span',
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

/* =============== SAVE USER DATA =============== */
$(document).on('click', '.save-user', function () {
    var url = $(this).attr('data-url')

    if ($('#addUserForm').valid()) {
        ;(url = url), (method = 'POST')
        $.ajax({
            url: url,
            method: method,
            data: $('#addUserForm').serialize(),
            beforeSend: function () {
                $('.loader').fadeIn(300);
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
                    $('#addUserForm')[0].reset();
                    $('.user-table').html(response.output);
                    $('.btn-close').trigger('click');
                    feather.replace();
                    toastr.success(response.message, 'Success!', {
                        timeOut: '4000',
                    })
                    $('.error').html('');
                    $('.search').val('');
                    // billShipAdd(response.userId);
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

/* =============== VIEW USER DATA =============== */
$(document).on('click', '.view-user-profile', function () {
    var url = $(this).attr('data-url');
    $.ajax({
        url: url,
        method: 'GET',
        beforeSend: function () {
            $('.loader').fadeIn(300)
        },
        success: function (response) {
            if (response.status == 'success') {
                id = '#userViewProfile'
                modelRender(response.output, id)
            }
        },
        complete: function () {
            setTimeout(function () {
                $('.loader').fadeOut(300)
            }, 700)
        },
    })
})

/* =============== EDIT USER MODAL =============== */
$(document).on('click', '.edit-user-modal', function () {
    var url = $(this).attr('data-url')
    $.ajax({
        url: url,
        method: 'get',
        beforeSend: function () {
            $('.loader').fadeIn(300)
        },
        success: function (response) {
            if (response.status == 'success') {
                id = '#editUserModal';
                modelRender(response.output, id);
                $('#editUserForm').validate({
                    onfocusout: function (element) {
                        this.element(element)
                    },
                    // errorClass: 'error_validate',
                    errorElement: 'span',
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

/* =============== UPDATE USER DATA =============== */
$(document).on('click', '.update-user', function () {
    var url = $(this).attr('data-url')
    if ($('#editUserForm').valid()) {
        method = 'POST'
        $.ajax({
            url: url,
            method: method,
            data: $('#editUserForm').serialize(),
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
                    $('#editUserForm')[0].reset();
                    $('.user-table').html(response.output);
                    $('.btn-close').trigger('click');
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

/* =============== USER STATUS WITH SWEET ALERT =============== */
$(document).on('click', '.user-status', function () {
    var dataId = $(this).attr('data-id')
    var name = $(this).attr('data-name')
    var url = $(this).attr('data-url')
    var text =
    dataId == '1' ? "Do you want to inactive customer?" : "Do you want to active customer?"
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

/* =============== BILLING SHIPPING ADDRESS =============== */
function billShipAdd(userId){
    Swal.fire({
        // title: 'Are you sure?',
        text: 'Do you want to add billing and shipping addresses?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Confirm it!',
    }).then((result) => {
        if (result.isConfirmed) {
            $('.edit-address-modal-'+userId).trigger('click')
        }
    })
}