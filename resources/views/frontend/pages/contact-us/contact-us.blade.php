@extends('frontend.layouts.include.app', ['title' => 'Contact-Us'])
@section('content')

<!-- --------Start-breadcrumb-section--------- -->
<section class="breadcrumb-bg-section">
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg></li>
                    <li class="breadcrumb-item active">Contact-us</li>
                </ol>
            </nav>
        </div>
        <div class="breadcrumb-bg-block mt-2">
            <h4 class="text-uppercase mb-2">about dnz products</h4>
            <p>DNZ Products is a family owned and operated, American company. Every product that comes out of our warehouse has been checked for quality and #Accuracy.</p>
            <div class="country-tag">
                <img src="{{ asset('front-end/assets/image/flag-img.png') }}" alt="">
            </div>
        </div>
    </div>
</section>
<!-- --------End-breadcrumb-section--------- -->

<!-- --------Start-contact-block-section--------- -->
<section class="contact-block-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                <div class="contact-block contact-map-block">
                    <h4 class="text-uppercase">Our headquarters</h4>
                    <div class="conatct-map mt-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25984.12882703137!2d-79.22548626708567!3d35.503880039695844!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89aca97022ff3aed%3A0x98732517c62495e5!2sDNZ%20Products!5e0!3m2!1sen!2sin!4v1689057212282!5m2!1sen!2sin" width="100%" height="542px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                  
                    </div>
                    <div class="contact-detail-block">
                        <ul class="content">
                            <li>
                                <img src="{{ asset('front-end/assets/image/location.svg') }}" alt=""> DNZ Products, LLC 2710 Wilkins DrSanford, NC 27330 USA
                            </li>
                            <li>
                                <a href="tel: 919-777-9608"><img src="{{ asset('front-end/assets/image/phone.svg') }}" alt=""> 919-777-9608 </a>
                            </li>
                            <li>
                                <a href="mailto: certified@Windstream.net"><img src="{{ asset('front-end/assets/image/email.svg') }}" alt=""> certified@Windstream.net</a>
                            </li>
                        </ul>
                    </div>
                    {{-- <div class="contact-social-block">
                        <button class="followbtn followbtn-facebook"><a href="">Follow us on Facebook</a>
                            
                        </button>

                        <button class="followbtn followbtn-instagram"><a href="">Follow us on Instagram</a>
                           
                        </button>
                    </div> --}}
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 pl-md-0">
                <div class="contact-block contact-map-block">
                    <h4 class="text-uppercase">have any question? write to us</h4>
                    <p>DNZ Products is a family owned and operated, American company. Every product that comes out of our warehouse has been checked for quality and #Accuracy.</p>
                    <div class="form-block mt-4">
                        <form id="contactUsForm" method="post" action="{{ route('contact-us.save')}}" class="common-form-design" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="fullname">Full Name<span class="danger">*</span></label>
                                        <input type="text" class="form-control alpha name" id="" name="name" aria-describedby="" placeholder="" data-rule-required="true" data-msg-required="{{ __('required_cantact_name') }}" data-rule-minLength="2" data-rule-maxLength="20" aria-required="true">
                                        <span class="text-danger error name-errors"></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="email">Email address<span class="danger">*</span></label>
                                        <input type="email" class="form-control email" id="email" aria-describedby="" placeholder="" name="email" data-rule-required="true" data-msg-required="{{ __('required_cantact_email') }}" aria-required="true" data-rule-maxLength="40">
                                        <span class="text-danger error email-errors"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="phonenumber">Mobile Number<span class="danger">*</span></label>
                                        <input type="number" class="form-control mobile mobile_number" id="" aria-describedby="" placeholder="" name="mobile_number" data-rule-required="true" data-rule-minLength="10" data-rule-number="true" data-rule-maxLength="13" data-msg-required="{{ __('required_cantact_mobile_number') }}" aria-required="true">
                                        <span class="text-danger error mobile_number-errors"></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="subject">Subject<span class="danger">*</span></label>
                                        <input type="text" class="form-control subject" id="" aria-describedby="" placeholder="" name="subject" data-rule-required="true" data-msg-required="{{ __('required_cantact_subject') }}" data-rule-minLength="2" data-rule-maxLength="100" aria-required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="textarea">Your Message<span class="danger">*</span></label>
                                        <textarea class="form-control description" id="txtArea" rows="5" onkeypress="onTestChange();" data-rule-required="true" data-msg-required="{{ __('required_cantact_message') }}" data-rule-minLength="2" data-rule-maxLength="350" name="description"></textarea>
                                        <span class="text-danger error description-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck10" name="newslatter" value="1">
                                        <label class="form-check-label" for="exampleCheck10">
                                            Subscribe to the DNZ Newsletter
                                        </label>
                                    </div>
                                </div>
                            </div>
                           
                            <button type="button" id="save-contact" class="btn-primary contact-btn mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- --------End-contact-block-section--------- -->

@endsection
@section('javascript')

<script>
    function onTestChange() {
        var key = window.event.keyCode;
        // If the user has pressed enter
        if (key === 13) {
            document.getElementById("txtArea").value = document.getElementById("txtArea").value + "\n";
            return false;
        }
        else {
            return true;
        }
    }
    </script>
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