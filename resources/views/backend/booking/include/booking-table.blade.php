@if (isset($bookingData))
  @forelse ($bookingData as $key => $booking)
    <tr>
      <td class="text-center"><td class="text-center">{{ paginatePage($bookingData,$key) }}</td></td>
      <td class="text-right">{{ $booking->user ? ucwords($booking->user->first_name) : '-' }} {{ $booking->user ?  ucwords($booking->user->last_name) : '-' }}</td>
      <td class="text-right">{{ $booking->user->mobile ?? '-' }}</td>
      <td role="button"  class="text-right"><a class="tooltip-top" data-tooltip="{{ucwords($booking->webinar->name ?? '')}}"> {{ Str::limit(ucwords($booking->webinar->name ?? '-'),40) }}</a></td>
      <td class="text-center">{{ $booking->total_booking }}</td>
      <td class="text-center">{{ dateFormatWithMonthName($booking->created_at) }}</td>
      <td class="text-right">${{ $booking->total_amount ?? '-' }}</td>
      <td class="text-right"><span class="badge bg-{{$booking->payment_status == 0 ? 'warning' :'success'}}" style="cursor: not-allowed;"><span class="text-white">{{$booking->payment_status == 0 ? 'unpaid' :'paid'}} </span>
      </span></td>
      <td class="text-center">
        @if($booking->payment_status == 1)
        <a href="{{ route('booking.generatePDF', $booking->id) }}" class="btn tooltip-top button-view btn-xs" id="contactUsDetail" data-tooltip="Download Invoice"><i class="c-sidebar-nav-icon fe-icon" data-feather="file"></i></a>
        @endif
        <a class="booking-detail btn tooltip-top button-view btn-xs" data-id="{{$booking->id}}" data-url="{{route('booking.create')}}" id="bookingDetail" data-tooltip="View Details"><i class="c-sidebar-nav-icon fe-icon" data-feather="eye"></i></a>
      </td>
    </tr>
  @empty
  <tr>
    <td colspan="15">
      <div class="text-center mb-3">
        <i data-feather="alert-circle"></i>
        <h4 class="title">  @lang('no_booking') </h4>
      </div>
    </td>
  </tr>
  @endforelse
@else
<tr>
  <td colspan="15">
    <div class="text-center mb-3">
      <i data-feather="alert-circle"></i>
      <h4 class="title">  @lang('no_booking') </h4>
    </div>
  </td>
</tr>
@endif
