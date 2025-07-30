<form method="post" id="update-user-profile" class="common-form-design">
    @csrf
    <div class="order-address-block">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="form-label">First Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control alpha" value="{{ $userData->first_name }}" data-rule-required="true" data-rule-maxlength="20" data-msg-required="{{ __('required_first_name') }}" name="first_name" value="" autocomplete="off">
                            <span class="text-danger error first_name-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="form-label">Last Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control alpha" value="{{ $userData->last_name }}" data-rule-required="true" data-rule-maxlength="20" data-msg-required="{{ __('required_last_name') }}" name="last_name" autocomplete="off">
                            <span class="text-danger error last_name-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="form-label">Mobile Number<span class="text-danger">*</span></label>
                            <input type="number" min="0" data-rule-digits="true" data-rule-maxlength="14" data-rule-minlength="8" class="form-control mobile" value="{{ $userData->mobile }}" data-rule-required="true" data-msg-required="{{ __('required_mobile') }}" name="mobile" autocomplete="off">
                            <span class="text-danger error mobile-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <label class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" name="email" autocomplete="off" data-rule-required="true" data-rule-email="true" data-msg-required="{{ __('required_email') }}" class="form-control" value="{{ $userData->email }}">
                        <span class="text-danger error email-error"></span>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="col-lg-12 col-sm-12 col-12 text-center">
                        <button class="btn btn-primary user-common-btn user-profile-update mb-3" data-url="{{ route('dashboard.myprofile.update') }}" type="button">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>