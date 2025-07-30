<div class="modal fade" id="review" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    {{-- {{dd($review)}} --}}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="c-sidebar-nav-icon fe-icon" data-feather="phone"></i>Review Details</h5>
                <div class="detail-header d-flex align-items-center">
                    <div class="field-tag">
                        <i class="fa fa-info"></i>
                        <div class="field-text">
                            <label>Submitted On : </label>
                            <p>{{ dbCustomDateFormat($review->created_at) ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            @php $fullName = $review->user->first_name. ' ' .$review->user->last_name; @endphp

            <div class="modal-body">
                <div class="view-detail-block">
                    <div class="main-user-block">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="detail-inner-block">
                                    <div class="user-block">
                                        <label>Customer Name</label>
                                        <span class="hypan-area">:</span>
                                        <p class="text-capitalize">{{$fullName  ?? '-'}}</p>
                                    </div>
                                    <div class="user-block">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="detail-inner-block">
                                    <div class="user-block">
                                        <label>Product Name</label>
                                        <span class="hypan-area">:</span>
                                        <p class="text-capitalize">{{$review->product->name ?? '-'}}</p>
                                    </div>
                                    <div class="user-block">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="detail-inner-block">
                                    <div class="user-block">
                                        <label>Review</label>
                                        <span class="hypan-area">:</span>
                                        <p>{{$review->review ?? '-'}}</p>
                                    </div>
                                    <div class="user-block">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>