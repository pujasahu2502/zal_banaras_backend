@extends('frontend.pages.dashboard.user-base', ['title' => 'My Order'])
@section('user-section')
    <div class="card order-table-block">
        <div class="card-header dashboard-title">
            <h5>Gift Card</h5>
        </div>
        <div class="table-responsive">
             <table class="table table-strip my-order">
                <thead>
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Code</th>
                        <th scope="col">Raffle Name</th>
                        <th scope="col">Price</th>
                        <th scope="col" class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assignGiftCard as $giftCard)
                        <tr>
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $giftCard->giftCard->code ?? 'NA' }}</td>
                            <td>{{ $giftCard->webinar->name ?? '0' }} Seat</td>
                            <td>${{ $giftCard->giftCard->price ?? 'NA' }}</td>
                            <td class="text-center"><span style="cursor:none;"
                                    class="badge bg-{{ $giftCard->giftCard['status'] == '1' ? 'primary' : 'warning' }} text-white no-cursor">{{ $giftCard->giftCard['status'] == '1' ? 'Hold' : 'Redeem' }}</span>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="7">
                                <div class="minH250 d-flex justify-content-center align-items-center">
                                    <b> @lang('no_gift_card')</b>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endsection
