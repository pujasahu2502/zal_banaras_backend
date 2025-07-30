<!-- Modal -->
<!-- ----------login-modal-popup------------------ -->
<div class="modal login-modal-pop fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-login modal-dialog-centered" role="document">
      <div class="modal-content ">
          <div class="modal-header p-0">
              <div class="nav-home-logo mt-3 mb-3 relative">
                  <img alt="logo" src="{{ asset('front-end/assets/image/dnz-logo.png') }}" />
              </div>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-toggle="tooltip" title="Close"><span aria-hidden="true"><i class="fe-icon" data-feather="x"></i></span></button>
          </div>
          <div class="modal-body">
              <!-- dont forget to add action and action method  -->
              <form class="mt-3" id="loginFormId" autocomplete="off">
                  {{-- @csrf --}}
                  <div class="form-group form-input-login">
                      <div class="input-group">
                          <span class="input-group-addon"><i data-feather="mail"></i></span>
                          <input type="text" class="form-control email" name="email" placeholder="Enter your email" data-rule-required="true" data-rule-minlength="2" data-rule-maxlength="250" data-msg-required="{{ __('required_email') }}">
                      </div>
                      <span class="text-danger error email-error d-block"></span>
                  </div>
                  <div class="form-group form-input-login">
                      <div class="input-group">
                          <span class="input-group-addon"><i data-feather="lock"></i></span>
                          <input type="password" id="password" class="form-control password" name="password" placeholder="Enter Password" data-rule-required="true" data-msg-required="{{ __('required_password') }}">
                          <a onclick="passwordShow(this)"><i class="c-sidebar-nav-icon password-eye mr-2" id="pass-eye" data-feather="eye-off"></i></a>
                      </div>
                      <span class="text-danger error password-error  d-block"></span>
                  </div>
                  <div class="row pl-1 pr-1">
                      <div class="col text-left">
                          <label class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox" value="option1">
                              <span class="custom-control-label">&nbsp;Remember Me</span>
                          </label>
                      </div>
                      <div class="col text-right hint-text pt-0">
                          <a href="#forgotModal" data-dismiss="modal" data-toggle="modal" class="text-danger">Forgot Password?</a>
                      </div>
                  </div>
                  <div class="form-group text-center mt-2 mb-0">
                      <button type="button" class="btn btn-primary btn-sm login-form-submit" data-url="{{ route('login') }}">Login</button>
                  </div>
                  {{-- <p class="hint-text text-center">or continue login with</p>
                  <div class="social-login mb-2 text-center">
                      <a class="social-btn text-uppercase" href="#"><img alt="logo" src="{{ asset('front-end/assets/image/facebook.png') }}" /></a>
                      <a class="social-btn text-uppercase" href="#"><img alt="logo" src="{{ asset('front-end/assets/image/instagram.png') }}" /></a>
                      <a class="social-btn text-uppercase" href="#"><img alt="logo" src="{{ asset('front-end/assets/image/mail.png') }}" /></a>
                  </div> --}}
              </form>
          </div>
          <div class="modal-footer">Don't have an account? <a href="#registerModal" data-dismiss="modal" data-toggle="modal" class="ml-1"> Register Now</a></div>
      </div>
  </div>
</div>
<script src="{{ asset('js/passwordshow/passwordshow.js') }}"></script>
