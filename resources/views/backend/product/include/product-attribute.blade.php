<div class="attribute-list" id="main-{{ $attribute->id ?? '' }}">
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{$attribute->slug ?? ''}}">
                <button class="accordion-button" type="button" data-coreui-toggle="collapse" data-coreui-target="#collapse{{$attribute->slug ?? ''}}" aria-expanded="true" aria-controls="collapse{{$attribute->slug ?? ''}}">{{ $attribute->name ?? '' }}</button>
            </h2>
            <a class="text-danger remove-attribute tooltip-top" data-toggle="tooltip" data-tooltip="Remove Attribute" role="button" data-name="{{ $attribute->name ?? '' }}" data-id="{{ $attribute->id ?? '' }}" data-url=""><small>Remove</small></a>
            <div id="collapse{{$attribute->slug ?? ''}}" class="accordion-collapse" aria-labelledby="heading{{$attribute->slug ?? ''}}" data-coreui-parent="#accordionExample"><!-- Class = collapse -->
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-lg-2 col-md-2">
                            <div class="form-group">
                                <label>Name:</label>
                                <p class="attr-title">{{$attribute->name ?? ''}}</p>
                                <input type="hidden" name="{{$attribute->slug ?? ''}}_attribute_id" value="{{$attribute->id ?? ''}}">
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-10">
                            <div class="form-group">
                                <label>Value</label>
                                <select class="attribute-select2 form-control form-select select-{{ $attribute->slug ?? ''}}" name="{{$attribute->slug ?? ''}}_attribute_value[]" multiple="multiple">
                                    @forelse($attribute->variations as $attrKey => $attrVal)
                                        <option value="{{ $attrVal->id ?? '' }}">{{ $attrVal->name ?? '' }}</option>
                                    @empty

                                    @endforelse
                                </select>
                                <span class="varitaion-error error text-danger"></span>
                            </div>
                            <div class="form-group">
                                <a href="javaScript:;" class="btn btn-outline-secondary select-all" data-attr-slug="{{ $attribute->slug ?? '' }}">Select All</a>
                                <a href="javaScript:;" class="btn btn-outline-secondary select-none" data-attr-slug="{{ $attribute->slug ?? '' }}">Select None</a>
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