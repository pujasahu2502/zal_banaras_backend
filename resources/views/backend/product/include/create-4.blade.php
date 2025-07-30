@extends('backend.layouts.app', ['title' => 'Variation Information'])
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/step-form.css') }}">
<style type="text/css">
    .variation-tab {
        border: 2px solid #cccc;
        padding: 5px 5px 5px 5px;
        border-radius: 8px;
        background-color: #fff;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
</style>
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

                            <li class="step-4"><a class="nav-link wizard-btn active" href="{{ (isset($allCombinations->productVariation) && count($allCombinations->productVariation) > 0) ? route('product.create4',['4',$id]) : 'javascript:;' }}">Variation Information</a></li>
                        </ul>
                    </div>
                    <fieldset class="wizard-fieldset show">
                        <form method="POST" id="form-varitaion-id" action="{{route('product.store4')}}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <input type="hidden" name="product_id" class="product_id" value="{{ $id ?? '' }}">
                            <input type="hidden" name="next_id" class="next_id" value="4">
                            <div class="product-head text-left">
                                <h5>Variation Information</h5>
                            </div>
                            <div class="row">

                                @if (isset($allCombinations))
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-center" width="5%">S.No.</th>
                                                    {{-- <th scope="col" class="text-center" width="10%">Image</th> --}}
                                                    <th scope="col">Product Variations</th>
                                                    <th scope="col" width="5%">Status</th>
                                                    <th scope="col" class="text-center" width="13%">Regular Price</th>
                                                    <th scope="col" class="text-center" width="13%">Sale Price</th>
                                                    <th scope="col" class="text-center" width="11%">SKU</th>
                                                    <th scope="col" class="text-center" width="13%">Stock Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="product-variation-table admin-table">
                                                @php
                                                $count = count($combinations);
                                                @endphp
                                                <input type="hidden" name="count" value="{{ $count }}">
                                                @forelse ($combinations as $key => $value)
                                                <input type="hidden" name="product_variations_id[]" value="{{ $value->id }}">
                                                <tr class="data-row">
                                                    <td class="text-center">{{ paginatePage($combinations,$key) }}</td>
                                                    {{-- <td class="text-center variation-image-td">
                                                        <div class="upload-img-block form-group mb-0">
                                                            <div class="upload__btn-box d-none">
                                                                <label data-toggle="tooltip" data-placement="top" title="Choose Product Image" class="upload__btn">
                                                                    <input type='file' name="image{{$key}}" class="upload__inputfile variation-image" data-key="{{ $key+1 }}" data-count="0" data-check="create" accept=".png, .jpg, .jpeg">
                                                                </label>
                                                            </div>
                                                            <div class="product-image upload__img-wrap d-none"></div>
                                                            <div class="no-img {{ $value->getMedia('product')->count() != 0 ? 'd-none' : '' }}">
                                                                <img src="{{ asset('backend/no-img.png')}}" alt="" class="image-uploader image-uploader-{{$key+1}}" data-coreui-placement="right" data-toggle="tooltip" title="Note: Image size should be less than 2 MB and Accepted image format must be jpg, jpeg, png.">
                                                            </div>
                                                            <div class="upload__img-wrap-edit {{ $value->getMedia('product')->count() == 0 ? 'd-none' : '' }}">
                                                                @if ($value->getMedia('product')->count())
                                                                @forelse ($value->getMedia('product') as $media)
                                                                <div class="upload__img-box">
                                                                    <div style="background-image: url({{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }})" data-number="0" data-file="536402.jpg" class="img-bg">
                                                                        <div class="upload__img-close" data-check="edit" data-url="{{ route('product.destroyMedia', $media->id) }}" data-id="{{ $media->id }}"></div>
                                                                    </div>
                                                                </div>
                                                                @empty
                                                                <div class="no-img">
                                                                    <img src='{{asset("backend/no-img.png")}}' alt="" class="image-uploader" data-coreui-placement="right" data-toggle="tooltip" title="Note: Maximum 5 images can be uploaded at a time, Image size should be less than 2 MB and Accepted image format must be jpg, jpeg, png.">
                                                                </div>
                                                                @endforelse
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td> --}}
                                                    <td>
                                                        @forelse ($value->variation as $varKey => $varValue)
                                                        <label class="variation-tab">{{ $varValue->name ?? '' }}</label>
                                                        @empty

                                                        @endforelse
                                                    </td>
                                                    <td>
                                                        <div class="required-field-block">
                                                            <div class="variation-block form-check form-switch" data-toggle="tooltip" title="{{$value->status == 2 ? 'This variation is no more longer available.' : 'Enabling this button makes this variation of the product available.' }}">
                                                                <input type="checkbox" role="switch" name="status[]" class="form-check-input status-checkbox" attr-id="{{ $value->id }}" {{ $value->status == '1' ? 'checked' : '' }} {{$value->status == 2 ? 'disabled' : '' }}>

                                                                <input type="hidden" name="status_value[]" id="status-value-{{ $value->id }}" value="{{ $value->status ?? '1' }}">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="required-field-block">
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <i class="fa fa-rupee"></i>
                                                                </div>
                                                                <input type="text" name="regular_price[]" class="form-control wizard-required regular_price numberonly amount closePaste" value="{{ $value->regular_price ?? '' }}" {{$value->status == 2 ? ' ' : '' }}>
                                                            </div>
                                                            <span class="error regular-price-error text-danger"></span>
                                                            
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="required-field-block">
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <i class="fa fa-rupee"></i>
                                                                </div>
                                                                <input type="text" name="sale_price[]" class="form-control numberonly amount closePaste" value="{{ $value->sale_price ?? '' }}" {{$value->status == 2 ? 'readonly' : '' }}>
                                                                <span class="error sale-price-error text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="required-field-block">
                                                            <input type="text" name="sku[]" class="form-control sku sku-name" value="{{ isset($value->sku) ?  ($value->sku ?? ' ') : skuVariation() . ($key+1) . 'V' }}" {{$value->status == 2 ? ' ' : '' }}>
                                                            {{-- <span class="error text-danger sku-error"></span> --}}
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="required-field-block">
                                                            <select name="stock_status[]" class="form-control form-select">
                                                                <option value="In stock" {{ (isset($value->stock_status) && $value->stock_status == "In stock") ? "selected" : '' }} {{$value->status == 2 ? 'readonly' : '' }}>In stock</option>
                                                                <option value="Out of stock" {{ (isset($value->stock_status) && $value->stock_status == "Out of stock") ? "selected" : '' }} {{$value->status == 2 ? 'disabled selected' : '' }}>Out of stock</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty

                                                @endforelse
                                            </tbody> 
                                            <!-- showing pagination for product variation -->
                                            {{-- <tbody class="product-variation-table admin-table">
                                                @php
                                                $count = count($allCombinations);
                                                @endphp
                                                <input type="hidden" name="count" value="{{ $count }}">
                                                @forelse ($allCombinations as $key => $value)
                                                <input type="hidden" name="product_variations_id[]" value="{{ $value->id }}">
                                                <tr class="data-row">
                                                    <td class="text-center">{{ $key+1 }}</td>
                                                    <td class="text-center variation-image-td">
                                                        <div class="upload-img-block form-group mb-0">
                                                            <div class="upload__btn-box d-none">
                                                                <label data-toggle="tooltip" data-placement="top" title="Choose Product Image" class="upload__btn">
                                                                    <input type='file' name="image{{$key}}" class="upload__inputfile variation-image" data-key="{{ $key+1 }}" data-count="0" data-check="create" accept=".png, .jpg, .jpeg">
                                                                </label>
                                                            </div>
                                                            <div class="product-image upload__img-wrap d-none"></div>
                                                            <div class="no-img {{ $value->getMedia('product')->count() != 0 ? 'd-none' : '' }}">
                                                                <img src="{{ asset('backend/no-img.png')}}" alt="" class="image-uploader image-uploader-{{$key+1}}" data-coreui-placement="right" data-toggle="tooltip" title="Note: Maximum 5 images can be uploaded at a time, Image size should be less than 2 MB and Accepted image format must be jpg, jpeg, png.">
                                                            </div>
                                                            <div class="upload__img-wrap-edit {{ $value->getMedia('product')->count() == 0 ? 'd-none' : '' }}">
                                                                @if ($value->getMedia('product')->count())
                                                                @forelse ($value->getMedia('product') as $media)
                                                                <div class="upload__img-box">
                                                                    <div style="background-image: url({{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }})" data-number="0" data-file="536402.jpg" class="img-bg">
                                                                        <div class="upload__img-close" data-check="edit" data-url="{{ route('product.destroyMedia', $media->id) }}" data-id="{{ $media->id }}"></div>
                                                                    </div>
                                                                </div>
                                                                @empty
                                                                <div class="no-img">
                                                                    <img src='{{asset("backend/no-img.png")}}' alt="" class="image-uploader" data-coreui-placement="right" data-toggle="tooltip" title="Note: Maximum 5 images can be uploaded at a time, Image size should be less than 2 MB and Accepted image format must be jpg, jpeg, png.">
                                                                </div>
                                                                @endforelse
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        @forelse ($value->variation as $varKey => $varValue)
                                                        <label class="variation-tab">{{ $varValue->name ?? '' }}</label>
                                                        @empty

                                                        @endforelse
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="required-field-block">
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <i class="fa fa-rupee"></i>
                                                                </div>
                                                                <input type="text" name="regular_price[]" class="form-control wizard-required regular_price numberonly amount closePaste" value="{{ $value->regular_price ?? '' }}">
                                                            </div>
                                                            <span class="error regular-price-error text-danger"></span>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="required-field-block">
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <i class="fa fa-rupee"></i>
                                                                </div>
                                                                <input type="text" name="sale_price[]" class="form-control numberonly amount closePaste" value="{{ $value->sale_price ?? '' }}">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="required-field-block">
                                                            <input type="text" name="sku[]" class="form-control sku sku-name closePaste" value="{{ $value->sku ?? '' }}">
                                                            <span class="error text-danger sku-error"></span>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="required-field-block">
                                                            <select name="stock_status[]" class="form-control form-select">
                                                                <option value="In stock" {{ (isset($value->stock_status) && $value->stock_status == "In stock") ? "selected" : '' }}>In stock</option>
                                                                <option value="Out of stock" {{ (isset($value->stock_status) && $value->stock_status == "Out of stock") ? "selected" : '' }}>Out of stock</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="required-field-block">
                                                            <div class="variation-block form-check form-switch">
                                                                <input type="checkbox" role="switch" name="status[]" class="form-check-input status-checkbox" attr-id="{{ $value->id }}" {{ $value->status == '1' ? 'checked' : '' }}>

                                                                <input type="hidden" name="status_value[]" id="status-value-{{ $value->id }}" value="{{ $value->status ?? '1' }}">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty

                                                @endforelse
                                            </tbody> --}}
                                            <!-- end pagination for product variation -->
                                        </table>
                                    </div>
                                </div>
                                <!-- product variation pagination div -->
                                <div class="view-btn">
                                    {{ $combinations->links() }}
                                </div>
                                <!-- end variation pagination div here -->
                                @else

                                @endif
                            </div>
                            <div class="form-group clearfix" style="text-align: right;">
                                <input type="hidden" name="whichClick" class="which-click" value="0">
                                <a href="{{ route('product.create3',['3',$id]) }}" class="btn btn-primary back"><i class="fa fa-arrow-left"></i><span class="back-arrow">Back</span></a>
                                <button type="submit" class="btn btn-primary variation-submit d-none">Save</button>
                                
                                <button type="button" class="btn btn-primary variation-validate next" data-which-click="1">Save</button>
                                <button type="button" class="btn btn-primary variation-validate next" data-which-click="0">Save & Continue</button>
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

<script type="text/javascript">
    $('.status-checkbox').click(function() {
        var attrId = $(this).attr('attr-id');
        if ($(this).is(':checked')) {
            $('#status-value-' + attrId).val('1');
        } else {
            $('#status-value-' + attrId).val('0');
        }
    });
</script>

<script>
    /* === VALIDATION === */
    $(document).on('click', '.variation-validate', function() {
        let flag = true, statusFlag = false;
        $('.data-row').each(function() { 
            if($(this).find('.status-checkbox').is(":checked")) {
                statusFlag = true;
            }
        });
        if(statusFlag) {
            $('.data-row').each(function() {
                let regularPrice = $(this).find('.regular_price').val();
                let salePrice = $(this).find('input[name="sale_price[]"]').val();
                if(!salePrice) {
                    salePrice = 0;
                }
                let sku = $(this).find('.sku').val();
                let status = $(this).find('.status-checkbox').is(':checked');
                console.log(parseFloat(regularPrice) +'>='+ parseFloat(salePrice));
                console.log(parseFloat(regularPrice) >= parseFloat(salePrice));
                console.log("--", status)
                if(status){
                    if (parseFloat(regularPrice) < parseFloat(salePrice)) {
                        $(this).find('.sale-price-error').text('sale price is less or equal.');
                        flag = false;
                    }

                    if (regularPrice == '') {
                        $(this).find('.regular-price-error').text('Required');
                        flag = false;
                    }

                    if (sku == '') {
                        $(this).find('.sku-error').text('Required');
                        flag = false;
                    }
                }
            });

            if (flag) {
                $('.which-click').val('');
                var dataWhichClick = $(this).attr('data-which-click');
                $('.which-click').val(dataWhichClick);
                setTimeout(function() {
                    $('.variation-submit').click();
                }, 2000);
            }
        }else{
            toastr.error('Atleast One variation need to be active!', 'Error!', {
                timeOut: '4000',
            });
        }
    });

    $(document).on('focus', '.regular_price,.sku', function() {
        if ($(this).hasClass('regular_price')) {
            $(this).closest('td').find('.regular-price-error').text(' ');
        }
        if ($(this).hasClass('sku')) {
            $(this).closest('td').find('.sku-error').text(' ');
        }
    });
</script>
@endsection