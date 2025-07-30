@extends('backend.layouts.app', ['title' => 'General Information'])
@section('content')
<style type="text/css">
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/step-form.css') }}">

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
                            <li><a class="nav-link wizard-btn active" href="{{ (isset($productData) && $productData != []) ? route('product.create1',['1',$id]) : 'javascript:;' }}">General Information</a></li>

                            <li><a class="nav-link" href="{{ (isset($productData->product_information) && $productData != []) ? route('product.create2',['2',$id]) : 'javascript:;' }}">Inventory Information</a></li>

                            <li><a class="nav-link" href="{{ (isset($productData->productAttribute) && count($productData->productAttribute) > 0) ? route('product.create3',['3',$id]) : 'javascript:;' }}">Attribute Information</a></li>

                            <li class="step-4"><a class="nav-link" href="{{ (isset($allCombinations->productVariation) && count($allCombinations->productVariation) > 0) ? route('product.create4',['4',$id]) : 'javascript:;' }}">Variation Information</a></li>
                        </ul>
                    </div>
                    <fieldset class="wizard-fieldset show">
                        <form method="POST" action="{{route('product.store1')}}" autocomplete="off">
                            @csrf
                            @method('post')
                            <input type="hidden" name="product_id" class="product_id" value="{{ $id ?? '' }}">
                            <input type="hidden" name="next_id" class="next_id" value="1">
                            <div class="product-head text-left">
                                <h5>General Information</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Product Category<span class="text-danger">*</span></label>
                                        {{-- {{dd($categories)}} --}}
                                        <div class="category-select-box">
                                            <select name="category[]" class="category-select2 form-control form-select" data-rule-required="true" data-msg-required="{{ __('required_category') }}" multiple="multiple">
                                                <option disabled>Select Category</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if(isset($productData->productCategory))
                                                    @foreach ($productData->productCategory as $prodCate)
                                                    @if(isset($prodCate) && $prodCate->category_id == $category->id)
                                                    {{'selected'}}
                                                    @else
                                                    {{ (old('category') == $category->id) ? 'selected' : '' }}
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                    >{{ucwords($category->name) ?? ''}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category')
                                        <span class="text-danger error">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Product Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control product-name" name="name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="100" data-msg-required="{{ __('required_name') }}" value="{{ $productData->name ?? old('name') }}">
                                        @error('name')
                                        <span class="text-danger error">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Product Type<span class="text-danger">*</span></label>
                                        <select name="type" class="form-control form-select type" data-rule-required="true" data-msg-required="{{ __('required_product_type') }}">
                                            <option disabled>Select Product Type</option>
                                            <option value="1" {{ (isset($productData->type) && $productData->type == "1") ? "selected" : ((old('type') == '1') ? 'selected' : 'selected') }}>Simple Product</option>
                                            <option value="2" {{ (isset($productData->type) && $productData->type == "2") ? "selected" : ((old('type') == '2') ? 'selected' : '') }}>Variable Product</option>
                                        </select>
                                        @error('type')
                                        <span class="text-danger error">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 regular-sale-price">
                                    <div class="form-group">
                                        <label>Regular Price<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fa fa-rupee"></i>
                                            </div>
                                            <input type="text" class="form-control regular_price numberonly amount" name="regular_price" data-rule-required="true" data-msg-required="{{ __('required_regular_price') }}" value="{{ $productData->regular_price ?? old('regular_price') }}">
                                        </div>
                                        @error('regular_price')
                                        <span class="text-danger error">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 regular-sale-price">
                                    <div class="form-group">
                                        <label>Sale Price</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fa fa-rupee"></i>
                                            </div>
                                            <input type="text" class="form-control sale_price numberonly amount" name="sale_price" data-rule-required="true" data-msg-required="{{ __('required_sale_price') }}" value="{{ $productData->sale_price ?? old('sale_price') }}">
                                        </div>
                                        @error('sale_price')
                                        <span class="text-danger error">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Product Brand</label>
                                        <select name="brand" class="form-control form-select brand" data-rule-required="true" data-msg-required="{{ __('required_product_brand') }}">
                                            <option value="">Select Product Brand {{ old('brand') }}</option>
                                            @if($brands->count()>0)
                                            @foreach ($brands as $key => $brand)
                                            <option value="{{ $brand->id }}" {{ (isset($productData->brand_id) && $productData->brand_id == $brand->id) ? "selected" : ((old('brand') == $brand->id) ? 'selected' : '') }}>{{ ucwords($brand->name) ?? '' }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @error('brand')
                                        <span class="text-danger error">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Featured Product</label>
                                        <select class="form-contro form-select" name="featured_product" id="featured_product" data-rule-required="true" data-msg-required="{{ __('required_featured_product') }}">
                                            <option disabled>Select Featured Product</option>
                                            <option value="0" {{ (isset($productData->featured_product) && $productData->featured_product == "0") ? "selected" : ((old('featured_product') == '0') ? 'selected' : 'selected') }} selected>No</option>
                                            <option value="1" {{ (isset($productData->featured_product) && $productData->featured_product == "1") ? "selected" : ((old('featured_product') == '1') ? 'selected' : '') }}>yes</option>
                                        </select>
                                        <span class="text-danger error featured_product-error"></span>
                                        @error('featured_product')
                                        <span class="text-danger error">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="product-head text-left">
                                    <h5>SEO</h5>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>SEO Title</label>
                                        <input type="text" class="form-control" name="title" value="{{ $productData->seoAnalysis->title ?? old('title') }}">
                                        @error('title')
                                        <span class="text-danger error">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Meta Keywords</label>
                                        <input type="text" name="meta_keywords" class="form-control meta_keywords" value="{{ $productData->seoAnalysis->meta_keywords ?? old('meta_keywords') }}">
                                        @error('meta_keywords')
                                        <span class="text-danger error">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <textarea name="description" class="form-control description" rows="2">{{ $productData->seoAnalysis->description ?? old('description') }}</textarea>
                                        @error('description')
                                        <span class="text-danger error">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group clearfix" style="text-align: right;">

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
@endsection