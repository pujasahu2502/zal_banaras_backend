<div class="modal fade modal-create" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
  <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"><i class="fe-icon mr-2" data-feather="book-open"></i>Booking Details</h5>
    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
    <h6 class="text-right" style="margin-right: 12px;"><span class="badge bg-{{ $bookingData->payment_status == '1' ? 'success' : 'warning' }}">{{ $bookingData->payment_status == '1' ? 'Paid' : 'Unpaid' }}</span></h6>
    </div>
    <div class="modal-body my-order-block">
    <div class="order-detail-block">
      <div class="row mb-4 mr-1 ml-1 mt-2">
      <div class="col-sm-12">
        <div class="d-flex justify-content-between mt-2">
        <div>
          @if (isset($bookingData->payment))
          <div class="d-flex detail_item">
            <span class="font-weight-bold">{{ __('Invoice Id ') }}</span>
            <span class="detail-colon">:</span>
            <span class="order-detail-content">{{ $bookingData->invoice_id ?? '-' }}</span>
          </div>
          <div class="d-flex detail_item">
            <span class="font-weight-bold">{{ __('Order Id') }}</span>
            <span class="detail-colon">:</span>
            <span class="order-detail-content">{{ $bookingData->order_number ?? '-' }}</span>
          </div>
          @endif
        </div>
        <div class="d-flex detail_item">
          <span class="font-weight-bold">{{ __('Order Date') }}</span>
          <span class="detail-colon">:</span>
          <span class="order-detail-content">{{ dateFormatWithMonthName($bookingData->created_at) ?? '-' }}</span>
        </div>
        </div>
      </div>
      </div>
    </div>
    <div class="order-detail-block">
      <div class="row mb-4 mr-1 ml-1 mt-2">
      <div class="col-sm-6">
        <h5>Customer Detail</h5>
        <div class="mt-2">
        <div class="d-flex detail_item">
          <span class="font-weight-bold">{{ __('Name') }}</span>
          <span class="detail-colon">:</span>
          <span class="order-detail-content">{{ ucwords($bookingData->user->display_name) ?? '-' }}</span>
        </div>
        <div class="d-flex detail_item">
          <span class="font-weight-bold">{{ __('Email') }}</span>
          <span class="detail-colon">:</span>
          <span class="order-detail-content">{{ ucwords($bookingData->user->email) ?? '-' }}</span>
        </div>
        <div class="d-flex detail_item">
          <span class="font-weight-bold">{{ __('Mobile No') }}</span>
          <span class="detail-colon">:</span>
          <span class="order-detail-content">{{ ucwords($bookingData->user->mobile) ?? '-' }}</span>
        </div>

        </div>
      </div>
      <div class="col-sm-6">
        <h5>Raffle Detail</h5>
        <div class="mt-2">
        <div class="d-flex webinar-detail_item">
          <span class="font-weight-bold">{{ __('Raffle') }}</span>
          <span class="detail-colon">:</span>
          <span class="order-detail-content">{{ ucwords($bookingData->webinar->name) ?? '-' }}</span>
        </div>
        <div class="d-flex webinar-detail_item">
          <span class="font-weight-bold">{{ __('Releasing Date') }}</span>
          <span class="detail-colon">:</span>
          <span class="order-detail-content">{{ dateFormatWithMonthName($bookingData->webinar->releasing_date) ?? '-' }}</span>
        </div>
        <div class="d-flex webinar-detail_item">
          <span class="font-weight-bold">{{ __('Releasing Time') }}</span>
          <span class="detail-colon">:</span>
          <span class="order-detail-content">{{ $bookingData->webinar->releasing_time ?? '-' }}</span>
        </div>
        <div class="d-flex webinar-detail_item">
          <span class="font-weight-bold">{{ __('Reserved Seats') }}</span>
          <span class="detail-colon">:</span>
          <span class="order-detail-content">{{ ucwords($bookingData->booking_per_person_count) ?? '-' }}</span>
        </div>
        </div>
      </div>
      </div>
    </div>
    <div class="order-detail-block">
      <div class="row mb-4 mr-1 ml-1 mt-2">
      <div class="col-sm-6">
        <h5 class="detail-head">Shipping Address</h5>
        <div class="mt-2">
        <div class="d-flex detail_item">
          <span class="font-weight-bold">{{ __('Address 1') }}</span>
          <span class="detail-colon">:</span>
          <span
          class="detail-right-colon">{{ ucwords($bookingData->shippingAddress->address1) ?? '-' }}</span>
        </div>
        <div class="d-flex detail_item">
          <span class="font-weight-bold">{{ __('Address 2') }}</span>
          <span class="detail-colon">:</span>
          <span
          class="detail-right-colon">{{ ucwords($bookingData->shippingAddress->address2) ?? '-' }}</span>
        </div>
        <div class="d-flex detail_item">
          <span class="font-weight-bold">{{ __('Country') }}</span>
          <span class="detail-colon">:</span>
          <span
          class="detail-right-colon">{{ ucwords($bookingData->shippingAddress->country) ?? '-' }}</span>
        </div>
        <div class="d-flex detail_item">
          <span class="font-weight-bold">{{ __('State') }}</span>
          <span class="detail-colon">:</span>
          <span
          class="detail-right-colon">{{ ucwords($bookingData->shippingAddress->state) ?? '-' }}</span>
        </div>
        <div class="d-flex detail_item">
          <span class="font-weight-bold">{{ __('City') }}</span>
          <span class="detail-colon">:</span>
          <span
          class="detail-right-colon">{{ ucwords($bookingData->shippingAddress->city) ?? '-' }}</span>
        </div>
        <div class="d-flex detail_item">
          <span class="font-weight-bold">{{ __('Zip Code') }}</span>
          <span class="detail-colon">:</span>
          <span
          class="detail-right-colon">{{ ucwords($bookingData->shippingAddress->zip_code) ?? '-' }}</span>
        </div>
        </div>
      </div>
      <div class="col-sm-6">
        <h5 class="detail-head">Billing Address</h5>
        <div class="mt-2">
        <div class="d-flex detail_item">
          <span class="font-weight-bold">{{ __('Address 1') }}</span>
          <span class="detail-colon">:</span>
          <span
          class="detail-right-colon">{{ ucwords($bookingData->billingAddress->address1) ?? '-' }}</span>
        </div>
        <div class="d-flex detail_item">
          <span class="font-weight-bold">{{ __('Address 2') }}</span>
          <span class="detail-colon">:</span>
          <span
          class="detail-right-colon">{{ ucwords($bookingData->billingAddress->address2) ?? '-' }}</span>
        </div>
        <div class="d-flex detail_item">
          <span class="font-weight-bold">{{ __('Country') }}</span>
          <span class="detail-colon">:</span>
          <span
          class="detail-right-colon">{{ ucwords($bookingData->billingAddress->country) ?? '-' }}</span>
        </div>
        <div class="d-flex detail_item">
          <span class="font-weight-bold">{{ __('State') }}</span>
          <span class="detail-colon">:</span>
          <span
          class="detail-right-colon">{{ ucwords($bookingData->billingAddress->state) ?? '-' }}</span>
        </div>
        <div class="d-flex detail_item">
          <span class="font-weight-bold">{{ __('City') }}</span>
          <span class="detail-colon">:</span>
          <span
          class="detail-right-colon">{{ ucwords($bookingData->billingAddress->city) ?? '-' }}</span>
        </div>
        <div class="d-flex detail_item">
          <span class="font-weight-bold">{{ __('Zip Code') }}</span>
          <span class="detail-colon">:</span>
          <span
          class="detail-right-colon">{{ ucwords($bookingData->billingAddress->zip_code) ?? '-' }}</span>
        </div>
        </div>
      </div>
      </div>
    </div>
    <div class="order-detail-block">
      <div class="row mb-4 mr-1 ml-1 mt-2">
      <div class="col-sm-12">
        <div class="table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar mr-1 ml-1">
        <h5>Seats Detail</h5>
        <table class="table table-striped mt-4">
          <thead>
          <tr>
            <th class="text-left">S.No</th>
            <th>Member</th>
            <th class="text-center">Seat</th>
            <th class="text-right">Price</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($bookingData->bookingPerPerson as $seatUser)
            <tr>
            <td class="text-left">{{ $loop->index + 1 }}</td>
            <td class="right">
              {{ ucwords($seatUser->first_name . ' ' . $seatUser->last_name) }}
            </td>
            <td class="text-center">{{ ($bookingData->booking_per_person_count) }}</td>

            <td class="text-right">${{ $bookingData->webinar->price ?? '' }}</td>
            </tr>
          @endforeach
          <tr rowspan=3>
            <td colspan="3"></td>
            <td>
            <div class="d-flex justify-content-between border-bottom">
              <span>Sub Total</span>
              <span>{{ $bookingData->booking_per_person_count }} x
              {{ '₹' . $bookingData->webinar->price }}</span>
            </div>
            <div class="d-flex justify-content-between">
              <span>Total</span>
              <span>{{ '₹' . number_format($bookingData->webinar->price * $bookingData->booking_per_person_count, 2) ?? '-' }}</span>
            </div>
            <div class="d-flex justify-content-between">
              <span>Tax (0%)</span>
              <span>$0.00</span>
            </div>
            @if (isset($bookingData->payment))
              <div class="d-flex justify-content-between border-bottom">
              <span>Gift Card Discount</span>
              <span>{{ $bookingData->payment->giftCard->price ?? '$0.00' }}</span>
              </div>
            @endif
            <div class="d-flex justify-content-between border-bottom">
              <span>Grand Total</span>
              <span>${{ number_format($bookingData->payment_status == '1' ? $bookingData->total_amount : $bookingData->webinar->price * $bookingData->booking_per_person_count, 2) }}</span>
            </div>
            </td>
          </tr>
          </tbody>
        </table>
        </div>
      </div>
      </div>
    </div>
    @if ($bookingData->payment_status == '1')
      <div class="row mb-4 mr-1 ml-1 mt-2">
      <div class="col-md-12 text-center">
        <a href="{{ route('booking.generatePDF', $bookingData->id) }}" class="btn btn-primary">Download Invoice</a>
      </div>
      </div>
    @endif
    </div>
  </div>
  </div>
</div>
