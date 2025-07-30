@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Internal server error'))
@section('message_2',__('We are currently trying to fix the problem.'))
