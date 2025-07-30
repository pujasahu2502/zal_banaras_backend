<style type="text/css">
    .bill-ship-add {
        display: none;
    }
</style>
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="c-sidebar-nav-icon fe-icon" data-feather="users"></i>Edit Customer</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm" autocomplete="off">
                @csrf
                @method('put')
                <div class="modal-body edit-user-modal-block">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>First Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="first_name" value="{{$user->first_name ?? '' }}" id="first_name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_first_name') }}">
                                <span class="text-danger error first_name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Last Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="last_name" value="{{$user->last_name ?? '' }}" id="last_name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_last_name') }}">
                                <span class="text-danger error last_name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" value="{{$user->display_name ?? '' }}" id="username">
                                <span class="text-danger error username-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{$user->email ?? '' }}" id="email" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_email') }}">
                                <span class="text-danger error email-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Mobile Number<span class="text-danger">*</span></label>
                                <input type="number" class="form-control mobile" name="mobile" value="{{$user->mobile ?? '' }}" id="mobile" data-rule-required="true" data-rule-minlength="8" data-rule-maxlength="13" data-msg-required="{{ __('required_mobile') }}">
                                <span class="text-danger error mobile-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control alpha form-select" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('category_status') }}">
                                <option selected disabled>Select Status</option>
                                <option value="1" {{ ($user['status'])==1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ ($user['status'])==0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <span class="text-danger error status-error"></span>
                            </div>
                        </div>
                    </div>
                    <!-- PROFILE -->
                    {{-- <div class="card edit-inner-card mb-3">
                        <div class="row">
                            <span class="mb-2" style="font-size: 18px; font-weight: 600; color: #f16e22;">Profile</span>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>First Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="first_name" value="{{$user->first_name ?? '' }}" id="first_name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_first_name') }}">
                                    <span class="text-danger error first_name-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Last Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="last_name" value="{{$user->last_name ?? '' }}" id="last_name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_last_name') }}">
                                    <span class="text-danger error last_name-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Username<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="username" value="{{$user->display_name ?? '' }}" id="username" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="100" data-msg-required="{{ __('required_username') }}">
                                    <span class="text-danger error username-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{$user->email ?? '' }}" id="email" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_email') }}">
                                    <span class="text-danger error email-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Mobile Number<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="mobile" value="{{$user->mobile ?? '' }}" id="mobile" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="13" data-msg-required="{{ __('required_mobile') }}">
                                    <span class="text-danger error mobile-error"></span>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <!-- BILLING ADDRESS -->
                    <div class="card edit-inner-card mb-3">
                        <div class="row">
                            <span class="mb-2" style="font-size: 18px; font-weight: 600; color: #f16e22;">Billing Address</span>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>First Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="billing_first_name" value="{{$user->billingaddress->first_name ?? $user->first_name }}" id="billing_first_name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_billing_first_name') }}">
                                    <span class="text-danger error billing_first_name-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>Last Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="billing_last_name" value="{{$user->billingaddress->last_name ?? $user->last_name }}" id="billing_last_name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_billing_last_name') }}">
                                    <span class="text-danger error billing_last_name-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>Email<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="billing_email" value="{{$user->billingaddress->email ?? $user->email }}" id="billing_email" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_billing_email') }}">
                                    <span class="text-danger error billing_email-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" class="form-control" name="billing_company_name" value="{{$user->billingaddress->company_name ?? '' }}" id="billing_company_name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>Mobile Number<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="billing_mobile" value="{{$user->billingaddress->mobile ?? $user->mobile }}" id="billing_mobile" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="13" data-msg-required="{{ __('required_billing_mobile') }}">
                                    <span class="text-danger error billing_mobile-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>Street Address<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="billing_address" value="{{$user->billingaddress->address ?? '' }}" id="billing_address" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="100" data-msg-required="{{ __('required_billing_address') }}">
                                    <span class="text-danger error billing_address-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>Country<span class="text-danger">*</span></label>
                                    <select class="form-control alpha form-select" name="billing_country" id="billing_country" data-rule-required="true" data-msg-required="{{ __('required_billing_country') }}">
                                        <option selected disabled>Select Country</option>
                                        <option value="United State" selected>United State (US)</option>
                                    </select>
                                    <span class="text-danger error billing_country-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>State<span class="text-danger ">*</span></label>
                                    <select class="form-control alpha form-select" name="billing_state" id="billing_state" data-rule-required="true" data-msg-required="{{ __('required_billing_state') }}">
                                        <option selected disabled>Select State</option>
                                        @forelse($states as $billingStateKey => $billingStateVal)
                                        <option value="{{ $billingStateVal ?? '' }}" {{ ((isset($user->billingaddress->state)) && ($billingStateVal == $user->billingaddress->state)) ? 'selected' : '' }}>{{ $billingStateVal ?? '' }}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                    <span class="text-danger error billing_state-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>Town/City<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="billing_city" value="{{$user->billingaddress->city ?? '' }}" id="billing_city" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_billing_city') }}">
                                    <span class="text-danger error billing_city-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>Zipcode<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="billing_zipcode" value="{{$user->billingaddress->zipcode ?? '' }}" id="billing_zipcode" data-rule-required="true" data-rule-minlength="5" data-rule-maxlength="6" data-msg-required="{{ __('required_billing_zipcode') }}">
                                    <span class="text-danger error billing_zipcode-error"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SHIPPING -->
                    <div class="card edit-inner-card mb-3">
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size: 18px; font-weight: 600; color: #f16e22;">Shipping Address</span>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <div class="form-check">
                                    <input type="checkbox" name="same_address" id="same_address" class="same_address form-check-input" value="1" {{ ($user->address_status == '1') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckChecked">Same As Billing Address</label>
                                </div>
                            </div>
                        </div>

                        <!-- SHIPPING ADDRESS -->
                        <div class="show-hide-ship-add mt-2 {{ ($user->address_status == '1') ? 'bill-ship-add' : '' }}">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label>First Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="shipping_first_name" value="{{$user->shippingaddress->first_name ?? $user->first_name }}" id="shipping_first_name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_shipping_first_name') }}">
                                        <span class="text-danger error shipping_first_name-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label>Last Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="shipping_last_name" value="{{$user->shippingaddress->last_name ?? $user->last_name }}" id="shipping_last_name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_shipping_last_name') }}">
                                        <span class="text-danger error shipping_last_name-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label>Email<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="shipping_email" value="{{$user->shippingaddress->email ?? $user->email }}" id="shipping_email" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_shipping_email') }}">
                                        <span class="text-danger error shipping_email-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text" class="form-control" name="shipping_company_name" value="{{$user->shippingaddress->company_name ?? ''}}" id="shipping_company_name">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label>Mobile Number<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="shipping_mobile" value="{{$user->shippingaddress->mobile ?? $user->mobile }}" id="shipping_mobile" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="13" data-msg-required="{{ __('required_shipping_mobile') }}">
                                        <span class="text-danger error shipping_mobile-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label>Street Address<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="shipping_address" value="{{$user->shippingaddress->address ?? '' }}" id="shipping_address" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="100" data-msg-required="{{ __('required_shipping_address') }}">
                                        <span class="text-danger error shipping_address-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label>Country<span class="text-danger">*</span></label>
                                        <select class="form-control alpha form-select" name="shipping_country" id="shipping_country" data-rule-required="true" data-msg-required="{{ __('required_shipping_country') }}">
                                            <option disabled>Select Country</option>
                                            <option value="United State">United State (US)</option>
                                        </select>
                                        <span class="text-danger error shipping_country-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label>State<span class="text-danger ">*</span></label>
                                        <select class="form-control alpha form-select" name="shipping_state" id="shipping_state" data-rule-required="true" data-msg-required="{{ __('required_shipping_state') }}">
                                            <option value="" selected disabled>Select State</option>
                                            @forelse($states as $shippingStateKey => $shippingStateVal)
                                            <option value="{{ $shippingStateVal ?? '' }}" {{ ((isset($user->shippingaddress->state)) && ($shippingStateVal == $user->shippingaddress->state)) ? 'selected' : '' }}>{{ $shippingStateVal ?? '' }}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                        <span class="text-danger error shipping_state-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label>Town/City<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="shipping_city" value="{{$user->shippingaddress->city ?? '' }}" id="shipping_city" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="40" data-msg-required="{{ __('required_shipping_city') }}">
                                        <span class="text-danger error shipping_city-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label>Zipcode<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="shipping_zipcode" value="{{$user->shippingaddress->zipcode ?? '' }}" id="shipping_zipcode" data-rule-required="true" data-rule-minlength="5" data-rule-maxlength="6" data-msg-required="{{ __('required_shipping_zipcode') }}">
                                        <span class="text-danger error shipping_zipcode-error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{$user->id ?? '' }}">
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" data-url="{{route('customer.update',$user['id'])}}" class="btn btn-primary common-btn update-user">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#same_address').click(function() {
            $('#shipping_first_name').val('');
            $('#shipping_last_name').val('');
            $('#shipping_company_name').val('');
            $('#shipping_email').val('');
            $('#shipping_mobile').val('');
            $('#shipping_country').val('');
            $("#shipping_country option[value='United State']").attr('selected', true)
            $('#shipping_address').val('');
            $('#shipping_state').val('');
            $("#shipping_state option[value='']").attr('selected', true)
            $('#shipping_city').val('');
            $('#shipping_zipcode').val('');

            if ($(this).is(':checked'))
                $('.show-hide-ship-add').css('display', 'none');
            else
                $('.show-hide-ship-add').css('display', 'block');
        });
    });
</script>