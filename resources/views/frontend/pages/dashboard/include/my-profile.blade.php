@extends('frontend.pages.dashboard.user-base', ['title' => 'My Profile','subtitle' => ''])
@section('user-section')
<div class="card">
    <div class="card-header custom-card-header">
        <h5 class="d-flex align-items-center"><span class="arrow-icon"><i data-feather="user" class="feather mr-2"></i></span> My Profile</h5>
    </div>
    <div class="my-profile-update mt-3 mb-2">
        @include('frontend.pages.dashboard.include.my-profile-form')
    </div>
</div>
@endsection
@section('user-javascript')
    <script src="{{ asset('front-end/profile-update.js') }}"></script>
@endsection