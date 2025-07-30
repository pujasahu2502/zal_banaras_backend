<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.1
* @link https://coreui.io
* Copyright (c) 2022 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    
    <title>{{config('app.name')}}</title>

    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/new-logo.png')}}">
    {{-- <link rel="manifest" href="{{asset('assets/favicon/manifest.json')}}"> --}}
    <meta name="msapplication-TileColor" content="#ffffff">
    {{-- <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png"> --}}
    <meta name="theme-color" content="#ffffff">
    
    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{asset('vendors/simplebar/css/simplebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendors/simplebar.css')}}">
    <!-- Main styles for this application-->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="{{asset('css/examples.css')}}" rel="stylesheet">
    <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
</head>
<body>
    
    @yield('content')
    
    <!-- CoreUI and necessary plugins-->
    <script src="{{asset('vendors/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
    <script src="{{asset('vendors/simplebar/js/simplebar.min.js')}}"></script>
    <!-- <script src="{{asset('assets/backend/genral.js')}}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.js" integrity="sha512-0hV9FhQc44B5NIfBhQFNBTXrrasLwG6SVxbRiaO7g6962sZV/As4btFdLxXn+brwH7feEg3+AoyQxZQaArEjVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // Register form validation
        $('#registerForm').validate();

        //Login form validation
        $('#loginForm').validate({
            onfocusout: function (element) {
                this.element(element)
            },
            // errorClass: 'error_validate',
            errorElement: 'span',
        });

        $(document).on("focus","input",function() {
            $(this).closest(".form-group").find('.error').html(' ');
        })

        // password reset validation
        $('#passwordReset').validate();

        $(document).ready(function() {
            toastr.options.timeOut = 4000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get("error") }}', 'Error!');
            @elseif(Session::has('success'))
                toastr.success('{{ Session::get("success") }}', 'Success!');
            @endif
        });
    </script>
       <script>
        feather.replace();
     </script>
</body>
</html>