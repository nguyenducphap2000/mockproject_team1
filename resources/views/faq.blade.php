@extends('layouts.master')
@section('title', 'FAQ Page')
<link rel="stylesheet" href="{{URL::asset('assets/css/faq.css')}}">
@section('content')
    <div class="heading">
        <div class="container">
            <!-- Start Search -->
            <form class="form-inline">
                <input class="form-control search-input"
                       id="search-input"
                       type="search"
                       placeholder="Search"
                       aria-label="Search">
            </form>
            <!-- End Search -->

            <!-- Start FAQ result -->

            <div class="faq-container">
                <div class="questions row" id="accordion">
                </div>
            </div>
            <!-- End FAQ result -->
        </div>
    </div>
    <script src="{{URL::asset('assets/js/faq.js')}}"></script>
@endsection
