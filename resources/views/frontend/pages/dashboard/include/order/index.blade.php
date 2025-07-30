@extends('frontend.pages.dashboard.user-base', ['title' => 'My Orders','subtitle' => ''])
@section('user-section')
<div class="card order-table-block">
    <div class="card-header custom-card-header">
        <h5 class="d-flex align-items-center">
            <span class="arrow-icon"><i data-feather="shopping-cart" class="feather mr-2"></i></span>My Orders
        </h5>
    </div>
    <div class="my-order-table-block mt-3 mb-2">
        <div class="table-responsive">
            <table class="table table-strip my-order text-center">
                <thead class="thead-light">
                    <tr>
                        <th style="width:5%">S.No.</th>
                        <th style="width:15%">Order Id</th>
                        <!-- <th style="width:12%">Product</th> -->
                        <th style="width:15%">Date</th>
                        <!-- <th style="width:7%">Qty</th> -->
                        <th style="width:15%">Total</th>
                        <th style="width:15%">Order Status</th>
                        <th style="width:15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($orders))
                    @forelse ($orders as $key => $order)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{'#'.$order->order_id ?? '-'}}</td>
                        <td>{{ dbCustomDateFormat($order->created_at) }}</td>
                        <td>
                            ${{ number_format($order["amount"], 2) }}
                        </td>
                        <td class="text-left">
                            @if($order->order_status == '1')
                                @php
                                    $statusText = 'Processing';
                                    $statusSvg = 'pending-icon.svg';
                                @endphp
                            @elseif($order->order_status == '2')
                                @php
                                    $statusText = 'On hold';
                                    $statusSvg = 'pending-icon.svg';
                                @endphp
                            @elseif($order->order_status == '3')
                                @php
                                    $statusText = 'Completed';
                                    $statusSvg = 'complete-icon.svg';
                                @endphp
                            @elseif($order->order_status == '4')
                                 @php
                                     $statusText = 'Refuneded';
                                     $statusSvg = 'complete-icon.svg';
                                 @endphp
                            @elseif($order->order_status == '9')
                                @php
                                    $statusText = 'Canceled';
                                    $statusSvg = 'complete-icon.svg';
                                @endphp
                            @elseif($order->order_status == '10')
                                @php
                                    $statusText = 'Failed';
                                    $statusSvg = 'complete-icon.svg';
                                @endphp
                            @endif
                            <span class="order-status success-order"><img src="{{ asset('front-end/assets/image/'.$statusSvg) }}" alt="" class="mr-2">{{$statusText ?? '-'}}</span>
                        </td>
                        <td>
                            <a href="{{route('orders.details', $order->order_id)}}" class="btn-primary" data-toggle="tooltip" data-placement="top" data-original-title="Order Details">View</a>
                            {{-- <a href="{{route('orders.details', $order->order_id)}}" class="btn-primary" data-toggle="tooltip" data-placement="top" data-original-title="View"></a> --}}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="15">
                            <div class="text-center mb-3">
                                <i data-feather="alert-circle"></i>
                                <h4 class="title">@lang('no_order_available') </h4>
                                <a href="{{route('frontend.products.index')}}" class="btn btn-primary">Shop Now</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                    @else
                    <tr>
                        <td colspan="15">
                            <div class="text-center mb-3">
                                <i data-feather="alert-circle"></i>
                                <h4 class="title">@lang('no_order_available') </h4>
                                <a href="{{route('frontend.products.index')}}" class="btn btn-primary">Shop Now</a>
                            </div>
                        </td>
                    </tr>
                    @endif
                    <!-- <tr>
                    <td>#50050</td>
                    <td>Game Reaper</td>
                    <td>07 Apr 2023</td>
                    <td>3 Item</td>
                    <td>$2500.75</td>
                    <td><span class="order-status success-order"><img src="{{ asset('front-end/assets/image/complete-icon.svg') }}" alt="" class="mr-2"> Complete</span></td>
                    <td>
                        <span class="view-order-block"><a href="#" class="action-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><span class="view-order-title">View <img src="{{ asset('front-end/assets/image/eye-icon.svg') }}" alt="" class="ml-1"></span>
                        </a></span>
                    </td>
                </tr>
                <tr>
                    <td>#50050</td>
                    <td>Game Reaper 2</td>
                    <td>07 Apr 2023</td>
                    <td>3 Item</td>
                    <td>$2500.75</td>
                    <td><span class="order-status pending-order"><img src="{{ asset('front-end/assets/image/pending-icon.svg') }}" alt="" class="mr-2"> Pending</span></td>
                    <td>
                        <span class="view-order-block"><a href="#" class="action-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><span class="view-order-title">View <img src="{{ asset('front-end/assets/image/eye-icon.svg') }}" alt="" class="ml-1"></span>
                        </a></span>
                    </td>
                </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="pagination-block mt-4">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{-- <div class="select-pagination mb-4">
                <label for="select2-multiple-input-sm" class="control-label">Show: </label>
                <select class="field-select">
                    <option data-display="Choose an option">Choose an option</option>
                    <option value="12 per page">12 per page</option>
                    <option value="10 per page">10 per page</option>
                    <option value="4 per page">4 per page</option>
                </select>
            </div> --}}
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="pagination-inner-block ">
                <nav aria-label="Page navigation example">
                    {!! $orders->links() !!}
                    {{-- <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul> --}}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection