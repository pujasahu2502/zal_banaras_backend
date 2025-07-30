/* =============== ADD DEALER MODAL =============== */
$(document).on('click', '.add-dealer-modal', function () {
    var id = '#dealerModal'
    if ($('.modal').hasClass('modal-create')) {
        $(id).modal('show')
        renderSelect2('.stateSelect2','data'); 
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
                    renderSelect2('.stateSelect2','data'); 
                    tooltipInitialize();
                    $('#addDealerForm').validate({
                        onfocusout: function (element) {
                            this.element(element)
                        },
                        errorClass: 'error_validate',
                        errorElement: 'span',
                        errorPlacement: function(error, element) {
                            var placement = $(element).attr('name');
                            if (placement) {
                                $('.'+($(element).attr('name'))).closest('.dealer-input').find('.'+$(element).attr('name')+'-error').html(error.text())
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

/* =============== EDIT DEALER MODAL =============== */
$(document).on('click', '.edit-dealer-modal', function () {
    var url = $(this).attr('data-url')
    $.ajax({
        url: url,
        method: 'get',
        beforeSend: function () {
            $('.loader').fadeIn(300)
        },
        success: function (response) {
            if (response.status == 'success') {
                id = '#editDealerModal';
                modelRender(response.output, id);
                renderSelect2('.stateSelect2','state');
                tooltipInitialize();
                $('#editDealerForm').validate({
                    onfocusout: function (element) {
                        this.element(element)
                    },
                    errorClass: 'error_validate',
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        var placement = $(element).attr('name');
                        if (placement) {
                            $('.'+($(element).attr('name'))).closest('.dealer-input').find('.'+$(element).attr('name')+'-error').html(error.text())
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

/* =============== SAVE DEALER MODAL =============== */
$(document).on('click', '.save-dealer', function () {
    var formId = "#addDealerForm";
    var url = $(this).attr('data-url')
    saveDealer(formId, url)
})

/* =============== UPDATE DEALER MODAL =============== */
$(document).on('click', '.update-dealer', function () {
    var formId = "#editDealerForm";
    var url = $(this).attr('data-url')
    saveDealer(formId, url)
})

/* =============== COMMON SAVE/UPDATE DEALER FUNCTION =============== */
function saveDealer(formId, url) {
    if($(formId).valid()) {
        var fd = new FormData()
        var files = imgArray
        fd.append('fileCount', imgArray.length);
        if (files == undefined) {
            files = ''
        }
        $.each(imgArray, function (index, value) {
            if (index) {
                fd.append('file' + index, value)
            } else {
                fd.append('file', value)
            }
        })
        $.each($(formId).serializeArray(), function (index, value) {
            fd.append(value.name, value.value)
        })
        method = 'POST'
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
                    $(formId)[0].reset();
                    $('.dealer-table').html(response.output);
                    $('.btn-close').trigger('click');
                    feather.replace();
                    toastr.success(response.message, 'Success!', {
                        timeOut: '4000',
                    });
                    $('.error').html('');
                    tooltipInitialize();
                    imgArray = [];
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
                        console.log(value);
                        $('.' + index + '-error').html(value);
                    });
                }
            }
        })
    }
}

/* =============== DEALER STATUS WITH SWEET ALERT =============== */
$(document).on('click', '.dealer-status', function () {
    var dataId = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    var url = $(this).attr('data-url');
    var text =
    dataId == '1' ? "Do you want to inactive dealer?" : "Do you want to active dealer?"
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
  
/* =============== DEALER DELETE WITH SWEET ALERT =============== */
$(document).on('click', '.delete-dealer', function () {
    var htmlOutput = $(this).closest('tr')
    Swal.fire({
       // title: 'Are you sure?',
        text: 'Do you want to delete this dealer?',
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
                        $('.dealer-table').html(response.output)
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



 /* =============== IMAGE MEDIA JS =============== */
var imgArray = []
function readURL(e) {
    var imgWrap = ''
    imgArray = []
    imgWrap = $('div.upload__img-wrap')
    var maxLength = $(this).attr('data-max_length')
    var files = e.files
    var filesArr = Array.prototype.slice.call(files)
    var iterator = 0
    var imageCount = $('.upload__inputfile').attr("data-count");
    filesArr.forEach(function (f, index) {
        // if (!f.type.match('image.*')) {
        //     return
        // }
        if((f.type == 'image/jpeg') || (f.type == 'image/jpg') || (f.type == 'image/png')){
            var size = parseFloat(files[index].size / 1024).toFixed(2);
            if (size > 2048) {
                toastr.options.timeOut = 4000 // 1.5s
                // toastr.error(files[index].name + ' ' +'File size is more then 2Mb.')
                toastr.error('Image size should be less than 2 MB!', 'Error!', {
                    timeOut: '4000',
                });
                return;
            }

            var imgaeCount = parseInt(imageCount) + index;
            if (imgaeCount > 4) {
                if (imgaeCount == 5) {
                    $('.upload__inputfile').prop('disabled', true)
                    toastr.options.timeOut = 4000 // 1.5s
                    toastr.error('Only 5 images allowed!')
                    return;
                }
                return;
            }
            if (imgaeCount <= 4) {
                if (imgArray.length > maxLength) {
                    return false
                } else {
                    var len = 0
                    for (var i = 0; i < imgArray.length; i++) {
                        if (imgArray[i] !== undefined) {
                            len++
                        }
                    }
                    if (len > maxLength) {
                        return false
                    } else {
                        $('div.upload__img-wrap').html('')
                        $('.upload__img-wrap').removeClass('d-none')
                        imgArray.push(f)
                        var reader = new FileReader()
                        reader.onload = function (e) {
                            var html =
                            "<div class='upload__img-box'><div style='background-image: url(" +
                            e.target.result +
                            ")' data-number='" +
                            $('.upload__img-close').length +
                            "' data-file='" +
                            f.name +
                            "' class='img-bg'><div class='upload__img-close' data-check='create'></div></div></div>"
                            imgWrap.append(html)
                            iterator++
                        }
                        reader.readAsDataURL(f)
                    }
                    if(imgArray.length) {
                        $('.no-img').hide();
                    }
                }
            }
        }else{
            toastr.error('Accepted image format must be jpg, jpeg, png!', 'Error!', {
                timeOut: '4000',
            });
            return;
        }
    })
}

$(document).on('change', '#image', function () {
    $('.upload__img-wrap').addClass('d-none')
    readURL(this)
})

$(document).on('click', '.upload__img-close', function (e) {
    var file = $(this).parent().data('file')
    for (var i = 0; i < imgArray.length; i++) {
        if (imgArray[i].name === file) {
            imgArray.splice(i, 1)
            break
        }
    }
    $(this).parent().parent().remove()
    $('.upload__inputfile').prop('disabled', false)
    if ($(this).attr('data-check') == 'edit') {
        var imageCount = $('.upload__inputfile').attr("data-count");
        imageCount = parseInt(imageCount) - 1;
        $('.upload__inputfile').attr("data-count", imageCount);
        var checkLastImage = 0
        $('.upload__img-wrap-edit')
        .find('.upload__img-box')
        .each(function () {
            checkLastImage++
        })
        if (checkLastImage == 0) {
            $('.upload__img-wrap-edit').addClass('d-none')
            $('.upload__img-wrap-edit-label').addClass('d-none');
            $('.no-img').removeClass('d-none');
        }
        //Working On Ajax
        var mediaId = $(this).attr('data-id')
        var dataUrl = $(this).attr('data-url')
        url = dataUrl
        method = 'Get'
        $.ajax({
            url: url,
            method: method,
            data: {
                _method: 'DELETE',
            },
            beforeSend: function () {
                $('.loader').fadeIn(300)
            },
            success: function (response) {
                toastr.success(response.message, 'Success!', {
                    timeOut: '4000',
                })
            },
            complete: function () {
                setTimeout(function () {
                    $('.loader').fadeOut(300)
                }, 700)
            },
        })
    } else {
        if (imgArray.length == 0) {
            $('.upload__inputfile').val('');
            $('.upload__img-wrap').addClass('d-none')
            $('.no-img').show();
        }
        toastr.options.timeOut = 4000 // 1.5s
        toastr.success('Image removed successfully!', 'Success!', {
            timeOut: '4000',
        })
    }
})

$(document).on("click",".image-uploader",function() {
    $('.upload__inputfile').click();
});
