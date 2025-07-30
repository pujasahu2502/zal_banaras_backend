
var editorData;

/* =============== ADD BLOG MODAL =============== */
$(document).on('click', '.add-blog-modal', function () {
    var id = '#addBlogModal'
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
                    
                    // ClassicEditor.create(document.querySelector('#description'), {
                    //     cloudServices: {
                    //         tokenUrl: "https://33333.cke-cs.com/token/dev/ijrDsqFix838Gh3wGO3F77FSW94BwcLXprJ4APSp3XQ26xsUHTi0jcb1hoBt",
                    //         uploadUrl: "https://33333.cke-cs.com/easyimage/upload/"
                    //     }
                    // }).then(editor => {
                    //     editorData = editor;
                    // })
                    //     .catch(error => {
                    //         console.error(error);
                    //     });

                    CKEDITOR.replace('description');
                    $('#addBlogForm').validate({
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
    }
})

/* =============== EDIT BLOG MODAL =============== */
$(document).on('click', '.edit-blog-modal', function () {
    var url = $(this).attr('data-url')
    $.ajax({
        url: url,
        method: 'get',
        beforeSend: function () {
            $('.loader').fadeIn(300)
        },
        success: function (response) {
            if (response.status == 'success') {
                id = '#editBlogModal';
                modelRender(response.output, id);
                tooltipInitialize();
                // ClassicEditor.create(document.querySelector('#description'), {
                //     cloudServices: {
                //         tokenUrl: "https://33333.cke-cs.com/token/dev/ijrDsqFix838Gh3wGO3F77FSW94BwcLXprJ4APSp3XQ26xsUHTi0jcb1hoBt",
                //         uploadUrl: "https://33333.cke-cs.com/easyimage/upload/"
                //     }
                // }).then(editor => {
                //     editorData = editor;
                // })
                //     .catch(error => {
                //         console.error(error);
                //     });
                CKEDITOR.replace('description');

                $('#editBlogForm').validate({
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

/* =============== SAVE BLOG MODAL =============== */
$(document).on('click', '.save-blog', function () {
    var formId = "#addBlogForm";
    var url = $(this).attr('data-url')
    saveBlog(formId, url)
})

/* =============== UPDATE BLOG MODAL =============== */
$(document).on('click', '.update-blog', function () {
    var formId = "#editBlogForm";
    var url = $(this).attr('data-url')
    saveBlog(formId, url)
})

/* =============== COMMON SAVE/UPDATE BLOG FUNCTION =============== */
function saveBlog(formId, url) {
    if ($(formId).valid()) {
        var description = CKEDITOR.instances['description'].getData();
        var fd = new FormData()
        var files = imgArray
        fd.append('description', description);
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
            if (value.name != 'description') {
                fd.append(value.name, value.value)
            }
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
                    $(formId)[0].reset()
                    $('.blog-table').html(response.output)
                    $('.btn-close').trigger('click')
                    feather.replace()
                    toastr.success(response.message, 'Success!', {
                        timeOut: '4000',
                    })
                    $('.error').html('');
                    $('.search').val('');
                    tooltipInitialize();
                    imgArray = [];
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

/* =============== BLOG STATUS WITH SWEET ALERT =============== */
$(document).on('click', '.blog-status', function () {
    var dataId = $(this).attr('data-id')
    var name = $(this).attr('data-name')
    var url = $(this).attr('data-url')
    var text =
        dataId == '1' ? "Do you want to inactive blog?" : "Do you want to active blog?"
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


/* =============== SWEET ALERT FOR DELETE =============== */
$(document).on('click', '.delete', function () {
    var htmlOutput = $(this).closest('tr')
    Swal.fire({
        // title: 'Are you sure?',
        text: 'Do you want to delete this blog?',
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
                        $('.blog-table').html(response.output)
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
        if ((f.type == 'image/jpeg') || (f.type == 'image/jpg') || (f.type == 'image/png')) {
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
                    if (imgArray.length) {
                        $('.no-img').hide();
                    }
                }
            }
        } else {
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

$(document).on("click", ".image-uploader", function () {
    $('.upload__inputfile').click();
});