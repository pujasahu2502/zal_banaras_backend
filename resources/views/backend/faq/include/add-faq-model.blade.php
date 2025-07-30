<div class="modal fade modal-create" id="addFaqModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="c-sidebar-nav-icon fe-icon" data-feather="help-circle"></i>Add FAQ</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addFaqForm" autocomplete="off">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>FAQ Category<span class="text-danger">*</span></label>
                                <select class="form-control alpha form-select" name="faq_category" id="faq_category" data-rule-required="true" data-msg-required="{{ __('required_faq_category') }}">
                                    <option disabled selected>Select FAQ Category</option>
                                    <!-- Getting faq category from General Helper -->
                                    @foreach (getFaqCategory() as $faqCategory)
                                        <option value="{{$faqCategory}}">{{ $faqCategory }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error faq_category-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label>Question<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="question" id="question" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="300" data-msg-required="{{ __('required_faq_question') }}">
                                <span class="text-danger error question-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Answer<span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" name="answer" id="answer" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="3000" data-msg-required="{{ __('required_faq_answer') }}" rows="4"></textarea>
                                <span class="text-danger error answer-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Video URL</label>
                                <input type="text" name="url" id="url" class="form-control">
                                <span class="text-danger error url-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control alpha form-select" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('required_faq_status') }}">
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
                    <button type="button" data-url="{{route('faq.store')}}" class="btn btn-primary common-btn save-faq">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>