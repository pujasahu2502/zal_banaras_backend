@extends('auth.layouts.base_auth')
@section('content')
<div class="bg-dark min-vh-100 d-flex flex-row align-items-center auth-modal-popup common-modal-popup">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="logo-block d-flex justify-content-center pb-2">
                    <a href="{{route('admin.login')}}">
                        <img src="{{ asset('assets/img/new-logo.png')}}" height="auto" style="margin-bottom: 30px" width="auto">
                    </a>
                </div>
                <div class="card-group d-block d-md-flex row">
                    <div class="card col-md-7">
                        <div class="card-body">
                            <div class="text-center">
                                <span style="font-size: 32px; font-weight: 600;">Sign In</span>
                            </div>
                            <form method="POST" id="loginForm" action="{{ route('admin-login') }}" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('email') }}<span class="text-danger">*</span></label>
                                            <input id="email" type="email" value="{{ old('email') }}" class="form-control" data-rule-required="true" data-msg-required="{{__('required_email')}}" name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="text-danger error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('password') }}<span class="text-danger">*</span></label>
                                            <input id="password" type="password" value="{{ old('password') }}" class="form-control" data-rule-required="true" data-msg-required="{{__('required_password')}}" name="password">
                                            <a onclick="passwordShow(this)"><i class="c-sidebar-nav-icon password-eye mr-2" id="pass-eye" data-feather="eye-off"></i></a>
                                            <span class="errors-password"></span>
                                            @error('password')
                                                <span class="text-danger error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <input type="hidden" name="admin_form" value="admin">
                                        <div class="common-link-btn pb-3">
                                            <button type="submit" class="btn btn-primary submit-btn w-100">{{ __('sign_in') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="{{ asset('js/passwordshow/passwordshow.js') }}"></script>
