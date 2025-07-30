<div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content common-modal-popup">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="c-sidebar-nav-icon ml-2" data-feather="lock"></i> Change Password</h5>
                <button type="button" class="btn-close close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="change-password-form" action="{{ route('change-password.store') }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>{{ __('old_password') }}<span class="text-danger">*</span> </label>
                                <input id="current-password" type="password"  class="form-control show" name="current_password" value="{{ old('current_password') }}" data-rule-required="true" data-msg-required="{{ __('required_current_password') }}">
                                <a onclick="currentPassword()"><i class="c-sidebar-nav-icon password-eye mr-2" id="eye-current-password" data-feather="eye-off"></i></a>
                                <span class="text-danger error current_password-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>{{ __('new_password') }}<span class="text-danger">*</span></label>
                                <input id="password" type="password" class="form-control" name="new_password" data-rule-required="true" data-msg-required="{{ __('required_new_password') }}">
                                <a onclick="passwordShow(this)"><i class="c-sidebar-nav-icon password-eye mr-2" id="pass-eye" data-feather="eye-off"></i></a>
                                <span class="text-danger error not_match_password-error"></span>
                                <span class="text-danger error new_password-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12" >
                            <div class="form-group">
                                <label>{{ __('confirm_password') }}<span class="text-danger">*</span></label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="password_confirmation" data-msg-required="{{ __('required_confirm_password') }}" data-rule-required="true" data-rule-equalto="#password" data-msg-equalto="{{ __('confirm_password_match') }}">
                                <a onclick="passwordConfirm()" ><i class="c-sidebar-nav-icon password-eye mr-2" id="pass-eye-confirm" data-feather="eye-off"></i></a>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary common-btn change-password-update">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/passwordshow/passwordshow.js') }}"></script>


