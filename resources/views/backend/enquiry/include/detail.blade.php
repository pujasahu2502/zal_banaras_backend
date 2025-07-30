<div class="modal fade" id="contactUs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="c-sidebar-nav-icon fe-icon" data-feather="phone"></i>Enquiry</h5>
                <div class="detail-header d-flex align-items-center">
                    <div class="field-tag">
                        <i class="fa fa-info"></i>
                        <div class="field-text">
                            <label>Enquiry At : </label>
                            <p>{{ dbCustomDateFormat($contactUs->created_at) ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="view-detail-block">
                    <div class="main-user-block">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="detail-inner-block">
                                    <div class="user-block">
                                        <label>Customer Name</label>
                                        <span class="hypan-area">:</span>
                                        <p>{{ucwords($contactUs['name']) ?? '-'}}</p>
                                    </div>
                                    <div class="user-block">
                                        <label>Customer Email</label>
                                        <span class="hypan-area">:</span>
                                        <p>{{$contactUs['email'] ?? '-'}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="detail-inner-block">
                                    <div class="user-block">
                                        <label>Mobile Number</label>
                                        <span class="hypan-area">:</span>
                                        <p>{{$contactUs['mobile'] ?? '-'}}</p>
                                    </div>
                                    <div class="user-block">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="detail-inner-block">
                                    <div class="user-block">
                                        <label>Subject</label>
                                        <span class="hypan-area">:</span>
                                        <p>{{$contactUs['subject'] ?? '-'}}</p>
                                    </div>
                                    <div class="user-block">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="detail-inner-block">
                                    <div class="user-block">
                                        <label>Message</label>
                                        <span class="hypan-area">:</span>
                                        <p>{{$contactUs['description'] ?? '-'}}</p>
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