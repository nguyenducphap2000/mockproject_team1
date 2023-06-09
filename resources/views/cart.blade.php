@extends('layouts.dashboard')
@section('title', 'Cart')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Cart</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-centered mb-0 table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Product Desc</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th colspan="2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                                        alt="product-img" title="product-img" class="avatar-md" />
                                                </td>
                                                <td>
                                                    <h5 class="font-size-14 text-truncate">
                                                        <a href="ecommerce-product-detail.html" class="text-dark">
                                                            {{ $item->product->name }}
                                                        </a>
                                                    </h5>
                                                    <p class="mb-0">Color : <span
                                                            class="font-weight-medium">{{ $item->product->name }}</span>
                                                    </p>
                                                </td>
                                                <td>
                                                    $ {{ number_format($item->product->price, 0) }}
                                                </td>
                                                <td>
                                                    <div style="width: 120px;">
                                                        <input type="text" value="{{ $item->amount }}"
                                                            name="demo_vertical">
                                                    </div>
                                                </td>
                                                <td>
                                                    $ {{ number_format($item->amount * $item->product->price, 0) }}
                                                </td>
                                                <td>
                                                    <a href="{{route('cartDelete', $item->id)}}" class="action-icon text-danger">
                                                        <i class="mdi mdi-trash-can font-size-18"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <a href="{{ route('showProduct') }}" class="btn btn-secondary">
                                        <i class="mdi mdi-arrow-left mr-1"></i> Continue Shopping </a>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="text-sm-right mt-2 mt-sm-0">
                                        <a href="{{ route('checkout') }}" class="btn btn-success">
                                            <i class="mdi mdi-cart-arrow-right mr-1"></i> Checkout </a>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Order Summary</h4>

                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Amount :</td>
                                            <td>{{ $amount }}</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping Charge :</td>
                                            <td class="text text-success">Free</td>
                                        </tr>
                                        {{-- <tr>
                                            <td>Estimated Tax : </td>
                                            <td>$ 19.22</td>
                                        </tr> --}}
                                        <tr>
                                            <th>Total :</th>
                                            <th>$ {{ number_format($total, 0) }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
