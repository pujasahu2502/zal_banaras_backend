<div class="modal fade modal-create EditWebinarModelForm" id="editListningModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fe-icon mr-2" data-feather="list"></i>Add
                    Listning</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="line-height: 30px;">
                <form id="editListningForm">
                    @csrf
                    @method('put')
                    <div class="examAlertMsg"></div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label>Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control " name="name" id="name" value="{{$listingData->name ?? ''}}"
                                    data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="30"
                                    data-msg-required="{{ __('required_name') }}">
                                <span class="text-danger error name-error"></span>
                            </div>
                            <div class="form-group">
                                <label>Category<span class="text-danger">*</span></label>
                                <select class="form-control webinarSelect2" name="category_id" id="webinarSelect2" data-rule-required="true" data-msg-required="{{ __('required_status') }}" aria-label="Default select example">
                                    <option selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                      <option value="{{ $category->id }}"
                                        {{ $listingData->category_id == $category->id ? 'selected' : '' }}>
                                        {{ ucwords($category->name) }}
                                      </option>
                                    @endforeach
                                  </select>
                                <span class="text-danger error category_id-error"></span>
                            </div>
                            <div class="form-group">
                                <label>Price<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="form-control"><i class="fe-icon"
                                                data-feather="dollar-sign"></i></span></div>
                                    <input type="text" min="0" class="form-control price_decimal price-min"
                                        name="price" id="price" data-rule-required="true" value="{{$listingData->price ?? ''}}"
                                        data-msg-required="{{ __('required_price') }}">
                                </div>
                                <span class="text-danger error price-error"></span>
                            </div>
                            <div class="form-group">
                              <label>Video Url<span class="text-danger">*</span></label>
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend"><span class="form-control"><i class="fe-icon"
                                              data-feather="video"></i></span></div>
                                  <input type="url" class="form-control price_decimal price-min" value="{{$listingData->url ?? ''}}"
                                      name="url" id="price" data-rule-required="true"
                                      data-msg-required="{{ __('required_price') }}">
                              </div>
                          </div>
                          <span class="text-danger error url-error"></span>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Listening Status<span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="listening_status" data-rule-required="true"
                                    data-msg-required="{{ __('required_type') }}" aria-label="Default select example">
                                    <option value="0" {{ $listingData['listening_status'] == 0 ? 'selected' : '' }}>Available</option>
                                    <option value="1" {{ $listingData['listening_status'] == 1 ? 'selected' : '' }}>Sold</option>
                                </select>
                                <span class="text-danger error type-error"></span>
                            </div>
                            <div class="form-group ">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control" name="status" data-rule-required="true"
                                    data-msg-required="{{ __('required_status') }}"
                                    aria-label="Default select example">
                                    <option value="1" {{ $listingData['status'] == 1 ? 'selected' : '' }}> Active</option>
                                      <option value="0" {{ $listingData['status'] == 0 ? 'selected' : '' }}> Inactive</option>
                                </select>
                                <span class="text-danger error status-error"></span>
                            </div>
                            <div class="form-group mt-3">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="upload__btn-box">
                                      <label data-toggle="tooltip" data-placement="top" title="Select Webinar Image" class="upload__btn">
                                        <p>Choose Raffle Image</p>
                                        <input type='file' name="image" id="image" class="upload__inputfile" data-count="{{ $listingData->getMedia('webinar')->count() }}" data-check="edit" multiple="" data-max_length="5" data-rule-required="true" data-msg-required="{{ __('required_type') }}" accept=".png, .jpg, .jpeg" />
                                      </label>
                                    </div>
                                    <span class="text-danger error file-error"></span>
                                    <label class="upload__img-wrap d-none">Raffle Image Preview</label>
                                    <div class="upload__img-wrap d-none"></div>
                                    @if ($listingData->getMedia('listening')->count() > 0)
                                      <label class="upload__img-wrap-edit-label">Raffle Image</label>
                                    @endif
                                    <div
                                      class="upload__img-wrap-edit {{ $listingData->getMedia('listening')->count() == 0 ? 'd-none' : '' }}">
                                      @if ($listingData->getMedia('listening')->count())
                                        @foreach ($listingData->getMedia('listening') as $media)
                                          <div class="upload__img-box">
                                            <div style="background-image: url({{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }})" data-number="0" data-file="536402.jpg" class="img-bg">
                                              <div class="upload__img-close" data-check="edit" data-url="{{ route('webinar.destroyMedia', $media->id) }}" data-id="{{ $media->id }}"></div>
                                            </div>
                                          </div>
                                        @endforeach
                                      @endif
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>Description<span class="text-danger">*</span></label>
                            <textarea class="form-control " name="description" value="" id="description"
                                data-rule-required="true"data-msg-required="{{ __('required_description') }}" data-rule-maxlength="2000">{{ $listingData['description'] ?? ' ' }}</textarea>
                            <span class="text-danger error description-error"></span>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-4 text-center">
                        <button type="button" data-url="{{route('listing.update',$listingData->id)}}"  class="btn btn-primary common-btn update-listing">Submit</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

