@extends('frontend.layouts.include.app', ['title' => 'Raffles'])
@section('content')
  <div class="container mb-4 content-page-wrapper about-page-block">
    <div class="row">
      <div class="col-md-12 mt-4">
        <h1 class="text-center text-uppercase">{{ucwords($about->title) ?? 'NA'}}</h1>
      </div>
       <div class="col-md-12 mt-4">
      {!! $about->description ?? 'NA' !!}
       </div>
       <div class="col-md-12 mt-4">
        <iframe width="100%" height="516" src="{!! $about->url ?? 'NA' !!}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
         </div>
    </div>
  </div>
@endsection

