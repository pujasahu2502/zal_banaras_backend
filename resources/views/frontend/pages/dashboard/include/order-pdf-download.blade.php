<!DOCTYPE html>
<html>

<head>
   <title>Invoice</title>
</head>
<style type="text/css">
   body {
      font-family: 'Roboto Condensed', sans-serif;
   }

   .m-0 {
      margin: 0px;
   }

   .p-0 {
      padding: 0px;
   }

   .pt-5 {
      padding-top: 5px;
   }

   .mt-10 {
      margin-top: 10px;
   }

   .mt-20 {
      margin-top: 20px;
   }

   .text-center {
      text-align: center !important;
   }

   .w-100 {
      width: 100%;
   }

   .w-50 {
      width: 50%;
   }

   .w-85 {
      width: 85%;
   }

   .w-15 {
      width: 15%;
   }

   .logo img {
      width: 142px;
      margin-top: -10px;
   }

   .logo span {
      margin-left: 8px;
      top: 19px;
      position: absolute;
      font-weight: bold;
      font-size: 25px;
   }

   .gray-color {
      color: #5D5D5D;
   }

   .text-bold {
      font-weight: bold;
   }

   .border {
      border: 1px solid black;
   }

   table tr,
   th,
   td {
      border: 1px solid #d2d2d2;
      border-collapse: collapse;
      padding: 7px 8px;
   }

   table tr th {
      background: #F4F4F4;
      font-size: 15px;
   }

   table tr td {
      font-size: 13px;
   }

   table {
      border-collapse: collapse;
   }

   /* .box-text p {
      line-height: 10px;
      } */
   .float-left {
      float: left;
   }

   .float-right {
      float: right;
   }

   .total-part {
      font-size: 16px;
      line-height: 12px;
   }

   .total-right p {
      padding-right: 20px;
   }

   .font-weight-bold {
      font-weight: 600;
   }

   .payment-detail {
      border-bottom: 1px solid #000;
   }

   .table tr,
   th,
   td {
      vertical-align: top;
   }

   .table tbody tr,
   td {
      border: none;
   }

   .pricing-table-block table tbody tr td {
      border: 1px solid #d2d2d2;
   }
</style>

