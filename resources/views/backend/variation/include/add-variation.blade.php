<div class="modal fade modal-create" id="addVariationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="c-sidebar-nav-icon fe-icon" data-feather="framer"></i>Add Variant</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addVariationForm" autocomplete="off">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group variation-input">
                                <label>Variant Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control name" name="name" id="name" data-rule-required="true" data-rule-minlength="1" data-rule-maxlength="50" data-msg-required="{{ __('required_variation_name') }}">
                                <span class="text-danger error name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group variation-input">
                                <label>Status<span class="text-danger ">*</span></label>
                                <select class="form-control alpha form-select status" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('required_variation_status') }}">
                                    <option disabled>Select Status</option>
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span class="text-danger error status-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="{{ $id ?? ''}}">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" data-url="{{route('variant.store')}}" class="btn btn-primary common-btn save-variation">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>