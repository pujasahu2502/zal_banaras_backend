@extends('backend.layouts.app', ['title' => ''])
@section('content')
  <style>
    #map {
      border:1px solid rgb(0, 0, 0);
      width: 100%;
      height: 500px;
    }
  </style>
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
      <h4 class="title"><i class="c-sidebar-nav-icon fe-icon" data-feather="help-circle"></i>Dealers</h4>
    </div>
    <div class="card-body">
        <div id="filters">
            <form action="{{ route('get-dealers') }}" method="POST" id="filterDealers">
              <div class="row">
                <div class="col-3">
                  <input type="text" class="form-control" placeholder="Search Dealer Name" id="search" name="search" aria-label="Search Dealer Name">
                </div>
                <div class="col-3">
                  <select class="form-control" placeholder="Select City" id="city" name="city" aria-label="Select City">
                    @if($cities->count() > 0)
                      <option value="">Select City</option>
                      @foreach ($cities as $key => $value )
                        <option value="{{ $value->city }}">{{ $value->city }}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
                <div class="col-3">
                  <select class="form-control" placeholder="Select State" id="state" name="state" aria-label="Select State">
                    @if($states->count() > 0)
                      <option value="">Select State</option>
                      @foreach ($states as $key => $value )
                        <option value="{{ $value->state }}">{{ $value->state }}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
                <div class="col-3">
                  <button type="button" id="filterResults" class="btn btn-primary">Filter</button>
                  <button type="button" id="clearFilter" class="btn btn-primary">Clear Filter</button>
                </div>
              </div>
            </form>
        </div>
        <div id="map"></div>
    </div>
  </div>
  <div class="view-btn">
  </div>
@endsection
@section('javascript')
    <script type="text/javascript">
      $(document).ready(function(){
          var mymap="";
          var uLat="";
          var uLon="";

          $('#filterResults').on('click',function(){
            initializeMap();
          })

          $('#clearFilter').on('click',function(){
            $('#filterDealers')[0].reset();
            initializeMap();
          })
          // get users lat/long
          
          var getPosition = {
            enableHighAccuracy: false,
            timeout: 9000,
            maximumAge: 0
          };
          
          function success(gotPosition) {
            uLat = gotPosition.coords.latitude;
            uLon = gotPosition.coords.longitude;
            initializeMap();
          };
          
          function error(err) {
              alert('Unable to get user\'s location');
          };

          
          navigator.geolocation.getCurrentPosition(success, error, getPosition);
          
          function initializeMap(){
              mymap = new GMaps({
                el: '#map',
                lat: uLat,
                lng: uLon,
                zoom:6
              });
              $("#map").css("border", "1px solid rgb(0, 0, 0)");
              $("#map").css("width", "100%");
              $("#map").css("500px");
              getDealers(mymap);
          }
          function getDealers(mymap){
            var form = $('#filterDealers');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
              url: form.attr( 'action' ),
              type: 'POST',
              data: form.serialize(),
              success: function(response){
                  var locations = response.data;
                  addMarker(mymap,locations);
              },
              error: function(response){
                  var errors = response;
                  console.log(response);
                  alert(errors.message);
              }
            });
          }
          function addMarker(mymap,locations){
            $.each( locations, function( index, value ){
                mymap.addMarker({
                  lat: value.latitude,
                  lng: value.longitude,
                  title: value.name,
                  click: function(e) {
                    alert('This is '+value.name+', dealer.');
                }
              });
            });
          }
          
      });
    </script>

    <script type="text/javascript"
    src="https://maps.google.com/maps/api/js?key=AIzaSyBMrWXO51jXwNqkHv6BOaWEi8JUNuBGw4k" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>


@endsection