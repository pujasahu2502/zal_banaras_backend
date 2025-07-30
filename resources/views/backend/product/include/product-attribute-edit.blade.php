@forelse ($productData->productAttribute as $attrVar)
<div class="attribute-list col-lg-12 col-md-12">
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{$attrVar->attribute->slug ?? ''}}">
                <button class="accordion-button" type="button" data-coreui-toggle="collapse" data-coreui-target="#collapse{{$attrVar->attribute->slug ?? ''}}" aria-expanded="true" aria-controls="collapse{{$attrVar->attribute->slug ?? ''}}">{{ $attrVar->attribute->name ?? '' }}</button>
            </h2>
            <a class="text-danger remove-attribute tooltip-top" data-toggle="tooltip" data-tooltip="Remove Attribute" role="button" data-url="{{route('product.removeattribute', $attrVar->id)}}"><small>Remove</small></a>
            <div id="collapse{{$attrVar->attribute->slug ?? ''}}" class="accordion-collapse" aria-labelledby="heading{{$attrVar->attribute->slug ?? ''}}" data-coreui-parent="#accordionExample"><!-- Class = collapse -->
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-lg-2 col-md-2">
                            <div class="form-group">
                                <label>Name:</label>
                                <p class="attr-title">{{$attrVar->attribute->name ?? ''}}</p>
                                <input type="hidden" name="{{$attrVar->attribute->slug ?? ''}}_attribute_id" value="{{$attrVar->attribute->id ?? ''}}">
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-10">
                            <div class="form-group">
                                <label>Value</label>
                                <select class="attribute-select2 form-control form-select select-{{ $attrVar->attribute->slug ?? ''}}" name="{{$attrVar->attribute->slug ?? ''}}_attribute_value[]" multiple="multiple">
                                    @forelse($attrVar->totalVariation as $attrKey => $attrVal)
                                        @if($attrVal->status == '1')
                                            <option value="{{ $attrVal->id ?? '' }}" {{in_array($attrVal->id, json_decode($attrVar->variation_id)) > 0 ? 'selected' : ''}}>{{ $attrVal->name ?? '' }}</option>
                                        @endif
                                    @empty
                                    
                                    @endforelse
                                </select>
                                <span class="varitaion-error error text-danger"></span>
                            </div>
                            <div class="form-group">
                                <a href="javaScript:;" class="btn btn-outline-secondary select-all" data-attr-slug="{{ $attrVar->attribute->slug ?? '' }}">Select All</a>
                                <a href="javaScript:;" class="btn btn-outline-secondary select-none" data-attr-slug="{{ $attrVar->attribute->slug ?? '' }}">Select None</a>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2">
                            <div class="form-group">
                                <label>Priority:</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-10">
                            <div class="form-group">
                                <input type="number" class="form-control priorityAttribute number-data" name="{{$attrVar->attribute->slug ?? ''}}_priority" value="{{$attrVar->priority ?? ''}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>
@empty
<div class="col-lg-12 col-md-12 mb-5 mt-3 no-category-found" style="padding: 12px 12px; border: 1px solid; border-color: #e5e5e5; color: black; background-color: #e5e5e5;">
    <div class="text-center">
        <p style="font-size: 24px; font-weight: 500;"><i data-feather="alert-circle"></i><br>Currently, there is no attribute available!</p>
    </div>
</div>
@endforelse