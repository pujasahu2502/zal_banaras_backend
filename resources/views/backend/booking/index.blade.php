@extends('backend.layouts.app', ['title' => 'Order'])
@section('content')
  <div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
    <h4 class="title">
    <i class="c-sidebar-nav-icon fe-icon" data-feather="book-open"></i>Order
    </h4>
    <div class="filter-search-block d-flex justify-content-between">
    <form class="form-block" action="{{route('booking.index')}}" method="get">
      @csrf
      <div class="search-icon-wrap d-flex justify-content-between">
      <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control d-none" placeholder="Search..." autocomplete="off">
      <button type="submit" class="search-btn btn btn-primary d-none" data-toggle="tooltip" data-placement="top" title=" Search"><i class="fa fa-search" ></i></button>
      </div>
    </form>
    <a href="{{route('booking.index')}}"><button type="button" class="reset-btn btn btn-primary d-none" data-toggle="tooltip" data-placement="top" title="Reset"><i class="fa fa-refresh text-white"></i></button></a> 
    </div>
  </div>
  <div class="card-body">
    {{--<table class="table table-hover table-striped">
    <thead>
      <tr>
      <th scope="col" width="5%" class="text-center">S.No</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Mobile</th>
      <th scope="col">Raffle</th>
      <th scope="col">Seat</th>
      <th scope="col">Order Date</th>
      <th scope="col">Price</th>
      <th scope="col">Status</th>
      <th class="text-center" scope="col">Action</th>
      </tr>
    </thead>
    <tbody class="category-table admin-table">
      @include('backend.booking.include.booking-table')
    </tbody>
    </table>--}}
      @include('comming-soon')
  </div>
  </div>
  <div class="view-btn">
  {{ $bookingData->links() }}
  </div>
@endsection
@section('javascript')
<script src="{{asset('backend/js/booking.js')}}"></script>
@endsection
