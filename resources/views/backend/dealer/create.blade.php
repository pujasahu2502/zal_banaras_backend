<style>
.pac-container {
    z-index: 9999 !important;
    display: block ;
}
.pac-container:empty{
    display: none !important;
}    
</style>
<div class="modal fade modal-create" id="dealerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fe-icon mr-2" data-feather="user-check"></i>Add Dealer</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addDealerForm" autocomplete="off">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="product-head text-left">
                        <h5>Personal Information</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group dealer-input">
                                <label>Dealer Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control title" name="title" id="title" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="100" data-msg-required="{{ __('required_dealer_title') }}">
                                <span class="text-danger error title-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group dealer-input">
                                <label>Email</label>
                                <input type="email" class="form-control email" name="email" id="email" data-rule-minlength="2" data-rule-maxlength="40" data-rule-email="true">
                                <span class="text-danger error email-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group dealer-input">
                                <label>Mobile Number</label>
                                <input type="number" class="form-control phone mobile" name="phone" id="phone" data-rule-number="true">
                                <span class="text-danger error phone-error"></span>
                            </div>
                            <div class="form-group dealer-input">
                                <label>Website URL</label>
                                <input type="text" class="form-control website_url" name="website_url" id="website_url" data-rule-url="true" data-rule-maxlength="150">
                                <span class="text-danger error website_url-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <div class="upload__btn-box d-none">
                                    <label data-toggle="tooltip" data-placement="top" title="Choose Dealer Image" class="upload__btn">
                                        <input type='file' name="image" id="image" class="upload__inputfile" data-count="0" data-check="create" accept=".png, .jpg, .jpeg">
                                    </label>
                                </div>
                                <span class="text-danger error file-error"></span>
                                <label for="" class="upload__img-wrap d-none w-10">Dealer Image Preview</label>
                                <div class="dealer-image upload__img-wrap d-none"></div>
                                <label class="no-img">Upload Dealer Image <span data-coreui-placement="right" data-toggle="tooltip" title="Note: Image size should be less than 2 MB and Accepted image format must be jpg, jpeg, png."><i data-feather="info"></i></span></label>
                                <div class="no-img">
                                    <img src="{{asset('backend/no-img.png')}}" alt="" class="image-uploader">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group dealer-input">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control form-select status" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('required_dealer_status') }}">
                                    <option  disabled>Select Status</option>
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span class="text-danger error status-error"></span>
                            </div>
                        </div>
                        <div class="product-head text-left">
                            <h5>Dealer Address <span data-coreui-placement="right" data-toggle="tooltip" title="Note: Auto suggest functionality is included in the address field, when you type some words of your address, you will get address suggestions."><i class="fe-icon mr-2" data-feather="info"></i></span></h5>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group dealer-input">
                                <label>Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control address" name="address" id="address" data-rule-required="true" data-rule-maxlength="100" data-msg-required="{{ __('required_dealer_address') }}">
                                <span class="text-danger error address-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group dealer-input">
                                <label>City<span class="text-danger">*</span></label>
                                <input type="text" class="form-control city" name="city" id="city" readonly>
                                <span class="text-danger error city-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group dealer-input">
                                <label>State<span class="text-danger">*</span></label>
                                <input type="text" class="form-control state" name="state" id="state" readonly>
                                <span class="text-danger error state-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group dealer-input">
                                <label>Country<span class="text-danger">*</span></label>
                                <input type="text" class="form-control country" name="country" id="country" readonly>
                                <span class="text-danger error country-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group dealer-input">
                                <label>Zip Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control zipcode" name="zipcode" id="zipcode" readonly>
                                <span class="text-danger error zipcode-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group dealer-input">
                                <label>Latitude<span class="text-danger">*</span></label>
                                <input type="text" class="form-control latitude numberonly" name="latitude" id="latitude" readonly>
                                <span class="text-danger error latitude-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group dealer-input">
                                <label>Longitude<span class="text-danger">*</span></label>
                                <input type="text" class="form-control longitude numberonly" name="longitude" id="longitude" readonly>
                                <span class="text-danger error longitude-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" data-url="{{ route('dealer.store') }}" class="btn btn-primary  common-btn save-dealer">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMrWXO51jXwNqkHv6BOaWEi8JUNuBGw4k&libraries=places&callback=initMap" async defer></script>
<script>
    function initMap() {
        var options = {
            componentRestrictions: {country: "us"}
        };
        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input,options);
        autocomplete.addListener('place_changed', function() {

            var place = autocomplete.getPlace();
            const city = place.address_components.filter(f => JSON.stringify(f.types) === JSON.stringify(['locality', 'political']))[0].short_name;
            const state = place.address_components.filter(f => JSON.stringify(f.types) === JSON.stringify(['administrative_area_level_1', 'political']))[0].short_name;
            const displayCity = place.address_components.filter(f => JSON.stringify(f.types) === JSON.stringify(['locality', 'political']))[0].long_name;
            const displayState = place.address_components.filter(f => JSON.stringify(f.types) === JSON.stringify(['administrative_area_level_1', 'political']))[0].long_name;
            const country = place.address_components.filter(f => JSON.stringify(f.types) === JSON.stringify(['country', 'political']))[0].long_name;
            const postalcode = place.address_components.filter(f => JSON.stringify(f.types) === JSON.stringify(['postal_code']))[0].long_name;
            const lat = place.geometry.location.lat().toFixed(5);
            const lng = place.geometry.location.lng().toFixed(5);

            $('#city').val(displayCity);
            $('#state').val(displayState);
            $('#country').val(country);
            $('#zipcode').val(postalcode);
            $('#latitude').val(lat);
            $('#longitude').val(lng);
      });
    }
</script>