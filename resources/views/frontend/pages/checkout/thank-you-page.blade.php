@extends('frontend.layouts.include.app', ['title' => 'Thank you'])
@section('content')

<!-- --------Start-Empty-cart-section--------- -->
<section class="empty-cart-section">
    <div class="container">
        <div class="empty-cart-block text-center">
            <div class="empty-cart-content mt-4">
               
                <h2>Thank you for your order!</h2>
                <p>You're awesome {{Session::get('name')}}! Thank you for your purchase {{Session::get('transaction_id')}}.</p>
              <div class="row mt-2">
                <div class="col-md-8 offset-md-2">
                    <table class="table table-bordered mt-4">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold" colspan="2">
                                    <a href="{{auth()->guard("web")->check() ? route("orders.details",$order['order_id']) : '#'}}">
                                        ORDER #{{$order['order_id']}}
                                    </a>
                                </td>
                            </tr>
                            <tr class="text-left">
                                <td class="font-weight-bold">Transaction ID</td>
                                <td>{{$order['transaction_id']}}</td>
                            </tr>
                            <tr class="text-left">
                                <td class="font-weight-bold">Order Amount</td>
                                <td>{{ '₹'.number_format($order['amount'], 2)}}</td>
                            </tr>
                            <tr class="text-left">
                                <td class="font-weight-bold">Order Date</td>
                                <td>{{ $order['date']}}</td>
                            </tr>
                        </tbody>
                     </table>
                    {{-- <table class="table">
                        
                    </table> --}}
                    @if(auth()->guard("web")->check())
                        <a href="{{auth()->guard("web")->check() ? route("orders.details",$order['order_id']) : route("home")}}" class="font-weight-bold">View more details</a>
                    @endif
                </div>
              </div>
            </div>
            <!-- added home button -->
            <div class="home-redirect-btn mt-3">
                <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
            </div>
            <!-- end home button div -->
        </div>
    </div>
</section>
<!-- --------End-Empty-cart-section--------- -->

@endsection