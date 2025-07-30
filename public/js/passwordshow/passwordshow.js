   function currentPassword() {
      var x = document.getElementById("current-password");
      if (x.type === "password") {
        x.type = "text";
        $('#eye-current-password').attr('data-feather', 'eye');
      } else {
        x.type = "password";
        $('#eye-current-password').attr('data-feather', 'eye-off');
      }
      feather.replace();
    }
    // function passwordShow() {
    //   var x = document.getElementById("password");
    //   if (x.type === "password") {
    //     x.type = "text";
    //    $('#pass-eye').attr('data-feather', 'eye-off');
    //   } else {
    //     x.type = "password";
    //     $('#pass-eye').attr('data-feather', 'eye');
    //   }
    //   feather.replace();
    // }
    function passwordConfirm() {
      var x = document.getElementById("password-confirm");
      if (x.type === "password") {
        x.type = "text";
       $('#pass-eye-confirm').attr('data-feather', 'eye');
      } else {
        x.type = "password";
        $('#pass-eye-confirm').attr('data-feather', 'eye-off');
      }
      feather.replace();
    }

    function passwordShow(ele) {
      let formId = $(ele).closest("form").attr('id');
      let element = $(ele).closest('#'+formId);
      var type = element.find("#password").attr("type");
      if (type === "password") {
        element.find("#password").attr("type","text")
        element.find('#pass-eye').attr('data-feather', 'eye');
      } else {
       
        element.find("#password").attr("type","password")
        element.find('#pass-eye').attr('data-feather', 'eye-off');
      }
      feather.replace();
    }