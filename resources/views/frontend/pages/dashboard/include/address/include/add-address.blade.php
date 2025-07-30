<div class="order-address-block new-address-block">
    <div class="card-header custom-card-header pl-3">
        <h5 class="text-uppercase mb-0">
            <span class="arrow-icon"><i data-feather="map-pin" class="feather mr-2"></i></span>
            {{isset($address) ? 'Edit' : 'Add'}}  address
        </h5>
    </div>
    <div class="form-block order-address-block mt-4">
        <form autocomplete="off" id="address-add-form" class="common-form-design">
            @csrf
            @method(isset($address) ? 'put' :'post')
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="firstname">First Name <span class="danger">*</span></label>
                        <input type="text" class="form-control alpha first_name" value="{{isset($address) ? $address->first_name : ''}}" id="first_name" name="first_name" data-rule-required="true" data-msg-required="{{ __('required_first_name') }}" data-rule-minLength="2" data-rule-maxLength="20" aria-required="true">
                        <span class="text-danger error first_name-errors"></span>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="lastname">Last Name <span class="danger">*</span></label>
                        <input type="text" class="form-control alpha last_name" id="last_name" name="last_name" value="{{isset($address) ? $address->last_name : ''}}" data-rule-required="true" data-msg-required="{{ __('required_last_name') }}" data-rule-minLength="2" data-rule-maxLength="20" aria-required="true">
                        <span class="text-danger error last_name-errors"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="email">Email Address <span class="danger">*</span></label>
                        <input type="email" class="form-control email" name="email" id="email" value="{{isset($address) ? $address->email : ''}}" data-rule-required="true" data-msg-required="{{ __('required_cantact_email') }}" data-rule-minLength="2" data-rule-maxLength="60" aria-required="true">
                        <span class="text-danger error email-errors"></span>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="phonenumber">Mobile Number <span class="danger">*</span></label>
                        <input type="number" class="form-control mobile mobile_number" name="mobile_number" id="mobile_number" value="{{isset($address) ? $address->mobile : ''}}" data-rule-required="true" data-rule-minLength="10" data-rule-number="true" data-rule-maxLength="13" data-msg-required="{{ __('required_mobile') }}" aria-required="true" value="78433568653">
                        <span class="text-danger error mobile_number-errors"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="apartment">Apartment, suit, Unit, etc. [optional] </label>
                        <input type="text" class="form-control" id="" aria-describedby="" placeholder="">
                    </div>
                </div> -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="street-address">Address <span class="danger">*</span></label>
                        <input type="text" class="form-control address" name="address" id="address" value="{{isset($address) ? $address->address : ''}}" data-rule-required="true" data-rule-minLength="2" data-rule-maxLength="100" data-msg-required="{{ __('required_address') }}" aria-required="true">
                        <span class="text-danger error address-errors"></span>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="town-city">Town / City <span class="danger">*</span></label>
                        <input type="text" class="form-control city" name="city" id="city" data-rule-required="true" value="{{isset($address) ? $address->city : ''}}" data-msg-required="{{ __('required_city') }}" data-rule-minLength="2" data-rule-maxLength="50" aria-required="true">
                        <span class="text-danger error city-errors"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="town-city">Town / City <span class="danger">*</span></label>
                        <input type="text" class="form-control" id="" aria-describedby="" placeholder="">
                    </div>
                </div> -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="product-wrap">
                            <label for="select2-multiple-input-sm" class="control-label w-100">State <span class="danger">*</span></label>
                            <select id="select2-multiple-input-sm" class="form-control input-sm select2-multiple filed-select state" data-rule-required="true" data-msg-required="{{ __('required_state') }}" name="state">
                            <option disabled>Select State</option>
                            @foreach (getUsState() as $key => $state )
                                <option value="{{$state}}" {{isset($address) ? ($address->state == $state  ? 'selected' : ' ') : ' '}} >{{ $state }}</option>
                            @endforeach
                            </select>
                            <span class="text-danger error state-errors"></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="zipcode">Zip Code <span class="danger">*</span></label>
                        <input type="text" class="form-control zipcode" id="zipcode" value="{{isset($address) ? $address->zipcode : ' '}}" data-rule-required="true" data-rule-minlength="5" data-rule-maxlength="10" data-msg-required="{{ __('required_zipcode') }}" name="zipcode">
                        <span class="text-danger error zipcode-errors"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="default_address" class="form-check-input" value="1" id="default_address"{{isset($address) ? ($address->default_address == '1' ? 'checked' : ' ' ) : ' '}}>
                            <label class="form-check-label" for="default_address"> Set as default address</label>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label for="zipcode">Zip Code <span class="danger">*</span></label>
                        <input type="number" class="form-control" id="" aria-describedby="" placeholder="">
                    </div>
                </div> -->
                <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label for="phonenumber">Phone Number <span class="danger">*</span></label>
                        <input type="number" class="form-control" id="" aria-describedby="" placeholder="">
                    </div>
                </div> -->
                <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label for="email">Email Address <span class="danger">*</span></label>
                        <input type="email" class="form-control" id="" aria-describedby="" placeholder="">
                    </div>
                </div> -->
            </div>
            <button type="button" class="btn-primary contact-btn" data-url="{{isset($address) ? route('address.update',$address->id) : route('address.store') }}" data-id="{{isset($address) ? $address->id : ' '}}" data-addressUrl="{{ route('address.index') }}">SAVE ADDRESS</button>
        </form>
    </div>
</div>