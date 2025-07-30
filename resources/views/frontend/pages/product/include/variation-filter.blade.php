{{-- @foreach ( $variationList as $keyAttr => $attribute) --}}
@foreach ( $variationList as $keyAttr => $attribute)
    {{-- {{dd($attribute)}} --}}
    <div class="product-wrap mt-2 mb-2">
        <label for="">{{ ucfirst(str_replace('-', ' ',$keyAttr)) }}</label>
        <select class="filed-select {{$keyAttr}}-variationFilter  variationFilter" data-url="{{ route("variationFilter", $slug) }}" name="{{ $keyAttr?? "" }}" data-name="{{ $keyAttr ?? "" }}">
            <option data-display="{{ ucfirst(str_replace('-', ' ',$keyAttr)) }}" selected disabled>{{ ucfirst(str_replace('-', ' ',$keyAttr)) }}</option>
            @php $flagVariation = true; @endphp
            @foreach ($attribute as $varitaionKey => $varitaion)
                <option value="{{ $varitaion["id"] }}" {{ isset($attributeRequest[$keyAttr]) && $attributeRequest[$keyAttr] == $varitaion['id'] ? "selected" : ""}}>{{$varitaion["name"] ?? "" }}</option>
            @endforeach
        </select>
    </div>
@endforeach
@if($filterStatus)
<div class="clear-section d-block w-100">
    <a href="javascript:;" class="clear-filter" data-url="{{route('product.clear.filter', $slug)}}"><i data-feather="x" height="15" class="mb-2"></i><span class="font-weight-bold">Clear selection</span></a>
</div>
@endif