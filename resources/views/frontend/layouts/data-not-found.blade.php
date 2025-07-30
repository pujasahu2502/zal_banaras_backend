@extends('frontend.layouts.include.app', ['title' => 'Data Not Found'])
@section('content')

<!-- --------Start-breadcrumb-section--------- -->
<section class="no-data-section">
    <div class="container">
        <div class="no-data-block">
            <img alt="logo" src="{{ asset('front-end/assets/image/no-data-empty.png') }}" />
            <h3 class="mt-3">Data Not Found!</h3>
            <p>The data you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
            <a href="{{ 'home' }}" class="btn-primary">Go to homepage</a>
        </div>
    </div>
</section>
<!-- --------End-breadcrumb-section--------- -->
@endsection