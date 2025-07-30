<div class="modal fade" id="editVariationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fe-icon mr-2" data-feather="framer"></i>Edit Variant</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editVariationForm" autocomplete="off">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group variation-input">
                                <label>Variant Name<span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control name" name="name" id="name" data-rule-required="true" data-rule-minlength="1" data-rule-maxlength="50" value="{{ $variation->name ?? '' }}" data-msg-required="{{ __('required_variation_name') }}">
                                <span class="text-danger error name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group variation-input">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control alpha form-select" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('required_variation_status') }}">
                                <option selected disabled>Select Status</option>
                                <option value="1" {{ ($variation['status'])==1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ ($variation['status'])==0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <span class="text-danger error status-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="{{ $variation->attribute_id ?? ''}}">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" data-url="{{route('variant.update',$variation['id'])}}" class="btn btn-primary common-btn update-variation">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>