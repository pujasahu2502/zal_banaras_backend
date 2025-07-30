<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static"  data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fe-icon mr-2" data-feather="briefcase"></i>Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCategoryForm" class="edit-category" autocomplete="off">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group category-input">
                                <label>Category Type<span class="text-danger ">*</span></label>
                                <select class="form-control alpha form-select type" name="type" id="type" data-rule-required="true" data-msg-required="{{ __('required_category_type') }}">
                                    <option disabled selected>Select Category Type</option>
                                    <option value="1" {{ $category->type == '1' ? 'selected' : '' }}>Scope Mounts and Rings</option>
                                    <option value="2" {{ $category->type == '2' ? 'selected' : '' }}>Gun Accessories</option>
                                    <option value="3" {{ $category->type == '3' ? 'selected' : '' }}>DNZ Hats & Apparel</option>
                                    <option value="4" {{ $category->type == '4' ? 'selected' : '' }}>Other Useful Products</option>
                                </select>
                                <span class="text-danger error type-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group category-input">
                                <label>Category Name<span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control name" name="name" id="name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="50" value="{{ $category->name ?? '' }}" data-msg-required="{{ __('required_category_name') }}">
                                <span class="text-danger error name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group mt-3">
                                <div class="upload__btn-box d-none">
                                    <label data-toggle="tooltip" data-placement="top" title="Choose Category Image" class="upload__btn">
                                        <input type='file' name="image" id="image" class="upload__inputfile" data-count="0" data-check="create" accept=".png, .jpg, .jpeg">
                                    </label>
                                </div>
                                <span class="text-danger error file-error"></span>
                                <label for="" class="upload__img-wrap d-none">Category Image Preview</label>
                                <div class="upload__img-wrap d-none"></div>
                                <label class="no-img {{ $category->getMedia('category')->count() > 0 ? 'd-none' : ''}}">Upload Category Image <span data-coreui-placement="top" data-toggle="tooltip" title="Note: Image size should be less than 2 MB and Accepted image format must be jpg, jpeg, png."><i data-feather="info"></i></span></label>
                                <div class="no-img {{ $category->getMedia('category')->count() > 0 ? 'd-none' : ''}}" >
                                    <img src="{{asset('backend/no-img.png')}}" alt="" class="image-uploader">
                                </div>
                            </div>
                            <div class="form-group">
                                @if ($category->getMedia('category')->count() > 0)
                                    <label class="upload__img-wrap-edit-label">Category Image</label>
                                @endif

                                <div class="upload__img-wrap-edit {{ $category->getMedia('category')->count() == 0 ? 'd-none' : '' }}">
                                    @if ($category->getMedia('category')->count())
                                        @forelse ($category->getMedia('category') as $media)
                                            <div class="upload__img-box">
                                                <div style="background-image: url({{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }})" data-number="0" data-file="536402.jpg" class="img-bg">
                                                    <div class="upload__img-close" data-check="edit" data-url="{{ route('category.destroyMedia', $media->id) }}" data-id="{{ $media->id }}"></div>
                                                </div>
                                            </div>

                                        @empty
                                            <label class="no-img">Upload Category Image</label>
                                            <div class="no-img" >
                                                <img src="{{asset("backend/no-img.png")}}" alt="" class="image-uploader">
                                            </div>
                                        @endforelse
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group category-input">
                                <label>Description<span class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control description" rows="4" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="500" data-msg-required="{{ __('required_category_description') }}">{{ $category->description ?? '' }}</textarea>
                                <span class="text-danger error description-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Video URL</label>
                                <input type="text" class="form-control" name="video_url" id="video_url" value="{{ $category->video_url ?? '' }}">
                                <span class="text-danger error video_url-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group category-input">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control alpha form-select" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('category_status') }}">
                                <option selected disabled>Select Status</option>
                                <option value="1" {{ ($category['status'])==1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ ($category['status'])==0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <span class="text-danger error status-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group category-input">
                                <label>SEO Title</label>
                                <input type="text" class="form-control seo_title" name="seo_title" value="{{ $category->seoAnalysis->title ?? old('seo_title') }}">
                                <span class="text-danger error seo_title-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group category-input">
                                <label>Meta Keywords</label>
                                <input type="text" name="meta_keywords" class="form-control meta_keywords" value="{{ $category->seoAnalysis->meta_keywords ?? old('meta_keywords') }}">
                                <span class="text-danger error meta_keywords-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group category-input">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control meta_description" rows="2" >{{ $category->seoAnalysis->description ?? old('meta_description') }}</textarea>
                                <span class="text-danger error meta_description-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" data-url="{{route('category.update',$category['id'])}}" class="btn btn-primary common-btn update-category">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>