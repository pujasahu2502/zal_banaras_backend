var productEditor;
var additionalInfoEditor;
/* ===== STEP FORM WITH VALIDATION ===== */
jQuery(document).ready(function() {
    // click on next button
    jQuery('.form-wizard-next-btn').click(function() {
        var parentFieldset = jQuery(this).parents('.wizard-fieldset');
        var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
        var next = jQuery(this);
        var nextWizardStep = true;
        parentFieldset.find('.wizard-required').each(function(){
            var thisValue = jQuery(this).val();
            var thisName = jQuery(this).attr('name');
            var thisClass = '.'+thisName+'-error';

            if( thisValue == "" || thisValue == null) {
                jQuery(thisClass).css('display', 'block');
                nextWizardStep = false;
            }
            else {
                jQuery(thisClass).css('display', 'none');
            }
        });
        if( nextWizardStep) {
            next.parents('.wizard-fieldset').removeClass("show","400");
            currentActiveStep.removeClass('active').addClass('activated').next().addClass('active',"400");
            next.parents('.wizard-fieldset').next('.wizard-fieldset').addClass("show","400");
            jQuery(document).find('.wizard-fieldset').each(function(){
                if(jQuery(this).hasClass('show')){
                    var formAtrr = jQuery(this).attr('data-tab-content');
                    jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){
                        if(jQuery(this).attr('data-attr') == formAtrr){
                            jQuery(this).addClass('active');
                            var innerWidth = jQuery(this).innerWidth();
                            var position = jQuery(this).position();
                            jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
                        }else{
                            jQuery(this).removeClass('active');
                        }
                    });
                }
            });
            /* ===== SUBMIT STEP BY STEP FORM ===== */
            var nextAttr = jQuery(this).attr('next-attr');
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method: 'POST',
                data: $('.form-submit-'+nextAttr).serialize(),
                // beforeSend: function () {
                //     $('.loader').fadeIn(300)
                // },
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
                        $('.product_id').val(response.product_id);
                        if(response.combinationData != ''){
                            $('.product-variation-table').html(response.combinationData)
                        }
                        feather.replace();
                        toastr.success(response.message, 'Success!', {
                            timeOut: '4000',
                        })
                        $('.error').html('');
                    }
                },
                complete: function () {
                    // setTimeout(function () {
                    //     $('.loader').fadeOut(300)
                    // }, 700)
                },
            })
        }
    });
    //click on previous button
    jQuery('.form-wizard-previous-btn').click(function() {
        var counter = parseInt(jQuery(".wizard-counter").text());;
        var prev =jQuery(this);
        var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
        prev.parents('.wizard-fieldset').removeClass("show","400");
        prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show","400");
        currentActiveStep.removeClass('active').prev().removeClass('activated').addClass('active',"400");
        jQuery(document).find('.wizard-fieldset').each(function(){
            if(jQuery(this).hasClass('show')){
                var formAtrr = jQuery(this).attr('data-tab-content');
                jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){
                    if(jQuery(this).attr('data-attr') == formAtrr){
                        jQuery(this).addClass('active');
                        var innerWidth = jQuery(this).innerWidth();
                        var position = jQuery(this).position();
                        jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
                    }else{
                        jQuery(this).removeClass('active');
                    }
                });
            }
        });
    });
    //click on form submit button
    jQuery(document).on("click",".form-wizard .form-wizard-submit" , function(){
        var parentFieldset = jQuery(this).parents('.wizard-fieldset');
        var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
        parentFieldset.find('.wizard-required').each(function() {
            var thisValue = jQuery(this).val();
            if( thisValue == "" ) {
                jQuery(this).siblings(".wizard-form-error").slideDown();
            }
            else {
                jQuery(this).siblings(".wizard-form-error").slideUp();
            }
        });
    });
    // focus on input field check empty or not
    jQuery(".form-control").on('focus', function(){
        var tmpThis = jQuery(this).val();
        if(tmpThis == '' ) {
            jQuery(this).parent().addClass("focus-input");
        }
        else if(tmpThis !='' ){
            jQuery(this).parent().addClass("focus-input");
        }
    }).on('blur', function(){
        var tmpThis = jQuery(this).val();
        if(tmpThis == '' ) {
            jQuery(this).parent().removeClass("focus-input");
            jQuery(this).siblings('.wizard-form-error').slideDown("3000");
        }
        else if(tmpThis !='' ){
            jQuery(this).parent().addClass("focus-input");
            jQuery(this).siblings('.wizard-form-error').slideUp("3000");
        }
    });
});


