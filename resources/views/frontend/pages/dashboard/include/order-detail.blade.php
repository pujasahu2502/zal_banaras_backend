@extends('frontend.pages.dashboard.user-base', ['title' => 'My Order Detail'])
@section('user-section')
<div class="card my-order-block">
   <div class="card-header custom-card-header d-flex justify-content-between">
      <h5>
         <a href="{{ route('my-order.index') }}" class="btn text-white arrow-icon mr-2"><i class="fa fa-arrow-left"></i></a>
         Order Detail
      </h5>
      <h6 class="text-right"><span class="badge badge-{{ $bookingData->payment_status == '1' ? 'success' : 'danger' }}">{{ $bookingData->payment_status == '1' ? 'Paid' : 'Unpaid' }}</span>
      </h6>
   </div>
   <div class="order-detail-block">
      <div class="row mb-4 mr-1 ml-1 mt-2">
         <div class="col-sm-12">
            <div class="order-place-block mt-2">
               <div>
                  @if(isset($bookingData->payment))
                     <div class="d-flex detail_item">
                        <span class="font-weight-bold">{{ __('Invoice Id ') }}</span>
                        <span class="detail-colon">:</span>
                        <span>{{ $bookingData->invoice_id ?? '-' }}</span>
                     </div>
                     <div class="d-flex detail_item">
                        <span class="font-weight-bold">{{ __('Order Id') }}</span>
                        <span class="detail-colon">:</span>
                        <span class="detail-right-colon">{{ $bookingData->order_number ?? '-' }}</span>
                     </div>
                  @endif
               </div>
               <div class="d-flex detail_item">
                  <span class="font-weight-bold">{{ __('Order Date') }}</span>
                  <span class="detail-colon">:</span>
                  <span class="detail-right-colon">{{ dateFormatWithMonthName($bookingData->created_at) ?? '-' }}</span>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="order-detail-block">
      <div class="row mb-4 mr-1 ml-1 mt-2">
         <div class="col-sm-6">
            <h5 class="detail-head">Customer Detail</h5>
            <div class="mt-2">
               <div class="d-flex detail_item">
                  <span class="font-weight-bold">{{ __('Name') }}</span>
                  <span class="detail-colon">:</span>
                  <span class="detail-right-colon">{{ ucwords($bookingData->user->display_name) ?? '-' }}</span>
               </div>
               <div class="d-flex detail_item">
                  <span class="font-weight-bold">{{ __('Email') }}</span>
                  <span class="detail-colon">:</span>
                  <span class="detail-right-colon">{{ ucwords($bookingData->user->email) ?? '-' }}</span>
               </div>
               <div class="d-flex detail_item">
                  <span class="font-weight-bold">{{ __('Mobile No') }}</span>
                  <span class="detail-colon">:</span>
                  <span class="detail-right-colon">{{ $bookingData->user->mobile ?? '-' }}</span>
               </div>

            </div>
         </div>
         <div class="col-sm-6">
            <div class="webinar-block">
               <h5 class="detail-head">Raffle Detail</h5>
               <div class="mt-2">
                  <div class="d-flex webinar-detail_item ">
                     <span class="font-weight-bold">{{ __('Raffle') }}</span>
                     <span class="detail-colon">:</span>
                     <span class="detail-right-colon"> {{ ucwords($bookingData->webinar->name) ?? '-' }}</span>
                  </div>
                  <div class="d-flex webinar-detail_item">
                     <span class="font-weight-bold">{{ __('Releasing Date') }}</span>
                     <span class="detail-colon">:</span>
                     <span class="detail-right-colon">{{ dateFormatWithMonthName($bookingData->webinar->releasing_date) ?? '-' }}</span>
                  </div>
                  <div class="d-flex webinar-detail_item">
                     <span class="font-weight-bold">{{ __('Releasing Time') }}</span>
                     <span class="detail-colon">:</span>
                     <span class="detail-right-colon">{{ $bookingData->webinar->releasing_time ?? '-' }}</span>
                  </div>
                  <div class="d-flex webinar-detail_item">
                     <span class="font-weight-bold">{{ __('Reserved Seats') }}</span>
                     <span class="detail-colon">:</span>
                     <span class="detail-right-colon">{{ ucwords($bookingData->booking_per_person_count) ?? '-' }}</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="order-detail-block">
      <div class="shipping-block row mb-4 mr-1 ml-1 mt-2">
         <div class="col-sm-6">
            <h5 class="detail-head">Shipping Address</h5>
            <div class="mt-2">
               <div class="d-flex detail_item">
                  <span class="font-weight-bold">{{ __('Address 1') }}</span>
                  <span class="detail-colon">:</span>
                  <span class="detail-right-colon">{{ ucwords($bookingData->shippingAddress->address1) ?? '-' }}</span>
               </div>
               <div class="d-flex detail_item">
                  <span class="font-weight-bold">{{ __('Address 2') }}</span>
                  <span class="detail-colon">:</span>
                  <span class="detail-right-colon">{{ ucwords($bookingData->shippingAddress->address2) ?? '-' }}</span>
               </div>
               <div class="d-flex detail_item">
                  <span class="font-weight-bold">{{ __('Country') }}</span>
                  <span class="detail-colon">:</span>
                  <span class="detail-right-colon">{{ ucwords($bookingData->shippingAddress->country) ?? '-' }}</span>
               </div>
               <div class="d-flex detail_item">
                  <span class="font-weight-bold">{{ __('State') }}</span>
                  <span class="detail-colon">:</span>
                  <span class="detail-right-colon">{{ ucwords($bookingData->shippingAddress->state) ?? '-' }}</span>
               </div>
               <div class="d-flex detail_item">
                  <span class="font-weight-bold">{{ __('City') }}</span>
                  <span class="detail-colon">:</span>
                  <span class="detail-right-colon">{{ ucwords($bookingData->shippingAddress->city) ?? '-' }}</span>
               </div>
               <div class="d-flex detail_item">
                  <span class="font-weight-bold">{{ __('Zip Code') }}</span>
                  <span class="detail-colon">:</span>
                  <span class="detail-right-colon">{{ ucwords($bookingData->shippingAddress->zip_code) ?? '-' }}</span>
               </div>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="billing-block">
               <h5 class="detail-head">Billing Address</h5>
               <div class="mt-2">
                  <div class="d-flex detail_item">
                     <span class="font-weight-bold">{{ __('Address 1') }}</span>
                     <span class="detail-colon">:</span>
                     <span class="detail-right-colon">{{ ucwords($bookingData->billingAddress->address1) ?? '-' }}</span>
                  </div>
                  <div class="d-flex detail_item">
                     <span class="font-weight-bold">{{ __('Address 2') }}</span>
                     <span class="detail-colon">:</span>
                     <span class="detail-right-colon">{{ ucwords($bookingData->billingAddress->address2) ?? '-' }}</span>
                  </div>
                  <div class="d-flex detail_item">
                     <span class="font-weight-bold">{{ __('Country') }}</span>
                     <span class="detail-colon">:</span>
                     <span class="detail-right-colon">{{ ucwords($bookingData->billingAddress->country) ?? '-' }}</span>
                  </div>
                  <div class="d-flex detail_item">
                     <span class="font-weight-bold">{{ __('State') }}</span>
                     <span class="detail-colon">:</span>
                     <span class="detail-right-colon">{{ ucwords($bookingData->billingAddress->state) ?? '-' }}</span>
                  </div>
                  <div class="d-flex detail_item">
                     <span class="font-weight-bold">{{ __('City') }}</span>
                     <span class="detail-colon">:</span>
                     <span class="detail-right-colon">{{ ucwords($bookingData->billingAddress->city) ?? '-' }}</span>
                  </div>
                  <div class="d-flex detail_item">
                     <span class="font-weight-bold">{{ __('Zip Code') }}</span>
                     <span class="detail-colon">:</span>
                     <span class="detail-right-colon">{{ ucwords($bookingData->billingAddress->zip_code) ?? '-' }}</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row mb-4 mr-1 ml-1 mt-2">
      <div class="col-sm-12">
         <div class="table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar mr-1 ml-1">
            <h5 class="detail-head">Seats Detail -</h5>
            <div class="table-responsive">
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
                        <td class="right">{{ ucwords($seatUser->first_name . ' ' . $seatUser->last_name) }}
                        </td>
                        <td class="text-center">{{ $seatUser->seat_number }}</td>
                        <td class="text-right">${{ $bookingData->webinar->price ?? '' }}</td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>

            <div class="payment-inform-block">
               <div class="payment-gateway-inner-block">
                  <div class="payment-block d-flex justify-content-between border-bottom">
                     <span>Sub Total</span>
                     <span>{{ $bookingData->booking_per_person_count }} x
                        {{ '₹' . $bookingData->webinar->price }}</span>
                  </div>
                  <div class="payment-block d-flex justify-content-between">
                     <span>Total</span>
                     <span>{{ '₹' . number_format($bookingData->webinar->price * $bookingData->booking_per_person_count, 2) ?? '-' }}</span>
                  </div>
                  <div class="payment-block d-flex justify-content-between">
                     <span>Tax (0%)</span>
                     <span>$0.00</span>
                  </div>
                  @if (isset($bookingData->payment))
                  <div class="payment-block d-flex justify-content-between border-bottom">
                     <span>Gift Card Discount</span>
                     <span>${{ $bookingData->payment->giftCard->price ?? '0.00' }}</span>
                  </div>
                  @endif
                  <div class="payment-block d-flex justify-content-between border-bottom">
                     <span>Grand Total</span>
                     <span>${{ number_format($bookingData->payment_status == '1' ? $bookingData->total_amount : $bookingData->webinar->price * $bookingData->booking_per_person_count, 2) }}</span>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>
   @if ($bookingData->payment_status == '1')
   <div class="row mb-4 mr-1 ml-1 mt-2">
      <div class="col-md-12 text-center">
         <a href="{{ route('my-order.generatePDF', $bookingData->id) }}" class="btn btn-primary">Download
            Invoice</a>
      </div>
   </div>
   @endif
</div>
@endsection
@section('user-javascript')
<script src="{{ asset('front-end/profile-update.js') }}"></script>
@endsection