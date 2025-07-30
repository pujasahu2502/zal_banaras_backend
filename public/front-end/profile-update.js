$(document).ready(function () {
    $('#update-user-profile').validate({
        //ignore: [],
        onfocusout: function (element) {
            this.element(element)
        },
        errorClass: 'error_validate',
        // errorElement: 'lable',
        errorPlacement: function(error, element) {
            var placement = $(element).attr('name');
            console.log($(element).attr('name'), error.text());
            if (placement) {
                $('.'+$(element).attr('name')+'-error').html(error.text());
            }
        },
    })

    $(document).on('click', '.user-profile-update', function () {
        url = $(this).attr('data-url');
        if ($('#update-user-profile').valid()) {
            $.ajax({
                url: url,
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: $('#update-user-profile').serialize(),
                beforeSend: function() {
                    $(".main-loader-page").fadeIn(300);
                },
                success: function (response) {
                    if (response.status == 'error') {
                        $.each(response.error, function (index, value) {
                            $('.' + index + '-error').html(value)
                            $('.' + index + '-error').show()
                        })
                    } else if (response.status == 'success') {
                        // error remove and hide
                        $('#update-user-profile')[0].reset();
                        //close model
                        $('.my-profile-update').html(response.output)

                        toastr.success(response.message, 'Success!', {
                            timeOut: '4000',
                        })
                        $('.error').html('')
                    }
                },
                complete: function() {
                    setTimeout(function() {
                        $('.main-loader-page').fadeOut(300)
                    }, 700)
                },
            })
        }
    })
})

//disbable submit button id there is no updation
$('form').each(function(){
    $(this).data('serialized', $(this).serialize())
}).on('change input', function(){
    $(this).find('button:button').attr('disabled', $(this).serialize() == $(this).data('serialized'));
}).find('button:button').attr('disabled', true);