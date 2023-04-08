@extends('layouts.master')
@section('title','Category')
<link rel="stylesheet" href="{{URL::asset('/assets/css/category.css')}}">
@section('content')
    <div class="heading">
        <div class="category-container">
            <div class="row">
                <div class="col-4 category-filter">
                    <h3 class="filter-title text-capitalize">Category filter</h3>
                    <form action="">
                        <div class="input-group row">
                            <input type="text" class="form-control col-9" name="search-box" placeholder="Search">
                            <button type="submit" class="search-btn btn btn-primary col-3" value="Search"
                                    name="search-btn"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                        </div>
                        {{--Filter part category--}}
                        <div class="check-group">
                            <h4>Category</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Default checkbox
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Checked checkbox
                                </label>
                            </div>
                        </div>
                        {{--Filter part color--}}
                        <div class="check-group">
                            <h4>color</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="red" id="red">
                                <label class="form-check-label" for="red">
                                    Red
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="blue" id="blue">
                                <label class="form-check-label" for="blue">
                                    blue
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-8 product-list">
                    <div class="row">
                        <div class="col-md-4 col-6">
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul class="row">
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-eye"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-star"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <img src="{{ asset('assets/images/men-01.jpg') }}" alt="">
                                </div>
                                <div class="down-content row">
                                    <h4 class="col-9 mb-1">Classic Spring</h4>
                                    <span class="col-3">$120.00</span>
                                    <ul class="col-9 stars row">
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul class="row">
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-eye"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-star"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <img src="{{ asset('assets/images/men-01.jpg') }}" alt="">
                                </div>
                                <div class="down-content row">
                                    <h4 class="col-9 mb-1">Classic Spring</h4>
                                    <span class="col-3">$120.00</span>
                                    <ul class="col-9 stars row">
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul class="row">
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-eye"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-star"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <img src="{{ asset('assets/images/men-01.jpg') }}" alt="">
                                </div>
                                <div class="down-content row">
                                    <h4 class="col-9 mb-1">Classic Spring</h4>
                                    <span class="col-3">$120.00</span>
                                    <ul class="col-9 stars row">
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul class="row">
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-eye"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-star"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <img src="{{ asset('assets/images/men-01.jpg') }}" alt="">
                                </div>
                                <div class="down-content row">
                                    <h4 class="col-9 mb-1">Classic Spring</h4>
                                    <span class="col-3">$120.00</span>
                                    <ul class="col-9 stars row">
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul class="row">
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-eye"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-star"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <img src="{{ asset('assets/images/men-01.jpg') }}" alt="">
                                </div>
                                <div class="down-content row">
                                    <h4 class="col-9 mb-1">Classic Spring</h4>
                                    <span class="col-3">$120.00</span>
                                    <ul class="col-9 stars row">
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul class="row">
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-eye"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-star"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <img src="{{ asset('assets/images/men-01.jpg') }}" alt="">
                                </div>
                                <div class="down-content row">
                                    <h4 class="col-9 mb-1">Classic Spring</h4>
                                    <span class="col-3">$120.00</span>
                                    <ul class="col-9 stars row">
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul class="row">
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-eye"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-star"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <img src="{{ asset('assets/images/men-01.jpg') }}" alt="">
                                </div>
                                <div class="down-content row">
                                    <h4 class="col-9 mb-1">Classic Spring</h4>
                                    <span class="col-3">$120.00</span>
                                    <ul class="col-9 stars row">
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul class="row">
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-eye"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-star"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <img src="{{ asset('assets/images/men-01.jpg') }}" alt="">
                                </div>
                                <div class="down-content row">
                                    <h4 class="col-9 mb-1">Classic Spring</h4>
                                    <span class="col-3">$120.00</span>
                                    <ul class="col-9 stars row">
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul class="row">
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-eye"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-star"></i></a></li>
                                            <li class="col-4"><a href="{{ url('/single-product') }}"><i
                                                        class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <img src="{{ asset('assets/images/men-01.jpg') }}" alt="">
                                </div>
                                <div class="down-content row">
                                    <h4 class="col-9 mb-1">Classic Spring</h4>
                                    <span class="col-3">$120.00</span>
                                    <ul class="col-9 stars row">
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                        <li><i class="fa fa-star col-3"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pagination">
                        <nav aria-label="Page navigation">
                            <ul class="pagination right">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
@endsection
