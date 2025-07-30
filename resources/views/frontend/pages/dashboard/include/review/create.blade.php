@extends('frontend.pages.dashboard.user-base', ['title' => 'My Order','subtitle' => 'Review', 'titleUrl' => route('orders.details',['slug' => $product["slug"], 'id' => $order["order_id"] ]) ])
@section('user-section')
<style type="text/css">
    *{
        margin: 0;
        padding: 0;
    }
    .rate {
        float: left;
        height: 46px;
        /* padding: 0 10px; */
        padding: 0 0px;
    }
    .rate:not(:checked) > input {
        position:absolute;
        top:-9999px;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: var(--light-green);    
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: var(--light-green);    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: var(--light-green);    }
</style>
<div class="card">
    <div class="card-header">
        <h5 class="d-flex align-items-center">
            <span class="arrow-icon"><i data-feather="star" class="feather mr-2"></i></span>
            Review
        </h5>
    </div>
    <div class="mt-3 mb-2">
        <form method="POST" id="review-add-form" action="{{ isset($review) && empty($review) ?  route('user.review.store',["slug" => $product["slug"], "order_id" => $order['order_id']]) : "" }}" class="common-form-design" autocomplete="off">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Product Name</label>
                                <input name="product" readonly value="{{ $product["name"] }}" class="form-control">
                                @error('review')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Order Id</label>
                                <input name="order_id" readonly value="{{ $order['order_id'] ?? '' }}" class="form-control">
                                @error('review')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-6">
                            <label class="form-label">Rating<span class="text-danger">*</span></label>
                            <div class="form-group review-input">
                                <div class="rate">
                                    <input type="radio" id="star5" name="rating" value="5" {{ isset($review->rating) && $review->rating == 5 ? "checked" : "" }} {{ isset($review->rating) && $review->rating ? "disabled" : "" }}  >
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rating" value="4" {{ isset($review->rating) && $review->rating == 4 ? "checked" : "" }}  {{ isset($review->rating) && $review->rating ? "disabled" : "" }}  >
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rating" value="3" {{ isset($review->rating) && $review->rating == 3 ? "checked" : "" }} {{ isset($review->rating) && $review->rating ? "disabled" : "" }}  >
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rating" value="2" {{ isset($review->rating) && $review->rating == 2 ? "checked" : "" }} {{ isset($review->rating) && $review->rating ? "disabled" : "" }}  >
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rating" value="1" {{ isset($review->rating) && $review->rating == 1 ? "checked" : "" }} {{ isset($review->rating) && $review->rating ? "disabled" : "" }}  >
                                    <label for="star1" title="text">1 star</label>
                                </div>
                                @error('rating')
                                    <br>
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                               
                            </div>
                        </div> --}}
                        <div class="col-12">
                            <div class="form-group review-input">
                                <label class="form-label">Review<span class="text-danger">*</span></label>
                                <textarea name="review" {{ empty($review) ? "" : "readonly" }} class="form-control" rows="5" data-rule-minlength="2" data-rule-maxlength="200" data-msg-required="{{ __('required_review') }}">{{ isset($review["review"]) ? $review["review"] : old('review') }}</textarea>
                                @error('review')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                                <span class="text-danger error review review-error"></span>

                            </div>
                        </div>
                    </div>
                   @if(empty($review))
                        <div class="mt-3">
                            <div class="col-lg-12 col-sm-12 col-12 text-center">
                                <button type="submit" class="btn-primary mb-3">Save</button>
                                <a href="{{ url()->current() }}" class="btn-primary mb-3">Cancel</a>
                                <a href="{{ route('orders.details',$order['order_id']) }}" class="btn-primary mb-3">Back to Order</a>
                            </div>
                        </div>
                    @else
                        <div class="mt-3">
                            <div class="col-lg-12 col-sm-12 col-12 text-center">
                            <a href="{{ route('orders.details',$order['order_id']) }}" class="btn-primary mb-3">Back to Order</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('user-javascript')
    <script src="{{ asset('front-end/review.js') }}"></script>
@endsection