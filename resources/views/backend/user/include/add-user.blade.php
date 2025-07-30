<div class="modal fade modal-create" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="c-sidebar-nav-icon fe-icon" data-feather="users"></i>Add Customer</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUserForm" autocomplete="off">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>First Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="first_name" id="first_name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_first_name') }}">
                                <span class="text-danger error first_name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Last Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="last_name" id="last_name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_last_name') }}">
                                <span class="text-danger error last_name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" id="username">
                                <span class="text-danger error username-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_email') }}">
                                <span class="text-danger error email-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Mobile Number<span class="text-danger">*</span></label>
                                <input type="number" class="form-control mobile" name="mobile" id="mobile" data-rule-required="true" data-rule-minlength="8" data-rule-maxlength="13" data-msg-required="{{ __('required_mobile') }}">
                                <span class="text-danger error mobile-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control alpha form-select status" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('required_category_status') }}">
                                    <option disabled>Select Status</option>
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span class="text-danger error status-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <span style="color:#F16E22;"><b>Note: </b>A password will be sent to the registered email of the customer.</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" data-url="{{route('customer.store')}}" class="btn btn-primary common-btn save-user">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>