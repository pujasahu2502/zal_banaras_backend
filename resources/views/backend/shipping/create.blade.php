<div class="modal fade {{ isset($shipping) ? ' ' : 'modal-create' }}" id="{{ isset($shipping) ? 'editShippingModal' : 'shippingModal'}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fe-icon mr-2" data-feather="truck"></i>{{ isset($shipping) ? 'Edit' : 'Add' }} Shipping
                </h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="{{ isset($shipping) ? 'editShippingForm':'addShippingForm'}}" class="{{ isset($shipping) ?  'update-shipping' : 'save-shipping'}}" action="{{ isset($shipping) ? route('shipping.update', Str::slug(collect($shipping)->first()->zone_name)) : route('shipping.store') }}" autocomplete="off">
                @csrf
                @method( isset($shipping) ? 'put' : 'post')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group shipping-input">
                                <label>Zone Name<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control zone_name" name="zone_name"  data-rule-maxlength="100" data-rule-required="true" data-msg-required="{{ __('required_shipping_zone_name') }}" value="{{ isset($shipping) ? collect($shipping)->first()->zone_name : '' }}">
                                </div>
                                <span class="text-danger error zone_name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group shipping-input">
                                <label>Shipping State<span class="text-danger">*</span></label>
                                <select class="form-control stateSelect2 state" name="state" id="state"
                                    data-rule-required="true" data-msg-required="{{ __('required_shipping_state') }}" multiple>
                                    {{-- <option selected disabled>Select Shipping State</option>    --}}
                                    @foreach (getUsState() as $key => $state )
                                        <option value="{{$state}}" {{ isset($shipping) && in_array($state ,collect($shipping)->pluck('state')->toArray()) > 0  ?  'selected' : '' }} >{{ $state }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error state-error"></span>
                                <textarea name="states" class="statedata d-none"  cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group shipping-input">
                                <label>Flat Rate<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-rupee"></i>
                                    </div>
                                    <input type="text" min="1" max="499.99" class="form-control price_decimal price-min amount numberonly" name="amount" data-rule-required="true" data-msg-required="{{ __('required_shipping_amount') }}" value="{{ isset($shipping) ? collect($shipping)->first()->fixed_amount : '' }}">
                                </div>
                                <span class="text-danger error amount-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group shipping-input">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control alpha form-select status" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('required_shipping_status') }}">
                                    <option selected disabled>Select Status</option>
                                    @if (isset($shipping))
                                        <option value="1" {{ (collect($shipping)->first()->status )==1 ? 'selected' : '' }} >Active</option>
                                        <option value="0" {{ (collect($shipping)->first()->status)==0 ? 'selected' : '' }} >Inactive</option>
                                    @else
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    @endif
                                </select>
                                <span class="text-danger error status-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary common-btn">{{ isset($shipping) ? 'Update' : 'Add' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>