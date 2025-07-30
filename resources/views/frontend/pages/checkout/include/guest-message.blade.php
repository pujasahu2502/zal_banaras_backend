@if(!auth()->guard('web')->check())
    <div class="checkout-head">
        <p class="checkout-text mb-3">
            Returning Customer? <a href="javascript:void(0);" data-toggle="modal" data-target="#loginModal" title="Login" id="">Login here</a> for a better experience.
        </p>
        <p class="checkout-text mb-3">
            Don't have an Account yet? <a href="javascript:void(0);" data-toggle="modal" data-target="#registerModal" title="Register">Join us .</a>
        </p>
        <p class="checkout-text">
            I want to continue as guest.
        </p>
    </div>
@endif