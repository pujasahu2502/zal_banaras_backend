<div class="modal fade" id="profileSetting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i data-feather="user"></i> Profile</h5>
                <button type="button" class="btn-close close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="profile-setting-form" action="{{ route('profile.update', Auth::guard('admin')->id()) }}" autocomplete="off" >
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="examAlertMsg"></div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="name" class="mb-2">{{ __('admin_name') }}<span class="text-danger">*</span> </label>
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ Auth::guard('admin')->user()->first_name }}" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_admin_name') }}">
                                <span class="text-danger error first_name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="name" class="mb-2">{{ __('admin_email') }}<span class="text-danger">*</span></label>
                                <input id="email" type="email" class="form-control" name="email" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_email') }}" value="{{ Auth::guard('admin')->user()->email }}">
                                <span class="text-danger error email-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary common-btn admin-profile-update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>