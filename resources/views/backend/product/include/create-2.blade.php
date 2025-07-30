@extends('backend.layouts.app', ['title' => 'Inventory Information'])
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/step-form.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/image-uploader.min.css') }}">

    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link
        href="https://fonts.googleapis.com/css?family=Lato:300,700|Montserrat:300,400,500,600,700|Source+Code+Pro&display=swap"
        rel="stylesheet">

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="shopping-cart"></i>Product</h4>
        </div>
        <div class="card-body">
            <section class="wizard-section">
                <div class="row no-gutters">
                    <div class="form-wizard">
                        <div class="smartwizard mb-4">
                            <ul class="nav">
                                <li><a class="nav-link wizard-btn active"
                                        href="{{ isset($productData) && $productData != [] ? route('product.create1', ['1', $id]) : 'javascript:;' }}">General
                                        Information</a></li>

                                <li><a class="nav-link wizard-btn active"
                                        href="{{ isset($productData->product_information) && $productData != [] ? route('product.create2', ['2', $id]) : 'javascript:;' }}">Inventory
                                        Information</a></li>

                                <li><a class="nav-link"
                                        href="{{ isset($productData->productAttribute) && count($productData->productAttribute) > 0 ? route('product.create3', ['3', $id]) : 'javascript:;' }}">Attribute
                                        Information</a></li>

                                @if ($productData->type == '2')
                                    <li class="step-4"><a class="nav-link"
                                            href="{{ isset($allCombinations->productVariation) && count($allCombinations->productVariation) > 0 ? route('product.create4', ['4', $id]) : 'javascript:;' }}">Variation
                                            Information</a></li>
                                @endif
                            </ul>
                        </div>
                        <fieldset class="wizard-fieldset show">
                            <form method="POST" id="step2" action="{{ route('product.store2') }}" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <input type="hidden" name="product_id" class="product_id" value="{{ $id }}">
                                <input type="hidden" name="next_id" class="next_id" value="2">
                                <div class="product-head text-left">
                                    <h5>Inventory Information</h5>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 {{ $productData->type == '2' ? 'd-none' : ' ' }}">
                                        <div class="form-group">
                                            <label>Product SKU <span data-coreui-placement="top" data-toggle="tooltip"
                                                    title="Note: SKU will be generated automatically"><i
                                                        data-feather="info"></i></span></label>
                                            <input type="text" class="form-control" name="sku"
                                                value="{{ $productData->sku != null ? $productData->sku : Sku() . 'S'  }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group">
                                            <label>Stock Status<span class="text-danger">*</span></label>
                                            <select name="stock_status" class="form-control form-select"
                                                data-rule-required="true"
                                                data-msg-required="{{ __('required_stock_status') }}">
                                                <option disabled>Select Stock Status</option>
                                                <option value="In stock"
                                                    {{ isset($productData->stock_status) && $productData->stock_status == 'In stock' ? 'selected' : 'selected' }}>
                                                    In stock</option>
                                                <option value="Out of stock"
                                                    {{ isset($productData->stock_status) && $productData->stock_status == 'Out of stock' ? 'selected' : '' }}>
                                                    Out of stock</option>
                                            </select>
                                            @error('stock_status')
                                                <span class="text-danger error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">

                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Product Information<span class="text-danger">*</span></label>
                                            <textarea name="product_information" id="product_information" class="form-control product_information"
                                                data-rule-required="true" data-msg-required="{{ __('required_product_information') }}">{!! $productData->product_information ?? old('product_information') !!}</textarea>
                                            @error('product_information')
                                                <span class="text-danger error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Additional Information</label>
                                            <textarea name="additional_information" id="additional_information" class="form-control additional_information">{!! $productData->additional_information ?? old('additional_information') !!}</textarea>
                                            <span class="text-danger error additional_information-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            @if ($productData->getMedia('featured_product_image')->count())
                                                <div class="previewFImage">
                                                    <label class="mb-0">Product Featured Image</label><br>
                                                    @foreach ($productData->getMedia('featured_product_image') as $media)
                                                        <div class="upload__img-box">
                                                            <div style="background-image: url( {{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }} )" data-number="0" data-file="536402.jpg" class="img-bg">
                                                                <div class="upload__img-close" data-check="edit" data-url="{{ route('product.destroyMedia', $media->id) }}" data-id="{{ $media->id }}"></div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                            <div class="noImage" style="display: {{ $productData->getMedia('featured_product_image')->count() > 0 ? ' none;' : '' }}">
                                                <label>Upload Product Featured Image<span class="text-danger">*</span> <span data-coreui-placement="right" data-toggle="tooltip" title="Note:Accepted image format must be jpg, jpeg, png."><i data-feather="info"></i></span></label>
                                                <br>
                                                <label for="featured_image" class=" mb-0">
                                                    <div class="no-img mt-2">
                                                        <img src="{{ asset('backend/no-img.png') }}" alt="" id="featuredImage" class="image-uploader" style="width:auto">
                                                    </div>
                                                </label>
                                                <input type='file' style="display: none" name="featured_image" id="featured_image" onchange="preview()" class="form-control featured_image" accept=".png, .jpg, .jpeg">
                                            </div>
                                            @error('featured_image')
                                                <span class="text-danger error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8">
                                        <div class="form-group">
                                            <div class="productImagesUploader" style="display: {{ $productData->getMedia('product')->count() == 5 ? ' none;' : '' }}">
                                                <label>Upload Product Image <span data-coreui-placement="top" data-toggle="tooltip" title="Note: Maximum 5 images can be uploaded at a time, Image size should be less than 2 MB and Accepted image format must be jpg, jpeg, png."><i data-feather="info"></i></span></label>
                                                <div class="draganddrop">
                                                    <div class="input-images"></div>
                                                </div>
                                                <input style="display: none;" type='file' name="image[]" id="image" class="upload__inputfile" data-count="0" data-check="create" accept=".png, .jpg, .jpeg" multiple>
                                            </div>
                                            @if ($productData->getMedia('product')->count() > 0)
                                                <label class="upload__img-wrap-edit-label mb-0">Product Images</label>
                                                <div class="upload__img-wrap-edit product-img-wrap-block {{ $productData->getMedia('product')->count() == 0 ? 'd-none' : '' }}">
                                                    @if ($productData->getMedia('product')->count())
                                                        @foreach ($productData->getMedia('product') as $media)
                                                            <div class="upload__img-box">
                                                                {{-- {{dd($media->geturl('thumb'))}} --}}
                                                                <div style="background-image: url( {{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }} )" data-number="0" data-file="536402.jpg" class="img-bg">
                                                                    <div class="upload__img-close" data-check="edit" data-url="{{ route('product.destroyMedia', $media->id) }}" data-id="{{ $media->id }}"></div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix" style="text-align: right;">
                                    <a href="{{ route('product.create1', ['1', $id]) }}" class="btn btn-primary back"><i class="fa fa-arrow-left"></i><span class="back-arrow"> Back</span></a>
                                    <button type="submit" class="btn btn-primary next" name="whichClick" value="1"><span class="next-arrow">Save</span></button>
                                    <button type="submit" class="btn btn-primary next"><span class="next-arrow">Save & Next</span><i class="fa fa-arrow-right"></i></button>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('backend/js/product.js') }}"></script>
    <script src="{{ asset('backend/js/image-uploader.min.js') }}"></script>
    <script>
        
        $(document).on('ready',function() {
            CKEDITOR.replace('product_information')
            CKEDITOR.replace('additional_information')
            // ClassicEditor.create(document.querySelector('#product_information'), {
            //     cloudServices: {
            //         tokenUrl: "https://33333.cke-cs.com/token/dev/ijrDsqFix838Gh3wGO3F77FSW94BwcLXprJ4APSp3XQ26xsUHTi0jcb1hoBt",
            //         uploadUrl: "https://33333.cke-cs.com/easyimage/upload/"
            //     }
            // }).then(editor => {
            //     editorData = editor;
            // }).catch(error => {
            //     console.error(error);
            // });

            // ClassicEditor.create(document.querySelector('#additional_information'), {
            //     cloudServices: {
            //         tokenUrl: "https://33333.cke-cs.com/token/dev/ijrDsqFix838Gh3wGO3F77FSW94BwcLXprJ4APSp3XQ26xsUHTi0jcb1hoBt",
            //         uploadUrl: "https://33333.cke-cs.com/easyimage/upload/"
            //     }
            // }).then(editor => {
            //     editorData = editor;
            // }).catch(error => {
            //     console.error(error);
            // });    
        });

        $(function() {
            var uploadCount = {{ $productData->getMedia('product')->count() }};
            // if (uploadCount == 0) {
                $('.productImagesUploader').show();
                $('.input-images').imageUploader({
                    imagesInputName: 'image[]',
                    extensions: ['.jpg', '.jpeg', '.png','.JPG'],
                    mimes: ['image/jpeg', 'image/png', 'image/jpg','image/JPG'],
                    // maxFiles: 5,
                    // maxSize: 2 * 1024 * 1024,
                });
            // } 
            // else if (uploadCount <= 4) {
            //     // uploadCount = 5 - {{ $productData->getMedia('product')->count() }};
            //     // $('.productImagesUploader').show();
            //     $('.input-images').imageUploader({
            //         imagesInputName: 'image[]',
            //         extensions: ['.jpg', '.jpeg', '.png'],
            //         mimes: ['image/jpeg', 'image/png', 'image/jpg'],
            //         maxFiles: uploadCount,
            //         maxSize: 2 * 1024 * 1024,
            //     });
            // }
        });
        function preview() {
            f = event.target.files[0];
            if((f.type == 'image/jpeg') || (f.type == 'image/jpg') || (f.type == 'image/png')){
                var size = parseFloat(f.size / 1024).toFixed(2);
                // if (size > 2048) {
                //     // toastr.options.timeOut = 4000 
                //     // toastr.error(`The file "${f.name}" exceeds the maximum size of 2Mb`)
                //     toastr.error("Image size should be less than 2 MB!", 'Error!', {
                //         timeOut: '4000',
                //     })
                //     return;
                // }else{
                    featuredImage.src=URL.createObjectURL(event.target.files[0]);
                // }
            }else{
                // toastr.error(`The file "${f.name}" does not match with the accepted mime types: ".jpg", ".jpeg", ".png"`)
                toastr.error("Accepted image format must be jpg, jpeg, png!", 'Error!', {
                    timeOut: '4000',
                })
                return;
            }
        }
    </script>
@endsection