@if (isset($orders))
    @forelse ($orders as $key => $order)
        <tr>
            <td class="text-center">{{ paginatePage($orders,$key)}}</td>
            <td>{{'#'.$order->order_id ?? '-'}}</td>
            <td class="text-capitalize">
                {{ $order->customer->first_name ?? '-'}} {{ $order->customer->last_name ?? '-'}}
            </td>
            <td>{{ $order->customer->email ?? '-'}}</td>
            <td class="text-center">{{ $order->customer->mobile ?? '-'}}</td>
            <td class="text-center"><i class="fa fa-calendar pt-1"></i> {{ dbCustomDateFormat($order->created_at) ?? '' }}</td>
            {{-- <td class="text-capitalize">
               {{collect($order->orderItems)->pluck('product.name')->count() ? implode(',',json_decode(collect($order->orderItems)->pluck('product.name'))) : '-'}}
            </td> --}}
            <td class="text-center">
                @if($order->payment_status == '1')
                    @php
                        $payText = 'Pending';
                        $colorClass = 'bg-danger';
                    @endphp
                @else
                    @php
                        $payText = 'Completed';
                        $colorClass = 'bg-success';
                    @endphp
                @endif
                <span class="tooltip-top badge rounded-pill {{ $colorClass ?? '' }}" aria-hidden="true" style="cursor: not-allowed;" data-toggle="tooltip">{{ $payText ?? '' }}</span>
            </td>
            <td class="text-center">
                <select name="order_status" class="form-control form-select admin-order-status" data-toggle="tooltip" title="Change Order Status" data-url="{{route('order.status', $order['id'])}}">
                    <option disabled selected>Select</option>
                    <option value="1" {{ $order->order_status == '1' ? 'selected' : '' }}>Processing</option>
                    <option value="2" {{ $order->order_status == '2' ? 'selected' : '' }}>On hold</option>
                    <option value="3" {{ $order->order_status == '3' ? 'selected' : '' }}>Completed</option>
                    <option value="4" {{ $order->order_status == '4' ? 'selected' : '' }} disabled>Refunded</option>
                    <option value="9" {{ $order->order_status == '9' ? 'selected' : '' }} disabled>Cancelled</option>
                    <option value="10" {{ $order->order_status == '10' ? 'selected' : '' }} disabled>Failed</option>
                </select>
            </td>
            <td class="action-wrap text-center">
                <a class="edit-order-modal btn button-success tooltip-left btn-xs" id="faqEdit" data-url="{{route('order.edit', $order->id)}}" data-tooltip="Order Details" data-placement="left"><i class="c-sidebar-nav-icon fe-icon" data-feather="eye"></i></a>

                <a class="btn button-success tooltip-left btn-xs" target="_blank" href="{{route('order.invoice', $order->id)}}" data-tooltip="Download Invoice" data-placement="left"><i class="c-sidebar-nav-icon fe-icon" data-feather="download"></i></a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="15">
                <div class="text-center mb-3">
                    <i data-feather="alert-circle"></i>
                    <h4 class="title">@lang($flag == 1 ? 'no_order_found' : 'no_order') </h4>
                </div>
            </td>
        </tr>
    @endforelse
@else
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_order_found' : 'no_order') </h4>
            </div>
        </td>
    </tr>
@endif