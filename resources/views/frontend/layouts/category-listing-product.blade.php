@extends('frontend.layouts.include.app', ['title' => 'Listing Product Page'])
@section('content')

<!-- --------Start-jumbotron-bg-section--------- -->
<section class="jumbotron-banner-section">
    <div class="container">
        <div class="jumbotron-banner-content text-center wow slideInLeft">
            <div class="category-banner-img">
                <img alt="logo" src="{{ asset('front-end/assets/image/category-product-img.png') }}" />
            </div>
            <div class="category-banner-content">
                <span>1 piece scope mounts for hunting firearms</span>
                <h1>game reaper</h1>
                <p>when it comes time to take your trophy in the field, #accuracy is a must</p>
            </div>
        </div>
    </div>
</section>
<!-- --------End-jumbotron-section--------- -->

<!-- --------Start-about-section--------- -->
<section class="category-about-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 col-sm-5 col-xs-12">
                <div class="about-content-block text-center wow slideInLeft mb-3">
                    <div class="dnz-fevicon-block mb-2">
                        <img src="{{ asset('front-end/assets/image/dnz-fevicon.png') }}" alt="">
                    </div>
                    <h2>Master Long-Range Accuracy with the Game Reaper Scope Mount</h2>
                    <div class="category-about-text mt-3 mb-3">
                        <p>Don't compromise on performance; elevate your shooting experience with the unmatched reliability and durability of DNZ Products' Game Reaper scope mount.
                            Designed for seamless integration with your favorite scope, the Game Reaper offers a lightweight, low-profile solution that maintains perfect balance, ensuring that you stay on target at all times.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <div class="about-img-block wow slideInRight">
                    <img src="{{ asset('front-end/assets/image/category-about-img.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- --------End-about-section--------- -->

<!-- --------Start-category-listing-section--------- -->
<section class="category-listing-saection">
    <div class="container">
        <div class="head-block text-center mb-5 wow bounceInUp">
            <h2><span class="inner-text">Game Reaper </span> is compatible with these rifles</h2>
            <p>(Select your rifle manufacturer to learn more, customize & purchase your Game Reaper scope mount)</p>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER BANELLI</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-1.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER BROWNING</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-2.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER CVA</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-3.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER H&R</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-4.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER HENRI</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-5.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER - HOWA</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-6.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER - KIMBER</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-7.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER – KNIGHT</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-8.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER MARLIN</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-9.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER – MOSSBERG</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-10.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER – REMINGTON</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-11.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER – RUGER</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-12.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER – SAKO</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-13.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER – SAVAGE</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-14.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER THOMPSON/CENTER</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-15.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER – TIKKA</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-16.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER TRADITIONS</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-17.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER – WEATHERBY</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-18.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER – WEATHERBY</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-19.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER – WEATHERBY</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-20.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card product-card text-center">
                    <a href="#">
                        <div class="product-content">
                            <h5>GAME REAPER – WINCHESTER</h5>
                        </div>
                        <div class="category-product-img">
                            <img src="{{ asset('front-end/assets/image/new-game-reaper/game-reaper-21.png') }}" class="d-block " alt="">
                        </div>
                        <div class="product-btn">
                            <p class="mb-2">$36.75 - $369.60</p>
                            <a href="#" class="btn-primary cart-btn">Select Option</a>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- --------End-category-listing-section--------- -->

<!-- --------Start-product-video-section--------- -->
<section class="product-video-section">
    <div class="container">
        <div class="product-video-inner-block">
            <div class="head-block text-center mb-5 wow bounceInUp">
                <h2>WATCH: Game Reaper <span class="inner-text"> review and installation </span></h2>
            </div>
            <div class="product-video-block">
                <iframe width="100%" height="400px" src="https://www.youtube.com/embed/idvOdfe2eWw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>
<!-- --------End-product-video-section--------- -->

<!-- --------Start-user-review-section--------- -->
<section class="user-review-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 col-sm-5 col-xs-12">
                <div class="review-content-block text-center wow slideInLeft mb-4">
                    <div class="review-text mb-3">
                        <p>“I have Game Reaper mounts on my .35 Rem 30-30 Winchester and .444 marlin and just put one on my Remington 700 LA. Customer service is on point with fitting your rifle with the right height mount. They ALL fit like they are supposed to and they are rock solid!“ <span class="review-title">-Savannah Dan</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <div class="review-img-block wow slideInRight">
                    <img src="{{ asset('front-end/assets/image/review-img.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- --------End-user-review-section--------- -->

