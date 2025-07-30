<section class="about-dnz-section">
    <div class="container">
        <div class="head-block text-left mb-4 wow bounceInUp">
            <h2 class="common-title text-uppercase mb-4">Here’s What Avid Shooters say about DNZ</h2>
        </div>
        <div class="review-items-slider">
           @foreach($testimonials as $testimonial)
            <div class="card about-dnz-card">
                <p>"{{Str::limit($testimonial->description , 500) ?? ''}}"</p>
                <span class="tag-name">-{{$testimonial->name ?? ''}}</span>
            </div>
            @endforeach
        </div>
        <div class="about-dnz-btn text-center mt-4">
            <a href="{{route('frontend.products.index')}}" class="btn explore-btn">Explore DNZ Products</a>
        </div>
    </div>
</section>