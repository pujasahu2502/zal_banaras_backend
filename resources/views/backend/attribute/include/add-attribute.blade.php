<div class="modal fade modal-create" id="addAttributeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="c-sidebar-nav-icon fe-icon" data-feather="shopping-bag"></i>Add Attribute</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addAttributeForm" autocomplete="off">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group attribute-input">
                                <label>Attribute Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control name" name="name" id="name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="50" data-msg-required="{{ __('required_attribute_name') }}">
                                <span class="text-danger error name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group attribute-input">
                                <label>Status<span class="text-danger ">*</span></label>
                                <select class="form-control alpha form-select status" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('required_attribute_status') }}">
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
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" data-url="{{route('attribute.store')}}" class="btn btn-primary common-btn save-attribute">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>