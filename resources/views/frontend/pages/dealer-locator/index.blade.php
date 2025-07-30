@extends('frontend.layouts.include.app', ['title' => 'Dealer Locator'])
@section('content')

<!-- --------Start-jumbotron-section--------- -->
<section class="jumbotron-section">
    <div class="container">
        <div class="jumbotron-bg-img">
            <div class="jumbotron-content wow slideInLeft">
                <div class="bs-example">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-arrow"><i data-feather="chevron-right"></i></li>
                            <li class="breadcrumb-item active"><a href="#">Dealer-locator</a></li>
                        </ol>
                    </nav>
                </div>
                <h3 class="text-uppercase mb-3">Dealer-locator</h3>
            </div>
        </div>
    </div>
</section>
<!-- --------End-jumbotron-section--------- -->

<!-- --------Start-dealer-locator-section--------- -->
<section class="dealer-location-section">
    <div class="container">
        <div class="top-search-filter pb-0 mt-4 mb-4">
            <!-- added form here -->
            <form method="get" action="{{ route('dealer-locator') }}">
                <div class="search-wrap mt-2">
                    <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter Dealer's name, city, zipcode and address" name="locationSearch" value="{{ request()->input('locationSearch') }}">
                    <div class="locator-btn-block d-flex">
                        <button type="submit" class="btn-primary locator-btn dealer-search-btn mr-2">Search</button>
                        <a href="{{ route('dealer-locator') }}" class="btn-primary locator-btn dealer-reset-btn">Reset</a>
                    </div>
                </div>
            </form>
            <!-- end form here -->
        </div>
    </div>
    <div class="locator-map-block">
        <div class="container">
            @if(count($dealerData))
            <div class="row dealer-inner-block">
                <div class="col-md-5 col-sm-12 col-xs-12 pr-md-0">
                    <div class="dealer-locator-block">
                        <!-- created dynamic card for dealer locator -->
                        @forelse ($dealerData as $key => $dealer)
                        <div class="card">
                            <div class="card-body">
                                <div class="locator-inner-block d-flex">
                                    <div class="locator-img align-self-center">
                                        @if ($dealer->getMedia('dealer')->count())
                                        @foreach ($dealer->getMedia('dealer') as $mediaKey => $media)
                                        @if($mediaKey == 0)
                                        <img src="{{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }}">
                                        @endif
                                        @endforeach
                                        {{-- @else
                                        <img src="{{ asset('backend/no-img.png') }}" height="60" width="60"> --}}
                                        @endif
                                    </div>
                                    <div class="locator-content">
                                        <h6 class="text-capitalize">{{ $dealer->title }}</h6>
                                        @if (!empty($dealer->email))
                                        <p><span class="dealer-icon mr-2"><i data-feather="mail"></i></span> {{ $dealer->email ?? 'NA' }}</p>
                                        @endif
                                        @if (!empty($dealer->phone))
                                        <p><span class="dealer-icon mr-2"><i data-feather="phone"></i></span> {{ $dealer->phone ?? 'NA' }}</p>
                                        @endif
                                        <p><span class="dealer-icon mr-2"><i data-feather="map-pin"></i></span> {{ $dealer['address']->address.' '.$dealer['address']->zip }}</p>
                                    </div>
                                </div>
                                <div class="dealer-card-btn mt-2 mb-2">
                                    <ul>
                                        <li><a href="{{ $dealer->website_url }}" class="btn-primary" target="_blank">Dealer Contact</a></li>
                                        <li><a href="javaScript:;" class="btn-primary setMap" data-location="{{json_encode([$locations[$key]])}}">Dealer Map</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="card">
                            <div class="card-body">
                                <div class="locator-inner-block d-flex">
                                    <div class="locator-content">
                                        <h6 class="text-capitalize">@lang('no_dealer_record')</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforelse
                        <!-- end card here -->
                    </div>
                </div>
                <div class="col-md-7 col-sm-12 col-xs-12 pl-md-0">
                    <div class="dealer-map-block">
                        <div id="map" style='height:538px'></div>
                        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d207884.4160198776!2d-79.3087327443129!3d35.49948091698917!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89aca38c6e5a1cc9%3A0x33e094f5b0279618!2sSanford%2C%20NC%2C%20USA!5e0!3m2!1sen!2sin!4v1680698921165!5m2!1sen!2sin" width="100%" height="540px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  -->
                    </div>
                </div>
            </div>
            @else
            {{-- <div class="row dealer-inner-block">
                <div class="col-md-12 col-sm-12 col-xs-12 pr-md-0">

                </div> --}}             
                <div class="d-flex align-items-center justify-content-center" style="width:100%;">
                    <section class="no-data-section">
                        <div class="container">
                            <div class="no-data-block">
                                <img alt="logo" src="{{asset('front-end/assets/image/no-data-empty.png')}}">
                                <h3 class="mt-3">@lang('no_dealer_record')</h3>
                                <p>The data you are looking for might have been removed or is temporarily unavailable.</p>
                                <a href="{{route("home")}}" class="btn-primary">Go to homepage</a>
                            </div>
                        </div>
                    </section>
                </div>
            @endif
        </div>
    </div>
