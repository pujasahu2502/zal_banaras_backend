<!-- Modal -->
{{-- <div class="modal fade overflow-auto" id="RegisterModal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign up</h4>
        <button type="button" class="close btn-close-modal" data-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <form method="POST" id="registerForm" autocomplete="off">
        <div class="modal-body">
          @csrf
          <div class="row">

            <div class="col-12 mb-3">
              <label class="form-label">{{ __('first_name') }} <span class="mandatory">*</span></label>
              <input id="first_name" type="text" class="form-control alpha" data-rule-required="true"
                data-msg-required="{{ __('required_first_name') }}" name="first_name"
                autocomplete="off">
              <span class="text-danger error error-error"></span>
              <span class="errors-first_name"></span>
              <span class="text-danger error first_name-error"></span>
              @error('first_name')
              <span class="text-danger" role="alert">
                  {{ $message }}
              </span>
              @enderror
            </div>
            <div class="col-12 mb-3">
              <label class="form-label">{{ __('last_name') }} <span class="mandatory">*</span></label>
              <input id="last_name" type="text" class="form-control alpha" data-rule-required="true"
                data-msg-required="{{ __('required_last_name') }}" name="last_name" autocomplete="off">
              <span class="text-danger error error-error"></span>
              <span class="errors-last_name"></span>
              <span class="text-danger error last_name-error"></span>
              @error('last_name')
                <span class="text-danger" role="alert">
                  {{ $message }}
                </span>
              @enderror
            </div>
            <div class="col-12 mb-3">
              <label class="form-label">{{ __('email') }} <span class="mandatory">*</span></label>
              <input id="email" type="email" class="form-control" data-rule-required="true"
                data-msg-required="{{ __('required_email') }}" name="email" autocomplete="off">
              <div><span class="text-danger error email-error"></span></div>
              <span class="errors-email"></span>
              @error('email')
                <span class="text-danger" role="alert">
                  {{ $message }}
                </span>
              @enderror
            </div>
            <div class="col-12 mb-3">
              <label class="form-label">{{ __('password') }} <span class="mandatory">*</span></label>
              <input id="password1" type="password" class="form-control" data-rule-required="true"
                data-msg-required="{{ __('required_password') }}" data-rule-minlength="6"
                name="password" autocomplete="off">
              <span class="text-danger error error-error"></span>
              <span class="errors-password"></span>
              @error('password')
                <span class="text-danger" role="alert">
                  {{ $message }}
                </span>
              @enderror
            </div>
            <div class="col-12 mb-3">
              <label class="form-label">{{ __('Confirm Password') }}<span
                  class="mandatory">*</span></label>
              <input type="password" class="form-control" type="password" data-rule-required="true" data-msg-required="{{ __('required_confirm_password') }}"  data-rule-equalto="#password1" data-msg-equalto="{{ __('confirm_password_match') }}" class="form-control" name="password_confirmation" data-rule-minlength="6" autocomplete="new-password">
              <span class="text-danger error error-error"></span>
              <span class="text-danger error password-error"></span>
              <span class="errors-password"></span>
              @error('password')
                <span class="text-danger" role="alert">
                  {{ $message }}
                </span>
              @enderror
            </div>
            <div class="col-md-12 mb-3">
              <button class="btn btn-dark w-100 register-form" type="button"
                data-url="{{ route('register') }}"><b>{{ __('Register') }}</b></button>
            </div>
          </div>
          <div class="text-center auth-bottom-text">
            <span>Already a member?</span>
            <a class="sign-in" role="button" data-toggle="modal" data-target="#LoginModal"> Sign In</a>
          </div>
        </div>
      </form>
    </div>
</div>  --}}

