<footer>
    <div class="top-footer-block text-center">
        <a href="#">
            <img alt="logo" src="{{ asset('front-end/assets/image/white-logo.png') }}" />
        </a>
    </div>
    <div class="site-footer bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                    <div class="footer-block block-update">
                        <h3 class="header text-uppercase">Quick Links</h3>
                        <ul>
                            <li><a href="{{route('why-dnz')}}" class="text-capitalize">Product Info</a></li>
                            <li><a href="{{route('faqs.index')}}" class="text-capitalize">Videos</a></li>
                            <li><a href="{{route('faq.info')}}" class="text-capitalize">FAQ's</a></li>
                            {{-- <li><a href="{{route('help-center')}}" class="text-capitalize">Help Center</a></li> --}}
                            {{-- <li><a href="#" class="text-capitalize">Terms & Conditions</a></li>
                            <li><a href="#" class="text-capitalize">Privacy Policy</a></li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                    <div class="footer-block footer-news-letter">
                        <h3 class="header text-uppercase">NEWSLETTER</h3>
                        <p class="newsletter-head">Stay up to date with our news, promotions and our latest releases.</p>
                        <form id="subscriptionForm">
                            @csrf
                            <div class="newsletter-block">
                                <input onkeyup="stopEnterKey()" aria-describedby="basic-addon2" class="form-control subscription-email" name="email" autocomplete="off" placeholder="Email address" data-rule-required="true" data-msg-required="Please Enter Email" type="email">
                                <button class="btn-primary newsletter-btn disable-custom-btn" id="subscription-store" type="button" data-url="{{ route('home.subscription') }}">Join</button>
                                <span class="text-danger error email-error"></span>
                                <label class="error_validate" for="email"></label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="footer-block block-update d-md-flex justify-content-end">
                        <div class="footer-contact-block">
                            <h3 class="header text-uppercase">Contacts</h3>
                            <ul class="content">
                                <li>
                                    <a href="mailto: {{$setting->email ?? '#'}}" target="_blank"><i class="footer-contact" data-feather="mail"></i>{{$setting->email ?? ''}}</a>
                                </li>
                                <li>
                                    <a href="tel: {{$setting->mobile ?? '#'}}" target="_blank"><i class="footer-contact" data-feather="phone"></i> {{$setting->mobile ?? ''}} </a>
                                </li>
                                <li class="address-block d-flex">
                                    <i class="footer-contact-map" data-feather="map-pin"></i>
                                    <p>{{$setting->address ?? ''}}</p>
                                </li>
                            </ul>
                            {{-- {{dd($setting)}} --}}
                            @if(isset($setting) && !empty($setting['facebook'] || $setting['linkedin'] || $setting['instagram'] || $setting['twitter']))
                            <div class="social-block mt-3"> 
                                <h3 class="header">SOCIAL LINKS</h3>
                                <ul>
                                    @if($setting->facebook != null)
                                        <li><a href="{{$setting->facebook ?? '#'}}" target="_blank" data-toggle="tooltip" title="Facebook"><i data-feather="facebook"></i></a></li>
                                    @endif
                                    @if($setting->linkedin != null)
                                        <li><a href="{{$setting->linkedin ?? '#'}}" target="_blank" data-toggle="tooltip" title="Linkedin"><i data-feather="linkedin"></i></a></li>
                                    @endif
                                    @if($setting->instagram != null)
                                    <li><a href="{{$setting->instagram ?? '#'}}" target="_blank" data-toggle="tooltip" title="Instagram"><i data-feather="instagram"></i></a></li>
                                    @endif
                                    @if($setting->twitter != null)
                                    <li><a href="{{$setting->twitter ?? '#'}}" target="_blank" data-toggle="tooltip" title="Twitter"><i data-feather="twitter"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right bg-light-gray">
        <div class="col-md-12 text-center">
            <p>©{{getYear(today())}} Copyright <b class="copy-right-color">DNZ Products</b> | All Rights Reserved</p>
        </div>
    </div>
</footer>
<script type="text/javascript">
    function stopEnterKey(e) {
        if ( e.which == 13 ) return false;
        //or...
        if ( e.which == 13 ) e.preventDefault();
    }
    document.onkeypress = stopEnterKey;
</script>