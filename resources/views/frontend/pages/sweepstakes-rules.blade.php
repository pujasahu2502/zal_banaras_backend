@extends('frontend.layouts.include.app', ['title' => 'Webinar'])
@section('content')
  <div class="container mb-4 content-page-wrapper">
    <div class="row">
      <div class="col-md-12 mt-4">
        <h1 class="text-center text-uppercase">{{ucwords($sweepTakes->title) ?? 'NA'}}</h1>
      </div>
       <div class="col-md-12 mt-4">
      {!! $sweepTakes->description ?? 'NA' !!}
       </div>
    </div>
  </div>
@endsection