<!-- ----------register-modal-popup------------------ -->
<div class="modal login-modal-pop fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
              <form class="mt-3" id="registerForm" autocomplete="off">
                @csrf
                  <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group form-input-register">
                              <div class="input-group">
                                  <span class="input-group-addon"><i data-feather="user"></i></span>
                                  <input type="text" class="form-control first_name" name="first_name" placeholder="Enter First Name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="250" data-msg-required="{{ __('required_first_name') }}">
                              </div>
                              <span class="text-danger error first_name-error"></span>
                          </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group form-input-register">
                              <div class="input-group">
                                  <span class="input-group-addon"><i data-feather="user"></i></span>
                                  <input type="text" class="form-control last_name" name="last_name" placeholder="Enter Last Name" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="250" data-msg-required="{{ __('required_last_name') }}">
                              </div>
                              <span class="text-danger error last_name-error"></span>
                          </div>
                      </div>
                  </div>
                  <div class="form-group form-input-register">
                      <div class="input-group">
                          <span class="input-group-addon"><i data-feather="mail"></i></span>
                          <input type="email" class="form-control email" name="email" placeholder="Enter Email Address" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="250" data-msg-required="{{ __('required_email') }}">
                      </div>
                      <span class="text-danger error email-error"></span>
                  </div>
                  <div class="form-group form-input-register">
                      <div class="input-group">
                          <span class="input-group-addon"><i data-feather="phone"></i></span>
                          <input type="number" class="form-control mobile" name="mobile" placeholder="Enter Mobile Number" data-rule-required="true" data-rule-minlength="9" data-rule-maxlength="12" data-msg-required="{{ __('required_mobile') }}">
                      </div>
                      <span class="text-danger error mobile-error"></span>
                  </div>
                  <div class="form-group form-input-register">
                      <div class="input-group">
                          <span class="input-group-addon"><i data-feather="lock"></i></span>
                          <input id="password" type="password" class="form-control password passwordr" name="password" placeholder="Enter Password" data-rule-required="true" data-rule-minlength="8" data-rule-maxlength="250" data-msg-required="{{ __('required_password') }}">
                          <a onclick="passwordShow(this)"><i class="c-sidebar-nav-icon password-eye mr-2" id="pass-eye" data-feather="eye-off"></i></a>
                        </div>
                      <span class="text-danger error password-error"></span>
                  </div>
                  <div class="form-group form-input-register">
                      <div class="input-group">
                          <span class="input-group-addon"><i data-feather="lock"></i></span>
                          <input  id="password-confirm" type="password" class="form-control password_confirmation" name="password_confirmation" placeholder="Retype Password" data-rule-required="true" data-msg-required="{{ __('required_confirm_password') }}" data-msg-equalto="{{__('confirm_password_match')}}" data-rule-equalto=".passwordr">
                          <a onclick="passwordConfirm()"><i class="c-sidebar-nav-icon password-eye mr-2" id="pass-eye-confirm" data-feather="eye-off"></i></a>
                      </div>
                      <span class="text-danger error password_confirmation-error"></span>
                  </div>
                  <div class="form-group form-input-register text-center mt-4 mb-0">
                      <button type="button" class="btn btn-primary btn-sm register-form" data-url="{{ route('register') }}">Register</button>
                  </div>
                  <!-- <p class="hint-text text-center mt-2">or continue Register with</p>
                  <div class="social-login mb-2 text-center">
                      <a class="social-btn text-uppercase" href="#"><img alt="logo" src="{{ asset('front-end/assets/image/facebook.png') }}" /></a>
                      <a class="social-btn text-uppercase" href="#"><img alt="logo" src="{{ asset('front-end/assets/image/instagram.png') }}" /></a>
                      <a class="social-btn text-uppercase" href="#"><img alt="logo" src="{{ asset('front-end/assets/image/mail.png') }}" /></a>
                  </div> -->
              </form>
          </div>
          <div class="modal-footer">Already have an account? <a href="#loginModal" data-dismiss="modal" data-toggle="modal" class="ml-1"> Login</a></div>
      </div>
  </div>
</div>
<script src="{{ asset('js/passwordshow/passwordshow.js') }}"></script>

