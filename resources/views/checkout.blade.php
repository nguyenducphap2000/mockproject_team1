@extends('layouts.dashboard')
@section('title', 'Checkout')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Checkout</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Checkout</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class="checkout-tabs">
                <div class="row">
                    <div class="col-xl-2 col-sm-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-shipping-tab" data-toggle="pill" href="#v-pills-shipping"
                                role="tab" aria-controls="v-pills-shipping" aria-selected="true">
                                <i class="bx bxs-truck d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="font-weight-bold mb-4">Shipping Info</p>
                            </a>
                            <a class="nav-link" id="v-pills-confir-tab" data-toggle="pill" href="#v-pills-confir"
                                role="tab" aria-controls="v-pills-confir" aria-selected="false">
                                <i class="bx bx-badge-check d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="font-weight-bold mb-4">Confirmation</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-10 col-sm-9">
                        <form action="{{ route('checkoutStore') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$total}}" name="total">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-shipping" role="tabpanel"
                                            aria-labelledby="v-pills-shipping-tab">
                                            <div>
                                                <h4 class="card-title">Shipping information</h4>
                                                <p class="card-title-desc">Fill all information below</p>
                                                <div class="form-group row mb-4">
                                                    <label for="billing-name" class="col-md-2 col-form-label">Name</label>
                                                    <div class="col-md-10">
                                                        <input required name="name" value="{{ Auth::user()->name }}"
                                                            type="text" class="form-control" id="billing-name"
                                                            placeholder="Enter your name">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label for="billing-email-address" class="col-md-2 col-form-label">Email
                                                        Address</label>
                                                    <div class="col-md-10">
                                                        <input required value="{{ Auth::user()->email }}" name="email"
                                                            type="email" class="form-control" id="billing-email-address"
                                                            placeholder="Enter your email">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label for="billing-phone" class="col-md-2 col-form-label">Phone</label>
                                                    <div class="col-md-10">
                                                        <input required name="phoneNumber" value="{{ Auth::user()->phone_number }}"
                                                            type="text" class="form-control" id="billing-phone"
                                                            placeholder="Enter your Phone no.">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label for="billing-address"
                                                        class="col-md-2 col-form-label">Address</label>
                                                    <div class="col-md-10">
                                                        <textarea required name="address" class="form-control" id="billing-address" rows="3" placeholder="Enter full address">{{ Auth::user()->address }}</textarea>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h4 class="card-title">Payment information</h4>
                                                    <p class="card-title-desc">Fill all information below</p>

                                                    <div>
                                                        @foreach ($payment_methods as $item)
                                                            @if (str_contains($item->name, 'Credit'))
                                                                <div
                                                                    class="custom-control custom-radio custom-control-inline mr-4">
                                                                    <input value="{{ $item->id }}" type="radio"
                                                                        id="customRadioInline1" name="paymentMethod"
                                                                        class="custom-control-input">
                                                                    <label class="custom-control-label"
                                                                        for="customRadioInline1"><i
                                                                            class="fab fa-cc-mastercard mr-1 font-size-20 align-top"></i>
                                                                        Credit / Debit Card</label>
                                                                </div>
                                                            @else
                                                                <div
                                                                    class="custom-control custom-radio custom-control-inline mr-4">
                                                                    <input value="{{ $item->id }}" type="radio"
                                                                        id="customRadioInline3" name="paymentMethod"
                                                                        class="custom-control-input" checked>
                                                                    <label class="custom-control-label"
                                                                        for="customRadioInline3"><i
                                                                            class="far fa-money-bill-alt mr-1 font-size-20 align-top"></i>
                                                                        Cash on Delivery</label>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-confir" role="tabpanel"
                                            aria-labelledby="v-pills-confir-tab">
                                            <div class="card shadow-none border mb-0">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-4">Order Summary</h4>

                                                    <div class="table-responsive">
                                                        <table class="table table-centered mb-0 table-nowrap">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th scope="col">Product</th>
                                                                    <th scope="col">Product Desc</th>
                                                                    <th scope="col">Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($carts as $item)
                                                                    <tr>
                                                                        <th scope="row"><img
                                                                                src="{{ asset('storage/' . $item->product->image) }}"
                                                                                alt="product-img" title="product-img"
                                                                                class="avatar-md"></th>
                                                                        <td>
                                                                            <h5 class="font-size-14 text-truncate"><a
                                                                                    href="ecommerce-product-detail.html"
                                                                                    class="text-dark">{{ $item->product->name }}
                                                                                </a></h5>
                                                                            <p class="text-muted mb-0">
                                                                                $
                                                                                {{ number_format($item->product->price, 0) }}
                                                                                x
                                                                                {{ $item->amount }}
                                                                            </p>
                                                                        </td>
                                                                        <td>$ {{ number_format($item->product->price, 0) }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <h6 class="m-0 text-right">Sub Total:</h6>
                                                                    </td>
                                                                    <td>
                                                                        $ {{ number_format($total) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3">
                                                                        <div class="bg-soft-primary p-3 rounded">
                                                                            <h5 class="font-size-14 text-primary mb-0">
                                                                                <i class="fas fa-shipping-fast mr-2"></i>
                                                                                Shipping <span
                                                                                    class="float-right">Free</span>
                                                                            </h5>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <h6 class="m-0 text-right">Total:</h6>
                                                                    </td>
                                                                    <td>
                                                                        $ {{ number_format($total) }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <a href="{{ route('cart') }}"
                                        class="btn text-muted d-none d-sm-inline-block btn-link">
                                        <i class="mdi mdi-arrow-left mr-1"></i> Back to Shopping Cart </a>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="text-sm-right">
                                        <button type="submit" class="btn btn-success">
                                            <i class="mdi mdi-truck-fast mr-1"></i> Proceed to Shipping </button>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
