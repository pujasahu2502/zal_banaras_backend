<div class="modal fade modal-create" id="addCouponModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fe-icon mr-2" data-feather="gift"></i>Add Coupon</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addCouponForm" autocomplete="off">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group coupon-input">
                                <label for="type">Coupon Type<span class="text-danger">*</span></label>
                                <select class="form-control form-select type" name="type" id="type" data-rule-required="true" data-msg-required="{{ __('required_coupon_type') }}">
                                    <option disabled>Select Coupon Type</option>
                                    <option value="1">Flat Percent</option>
                                    <option value="2" selected>Fixed Price</option>
                                    <option value="3">Buy 1 Get 1 Free</option>

                                </select>
                                <span class="text-danger error type-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group coupon-input">
                                <label>Apply On<span class="text-danger">*</span></label>
                                <select class="form-control form-select apply_on" name="apply_on" id="apply_on" data-rule-required="true" data-msg-required="{{ __('required_apply_on') }}" data-url="{{ route('coupon.applyon') }}">
                                    <option selected disabled>Select Apply On</option>
                                    <option value="1">Gross Total</option>
                                    <option value="2">Product</option>
                                    <option value="3">Category</option>
                                </select>
                                <span class="text-danger error apply_on-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 coupon-amount">
                            <div class="form-group coupon-input">
                                <label>Amount<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text amount-dollar-sign">
                                        <i class="fa fa-rupee"></i>
                                    </div>
                                    <input type="number" step=".01" min="0.1" class="form-control amount" name="amount" id="amount" data-rule-required="true" data-rule-minlength="1" data-rule-maxlength="10" data-msg-required="{{ __('required_amount') }}">
                                    <div class="amount-percent-sign">
                                        
                                    </div>
                                </div>
                                <span class="text-danger error amount-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 product d-none">
                            <div class="form-group coupon-input">
                                <label for="name">Select Free Product<span class="text-danger">*</span></label>
                                <select class="form-control form-select product_id " name="product_id" id="product_id" data-rule-required ="" data-msg-required="{{ __('required_product') }}">
                                    <option selected disabled>Select Product</option>
                                    @foreach ($allProduct as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error product_id-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group coupon-input">
                                <label>Coupon Code<span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control code" name="code" id="code" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="15" data-msg-required="{{ __('required_code') }}">
                                <span class="text-danger error code-error"></span>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-md-12 applyon-html"></div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group coupon-input">
                                <label>Start Date<span class="text-danger">*</span></label>
                                <input type="text" id="start_date" name="start_date" class="form-control date start_date" placeholder="Select Start Date" autocomplete="off" data-rule-required="false" data-msg-required="{{ __('required_start_date') }}">
                                <span class="text-danger error start_date-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group coupon-input">
                                <label>End Date<span class="text-danger">*</span></label>
                                <input type="text" id="end_date" name="end_date" class="form-control date end_date" placeholder="Select End Date" autocomplete="off" data-rule-required="true" data-msg-required="{{ __('required_end_date') }}">
                                <span class="text-danger error end_date-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group coupon-input">
                                <label for="usage_limit">Usage Limit</label>
                                <input type="number" class="form-control usage_limit" data-rule-min="1" data-rule-max="100" name="usage_limit" id="usage_limit">
                                <span class="text-danger error usage_limit-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group coupon-input">
                                <label for="name">Status<span class="text-danger">*</span></label>
                                <select class="form-control form-select status" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('required_status') }}">
                                    <option disabled>Select Status</option>
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span class="text-danger error status-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group coupon-input">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="2"></textarea>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6 col-md-6">
                            <div class="form-group coupon-input">
                                <label for="name">Free Product<span class="text-danger">*</span></label>
                                <input class="form-check-input free_product" type="radio" name="free_product_status" id="free_product_1" value="0" checked>
                                <label class="form-check-label" for="exampleRadios1">No</label>
                                <input class="form-check-input free_product" type="radio" name="free_product_status" id="free_product_2" value="1">
                                <label class="form-check-label" for="exampleRadios2">Yes</label>
                                <span class="text-danger error free_product_status-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 product d-none">
                            <div class="form-group coupon-input">
                                <label for="name">Product<span class="text-danger">*</span></label>
                                <select class="form-control form-select product_id " name="product_id" id="product_id" data-rule-required ="" data-msg-required="{{ __('required_product') }}">
                                    <option selected disabled>Select Product</option>
                                    @foreach ($allProduct as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error product_id-error"></span>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-lg-9">
                            <p><b>Notes:</b> To apply the Buy One, Get One Free coupon, the user must first select the free product which is going to be free and then select name of products/categories on which this offer will be applicable.</p>                            
                        </div>
                        <div class="col-lg-3 text-center">
                            <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                            <button type="button" data-url="{{ route('coupon.store') }}" class="btn btn-primary  common-btn save-coupon">Add</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