jQuery(document).ready(function() {

    tooltipInitialize();

    /* ===== CATEGORY SELECT 2 ===== */
    renderSelect2withoutModal('.category-select2', 'Category');


    /* ===== SHOW HIDE PRICE ON CHANGE PRODUCT TYPE ===== */
    typeValue = $('.type').val();
    if(typeValue != null){
        if(typeValue == '1'){
            $('.regular-sale-price').css('display', 'block');
            $('.step-4').css('display', 'none');
            // $('.list-unstyled.form-wizard-steps li:last-child').last().remove();

        }else{
            $('.step-4').css('display', 'block');
            $('.regular-sale-price').css('display', 'none');
        }   
    }

});

/* ===== ON CHANGE SELECT 2 ===== */
renderSelect2withoutModal('.attribute-select2', 'data');

/* === ON CHANGE PRODUCT TYPE FOR THE PRICE === */
$(document).on('change', '.type', function () {
    typeValue = $(this).val();
    if(typeValue == '1'){
        $('.regular-sale-price').css('display', 'block');
        $('.step-4').css('display', 'none');
        // $('.list-unstyled.form-wizard-steps li:last-child').last().remove();
    }else{
        $('.regular-sale-price').css('display', 'none');
        $('.regular_price').val('');
        $('.sale_price').val('');
        $('.step-4').css('display', 'block');
        // $('.list-unstyled.form-wizard-steps').last().append('<li><span>4</span></li>');
    }
});

/* ===== NEXT CLICK LOADER ===== */
$(document).on('click', '.next', function () {
    $('.loader').fadeIn(300)

    setTimeout(function () {
        $('.loader').fadeOut(300)
    }, 2000)
});

/* ===== BACK CLICK LOADER ===== */
$(document).on('click', '.back', function () {
    $('.loader').fadeIn(300)

    setTimeout(function () {
        $('.loader').fadeOut(300)
    }, 2000)
});

/* ===== SELECT ALL SELECT-2 IN ATTRIBUTE VALUE ===== */
$(document).on('click', '.select-all', function () {
    var slug = $(this).attr('data-attr-slug');
    $(".select-"+slug+" > option").prop("selected", "selected");
    $(".attribute-select2").trigger("change");

});

/* ===== SELECT NONE SELECT-2 IN ATTRIBUTE VALUE ===== */
$(document).on('click', '.select-none', function () {
    var slug = $(this).attr('data-attr-slug');
    $(".select-"+slug+" > option").removeAttr("selected");
    $(".attribute-select2").trigger("change");
});

/* =============== SELECT PRODUCT ATTRIBUTE =============== */
$(document).on('change', '.attribute', function () {
    var attribute = $(this).val();
    var text = $(".attribute option:selected").text();
    $('.error').html('');
    $.ajax({
        url: '/projection-booth/product-attribute/',
        method: 'GET',
        data: {'attribute': attribute},
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
                $('.attribute-data').append(response.output)
                renderSelect2withoutModal('.attribute-select2', text.toLowerCase());
                $(".attribute option[value*='"+ attribute +"']").prop('disabled', true);
                $(".attribute option[value='']").prop('selected', true);
                $('.no-category-found').css('display', 'none')
            }
        },
        complete: function () {
            setTimeout(function () {
                $('.loader').fadeOut(300)
            }, 700)
        },
    })
})

