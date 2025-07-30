<div class="modal fade {{ isset($dealer) ? ' ' : 'modal-create' }}" id="{{ isset($dealer) ? 'editDealerModal' : 'dealerModal'}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fe-icon mr-2" data-feather="percent"></i>{{ isset($dealer) ? 'Edit' : 'Add' }} Dealer</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addDealerForm" action="{{ route('dealer.store') }}" autocomplete="off"> {{--{{ isset($dealer) ? 'editDealerForm':'addDealerForm'}}" class="{{ isset($dealer) ?  'update-dealer' : 'save-dealer'}}" action="{{ isset($dealer) ? route('dealer.update',$dealer['id']) : route('dealer.store') }}--}}
                @csrf
                @method( isset($dealer) ? 'put' : 'post')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group dealer-input">
                                <label>Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control name" name="name" id="name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="100" data-msg-required="{{ __('required_tax_name') }}" > {{--value="{{ isset($dealer) ? $dealer['title'] : '' }}"--}}
                                <span class="text-danger error name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group dealer-input">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" data-rule-required="true" data-msg-required="{{ __('required_email') }}">
                                <span class="text-danger error email-error"></span>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary common-btn">{{ isset($dealer) ? 'Update' : 'Add' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>