</section>
<!-- --------Start-dealer-locator-section--------- -->
{{-- image code use in script line 148  --}}
{{-- <div class="locator-img align-self-center"><img src="{{ asset('front-end/assets/image/amendment-outdoors.jpeg') }}"> --}}
@endsection

@section('javascript')
<script type="text/javascript">
    var locations = <?php echo json_encode($locations) ?>;
    var popupFlag = false;

    function initializeMap() {
        const map = new google.maps.Map(document.getElementById("map"));
        var infowindow = new google.maps.InfoWindow();
        var bounds = new google.maps.LatLngBounds();
        map.setOptions({ minZoom: 1, maxZoom: 6 });
        for (var location of locations) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(location.lat, location.lng),
                map: map,
            });
            bounds.extend(marker.position);
            google.maps.event.addListener(marker, 'click', (function(marker, location) {
                return function() {
                    var html = '<div class="card dealer-map-card"><div class="card-body"><div class="locator-inner-block d-flex"></div><div class="locator-content"><h6>' + location.title + '</h6><p><span class="dealer-icon mr-2"><i data-feather="mail"></i></span>' + location.email + '</p><p><span class="dealer-icon mr-2"><i data-feather="phone"></i></span>' + location.phone + '</p><p><span class="dealer-icon mr-2"><i data-feather="map-pin"></i></span> ' + location.address + '</p></div></div> <div class="dealer-card-btn mt-1 mb-1"><ul><li><a href="' + location.web_url + '" target="_blank" class="btn-primary">Dealer Contact</a></li></ul></div></div></div>';
                    // infowindow.setContent(location.lat + " & " + location.lng);
                    infowindow.setContent(html);
                    //infowindow.setContent(location.name + " & " +location.lat + " & " + location.lng);
                    infowindow.open(map, marker);
                }
            })(marker, location));
            if (popupFlag) {
                var html = '<div class="card dealer-map-card"><div class="card-body"><div class="locator-inner-block d-flex"><div class="locator-content"><h6>' + location.title + '</h6><p><span class="dealer-icon mr-2"><i data-feather="mail"></i></span>' + location.email + '</p><p><span class="dealer-icon mr-2"><i data-feather="phone"></i></span>' + location.phone + '</p><p><span class="dealer-icon mr-2"><i data-feather="map-pin"></i></span> ' + location.address + '</p></div></div> <div class="dealer-card-btn mt-1 mb-1"><ul><li><a href="' + location.web_url + '" target="_blank" class="btn-primary">Dealer Contact</a></li></ul></div></div></div>';
                // infowindow.setContent(location.lat + " & " + location.lng);
                infowindow.setContent(html);
                //infowindow.setContent(location.name + " & " +location.lat + " & " + location.lng);
                infowindow.open(map, marker);
            }
        }
        map.fitBounds(bounds);
    }

    $(document).on('click','.setMap',function() {
        locations = JSON.parse($(this).attr('data-location')); 
        popupFlag =true;
        initializeMap();

    }); 
</script>


<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initializeMap"></script>

{{--<script src="{{ asset('/front-end/dealer-locator.js') }}"></script>--}}
@endsection