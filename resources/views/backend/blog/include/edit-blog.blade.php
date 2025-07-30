<div class="modal fade" id="editBlogModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fe-icon mr-2" data-feather="edit-3"></i>Edit Blog</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editBlogForm" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Blog Title<span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="title" value="{{ $blogData->title ?? '' }}" id="title" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="255" data-msg-required="{{ __('required_blog_title') }}">
                                <span class="text-danger error title-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control alpha form-select" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('required_blog_status') }}">
                                    <option selected disabled>Select Status</option>
                                    <option value="1" {{ $blogData['status'] == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $blogData['status'] == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <span class="text-danger error status-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="upload__btn-box d-none">
                                    <label data-toggle="tooltip" data-placement="top" title="Choose Blog Image" class="upload__btn">
                                        <input type='file' name="image" id="image" class="upload__inputfile" data-count="0" data-check="create" accept=".png, .jpg, .jpeg">
                                    </label>
                                </div>
                                <span class="text-danger error file-error"></span>
                                <label for="" class="upload__img-wrap d-none">Blog Image Preview</label>
                                <div class="upload__img-wrap d-none"></div>
                                <label class="no-img {{ $blogData->getMedia('blog')->count() > 0 ? 'd-none' : ''}}">Upload Blog Image <span data-coreui-placement="right" data-toggle="tooltip" title="Note: Image size should be less than 2 MB and Accepted image format must be jpg, jpeg, png."><i data-feather="info"></i></span></label>
                                <div class="no-img {{ $blogData->getMedia('blog')->count() > 0 ? 'd-none' : ''}}" >
                                    <img src="{{asset('backend/no-img.png')}}" alt="" class="image-uploader">
                                </div>
                            </div>
                            <div class="form-group">
                                @if ($blogData->getMedia('blog')->count() > 0)
                                    <label class="upload__img-wrap-edit-label">Blog Image</label>
                                @endif

                                <div class="upload__img-wrap-edit {{ $blogData->getMedia('blog')->count() == 0 ? 'd-none' : '' }}">
                                    @if ($blogData->getMedia('blog')->count())
                                        @forelse ($blogData->getMedia('blog') as $media)
                                            <div class="upload__img-box">
                                                <div style="background-image: url('{{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }}')" data-number="0" data-file="536402.jpg" class="img-bg">
                                                    <div class="upload__img-close" data-check="edit" data-url="{{ route('blog.destroyMedia', $media->id) }}" data-id="{{ $media->id }}"></div>
                                                </div>
                                            </div>

                                        @empty
                                            <label class="no-img">Upload Blog Image</label>
                                            <div class="no-img" >
                                                <img src="{{asset("backend/no-img.png")}}" alt="" class="image-uploader">
                                            </div>
                                        @endforelse
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" id="description">{{ $blogData->description ?? '' }}</textarea>
                                <span class="text-danger error description-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>SEO Title</label>
                                <input type="text" class="form-control seo_title" name="seo_title" value="{{ $blogData->seoAnalysis->title ?? old('seo_title') }}">
                                <span class="text-danger error seo_title-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Meta Keywords</label>
                                <input type="text" name="meta_keywords" class="form-control meta_keywords" value="{{ $blogData->seoAnalysis->meta_keywords ?? old('meta_keywords') }}">
                                <span class="text-danger error meta_keywords-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control meta_description" rows="2">{{ $blogData->seoAnalysis->description ?? old('meta_description') }}</textarea>
                                <span class="text-danger error meta_description-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" data-url="{{ route('blogs.update',$blogData->id) }}" class="btn btn-primary  common-btn update-blog">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>