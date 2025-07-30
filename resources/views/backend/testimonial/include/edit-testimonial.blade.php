<div class="modal fade" id="editTestimonialModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fe-icon mr-2" data-feather="message-circle"></i>Edit Testimonial</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editTestimonialForm" autocomplete="off">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group testimonial-input">
                                <label>Author's Name<span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control name" name="name" id="name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="50" value="{{ $testimonial->name ?? '' }}" data-msg-required="{{ __('required_testimonial_name') }}">
                                <span class="text-danger error name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group testimonial-input">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control alpha form-select" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('required_testimonial_status') }}">
                                <option selected disabled>Select Status</option>
                                <option value="1" {{ ($testimonial['status'])==1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ ($testimonial['status'])==0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <span class="text-danger error status-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group testimonial-input">
                                <label>Testimonial<span class="text-danger ">*</span></label>
                                <textarea name="description" class="form-control description" rows="3" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="500" data-msg-required="{{ __('required_testimonial_description') }}">{{ $testimonial->description ?? '' }}</textarea>
                                <span class="text-danger error description-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" data-url="{{route('testimonial.update',$testimonial['id'])}}" class="btn btn-primary common-btn update-testimonial">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>