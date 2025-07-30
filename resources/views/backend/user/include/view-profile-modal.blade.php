<div class="modal fade" id="userViewProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="c-sidebar-nav-icon fe-icon" data-feather="users"></i>Customer Details</h5>
                <div class="detail-header d-flex align-items-center">
                    <div class="field-tag">
                        <i class="fa fa-info"></i>
                        <div class="field-text">
                            <label>Date Registered : </label>
                            <p>{{ dbCustomDateFormat($userData->created_at) ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="field-tag">
                        <div class="field-text">
                            <label>Last Active : </label>
                            <p>{{ $userData->last_login_at != null ? dbCustomDateFormat($userData->last_login_at) : '-' }}</p>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="view-detail-block">
                    <h5 class="d-flex align-items-center"><i class="c-sidebar-nav-icon fe-icon" data-feather="user"></i> Profile</h5>
                    <div class="main-user-block">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="detail-inner-block">
                                    <div class="user-block">
                                        <label>Customer Name</label>
                                        <span class="hypan-area">:</span>
                                        <p>{{ucwords($userData->first_name)}} {{ucwords($userData->last_name)}}</p>
                                    </div>
                                    <div class="user-block">
                                        <label>Username </label>
                                        <span class="hypan-area">:</span>
                                        <p>{{$userData->display_name ?? '-'}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="detail-inner-block">
                                    <div class="user-block">
                                        <label>Customer Email</label>
                                        <span class="hypan-area">:</span>
                                        <p>{{$userData->email ?? '-'}}</p>
                                    </div>
                                    <div class="user-block">
                                        <label>Mobile Number</label>
                                        <span class="hypan-area">:</span>
                                        <p>{{$userData->mobile ?? '-'}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="view-detail-block mt-4">
                    <h5 class="d-flex align-items-center"><i class="c-sidebar-nav-icon fe-icon" data-feather="map-pin"></i> Address</h5>
                    <div class="main-user-block">
                        <div class="row">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Mobile Number</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">State</th>
                                                <th scope="col">City</th>
                                                <th scope="col">Zipcode</th>
                                            </tr>
                                        </thead>
                                        <tbody class="product-table admin-table">
                                            @if (isset($userData->address))
                                                @forelse ($userData->address as $key => $address)
                                                <tr>
                                                    <td>
                                                        @php $name = $address->first_name.' '. $address->first_name; @endphp
                                                        @if(strlen($name) > 20)
                                                            <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($name) ?? '-'}}">{{ Str::limit(ucwords($name), 20) ?? '-'}}</span>
                                                        @else
                                                            <span>{{ ucwords($name) ?? '-'}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(strlen($address->email) > 20)
                                                            <span class="tooltip-top-large-contain" data-tooltip="{{$address->email ?? '-'}}">{{ Str::limit($address->email, 20) ?? '-'}}</span>
                                                        @else
                                                            <span>{{ $address->email ?? '-'}}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $address->mobile ?? '-' }}</td>
                                                    <td>
                                                        @if(strlen($address->address) > 20)
                                                            <span class="tooltip-top-large-contain" data-tooltip="{{$address->address ?? '-'}}">{{ Str::limit($address->address, 20) ?? '-'}}</span>
                                                        @else
                                                            <span>{{ $address->address ?? '-'}}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $address->state ?? '-' }}</td>
                                                    <td>{{ $address->city ?? '-' }}</td>
                                                    <td>{{ $address->zipcode ?? '-' }}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="15">
                                                        <div class="text-center mb-3">
                                                            <i data-feather="alert-circle"></i>
                                                            <h4 class="title"> @lang('no_address')</h4>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            @else
                                                <tr>
                                                    <td colspan="15">
                                                        <div class="text-center mb-3">
                                                            <i data-feather="alert-circle"></i>
                                                            <h4 class="title"> @lang('no_address')</h4>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>