<!-- --------Start-product-contact-section--------- -->
<section class="product-contact-section">
    <div class="container">
        <div class="product-contact-content text-center">
            <div class="contnt-btn mt-4">
                <ul>
                    <li><a href="#" class="btn dealer-btn">Dealer Locator</a></li>
                    <li><a href="#" class="btn contact-btn">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- --------End-product-contact-section--------- -->

<!-- --------Start-mount-gun-section--------- -->
<section class="mount-gun-section">
    <div class="container">
        <div class="mount-content-block text-center">
            <h3 class="mb-1">Unmatched Precision,</h3>
            <h2 class="mount-head mb-3">Stability, and Performance</h2>
            <p>The DNZ Products Game Reaper scope mount is a premium choice for hunters, sport shooters, and firearm enthusiasts alike. The key to its unparalleled performance and durability lies in the high-quality materials and manufacturing processes used in its creation. This article will explore the reasons why the Game Reaper scope mount stands out among its competitors and how it delivers consistent, reliable results in various shooting situations.</p>
        </div>
        <div class="mount-img-block mt-4">
            <img src="{{ asset('front-end/assets/image/mount-gun.png') }}" alt="">
        </div>
    </div>
</section>
<!-- --------End-mount-gun-section--------- -->

<!-- --------Start-category-description-section--------- -->
<section class="category-description-section">
    <div class="container">
        <div class="category-description-block d-flex align-items-center">
            <div class="category-description-content mr-3">
                <h4>Premium Materials for Enhanced Durability</h4>
                <p>The Game Reaper scope mount is constructed from high-grade aluminum, ensuring that it is lightweight, sturdy, and corrosion-resistant. This high-quality material maintains its shape and integrity under varying temperatures and environmental conditions, providing a stable platform for your scope even in the most demanding situations.</p>
            </div>
            <div class="category-description-img">
                <img src="{{ asset('front-end/assets/image/description-icon-1.svg') }}" class="d-block " alt="">
            </div>
        </div>

        <div class="category-description-block d-flex align-items-center">
            <div class="category-description-img mr-3">
                <img src="{{ asset('front-end/assets/image/description-icon-2.svg') }}" class="d-block " alt="">
            </div>
            <div class="category-description-content">
                <h4>Precision CNC Machining</h4>
                <p>DNZ Products utilizes computer numerical control (CNC) machining to create the Game Reaper scope mount. This state-of-the-art manufacturing process ensures that each component is machined with exceptional precision and accuracy. CNC machining eliminates the potential for human error and guarantees that every scope mount adheres to exact specifications, resulting in a perfect fit for your firearm.</p>
            </div>
        </div>

        <div class="category-description-block d-flex align-items-center">
            <div class="category-description-content mr-3">
                <h4>One-Piece Design for Increased Stability</h4>
                <p>The Game Reaper scope mount features a unique one-piece design, which eliminates the need for separate rings and bases. This design simplifies the mounting process and enhances stability, as it provides a solid, unbroken connection between the scope and the firearm. The one-piece construction also minimizes the possibility of misalignment or shifting, which can adversely affect accuracy.</p>
            </div>
            <div class="category-description-img">
                <img src="{{ asset('front-end/assets/image/description-icon-3.svg') }}" class="d-block " alt="">
            </div>
        </div>

        <div class="category-description-block d-flex align-items-center">
            <div class="category-description-img mr-3">
                <img src="{{ asset('front-end/assets/image/description-icon-4.svg') }}" class="d-block " alt="">
            </div>
            <div class="category-description-content">
                <h4>Custom Fit for Your Firearm</h4>
                <p>DNZ Products offers a wide range of Game Reaper scope mounts, each designed to fit a specific make and model of firearm. This ensures that each mount provides an optimal fit for your rifle, shotgun, or muzzleloader, resulting in a secure and stable platform for your scope. A perfect fit translates to improved accuracy and performance in the field or at the range.</p>
            </div>
        </div>

        <div class="category-description-block d-flex align-items-center">
            <div class="category-description-content mr-3">
                <h4>Rigorous Quality Control</h4>
                <p>DNZ Products is committed to maintaining the highest standards of quality in every aspect of their manufacturing process. Each Game Reaper scope mount undergoes a thorough inspection and quality control process to ensure that it meets the company's stringent performance and durability requirements. This attention to detail guarantees that you receive a superior product designed to stand up to the rigors of regular use.</p>
            </div>
            <div class="category-description-img">
                <img src="{{ asset('front-end/assets/image/description-icon-5.svg') }}" class="d-block " alt="">
            </div>
        </div>

    </div>
</section>

<!-- --------End-category-description-section--------- -->

@endsection