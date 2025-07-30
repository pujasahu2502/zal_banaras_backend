<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>{{config('app.name')}} | {{$title ?? 'Dashboard'}}</title>
      <meta name="description" content="Webinar Booking">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
      <meta http-equiv="Pragma" content="no-cache" />
      <meta http-equiv="Expires" content="0" />
      
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- fav icon  -->
      <link rel="icon" type="image/x-icon" href="{{asset('assets/img/new-logo.png')}}">
      <!-- Vendors styles-->
      <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
      <!-- Main styles for this application-->
      <link href="{{asset('css/style.css')}}" rel="stylesheet">
      {{-- <link href="{{asset('css/webinar.css')}}" rel="stylesheet">--}}
      <!-- toster  -->
      <link rel="stylesheet" type="text/css"  href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
      <!-- sweet alert -->
      <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
      <!-- select two  -->
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css"/> -->
      <!-- Date picker -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css" integrity="sha512-mQ8Fj7epKOfW0M7CwuuxdPtzpmtIB5rI4rl76MSd3mm5dCYBKjzPk7EU/2buhPMs0KmC6YOPR/MQlQwpkdNcpQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      {{-- <link rel="stylesheet" href="{{ asset('/vendors/@coreui/icons/css/free.min.css') }}">--}}
      {{-- <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script> --}}
      <script src="{{asset('/js/ckeditor/ckeditor.js')}}"></script>

      <style>
         .ck-editor__editable {
            min-height: 150px;
            max-height: 150px;
         }
         /* Remove canvas chart creadit  */         
         .canvasjs-chart-credit{
             display: none !important;
         }
      </style>
   </head>
   <body>
      @include('backend.layouts.include.sidebar')
      <div class="wrapper d-flex flex-column min-vh-100 bg-light">
         @include('backend.layouts.include.header')
         <div class="body flex-grow-1 px-3 z">
            @yield('content')
         </div>
         <div class="side-footer d-flex justify-content-center">
            <span>{{getYear(today())}} © {{config('app.name')}}</span>
          </div>
      </div>
      <div class="loader">
         <div class='loader-spiner'></div>
      </div>
      <div class="admin-model-render"></div>
      <!-- CoreUI and necessary plugins-->
      <script src="{{ asset('vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
      {{-- <script src="https://unpkg.com/feather-icons"></script> --}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.js" integrity="sha512-0hV9FhQc44B5NIfBhQFNBTXrrasLwG6SVxbRiaO7g6962sZV/As4btFdLxXn+brwH7feEg3+AoyQxZQaArEjVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      {{-- <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script> --}}
      <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
      <!-- Include Moment.js CDN -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
      <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
      <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
      {{-- toster  --}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      {{-- show password js  --}}
      <script src="{{asset('backend/js/show-password.js')}}"></script>
      {{-- sweetalert --}}
      <script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
      <!-- select two -->
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
      <script src='{{asset("/backend/js/tooltip.js")}}'></script>
      <script src="{{ asset('backend/js/general.js') }}"></script>
      <script src="{{ asset('backend/js/change-password.js') }}"></script>
      <!-- added profile setting js -->
      <script src="{{ asset('backend/js/profile-setting.js') }}"></script>
      <!-- added setting js -->
      <script src="{{ asset('backend/js/setting.js') }}"></script>
      <script src="{{asset('assets/js/canvasjs.min.js')}}"></script>
      <script src="{{asset('assets/js/canvas.js')}}"></script>
      @yield('javascript')
      <script>
         feather.replace();
         $('.loader').css('display', 'none');

         $(document).ready(function() {
            toastr.options.timeOut = 4000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get("error") }}', 'Error!');
            @elseif(Session::has('success'))
                toastr.success('{{ Session::get("success") }}', 'Success!');
            @endif
         });
      </script>
   </body>