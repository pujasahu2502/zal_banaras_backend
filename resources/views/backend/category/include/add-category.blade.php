<div class="modal fade modal-create" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="c-sidebar-nav-icon fe-icon" data-feather="briefcase"></i>Add Category</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addCategoryForm" autocomplete="off">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group category-input">
                                <label>Category Type<span class="text-danger ">*</span></label>
                                <input type="text" class="form-control" name="type" id="type">
                                <span class="text-danger error type-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group category-input">
                                <label>Category Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control name" name="name" id="name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="50" data-msg-required="{{ __('required_category_name') }}">
                                <span class="text-danger error name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <div class="upload__btn-box d-none">
                                    <label data-toggle="tooltip" data-placement="top" title="Choose Category Image" class="upload__btn">
                                        <input type='file' name="image" id="image" class="upload__inputfile" data-count="0" data-check="create" accept=".png, .jpg, .jpeg">
                                    </label>
                                </div>
                                <span class="text-danger error file-error"></span>
                                <label for="" class="upload__img-wrap d-none w-10">Category Image Preview</label>
                                <div class="category-image upload__img-wrap d-none"></div>
                                <label class="no-img">Upload Category Image <span data-coreui-placement="top" data-toggle="tooltip" title="Note: Image size should be less than 2 MB and Accepted image format must be jpg, jpeg, png."><i data-feather="info"></i></span></label>
                                <div class="no-img">
                                    <img src="{{asset('backend/no-img.png')}}" alt="" class="image-uploader">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group category-input">
                                <label>Description<span class="text-danger ">*</span></label>
                                <textarea name="description" id="description" class="form-control description" rows="4" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="500" data-msg-required="{{ __('required_category_description') }}"></textarea>
                                <span class="text-danger error description-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Video URL</label>
                                <input type="text" class="form-control" name="video_url" id="video_url">
                                <span class="text-danger error video_url-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group category-input">
                                <label>Status<span class="text-danger ">*</span></label>
                                <select class="form-control alpha form-select status" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('required_category_status') }}">
                                    <option disabled>Select Status</option>
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span class="text-danger error status-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group category-input">
                                <label>SEO Title</label>
                                <input type="text" class="form-control seo_title" name="seo_title">
                                <span class="text-danger error seo_title-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group category-input">
                                <label>Meta Keywords</label>
                                <input type="text" name="meta_keywords" class="form-control meta_keywords">
                                <span class="text-danger error meta_keywords-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group category-input">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control meta_description" rows="2"></textarea>
                                <span class="text-danger error meta_description-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" data-url="{{route('category.store')}}" class="btn btn-primary common-btn save-category">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>