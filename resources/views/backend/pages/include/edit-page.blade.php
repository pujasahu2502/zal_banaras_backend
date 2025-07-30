<div class="modal fade" id="editPagesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="c-sidebar-nav-icon fe-icon" data-feather="book"></i>Edit Page</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPageForm" autocomplete="off">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Page Title<span class="text-danger ">*</span></label>
                                <input type="text" class="form-control" name="title" value="{{$page->title ?? ''}}" id="title" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="30" data-msg-required="{{ __('required_title') }}">
                                <span class="text-danger error title-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label>Page Slug</label>
                                <input type="text" class="form-control" name="slug" value="{{$page->slug ?? ''}}" id="slug" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label>Status<span class="text-danger ">*</span></label>
                                <select class="form-control form-select alpha" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('category_status') }}">
                                    <option selected disabled>Select Status</option>
                                    <option value="1" {{ $page['status'] == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $page['status'] == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <span class="text-danger error status-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Description<span class="text-danger ">*</span></label>
                                <textarea class="form-control" name="description" id="description">{{ $page->description ?? '' }}</textarea>

                                {{-- <textarea  class="form-control editor1" name="description" id="editor1" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="300" rows="15" cols="100" data-msg-required="{{ __('required_description') }}">{!! Request::old('description', $page->description) !!}</textarea> --}}

                                <span class="text-danger error description-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" data-url="{{route('page.update',$page->id)}}" class="btn btn-primary common-btn update-page">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>