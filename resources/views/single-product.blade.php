@extends('layouts.master')
@section('title', 'Single-product')
<script src="{{URL::asset('/assets/js/singleProduct.js')}}"></script>
@section('content')
    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Single Product Page</h2>
                        <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->


    <!-- ***** Product Area Starts ***** -->
    <section class="section" id="product">
        <div class="container">
            <div class="row">
                @foreach($product as $item)
                    <div class="col-lg-8">
                        <div class="left-images">
                            <img src="{{$item->image}}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="right-content">
                            <h4>{{$item->name}}</h4>
                            <span class="price">${{$item->price}}</span>
                            <ul class="stars">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt
                            ut labore.</span>
                            <div class="quote">
                                <i class="fa fa-quote-left"></i>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiuski smod.</p>
                            </div>
                            <div class="quantity-content">
                                <div class="left-content">
                                    <h6>No. of Orders</h6>
                                </div>
                                <div class="right-content">
                                    <div class="quantity buttons_added">
                                        <input type="button" value="-" class="minus"
                                               onclick="minusProduct({{$item->price}})">
                                        <input type="number"
                                               min="1" max="" name="quantity" value="{{$quantity}}" title="Qty"
                                               class="input-text qty text" size="4" pattern="" inputmode=""
                                               id="qty-val">
                                        <input type="button" value="+" class="plus"
                                               onclick="addProduct({{$item->price}})"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="total">
                                <h4>Total: ${{$item->price}}</h4>
                                <div class="main-border-button"><a href="#">Add To Cart</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ***** Product Area Ends ***** -->
@endsection
