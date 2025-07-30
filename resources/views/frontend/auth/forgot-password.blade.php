<!-- Modal -->
{{-- <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Recover your password</h4>
        <button type="button" class="close btn-close-modal" data-dismiss="modal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
            viewBox="0 0 129 129" enable-background="new 0 0 129 129" width="512px" height="512px">
            <g>
              <path
                d="M7.6,121.4c0.8,0.8,1.8,1.2,2.9,1.2s2.1-0.4,2.9-1.2l51.1-51.1l51.1,51.1c0.8,0.8,1.8,1.2,2.9,1.2c1,0,2.1-0.4,2.9-1.2   c1.6-1.6,1.6-4.2,0-5.8L70.3,64.5l51.1-51.1c1.6-1.6,1.6-4.2,0-5.8s-4.2-1.6-5.8,0L64.5,58.7L13.4,7.6C11.8,6,9.2,6,7.6,7.6   s-1.6,4.2,0,5.8l51.1,51.1L7.6,115.6C6,117.2,6,119.8,7.6,121.4z"
                fill="#8e8e8e" />
            </g>
          </svg>
        </button>
      </div>
      <form method="POST" id="passwordReset" autocomplete="off">
        <div class="modal-body">
          @csrf
          <div class="row">
            <div class="col-12 mb-3">
              <label class="form-label">{{ __('Email Address') }} <span class="mandatory">*</span></label>
              <input id="email" type="email"
                class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="off" autofocus>
              <span class="text-danger error email-error"></span>
              <span class="errors-email"></span>
              @error('email')
                <span class="text-danger" role="alert">
                  {{ $message }}
                </span>
              @enderror
            </div>
            <div class="col-md-12 mb-3">
              <button class="btn btn-dark w-100 reset-password-send" type="button"
                data-url="{{ route('password.email') }}"><b>{{ __('Send Password Reset Link') }}</b></button>
            </div>
          </div>
          <div class="text-center auth-bottom-text">
            <span>Remember your password?</span>
            <a class="forgot-password" role="button" data-toggle="modal" data-target="#LoginModal"> Sign
              In</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div> --}}


<!-- ----------forgot-modal-popup------------------ -->
<div class="modal login-modal-pop fade" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-login modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header p-0">
              <div class="nav-home-logo mb-2 h-16 relative">
                  <img alt="logo" src="{{ asset('front-end/assets/image/dnz-logo.png') }}" />
              </div>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-toggle="tooltip" title="Close"><span aria-hidden="true"><i class="fe-icon" data-feather="x"></i></span></button>
          </div>
          <div class="modal-body">
              <!-- dont forget to add action and action method  -->
              <form class="mt-3" id="passwordReset" autocomplete="off">
                  <div class="form-group form-input-forgot">
                      <div class="input-group">
                          <span class="input-group-addon"><i data-feather="mail"></i></span>
                          <input type="email" class="form-control email" name="email" placeholder="Enter Email Address" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="250" data-msg-required="{{ __('required_email') }}">
                      </div>
                      <span class="text-danger error email-error"></span>
                  </div>
                  <div class="form-group text-center mt-4 mb-0">
                      <button type="button" class="btn btn-primary btn-sm reset-password-send" data-url="{{ route('password.email') }}">Send Password Reset Link</button>
                  </div>
              </form>
          </div>
          <div class="modal-footer">Don't have an account? <a href="#registerModal" data-dismiss="modal" data-toggle="modal" class="ml-1"> Register Now</a></div>
      </div>
  </div>
</div>
