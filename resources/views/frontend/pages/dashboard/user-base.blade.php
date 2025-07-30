@extends('frontend.layouts.include.app', ['title' => $title])
@section('content')
<!-- --------Start-breadcrumb-section--------- -->
<section class="breadcrumb-bg-section faq-bg-section">
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    {{-- {{dd(request()->segments())}} --}}
                    {{-- <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Dashboard</a></li> --}}

                    {{-- <li class="breadcrumb-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </li> --}}
                    <li class="breadcrumb-item active">
                        @isset($titleUrl)
                            <a href="{{$titleUrl}}" >
                        @endisset
                        {{$title ?? ''}}
                        @isset($titleUrl)
                            </a>
                        @endisset
                    </li>
                    @if(isset($subtitle) && $subtitle)
                        <li class="breadcrumb-arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </li>

                        <li class="breadcrumb-item active">{{$subtitle ?? ''}}</li>
                    @endif

                </ol>
            </nav>
        </div>
        {{-- <div class="breadcrumb-bg-block mb-3">
            <h4>{{   : $title ?? ''}}</h4>
        </div> --}}
    </div>
  </section>
  <!-- --------End-breadcrumb-section--------- -->
<section class="user-dashboard mt-3 mb-3">
    <div class="container">
        <div class="dashboard-wrap">
                <div class="row">
                    @include('frontend.pages.dashboard.include.sidebar') 
                    <!-- MAIN -->
                    <div class="col-md-9">
                        @yield('user-section')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('javascript')
    @yield('user-javascript')
@endsection