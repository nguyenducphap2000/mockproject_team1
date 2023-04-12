@extends('layouts.master')
@section('title', 'Single-product')
@section('content')
    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>New Product</h2>
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
                <div class="col-lg-8">
                    <div class="left-images">
                        <img height="900" src="{{ asset('storage/' . $product->image) }}" alt="">
                        {{-- <img src="{{ asset('assets/images/single-product-02.jpg') }}" alt=""> --}}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="right-content">
                        <h4>{{ $product->name }}</h4>
                        <span class="price">$ {{ number_format($product->price, 0) }}</span>
                        <ul class="stars">
                            <li>
                                <h5>{{ $product->size->name }}</h5>
                            </li>
                        </ul>
                        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt
                            ut labore.</span>
                        <div class="quote">
                            <i class="fa fa-quote-left"></i>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiuski smod.</p>
                        </div>
                        <form action="{{ route('cartStoreInDetail') }}" method="POST">
                            @csrf
                            <div class="quantity-content">
                                <input type="hidden" name="productId" value="{{ $product->id }}">
                                <div class="left-content">
                                    <h6>Stock : {{ $product->stock }}</h6>
                                </div>
                                <div class="right-content">
                                    <div class="quantity buttons_added">
                                        <input type="button" value="-" class="minus"><input type="number"
                                            step="1" min="1" max="" name="quantity" value="1"
                                            title="Qty" class="input-text qty text" size="4" pattern=""
                                            inputmode=""><input type="button" value="+" class="plus">
                                    </div>
                                </div>
                            </div>
                            <div class="total">
                                {{-- <h4>Total: $210.00</h4> --}}
                                <div class="main-border-button">
                                    <button {{ $product->stock <= 0 ? 'disabled' : '' }} class="btn btn-secondary"
                                        type="submit">Add To
                                        Cart
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Product Area Ends ***** -->
@endsection
