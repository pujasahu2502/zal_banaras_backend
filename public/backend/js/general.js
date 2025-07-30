var modelRender = function(output,instance) {
    $('.admin-model-render').html(output);
    $(instance).modal('show');
    feather.replace();
}

/* Accept Only Alphabet */
function testInput(event) {
    var value = String.fromCharCode(event.which);
    var pattern = new RegExp(/[a-zåäö ]/i);
    return pattern.test(value);
}
$(document).on('keypress','.alpha',testInput);

function tooltipInitialize() {
    // $("table tr").tooltip({ selector: '[data-toggle="tooltip"]' });
    $('[data-toggle="tooltip"]').tooltip({placement: "bottom"});
}

function renderSelect2(attribute,name) {
    $(attribute).select2({
        // dropdownParent: $('#listningModal'),
        dropdownParent: $('.modal'),
        width: '100%',
        containerCssClass: 'form-control',
        dropdownCssClass:'increasezindex',
        language: {
            noResults: function () {
                return 'No '+(name.toLowerCase())+' found';
            },
        },
    }).on("select2:close", function (e) {  
        if($(this).val()) $(this).closest('.form-group').find('.error').html(" "); 
    });
}

function renderSelect2withoutModal(attribute,name) {
    $(attribute).select2({
        // dropdownParent: $('#listningModal'),
        // dropdownParent: $('.modal'),
        placeholder: "Select "+name,
        width: '100%',
        containerCssClass: 'form-control',
        dropdownCssClass:'increasezindex',
        language: {
            noResults: function () {
                return 'No '+(name)+' found';
            },
        },
    }).on("select2:close", function (e) {  
        if($(this).val()) $(this).closest('.form-group').find('.error').html(" "); 
    });
}

//Remove error on runtime 
$(document).on("focus","input, select, textarea",function() {
    if($(this).closest(".form-group,.required-field-block").find('.error').length) {
        $(this).closest(".form-group,.required-field-block").find('.error').html(' ');
    }
})


// Remove Error on select change
$(document).on("change","select",function() {
    $(this).closest('.form-group').find('.error').html('');
}); 


/* Jquery For Amount */
$(document).on('keypress',".amount",function(event){
    var number = ($(this).val().split('.'));
    if(number[0].length > 5){
        event.preventDefault();
        return false;
    }
});

/* After last two digit */
$(document).on('blur',".amount",function(){
    var number = ($(this).val().split('.'));
    if(!$(this).val()) {
        return false;
    }
    if (number.length == 2){
        var salary = parseFloat($(this).val());
        $(this).val(salary.toFixed(2));
    } else{
        var salary = parseFloat($(this).val());
        $(this).val( salary.toFixed(2));

    }
});

/* Mobile Validation */ 
$(document).on('keypress',".mobile",function(event){
    var number = ($(this).val());
    if(number.length > 11){
        event.preventDefault();
        return false;
    }
});


/* Card Validation */ 
$(document).on('keypress',".card_number,.cvc",function(event){
    var number = ($(this).val());
    var validateLength = $(this).hasClass('cvc') ? 5 : 20;
    if(number.length > validateLength){
        event.preventDefault();
        return false;
    }
});


/* Accept Numeric and Decimal Value */ 
$(document).on('keypress','.numberonly',function (e) {
    var charCode = (e.which) ? e.which : event.keyCode
    if (String.fromCharCode(charCode).match(/[^0-9.+-]/g))    
    return false;
});

$(document).on('keypress','.number-data',function (e) {
    var charCode = (e.which) ? e.which : event.keyCode
    if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    return false;
});



/* Name Validation */ 
$(document).on('keypress',".product-name",function(event){
    var name = ($(this).val().split('.'));
    if(name[0].length > 99){
        event.preventDefault();
        return false;
    }
});

/* SKU Validation */ 
$(document).on('keypress',".sku-name",function(event){
    var name = ($(this).val().split('.'));
    if(name[0].length > 49){
        event.preventDefault();
        return false;
    }
});

/* === Disable cut,copy,paste === */
$(document).ready(function(){
    // $('.closePaste').bind('copy paste cut',function(e) {
    $('.closePaste').bind('paste',function(e) {
        e.preventDefault();
    });
});
