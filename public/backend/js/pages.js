var editorData;

/* =============== EDIT PAGE MODAL =============== */
$(document).on('click', '.edit-pages-modal', function () {
    var url = $(this).attr('data-url')
    $.ajax({
        url: url,
        method: 'get',
        beforeSend: function () {
            $('.loader').fadeIn(300)
        },
        success: function (response) {
            if (response.status == 'success') {
                id = '#editPagesModal';
                modelRender(response.output, id);
                tooltipInitialize();
                // var editor = CKEDITOR.replace('editor1');

                // ClassicEditor.create(document.querySelector('#description'), {
                //     cloudServices: {
                //         tokenUrl: "https://33333.cke-cs.com/token/dev/ijrDsqFix838Gh3wGO3F77FSW94BwcLXprJ4APSp3XQ26xsUHTi0jcb1hoBt",
                //         uploadUrl: "https://33333.cke-cs.com/easyimage/upload/"
                //     }
                // }).then(editor => {
                //     editorData = editor;
                // }).catch(error => {
                //     console.error(error);
                // });

                CKEDITOR.replace('description');


                $('#editPageForm').validate({
                    onfocusout: function (element) {
                        this.element(element)
                    },
                    errorClass: 'error_validate',
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

/* =============== UPDATE PAGE MODAL =============== */
$(document).ready(function () {
    $('#editPageForm').validate({
        onfocusout: function (element) {
            this.element(element)
        },
        errorClass: 'error_validate',
        errorElement: 'span',
    })

    $(document).on('click', '.update-page', function () {
        if ($('#editPageForm').valid()) {
            var url = $(this).attr('data-url');
            var description = editorData.getData();
            var fd = new FormData();
            fd.append('description', description);
            $.each($("#editPageForm").serializeArray(), function (index, value) {
                if (value.name != 'description') {
                    fd.append(value.name, value.value)
                }
            })
            method = 'POST';
            $.ajax({
                url: url,
                method: method,
                data: fd,
                contentType: false,
                processData: false,
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
                        $('#editPageForm')[0].reset();
                        $('.pages-table').html(response.output)
                        $('.btn-close').trigger('click')
                        feather.replace();
                        toastr.success(response.message, 'Success!', {
                            timeOut: '4000',
                        })
                        $('.error').html('');
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
})

/* =============== PAGE STATUS WITH SWEET ALERT =============== */
$(document).on('click', '.pages-status', function () {
    var dataId = $(this).attr('data-id')
    var name = $(this).attr('data-name')
    var url = $(this).attr('data-url')
    var text =
    dataId == '1' ? "Do you want to inactive page?" : "Do you want to active page?"  
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