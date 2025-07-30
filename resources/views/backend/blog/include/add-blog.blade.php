<div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fe-icon mr-2" data-feather="edit-3"></i>Add Blog</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addBlogForm" autocomplete="off">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Blog Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="title" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="255" data-msg-required="{{ __('required_blog_title') }}">
                                <span class="text-danger error title-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control alpha form-select" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('required_blog_status') }}">
                                    <option disabled>Select Status</option>
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span class="text-danger error status-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="upload__btn-box d-none">
                                    <label data-toggle="tooltip" data-placement="top" title="Choose Blog Image" class="upload__btn">
                                        <input type='file' name="image" id="image" class="upload__inputfile" data-count="0" data-rule-required="true" data-msg-required="The image field is required."  data-check="create" accept=".png, .jpg, .jpeg">
                                    </label>
                                </div>
                                <label for="" class="upload__img-wrap d-none w-10">Blog Image Preview</label>
                                <div class="blog-image upload__img-wrap d-none"></div>
                                    <label class="no-img">Upload Blog Image <span data-coreui-placement="right" data-toggle="tooltip" title="Note:Accepted image format must be jpg, jpeg, png."><i data-feather="info"></i></span></label>
                                <div class="no-img">
                                    <img src="{{asset('backend/no-img.png')}}" alt="" class="image-uploader">
                                </div>
                            </div>
                            <span class="text-danger error image-error"></span>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="form-group">
                                <label>Description</label>
                                <div id="description"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
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
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control meta_description" rows="2"></textarea>
                                <span class="text-danger error meta_description-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" data-url="{{ route('blogs.store') }}" class="btn btn-primary common-btn save-blog">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>