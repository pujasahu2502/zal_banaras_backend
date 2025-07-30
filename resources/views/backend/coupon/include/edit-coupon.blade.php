<div class="modal fade" id="editCouponModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fe-icon mr-2" data-feather="gift"></i>Edit Coupon</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCouponForm" autocomplete="off">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="type">Coupon Type<span class="text-danger">*</span></label>
                                <select class="form-control form-select type" name="type" id="type" data-rule-required="true" data-msg-required="{{ __('required_coupon_type') }}">
                                    <option selected disabled>Select Coupon Type</option>
                                    <option {{ $coupon->type==1 ? 'selected' : '' }} value="1">Flat Percent</option>
                                    <option {{ $coupon->type==2 ? 'selected' : '' }} value="2">Fixed Price</option>
                                    <option {{ $coupon->type==3 ? 'selected' : '' }} value="3">Buy 1 Get 1 Free</option>
                                </select>
                                <span class="text-danger error type-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="code">Apply On<span class="text-danger">*</span></label>
                                <select class="form-control form-select apply_on" name="apply_on" id="apply_on" data-rule-required="true" data-msg-required="{{ __('required_apply_on') }}" data-url="{{ route('coupon.applyon') }}">
                                    <option selected disabled>Select Apply On</option>
                                    <option {{ ($coupon->apply_on == 1) ? 'selected' : '' }} value="1">Gross Total</option>
                                    <option {{ ($coupon->apply_on == 2) ? 'selected' : '' }} value="2">Product</option>
                                    <option {{ ($coupon->apply_on == 3) ? 'selected' : '' }} value="3">Category</option>
                                </select>
                                <span class="text-danger error apply_on-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 coupon-amount">
                            <div class="form-group coupon-input">
                                <label for="amount">Amount<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="amount-dollar-sign">
                                        @if(isset($coupon->type) && $coupon->type == '2')
                                            <div class="input-group-postpend">
                                                <span class="form-control amount-sign">
                                                    <i class="fa fa-rupee p-1"></i>
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <input type="number" step=".01" min="0.1" value="{{$coupon->amount}}" class="form-control amount" name="amount" id="amount" data-rule-required="true" data-rule-minlength="1" data-rule-maxlength="10" data-msg-required="{{ __('required_amount') }}">
                                    <div class="amount-percent-sign">
                                        @if(isset($coupon->type) && $coupon->type == '1')
                                            <div class="input-group-postpend">
                                                <span class="form-control amount-sign">
                                                    <i class="fa fa-percent p-1"></i>
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <span class="text-danger error amount-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 product d-none">
                            <div class="form-group coupon-input">
                                <label for="name">Select Free Product<span class="text-danger">*</span></label>
                                <select class="form-control form-select product_id" name="product_id" id="product_id" data-rule-required="" data-msg-required="{{ __('required_product') }}">
                                    <option selected disabled>Select Product</option>
                                    @foreach($allProduct as $product)
                                       <option value="{{$product->id}}"{{$product->id == $coupon->product_id ? 'selected' : ' '}}>{{$product->name}}</option>
                                   @endforeach
                                </select>
                                <span class="text-danger error product_id-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group coupon-input">
                                <label for="code">Coupon Code<span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control code" value="{{$coupon->code}}" name="code" id="code" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="15" data-msg-required="{{ __('required_code') }}">
                                <span class="text-danger error code-error"></span>
                            </div>
                        </div>
                        

                        <div class="col-lg-12 col-md-12 applyon-html">
                            @if(count($coupon->couponApply) > 0)
                            <div class="form-group">
                                @php
                                    $data = [];
                                    $applied = '';
                                    if($coupon->apply_on == '2'){
                                        $data = $allProduct;
                                        $applied = 'Product';
                                    }else if($coupon->apply_on == '3'){
                                        $data = $allCategory;
                                        $applied = 'Category';
                                    }else{
                                        $data = [];
                                        $applied = '';
                                    }
                                @endphp
                                <label>Select {{ $applied ?? '' }}<span class="text-danger">*</span></label>
                                <select class="form-control form-select apply_on_value" name="apply_on_value[]" data-rule-required="true" data-msg-required="{{ __('required_apply_on_value') }}" data-url="{{ route('coupon.applyon') }}" multiple="multiple">
                                    @forelse($data as $key => $value)
                                        <option value="{{ $value->id }}"
                                            @foreach($coupon->couponApply as $applyValue)
                                                @if($value->id == $applyValue->apply_on_value)
                                                    {{'selected'}}
                                                @endif
                                            @endforeach
                                        >{{ $value->name }}</option>          
                                    @empty

                                    @endforelse
                                </select>
                                <span class="text-danger error apply_on_value-error"></span>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group coupon-input">
                                <label>Start Date<span class="text-danger">*</span></label>
                                <input type="text" class="form-control date start_date" value="{{ date_format(date_create($coupon->start_date), 'Y-m-d') }}" name="start_date" id="start_date" placeholder="Select Start Date" autocomplete="off" data-rule-required="true" data-msg-required="{{ __('required_start_date') }}">
                                <span class="text-danger error start_date-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group coupon-input">
                                <label>End Date<span class="text-danger">*</span></label>
                                <input type="text" class="form-control date end_date" name="end_date" value="{{ date_format(date_create($coupon->end_date), 'Y-m-d') }}" min="{{ date('Y-m-d') }}" id="end_date" placeholder="Select End Date" autocomplete="off" data-rule-required="true" data-msg-required="{{ __('required_end_date') }}">
                                <span class="text-danger error end_date-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group coupon-input">
                                <label for="usage_limit">Usage Limit</label>
                                <input type="number" class="form-control usage_limit" value="{{$coupon->usage_limit}}" name="usage_limit" id="usage_limit" data-rule-min="1" data-rule-max="100">
                                <span class="text-danger error usage_limit-error"></span>
                                
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="name">Status<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="status" id="status" data-rule-required="true" data-msg-required="{{ __('required_status') }}">
                                    <option selected disabled>Select Status</option>
                                    <option value="1" {{ ($coupon->status == 1) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ ($coupon->status == 0) ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <span class="text-danger error status-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="2">{{$coupon->description}}</textarea>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6 col-md-6">
                            <div class="form-group coupon-input">
                                <label for="name">Free Product<span class="text-danger">*</span></label>
                                    <input class="form-check-input free_product" type="radio" name="free_product_status" id="free_product_1" value="0" {{ $coupon->free_product_status == '0' ? 'checked' : ' '}}>
                                    <label class="form-check-label" for="exampleRadios1">No</label>
                                    <input class="form-check-input free_product" type="radio" name="free_product_status"id="free_product_2" value="1" {{ $coupon->free_product_status == '1' ? 'checked' : ' '}}>
                                    <label class="form-check-label" for="exampleRadios2">Yes</label>
                                <span class="text-danger error free_product-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 product d-none">
                            <div class="form-group coupon-input">
                                <label for="name">Product<span class="text-danger">*</span></label>
                                <select class="form-control form-select product_id" name="product_id" id="product_id" data-rule-required="" data-msg-required="{{ __('required_product') }}">
                                    <option selected disabled>Select Product</option>
                                    @foreach($allProduct as $product)
                                       <option value="{{$product->id}}"{{$product->id == $coupon->product_id ? 'selected' : ' '}}>{{$product->name}}</option>
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
                            <p><b>Notes:</b>To apply the Buy One, Get One Free coupon, the user must first select the free product which is going to be free and then select name of products/categories on which this offer will be applicable.</p>                            
                        </div>
                        <div class="col-lg-3 text-center">
                            <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                            <button type="button" data-url="{{ route('coupon.update', $coupon->id) }}" class="btn btn-primary  common-btn update-coupon">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>