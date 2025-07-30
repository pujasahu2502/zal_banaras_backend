@extends('frontend.layouts.include.app', ['title' => 'Contact'])
@section('content')
  <div class="bg-gray">
    <div class="custom-container pb-5">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li> {{-- route('home.webinar') --}}
          <li class="breadcrumb-item active" aria-current="page">Contact us</li>
        </ol>
      </nav>
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="contact-block card px-md-5 py-md-5 px-xs-3 py-xs-3">
            <div class="text-center">
              <h2>Contact Us</h2>
              <p class="lead">Feel free to contact us</p>
            </div>
            <form id="contactUsForm" action="#" class="common-form-design"> {{-- route('contact-us.save') --}}
              @csrf
              @method('post')
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                    <label for="name">Name<span class="mandatory">*</span></label>
                    <input id="name" type="text" autocomplete="off" class="form-control alpha" name="name"value="" data-rule-required="true" data-msg-required="Please Enter Name" data-rule-minLength="2" data-rule-maxLength="20" aria-required="true">
                    <span class="text-danger error name-errors"></span>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                    <label for="email">Email Address<span class="mandatory">*</span>
                    </label>
                    <input id="email" type="email" autocomplete="off" class="form-control" name="email" data-rule-required="true" data-msg-required="Please Enter Email" aria-required="true">
                    <span class="text-danger error email-errors"></span>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                    <label for="description">Message<span class="mandatory">*</span></label>
                    <textarea class="form-control"  data-rule-required="true" data-msg-required="Please Enter Message" data-rule-minLength="2" data-rule-maxLength="350" name="description" rows="2"></textarea><span class="text-danger error description-error"></span>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12">
                <div class="google-capcha">
                  <div class="g-recaptcha" data-sitekey="6LfkDD8kAAAAAG04962vrQC03ytLPbPyHMfj-Pb7"></div>
                   <span class="text-danger error capcha-errors"></span>
                </div>
                </div>
                <div class="col-lg-12 col-md-12">
                  <div class="form-group mt-3 text-center">
                    <button class="btn btn-dark w-100" type="button" id="save-contact"><span><b>Send</b>
                      </span>
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('javascript')
  <script src="{{ asset('front-end/contact-us.js') }}"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script type="text/javascript">
    var onloadCallback = function() {
     
    };
  </script>
  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
  async defer>
</script>
@endsection
