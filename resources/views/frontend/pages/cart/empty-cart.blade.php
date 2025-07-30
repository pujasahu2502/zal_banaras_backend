<!-- --------Start-Empty-cart-section--------- -->
<section class="empty-cart-section">
    <div class="container">
        <div class="empty-cart-block text-center">
            <img alt="logo" src="{{ asset('front-end/assets/image/empty-cart-img.png') }}" />
            <div class="empty-cart-content mt-4">
                <h2>Your cart is empty</h2>
                <p>It looks like you have not added anything to your cart. Go ahead & explore the top categories.</p>
            </div>
            <!-- added home and continue shopping buttons -->
            <div class="empty-cart-btn-block mt-3">
                <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
                <a href="{{ route('frontend.products.index') }}" class="btn btn-primary">Continue Shopping</a>
            </div>
            <!-- end home and continue shopping buttons div -->
        </div>
    </div>
</section>
<!-- --------End-Empty-cart-section--------- -->