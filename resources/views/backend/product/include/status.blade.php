@if($product['status'] < 2)
	<a class="badge tooltip-top bg-{{ $product['status'] == '1' ? 'success' : 'danger' }} view-btn product-status" data-id="{{ $product['status'] }}" role="button" data-productId="{{ $product['id'] }}" data-url="{{route('product.status', $product['id'])}}" data-tooltip="Click to {{ $product['status'] == '1' ? 'inactive' : 'active' }}"><span class="text-white">{{ $product['status'] == '1' ? 'Active' : 'Inactive' }}</span></a>
@else
    <a href="{{ route('product.create1',['1',$product['id']]) }}" class="tooltip-top badge bg-info" data-id="{{$product['id']}}" id="productEdit" data-tooltip="Draft">Draft</a>
@endif