@if (isset($productData))
    @forelse ($productData as $key => $product)
        <tr>
            <td class="text-center">{{ paginatePage($productData,$key)}}</td>
            <td class="text-center">
                @if ($product->getMedia('featured_product_image')->count())
                    @foreach ($product->getMedia('featured_product_image') as $mediaKey => $media)
                        @if($mediaKey == 0)
                            <img src="{{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }}" height="60" width="60">
                        @endif
                    @endforeach
                @else
                    <img src="{{ asset('backend/no-img.png') }}" height="60" width="60">
                @endif
            </td>
            <td>
                @if(strlen($product->name) > 20)
                    <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($product->name) ?? '-'}}">{{ Str::limit(ucwords($product->name), 20) ?? '-'}}</span>
                @else
                    <span>{{ ucwords($product->name) ?? '-'}}</span>
                @endif
            </td>
            <td>
                @if(isset($product->category->name) &&  strlen($product->category->name) > 20)
                    <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($product->category->name) ?? '-'}}">{{ Str::limit(ucwords($product->category->name), 20) ?? '-'}}</span>
                @else
                    <span>{{ json_decode(collect($product->productCategory)->pluck('category.name')) ? implode(", ",json_decode(collect($product->productCategory)->pluck('category.name'))) : "-" }}</span>
                @endif                
            </td>
            <td class="text-center"><span class="tooltip-top badge rounded-pill {{ $product['type'] == '1' ? 'bg-info' : 'variable-btn' }}" aria-hidden="true" style="cursor: not-allowed;">{{ $product['type'] == '1' ? 'Simple' : 'Variable' }}</span></td>

            @if($product->stock_status != '')
                @if($product->stock_status == 'Out of stock')
                    @php $colorClass = 'bg-danger'; @endphp
                @elseif($product->stock_status == 'On backorder')
                    @php $colorClass = 'variable-btn'; @endphp
                @else
                    @php $colorClass = 'bg-success'; @endphp
                @endif
                <td class="text-center"><span class="tooltip-top badge rounded-pill {{$colorClass}}" aria-hidden="true" style="cursor: not-allowed;">{{ ($product->stock_status) ?? '' }}</span></td>
            @else
                <td class="text-center">{{ '-' }}</td>
            @endif

            <td class="action-wrap text-center status-render">
                @include('backend.product.include.status')
            </td>
            <td class="action-wrap text-center">
                @php $stepStatus = $product->step_status ?? '1'; @endphp
                <a href="{{ route('product.create1',['1', $product->id]) }}" class="btn button-success btn-xs tooltip-left" data-id="{{$product['id']}}" id="productEdit" data-tooltip="Edit Product"><i class="fe-icon" data-feather="edit"></i></a>
            </td>
            {{--<td class="action-wrap text-center">
                @php $stepStatus = $product->step_status ?? '1'; @endphp
                <a href="{{ route('product.create'.$stepStatus,[$stepStatus, $product->id]) }}" class="btn button-success btn-xs tooltip-left" data-id="{{$product['id']}}" id="productEdit" data-tooltip="Edit Product"><i class="fe-icon" data-feather="edit"></i></a>
            </td>--}}
        </tr>
    @empty
        <tr>
            <td colspan="15">
                <div class="text-center mb-3">
                    <i data-feather="alert-circle"></i>
                    <h4 class="title">@lang($flag == 1 ? 'no_product_found' : 'no_product')</h4>
                </div>
            </td>
        </tr>
    @endforelse
@else
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_product_found' : 'no_product')</h4>
            </div>
        </td>
    </tr>
@endif