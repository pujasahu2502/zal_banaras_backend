
@extends('auth.layouts.base_auth')
@section('content')
<div class="bg-dark min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex justify-content-center pb-2"><a href="{{ route('home') }}">
                        <img src="{{ asset('assets/img/new-logo.png')}}" height="50px" style="margin-bottom: 30px" width="auto"></a>
                </div>
                <div class="card-group d-block d-md-flex row">
                    <div class="card col-md-7 p-4 mb-0">
                        <div class="text-center">
                            <span style="font-size: 32px; font-weight: 600;">{{ __('Reset Password') }}</span>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}" id="passwordReset">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token ?? '' }}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('Email Address') }}<span class="text-danger">*</span></label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" readonly autocomplete="email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('Password') }}<span class="text-danger">*</span></label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" data-rule-required="true" data-msg-required="{{ __('required_password') }}" name="password" required autocomplete="new-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('Confirm Password') }}<span class="text-danger">*</span></label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" data-rule-required="true" data-msg-required="{{ __('required_confirm_password') }}" data-rule-equalto="#password" data-msg-equalto="{{ __('confirm_password_match') }}" autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="common-link-btn pb-3">
                                            <button type="submit" class="btn btn-primary submit-btn w-100">
                                                {{ __('Reset Password') }}
                                            </button>
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