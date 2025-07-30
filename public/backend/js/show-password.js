
     $("#pass-eye" ).on("click", function() {
        let input = $('#password');
        if( input.attr('type') == 'password'){
            passwordShow(input,$(this));
        }else{
            passwordHide(input,$(this))
        }
     });
     $("#pass-current-eye" ).on("click", function() {
        let input = $('#current-password');
        if( input.attr('type') == 'password'){
            passwordShow(input,$(this));
        }else{
            passwordHide(input,$(this))
        }
     });

     $("#pass-confirm-eye" ).on("click", function() {
        let input = $('#password-confirm');
        if( input.attr('type') == 'password'){
            passwordShow(input,$(this));
        }else{
            passwordHide(input,$(this))
        }
     });


     function passwordShow(input,id){
        input.attr('type', 'text');
            id.addClass('fa-eye');
            id.removeClass('fa-eye-slash');
     }
     function passwordHide(input,id){
        input.attr('type', 'password'); 
        id.addClass('fa-eye-slash');
        id.removeClass('fa-eye');
     }