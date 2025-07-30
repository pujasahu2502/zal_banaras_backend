<div class="modal fade modal-create webinarModelForm" id="listningModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fe-icon mr-2" data-feather="list"></i>Add
                    Listning</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="line-height: 30px;">
                <form id="AddListningForm">
                    @csrf
                    @method('post')
                    <div class="examAlertMsg"></div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label>Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control " name="name" id="name"
                                    data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="30"
                                    data-msg-required="{{ __('required_name') }}">
                                <span class="text-danger error name-error"></span>
                            </div>
                            <div class="form-group">
                                <label>Category<span class="text-danger">*</span></label>
                                <select class="form-control webinarSelect2" name="category_id" id="webinarSelect2"
                                    data-rule-required="true" data-msg-required="{{ __('required_category') }}"
                                    aria-label="Default select example">
                                    <option selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ ucwords($category->name) }}</b></option>
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
                                        name="price" id="price" data-rule-required="true"
                                        data-msg-required="{{ __('required_price') }}">
                                </div>
                                <span class="text-danger error price-error"></span>
                            </div>
                            <div class="form-group">
                                <label>Video Url<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="form-control"><i class="fe-icon"
                                                data-feather="video"></i></span></div>
                                    <input type="url" class="form-control price_decimal price-min"
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
                                    <option selected value="0">Available</option>
                                    <option value="1">Sold</option>
                                </select>
                                <span class="text-danger error type-error"></span>
                            </div>
                            <div class="form-group ">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control" name="status" data-rule-required="true"
                                    data-msg-required="{{ __('required_status') }}"
                                    aria-label="Default select example">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span class="text-danger error status-error"></span>
                            </div>
                            <div class="form-group mt-3">
                                <div class="upload__btn-box">
                                    <label data-toggle="tooltip" data-placement="top" title="Select Raffle Image"
                                        class="upload__btn">
                                        <p>Choose Listening Image</p>
                                        <input type='file' name="image" id="image"
                                            class="upload__inputfile" data-count="0" data-check="create"
                                            multiple="" data-max_length="5" data-rule-required="true"
                                            data-msg-required="{{ __('required_type') }}"
                                            accept=".png, .jpg, .jpeg" />
                                    </label>
                                </div>
                                <span class="text-danger error file-error"></span>
                                <label for="" class="upload__img-wrap d-none">Listening Image Preview</label>
                                <div class="upload__img-wrap d-none"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>Description<span class="text-danger">*</span></label>
                            <textarea class="form-control " name="description" value="" id="description"
                                data-rule-required="true"data-msg-required="{{ __('required_description') }}" data-rule-maxlength="2000"></textarea>
                            <span class="text-danger error description-error"></span>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-4 text-center">
                        <button type="button" data-url="{{route('listing.store')}}" class="btn btn-primary common-btn save-listening">Submit</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

@section('javascript')
@endsection
