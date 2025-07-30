<div class="container">
    <div class="testimonial-heading">
        <h4 class="review-title text-uppercase mb-4">Reviews</h4>
    </div>
    @foreach ($reviews as $key => $single)
        <div class="review-inner-block mt-2">
            @if ($single->review != null)
                <div class="review-box-block">
                    <div class="box-top">
                        <div class="profile">
                            <div class="profile-img">
                                <span class="text-capitalize">{{ substr($single->user->fullName, 0, 1) ?? '' }}</span>
                            </div>
                            <div class="name-user">
                                <strong>{{ ucwords($single->user->fullName) ?? '' }}</strong>
                                <span>{{ dateFormatWithMonthName($single->created_at) ?? '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="client-comment">
                        <p>{{ $single->review ?? '' }}</p>
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>
