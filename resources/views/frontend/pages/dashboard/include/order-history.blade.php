@extends('frontend.pages.dashboard.user-base', ['title' => 'My Order'])
@section('user-section')
    <div class="card order-table-block">
        <div class="card-header dashboard-title">
            <h5>My Orders</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-strip my-order">
                <thead>
                    <tr>
                        <th scope="col" width="5%">S.No</th>
                        <th scope="col" width="25%">Raffle</th>
                        <th scope="col" width="10%" class="text-center">Seats</th>
                        <th scope="col" width="15%">Order At</th>
                        <th scope="col" width="10%">Price</th>
                        <th scope="col" class="text-center" width="15%">Status</th>
                        <th scope="col" class="text-center" width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $userDataFlag = false; @endphp
                    @if (\Cache::has(auth()->user()->email))
                        @php $userDataFlag = true; @endphp
                        @php  $userData = \Cache::get(auth()->user()->email) @endphp

                        <tr>
                            <td scope="row">1</td>
                            <td>{{ Str::limit($userData['webinar_name'], 25) ?? 'NA' }}</td>
                            <td class="text-center"><span data-toggle="tooltip"
                                    title="{{ count($userData['bookingPerPerson']) ?? '0' }} Seats Booked"><i
                                        data-feather="user"></i></span></td>
                            <td>{{ dateFormatWithMonthName(today()) }}</td>
                            <td>${{ number_format($userData['price'] * count($userData['bookingPerPerson']), 2) }}</td>
                            <td class="text-center"><span data-toggle="tooltip"
                                    title="Pay Before {{ gmdate('i', timeDifference($userData['current_time'])) }} Minutes to book your seat"
                                    class="badge badge-warning">Unpaid</span></td>
                            <td class="text-center">
                                <a href="{{ route('checkout.makePayment') }}" class="btn btn-primary" data-toggle="tooltip"
                                    data-placement="top" title="Pay now to book seat"><i class="fa fa-credit-card"></i></a>
                            </td>
                        </tr>
                    @endif
                    @forelse ($orderHistory as $history)
                        <tr>
                            <td scope="row">{{ $loop->index + ($userDataFlag ? 2 : 1) }}</td>
                            <td>{{ Str::limit($history->webinar->name, 25) ?? 'NA' }}</td>
                            <td class="text-center"><span data-toggle="tooltip"
                                    title="{{ $history->total_booking ?? '0' }} Seats Booked"><i
                                        data-feather="user"></i></span></td>
                            <td>{{ dateFormatWithMonthName($history->created_at) }}</td>
                            <td>${{ number_format($history->payment_status == '1' ? $history->total_amount : $history->webinar->price * $history->booking_per_person_count, 2) }}
                            </td>
                            <td class="text-center">
                                @if ($history->payment_status == '0')
                                    <a href="{{ route('checkout.pending.payment', $history->id) }}" data-toggle="tooltip"
                                        data-placement="top" title="Book Your Seat"><span
                                        class="badge badge-warning">Unpaid</span></a>@else<span
                                        class="badge badge-success">Paid</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('my-order.show', $history->order_number) }}" class="btn btn-primary mr-1"
                                    data-toggle="tooltip" data-placement="top" title="View"><i data-feather="eye"></i></a>
                                @if ($history->payment_status == '1')
                                    <a href="{{ route('my-order.generatePDF', $history->id) }}" class="btn btn-primary"
                                        data-toggle="tooltip" data-placement="top" title="Download Pdf"><i
                                            data-feather="file"></i></a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="7">
                                <div class="minH250 d-flex justify-content-center align-items-center">
                                    <b>@lang('no_order')</b>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
        <div class="d-flex justify-content-end mb-3">
            {{ $orderHistory->links() }}
        </div>
    @endsection
    @section('user-javascript')
        <script src="{{ asset('front-end/profile-update.js') }}"></script>
    @endsection
