@extends('auth.layouts.base_auth')
@section('content')
    <div class="bg-dark min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Register') }}</div>
                         <div class="card-body">
                            <form method="POST" action="{{ route('register') }}" id="registerForm"> 
                                @csrf

                                <div class="row mb-3">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input id="first_name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="first_name"
                                            value="{{ old('first_name') }}"  data-rule-required="true" data-msg-required="{{ __('required_first_name') }}" autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input id="last_name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="last_name"
                                            value="{{ old('last_name') }}" data-msg-required="{{ __('required_last_name') }}"  data-rule-required="true" autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}<span class="text-danger">*</span></label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" data-rule-required="true" data-msg-required="{{ __('required_email') }}" data-rule-email="true" autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Password') }}<span class="text-danger">*</span></label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" data-rule-required="true" data-msg-required="{{ __('required_password') }}" id="password" name="password"
                                             autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}<span class="text-danger">*</span></label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" data-rule-required="true" data-msg-required="{{ __('required_confirm_password') }}" data-msg-equalto="{{__('confirm_password_match')}}" data-rule-equalto="#password" class="form-control"
                                            name="password_confirmation"  autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection