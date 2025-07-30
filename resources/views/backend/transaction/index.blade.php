@extends('backend.layouts.app', ['title' => 'Transaction'])
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center flex-wrap">
            <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="dollar-sign"></i>Transaction</h4>
            {{-- <span style="padding:10px">(Shows only last 100 transactions)</span> --}}
        </div>
        <div class="card-body">
            {{-- <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="5%" class="text-center">S.No</th>
                        <th scope="col" width="10%" >Transaction Id</th>
                        <th scope="col" width="10%"  class="text-center">Amount</th>
                        <th scope="col" width="10%"  class="text-center">Stripe Fee</th>
                        <th scope="col" width="35%" >Description</th>
                        <th scope="col" width="10%"  class="text-center">Status</th>
                        <th scope="col" width="10%" >Transfer At</th>
                        <th scope="col" width="10%" >Available On</th>
                    </tr>
                </thead>
                <tbody class="user admin-table">


                    @forelse ($transactions as $key => $transaction)
                        <tr>
                            <td class="text-center">{{ $loop->index + 1 }}</td>
                            <td class="text-left">{{ $transaction->id }}</td>
                            <td class="text-center">${{ $transaction->amount / 100 }}</td>
                            <td class="text-center">${{ $transaction->fee / 100 }}</td>
                            <td class="text-left">{{ $transaction->description }}</td>
                            <td class="text-center"> <span class="badge bg-{{$transaction->status == 'available' ? 'success' : 'warning'}} "><span
                                        class="text-white">{{ ucwords($transaction->status) }}</span></span></td>
                            <td class="text-left">{{ dateFormatWithMonthName(stringToDate($transaction->created)) }}</td>
                            <td class="text-left">{{ dateFormatWithMonthName(stringToDate($transaction->available_on)) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="15">
                                <div class="text-center mb-3">
                                    <i data-feather="alert-circle"></i>
                                    <h4 class="title"> @lang('no_transaction') </h4>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table> --}}
            @include('comming-soon')
        </div>
    </div>
    {{-- <div class="view-btn ">
        {{ $transactions->links() }}
    </div> --}}
@endsection
@section('javascript')
@endsection
