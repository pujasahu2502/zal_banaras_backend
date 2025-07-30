@extends('frontend.pages.dashboard.user-base', ['title' => 'Change Password' ])
@section('user-section')
<div class="card">
    <div class="card-header custom-card-header">
        <h5 class="d-flex align-items-center"><span class="arrow-icon"><i data-feather="lock" class="feather mr-2"></i></span> Change Password</h5>
    </div>
    <div class="p-3">
        <form method="POST" id="change-password-form" action="{{ route('user-change-password.store') }}" autocomplete="off" id="changePasssword" class="common-form-design">
            @csrf
            <div class="examAlertMsg"></div>
            <div class="change-password-block">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">{{ __('old_password') }}<span class="text-danger">*</span>
                                    </label>
                                    <input id="current-password" type="password" class="form-control" name="current_password" value="{{ old('current_password') }}" data-rule-required="true" data-msg-required="{{ __('current_password') }}">
                                    <a onclick="currentPassword()"><i class="c-sidebar-nav-icon password-eye mr-2" id="eye-current-password" data-feather="eye-off"></i></a>
                                    <span class="text-danger error current_password-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">{{ __('new_password') }}<span class="text-danger">*</span>
                                    </label>
                                    <input id="password" type="password" class="form-control" name="new_password" data-rule-required="true" data-rule-minlength="8" data-rule-maxlength="20" data-msg-required="{{ __('new_password_required') }}">
                                    <a onclick="passwordShow(this)"><i class="c-sidebar-nav-icon password-eye mr-2" id="pass-eye" data-feather="eye-off"></i></a>
                                    <span class="text-danger error not_match_password-error"></span>
                                    <span class="text-danger error new_password-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">{{ __('confirm_password') }}<span class="text-danger">*</span></label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="password_confirmation" data-rule-minlength="8" data-rule-maxlength="20" data-msg-required="{{ __('confirm_password_required') }}" data-rule-required="true" data-rule-equalto="#password" data-msg-equalto="{{ __('confirm_password_match') }}">
                                    <a onclick="passwordConfirm()"><i class="c-sidebar-nav-icon password-eye mr-2" id="pass-eye-confirm" data-feather="eye-off"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group mt-4 text-center">
                                    <button type="button" data-url="{{route('user-change-password.store')}}" class="btn btn-primary user-common-btn change-password-update">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('user-javascript')
<script src="{{asset('front-end/change-password.js')}}"></script>
@endsection
<script src="{{ asset('js/passwordshow/passwordshow.js') }}"></script>