@if (isset($shippings))
@php $i = 0; @endphp
    @forelse ($shippings as $key => $shipping)
        <tr>
            <td class="text-center">{{ paginatePage($shippings,$i)}}</td>
            @php $i++ @endphp
            <td>
                @if(strlen($key) > 30)
                    <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($key) ?? '-'}}">{{ Str::limit(ucwords($key), 30) ?? '-'}}</span>
                @else
                    <span>{{ ucwords($key) ?? '-'}}</span>
                @endif
            </td>
            <td>{{ implode(', ',collect($shipping)->pluck('state')->toArray())}}</td>
            <td class="text-center">{{ '₹'.collect($shipping)->first()->fixed_amount}}</td>

            <td class="status-render text-center">
                @include('backend.shipping.include.status')
            </td>
            <td class="action-wrap text-center">
                <a class="edit-shipping-modal btn button-success tooltip-top btn-xs"  id="faqEdit" data-url="{{route('shipping.edit', Str::slug(collect($shipping)->first()->zone_name))}}" data-tooltip="Edit Shipping"> <i class="c-sidebar-nav-icon fe-icon" data-feather="edit"></i></a>

                <a class="delete-shipping btn button-success tooltip-top btn-xs" data-url="{{route('shipping.destroy',Str::slug(collect($shipping)->first()->zone_name))}}" data-tooltip="Delete Shipping"><i class="c-sidebar-nav-icon fe-icon" data-feather="trash"></i></a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="15">
                <div class="text-center mb-3">
                    <i data-feather="alert-circle"></i>
                    <h4 class="title">@lang($flag == 1 ? 'no_shippings_found' : 'no_shippings')</h4>
                </div>
            </td>
        </tr>
    @endforelse
@else
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_shippings_found' : 'no_shippings')</h4>
            </div>
        </td>
    </tr>
@endif