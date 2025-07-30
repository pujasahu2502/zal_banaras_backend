@extends('errors::minimal')

@section("img", asset('front-end/assets/image/gun-404.png') )
@section('title', __('Page Not Found'))
@section('code', '404')
@section('message', __('Look like you\'re lost'))
@section('message_2',__('the page you are looking for not avaible!'))
