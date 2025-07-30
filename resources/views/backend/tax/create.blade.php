<div class="modal fade {{ isset($tax) ? ' ' : 'modal-create' }}" id="{{ isset($tax) ? 'editTaxModal' : 'taxModal'}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fe-icon mr-2" data-feather="percent"></i>{{ isset($tax) ? 'Edit' : 'Add' }} Tax</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="{{ isset($tax) ? 'editTaxForm':'addTaxForm'}}" class="{{ isset($tax) ?  'update-tax' : 'save-tax'}}" action="{{ isset($tax) ? route('tax.update', Str::slug(collect($tax)->first()->name)) : route('tax.store') }}" autocomplete="off">
                @csrf
                @method( isset($tax) ? 'put' : 'post')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group tax-input">
                                <label>Tax Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control name" name="name" id="name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="100" data-msg-required="{{ __('required_tax_name') }}" value="{{ isset($tax) ? collect($tax)->first()->name : '' }}">
                                <span class="text-danger error name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group tax-input">
                                <label>State<span class="text-danger">*</span></label>
                                <select class="form-control stateSelect2 state" name="state" id="state" data-rule-required="true" data-msg-required="{{ __('required_tax_state') }}" multiple>
                                    {{-- <option selected disabled>Select tax State</option>    --}}
                                    @foreach (getUsState() as $key => $state )
                                        <option value="{{$state}}" {{ isset($tax) && in_array($state ,collect($tax)->pluck('state')->toArray()) > 0  ?  'selected' : '' }} >{{ $state }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error state-error"></span>
                                <textarea name="states" class="statedata d-none"  cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group tax-input">
                                <label>Tax (%)<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" min="0" max="99.99" class="form-control tax_percent price_decimal price-min" name="tax_percent" id="tax_percent" data-rule-required="true" data-msg-required="{{ __('required_tax') }}" value="{{ isset($tax) ? collect($tax)->first()->tax : '' }}">
                                    <div class="input-group-text">
                                        <i class="fa fa-percent"></i>
                                    </div>
                                </div>
                                <span class="text-danger error tax_percent-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group tax-input">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control alpha form-select" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('tax_status') }}">
                                    <option selected disabled>Select Status</option>
                                    @if (isset($tax))
                                        <option value="1" {{ (collect($tax)->first()->status )==1 ? 'selected' : '' }} >Active</option>
                                        <option value="0" {{ (collect($tax)->first()->status)==0 ? 'selected' : '' }} >Inactive</option>
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
                    <button type="submit" class="btn btn-primary common-btn">{{ isset($tax) ? 'Update' : 'Add' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>