@extends('backend.layouts.app', ['title' => 'Attribute Information'])
@section('content')

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

                            <li><a class="nav-link wizard-btn active" href="{{ (isset($productData->product_information) && $productData != []) ? route('product.create2',['2',$id]) : 'javascript:;' }}">Inventory Information</a></li>

                            <li><a class="nav-link wizard-btn active" href="{{ (isset($productData->productAttribute) && count($productData->productAttribute) > 0) ? route('product.create3',['3',$id]) : 'javascript:;' }}">Attribute Information</a></li>

                            @if($productData->type == '2')
                            <li class="step-4"><a class="nav-link" href="{{ (isset($allCombinations->productVariation) && count($allCombinations->productVariation) > 0) ? route('product.create4',['4',$id]) : 'javascript:;' }}">Variation Information</a></li>
                            @endif
                        </ul>
                    </div>
                    <fieldset class="wizard-fieldset show">
                        <form method="POST" action="{{route('product.store3')}}" class="variation-form" autocomplete="off">
                            @csrf
                            @method('post')
                            <input type="hidden" name="product_id" class="product_id" value="{{ $id ?? '' }}">
                            <input type="hidden" name="next_id" class="next_id" value="3">
                            <div class="product-head text-left">
                                <h5>Attribute Information</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Select Attribute<span class="text-danger">*</span></label>
                                        <select name="attribute" class="form-control form-select attribute" data-rule-required="true" data-msg-required="{{ __('required_attribute') }}">
                                            <option value="" selected disabled>Select Attribute</option>
                                            @foreach ($attribute as $attribute)
                                                @if(isset($productData->productAttribute) && $productData->productAttribute != [])
                                                    <option value="{{ $attribute->id }}"
                                                        @foreach ($productData->productAttribute as $attr)
                                                            @if($attribute->id == $attr->attribute_id)
                                                                {{ "disabled" }}
                                                            @endif
                                                        @endforeach
                                                    >{{ ucwords($attribute->name) ?? '' }}</option>
                                                @else
                                                    <option value="{{ $attribute->id }}">{{ ucwords($attribute->name) ?? '' }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('attribute')
                                            <span class="text-danger error">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="attribute-data">
                                    <!-- ATTRIBUTES APPEND HERE FOR CREATE -->

                                    <!-- ATTRIBUTES APPEND HERE FOR EDIT -->
                                    @if(isset($productData->productAttribute) && $productData->productAttribute != [])
                                        @include('backend.product.include.product-attribute-edit')
                                    @endif
                                </div>
                            </div>
                            <div class="form-group clearfix" style="text-align: right;">
                                <a href="{{ route('product.create2',['2',$id]) }}" class="btn btn-primary back"><i class="fa fa-arrow-left"></i><span class="back-arrow">Back</span></a>
                                @if($productData->type == '2')
                                <button type="submit" class="btn btn-primary next" name="whichClick" value="1"><span class="next-arrow">Save</span></button>
                                @endif
                                <button type="button" class="btn btn-primary attribute-validate next" data-num='{{ $productData->type == "1" ? "3" : "0 " }}' data-prod-type="{{ $productData->type ?? '' }}">
                                    {{ $productData->type == '1' ? "Save" : "Save & Next " }}
                                    @if($productData->type == '2')
                                        <i class="fa fa-arrow-right"></i>
                                    @endif
                                </button>
                                <button class="attribute-submit d-none">Submit</button>
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