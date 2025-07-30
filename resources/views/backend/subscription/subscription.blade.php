@extends('backend.layouts.app', ['title' => 'Newsletter'])
@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
    </div>

    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="shield"></i>Newsletter</h4>
        <div class="right-filter-block d-flex justify-content-between align-items-center flex-wrap">
            <form method="GET" class="form-block px-2" id="enquiry-filter" action="{{ route('conatct.subscriber') }}" autocomplete="off">

                <select name="sort_by" class="form-control form-select" autocomplete="off" data-toggle="tooltip" title="Sort Newsletter">
                    <option value="2" {{ request()->sort_by == '2' ? 'selected' : '' }}>Sort by New</option>
                    <option value="1" {{ request()->sort_by == '1' ? 'selected' : '' }}>Sort by Old</option>
                </select>

                <button type="submit" class="btn btn-secondary search-filter-btn filter-right" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>

                <a href="{{ route('conatct.subscriber') }}" class="btn reset-filter-btn btn-secondary" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh pt-1"></i></a>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-2  ">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" width="5%">S.No.</th>
                        <th scope="col">Customer Email</th>
                        <th scope="col" class="text-center">Subscribed On</th>
                    </tr>
                </thead>
                <tbody class="enquiry admin-table">
                    @if (isset($subscriptions))
                    @forelse ($subscriptions as $key => $subscription)
                    <tr>
                        <td class="text-center">{{ paginatePage($subscriptions,$key)}}</td>
                        <td>{{ $subscription->email ?? '-' }}</td>
                        <td class="text-center"><i class="fa fa-calendar"></i> {{ dbCustomDateFormat($subscription->created_at) ?? '' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="15">
                            <div class="text-center mb-3">
                                <i data-feather="alert-circle"></i>
                                <h4 class="title">@lang($flag == 1 ? 'no_subscription_found' : 'no_subscription')</h4>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                    @else
                    <tr>
                        <td colspan="15">
                            <div class="text-center mb-3">
                                <i data-feather="alert-circle"></i>
                                <h4 class="title">@lang($flag == 1 ? 'no_subscription_found' : 'no_subscription')</h4>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="view-btn">{{ $subscriptions->links() }}</div>
@endsection