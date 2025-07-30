@if (isset($couponData))
    @forelse ($couponData as $key => $coupon)
    <tr>
        <td class="text-center">{{ paginatePage($couponData,$key)}}</td>
        <td>{{ $coupon->code ?? '-' }}</td>
        <td class="text-center">
            @php $applyOn = '' @endphp
            @if($coupon->apply_on == 2)
                @php $applyOn = 'Product' @endphp
            @elseif($coupon->apply_on == 3)
                @php $applyOn = 'Category' @endphp
            @else
                @php $applyOn = 'Gross Total' @endphp
            @endif
            {{ $applyOn ?? '-' }}
        </td>
        <td class="text-center">{{ $coupon->typetext ?? '-' }}</td>
        <td class="text-center">{{ ($coupon->type == 2 || $coupon->type == 3) ? '₹' : '' }}{{ $coupon->amount ?? '0.00' }}{{ ($coupon->type == 1) ? '%' : '' }}</td>
        <td class="text-center">{{ $coupon->usage_limit ?? '-' }}</td>
        <td class="text-center"><i class="fa fa-calendar pt-1"></i> {{ dbCustomDateFormat($coupon->start_date) ?? '-' }}</td>
        <td class="text-center"><i class="fa fa-calendar pt-1"></i> {{ dbCustomDateFormat($coupon->end_date) ?? '-' }}</td>
        <td class="status-render text-center">
            @include('backend.coupon.include.status')
        </td>
        <td class="action-wrap text-center">
            <a class="edit-coupon-modal btn button-success tooltip-top btn-xs" data-url="{{ route('coupon.edit', $coupon['id']) }}" id="profileView" data-tooltip="Edit Coupon"><i class="c-sidebar-nav-icon fe-icon" data-feather="edit"></i></a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_coupon_found' : 'no_coupon') </h4>
            </div>
        </td>
    </tr>
    @endforelse
@else
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_coupon_found' : 'no_coupon') </h4>
            </div>
        </td>
    </tr>
@endif