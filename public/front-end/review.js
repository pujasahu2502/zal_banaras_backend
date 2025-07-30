$(document).ready(function () {
    $('#review-add-form').validate({
        rules: {
            review: {
                required: true
            },
            rating: {
                required: true
            }
        },
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
})