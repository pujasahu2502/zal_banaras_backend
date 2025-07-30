<div class="modal fade" id="adminSetting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i data-feather="settings"></i> Website Settings</h5>
                <button type="button" class="btn-close close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="admin-setting-form" action="{{ route('setting.store') }}" autocomplete="off">
                @csrf
                <input type="hidden" name="setting_id" value="1">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="product-head text-left">
                                <h5>General Information</h5>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="text" class="form-control email" name="email" value="{{$settingData->email ?? ''}}" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_email') }}">
                                <span class="text-danger error email-error"></span>
                            </div>
                            <div class="form-group">
                                <label>Mobile Number<span class="text-danger">*</span></label>
                                <input type="text" class="form-control mobile numberonly" name="mobile" value="{{$settingData->mobile ?? ''}}" data-rule-required="true" data-rule-minlength="8" data-rule-maxlength="13" data-msg-required="{{ __('required_mobile') }}">
                                <span class="text-danger error mobile-error"></span>
                            </div>
                            <div class="form-group">
                                <label>Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control address" name="address" value="{{$settingData->address ?? ''}}" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="100" data-msg-required="{{ __('required_address') }}">
                                <span class="text-danger error address-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="product-head text-left">
                                <h5>Social Links</h5>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label>Facebook</label>
                                <input type="url" class="form-control facebook" name="facebook" value="{{$settingData->facebook ?? ''}}" data-rule-required="false" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_facebook') }}">
                                <span class="text-danger error facebook-error"></span>
                            </div>
                            <div class="form-group">
                                <label>Twitter</label>
                                <input type="url" class="form-control twitter" name="twitter" value="{{$settingData->twitter ?? ''}}" data-rule-required="false" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_twitter') }}">
                                <span class="text-danger error twitter-error"></span>
                            </div>
                            <div class="form-group">
                                <label>Instagram</label>
                                <input type="url" class="form-control instagram" name="instagram" value="{{$settingData->instagram ?? ''}}" data-rule-required="false" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_instagram') }}">
                                <span class="text-danger error instagram-error"></span>
                            </div>
                            <div class="form-group">
                                <label>Linkedin</label>
                                <input type="url" class="form-control linkedin" name="linkedin" value="{{$settingData->linkedin ?? ''}}" data-rule-required="false" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_linkedin') }}">
                                <span class="text-danger error linkedin-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary common-btn admin-setting-update">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>