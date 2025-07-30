<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}} | {{$title ?? ''}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta   name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta property="og:image" content="{{ asset('front-end/assets/image/new-white-logo.png') }}">
    <meta property="og:" content="{{ asset('front-end/assets/image/new-white-logo.png') }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
    <!-- added meta to show product description and product seo -->
    <meta name="{{ $name ?? 'DNZ Product' }}" content="{{ $description ?? 'The Reef Reaper is designed to be bent if you cannot work it free'}}"/>
    <!-- end meta tag here -->
    <!-- fav icon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/new-logo.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('front-end/assets/css/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/animate.min.css') }}">

    <!-- single-product-magic-slider cdn-->
    <link href="{{ asset('front-end/assets/css/image-zoom-plugin.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('front-end/assets/css/image-zoom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('front-end/assets/css/image-zoom-responsive.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('front-end/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/slick.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Toaster cdn-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- css Files -->
    
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/custom.css') }}">
    <!-- sweet alert -->
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
</head>

<body class="dark-theme">
    <div class="main-loader-page">
        <div class="loader">
            <svg class="circular">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <main>
        <!-- Header include   -->
        @include('frontend.layouts.include.header')
        
        <!-- Main page   -->
        @yield('content')
        <!-- footer include   -->

        @include('frontend.layouts.include.footer')
        
    </main>

    <!-- Login sign up models   -->
    @include('frontend.auth.forgot-password')
    @include('frontend.auth.login')
    @include('frontend.auth.sign-up')
    <!-- All Java scripts   -->

    @include('frontend.layouts.include.script')

    <script>
          //Login form validation
          $('#loginForm').validate({
            onfocusout: function (element) {
                this.element(element)
            },
            errorClass: 'error_validate',
            // errorElement: 'span',
        });

        $(document).on("focus","input",function() {
            $(this).closest(".form-group").find('.error').html(' ');
        })

        $(document).ready(function() {
            toastr.options.timeOut = 4000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get("error") }}', 'Error!',{
                positionClass: 'toast-bottom-right'
            });
            @elseif(Session::has('success'))
                toastr.success('{{ Session::get("success") }}', 'Success!',{
                positionClass: 'toast-bottom-right'
            });
            @endif
        });
    </script>
</body>
</html>
