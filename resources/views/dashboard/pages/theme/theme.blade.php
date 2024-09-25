@extends('dashboard.layouts.app')
@section('title')
    Profile
@endsection
@section('style')
    <link href="{{ asset('dashboard_assets/vendor/lightgallery/css/lightgallery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="page-titles">
        <h4>Profile</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
        </ol>
    </div>
    <div class="container">
        Theme
    </div>
@endsection
@section('script')
@endsection