<body>

   <div class="add-detail mt-10">
      <div class="text-right w-50 float-left logo mt-10">
         <img src="https://dirt-collector.com/assets/img/dirtcollector.jpg">
      </div>

      <div class="w-30 float-right mt-10">
         <div class="head-title">
            <h1 class="m-0 p-0">Invoice</h1>
         </div>
         <p class="m-0 pt-5 text-bold w-100">Invoice Id - <span class="gray-color">{{ $booking->invoice_id ?? '-' }}</span></p>
         <p class="m-0 pt-5 text-bold w-100">Order Id - <span class="gray-color">{{ $booking->order_number ?? '-' }}</span></p>
         <p class="m-0 pt-5 text-bold w-100">Order Date - <span class="gray-color">{{ dateFormatWithMonthName($booking->created_at) ?? '-' }}</span></p>
      </div>

      <div style="clear: both;"></div>
   </div>
   <div class="table-section bill-tbl w-100 mt-20">
      <div class="table-responsive">
         <table class="table w-100 mt-10">
            <thead>
               <tr>
                  <th class="w-50">Customer Detail</th>
                  <th class="w-50">Raffle Detail</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td style="width: 50%; border: 1px solid #d2d2d2;">
                     <table class="border=0 w-100">
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('Name') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ ucwords($booking->user->display_name) ?? '-' }}</td>
                        </tr>
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('Email') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ ucwords($booking->user->email) ?? '-' }}</td>
                        </tr>
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('Mobile No') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ $booking->user->mobile ?? '-' }}</td>
                        </tr>
                     </table>
                  </td>
                  <td style="width: 50%; border: 1px solid #d2d2d2;">
                     <table class="border=0 w-100">
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('Raffle') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ ucwords($booking->webinar->name) ?? '-' }}</td>
                        </tr>
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('Releasing At') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ dateFormatWithMonthName($booking->webinar->releasing_date) ?? '-' }} &nbsp; {{ $booking->webinar->releasing_time ?? '-' }}</td>
                        </tr>
                        <!-- <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('Releasing Time') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ $booking->webinar->releasing_time ?? '-' }}</td>
                        </tr> -->
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('Seats') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ ucwords($booking->booking_per_person_count) ?? '-' }}</td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
   <div class="table-section bill-tbl w-100 mt-10">
      <div class="table-responsive">
         <table class="table w-100 mt-10">
            <thead>
               <th class="w-40">Shipping Address</th>
               <th class="w-60">Billing Address</th>
            </thead>
            <tbody>
               <tr>
                  <td style="width: 50%; border: 1px solid #d2d2d2;">
                     <table class="border=0 w-100">
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('Address 1') }}</td>
                           <td style="width: 20px">:</td>
                           <td class="w-70">{{ ucwords($booking->shippingAddress->address1) ?? '-' }}</td>
                        </tr>
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('Address 2') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ ucwords($booking->shippingAddress->address2) ?? '-' }}</td>
                        </tr>
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('Country') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ $booking->shippingAddress->country ?? '-' }}</td>
                        </tr>
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('State') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ $booking->shippingAddress->state ?? '-' }}</td>
                        </tr>
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('City') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ $booking->shippingAddress->city ?? '-' }}</td>
                        </tr>
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('Zip Code') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ $booking->shippingAddress->zip_code ?? '-' }}</td>
                        </tr>
                     </table>
                  </td>
                  <td style="width: 50%; border: 1px solid #d2d2d2;">
                     <table class="border=0 w-100">
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('Address 1') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ ucwords($booking->billingAddress->address1) ?? '-' }}</td>
                        </tr>
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('Address 2') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ ucwords($booking->billingAddress->address2) ?? '-' }}</td>
                        </tr>
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('Country') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ $booking->billingAddress->country ?? '-' }}</td>
                        </tr>
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('State') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ $booking->billingAddress->state ?? '-' }}</td>
                        </tr>
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('City') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ $booking->billingAddress->city ?? '-' }}</td>
                        </tr>
                        <tr style="line-height:1.5;">
                           <td class="font-weight-bold" style="width: 15%;">{{ __('Zip Code') }}</td>
                           <td style="width: 20px">:</td>
                           <td>{{ $booking->billingAddress->zip_code ?? '-' }}</td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
   <div class="table-section bill-tbl pricing-table-block w-100 mt-10">
      <div class="table-responsive">
         <table class="table w-100 mt-10">
            <thead>
               <th width="5%">S.No</th>
               <th width="28%">Member</th>
               <th width="23%">Seat</th>
               <th width="42%">Price</th>
            </thead>
            <tbody>
               @foreach ($booking->bookingPerPerson as $person)
               <tr align="center">
                  <td>{{ $loop->index + 1 }}</td>
                  <td>{{ ucwords($person->first_name . ' ' . $person->last_name ?? '-') }}</td>
                  <td>{{ $person->seat_number ?? '-' }}</td>
                  <td>${{ $booking->webinar->price ?? '-' }}</td>
               </tr>
               @endforeach
               <tr>
                  <td colspan="3"></td>
                  <td>
                     <div class="total-part">
                        <div class="total-left w-75 float-left">
                           <p class="payment-detail">Sub Total</p>
                           <p>Total</p>
                           <p>Tax (0%)</p>
                           @if (isset($booking->payment))
                           <p class="payment-detail">Gift Card Discount</p>
                           @endif
                           <p>Grand Total</p>
                        </div>
                        <div class="total-right w-25 float-right" align="right">
                           <p class="payment-detail">{{ $booking->booking_per_person_count }} x
                              {{ '₹' . $booking->webinar->price }}
                           </p>
                           <p class="text-bold">
                              ${{ number_format($booking->webinar->price * $booking->booking_per_person_count, 2) ?? '' }}
                           </p>
                           <p>$0.00</p>
                           @if (isset($booking->payment))
                           <p class="payment-detail">${{ $booking->payment->giftCard->price ?? '0.00' }}</p>
                           @endif
                           <p class="text-bold">{{ '₹' . $booking->total_amount ?? '-' }}</p>
                        </div>
                        <div style="clear: both;"></div>
                     </div>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</body>

</html>