/* =============== PRODUCT STATUS WITH SWEET ALERT =============== */
$(document).on('click', '.product-status', function () {
    var dataId = $(this).attr('data-id')
    var name = $(this).attr('data-name')
    var url = $(this).attr('data-url')
    var text =
    dataId == '1' ? "Do you want to inactive product?" : "Do you want to active product?"
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

/* =============== REMOVE PRODUCT ATTRIBUTE WITH SWEET ALERT =============== */
$(document).on('click', '.remove-attribute', function () {
    var url = $(this).attr('data-url');
    var dataId = $(this).attr('data-id');
    Swal.fire({
        // title: 'Are you sure?',
        text: 'Do you want to remove attribute?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Confirm it!',
    }).then((result) => {
        if (result.isConfirmed) {
            ;(url = url), (method = 'get')

            if(url == '' || url == undefined){
                var i = 0;
                if(dataId != ''){
                    $( ".accordion" ).each( function(index, value){
                        i++
                    })
                    $('#main-'+dataId).remove();
                    $(".attribute option[value*='"+ dataId +"']").prop('disabled', false);
                    if(i <= 1){
                        $('.no-category-found').css('display', 'block');
                    }
                }
            }else{
                $.ajax({
                    url: url,
                    method: method,
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    beforeSend: function () {
                        $('.loader').fadeIn(300)
                    },
                    success: function (response) {
                        if (response.status == 'error') {
                            toastr.error(response.message, 'Error!', { timeOut: '4000'})
                        } else if (response.status == 'success') {
                            location.reload();
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
                toastr.options.timeOut = 4000
                toastr.error('Image size should be less than 2 MB!', 'Error!', {
                    timeOut: '4000',
                });
                return;
            }

            var imgaeCount = parseInt(imageCount) + index;
            if (imgaeCount > 4) {
                if (imgaeCount == 5) {
                    $('.upload__inputfile').prop('disabled', true)
                    toastr.options.timeOut = 4000
                    toastr.error('Maximum 5 images can be uploaded at a time!', 'Error!', {
                        timeOut: '4000',
                    });
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
    $('.upload__img-wrap').addClass('d-none');
    readURL(this);
})

$(document).on('change', '.variation-image', function () {
    var dataKey = $(this).attr('data-key');
    $(this).addClass('d-none');
    const file = this.files[0];
    if (file){
        if((file.type == 'image/jpeg') || (file.type == 'image/jpg') || (file.type == 'image/png')){

            var size = parseFloat(file.size / 1024).toFixed(2);
            if (size > 2048) {
                toastr.error('Image size should be less than 2 MB!', 'Error!', {
                    timeOut: '4000',
                });
                return;
            }

            let reader = new FileReader();
            reader.onload = function(event){
                $('.image-uploader-'+dataKey).attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
            return;
        }else{
            toastr.error('Accept image format must be jpg, jpeg, png!', 'Error!', {
                timeOut: '4000',
            });
            return;
        }
    }
})

$(document).on('click', '.upload__img-close', function (e) {
    var file = $(this).parent().data('file')
    for (var i = 0; i < imgArray.length; i++) {
        if (imgArray[i].name === file) {
            imgArray.splice(i, 1)
            break
        }
    }
    if($(this).closest('td').hasClass('variation-image-td')) {
        $(this).closest('td').find('.no-img').removeClass('d-none');
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
                if(response.data.productFImage == 0){
                    $('.previewFImage').hide();
                    $('.noImage').show();
                }
                if(response.data.productImages == 5){
                    var uploadCount = 5 - response.data.productImages ;
                }
                else if(response.data.productImages <= 4){
                    $('.productImagesUploader').show();
                    var uploadCount = 5 - response.data.productImages ;
                    
                }
                $('.draganddrop').html('');
                $('.draganddrop').html('<div class="input-images"></div>');
                $('.input-images').imageUploader({
                    imagesInputName: 'image[]',
                    extensions: ['.jpg', '.jpeg', '.png'],
                    mimes: ['image/jpeg', 'image/png', 'image/jpg'],
                    maxFiles: uploadCount,
                    maxSize: 2 * 1024 * 1024,
                });
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
});

$(document).on("click",".image-uploader",function() {
    $(this).closest('.upload-img-block').find('.upload__inputfile').click();
});

/* =============== ATTRIBUTE VALUE VALIDATION =============== */
$(document).on('click','.attribute-validate',function() {
    // var dataProdType = $(this).attr('data-prod-type');
    // if(dataProdType == 2){
        let count = $('.attribute-list').find('.attribute-select2').length;
        let check = firstCheck = i = 0;
        $('.attribute option').filter(function() {
            if($(this).is('[disabled]')) firstCheck++;
        });
        var attrTitle = '';
        $('.attribute-list').find('.attribute-select2').each(function() {
            i++;
            if($(this).val()){
                check++;
                i--;
            }else{
                var attrTitle = $(this).closest('.attribute-list').find('.attr-title').text();

                $(this).closest('.attribute-list').find('.varitaion-error').html('The '+ attrTitle +' field is required.');
                if(i == 1){
                    toastr.error('Please add product\'s attribute value!', 'Error!', {
                        timeOut: '4000',
                    })
                }
            }
        });

        if(count == check) {
            setTimeout(function() {
                $('.attribute-submit').click();
            }, 1000);
        }else if(firstCheck > 1 && count == firstCheck) {
            setTimeout(function() {
                $('.attribute-submit').click(); 
            }, 1000);
        }
    // }else{
    //     setTimeout(function() {
    //         // $('.attribute-submit').click();
    //     }, 1000);
    // }
});

/* === Disable cut,copy,paste === */
// $('.closePaste').bind('copy paste cut',function(e) {
$('.closePaste').bind('paste',function(e) {
    e.preventDefault();
});


$(document).on('change','.priorityAttribute',function() {
    let priorityCount = $(this).closest('.attribute-data').find('.priorityAttribute').length;
    $priorityArray = [];
    $('.attribute-data').find('.attribute-list').each(function() {
        let priority = $(this).find('.priorityAttribute').val();
        if(priority) {
            if(priority <= 0 ) {
                $(this).find('.priorityAttribute').val('1');
                $('#toast-container').remove();
                toastr.error("Please insert the priority which is greater than \"0\".");
            }
            if(priorityCount < priority) {
                $(this).find('.priorityAttribute').val('1');
                $('#toast-container').remove();
                toastr.error("You can not insert above the priority");
            }
        }
    });

});