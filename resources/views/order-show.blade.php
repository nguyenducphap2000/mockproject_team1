@extends('layouts.dashboard')
@section('title', 'Order Detail')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Order Detail</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item">Order</li>
                                <li class="breadcrumb-item active">Order Detail</li>
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
                            <h5 class="card-title">Billing Name: {{ $user->name }}</h5>
                            <div class="table-responsive">
                                <table class="table table-centered mb-0 table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Product Desc</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                                        alt="product-img" title="product-img" class="avatar-md" />
                                                </td>
                                                <td>
                                                    <h5 class="font-size-14 text-truncate"><a
                                                            href="ecommerce-product-detail.html"
                                                            class="text-dark">{{ $item->product->name }}</a></h5>
                                                    <p class="mb-0">Color : <span
                                                            class="font-weight-medium">{{ $item->product->color }}</span>
                                                    </p>
                                                </td>
                                                <td>
                                                    $ {{ number_format($item->product->price, 0) }}
                                                </td>
                                                <td>
                                                    {{ $item->amount }}
                                                </td>
                                                <td>
                                                    $ {{ number_format($item->amount * $item->product->price, 0) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <a href="{{ route('order') }}" class="btn btn-secondary">
                                        <i class="mdi mdi-arrow-left mr-1"></i> Back To Orders </a>
                                </div> <!-- end col -->
                                @if (Auth::user()->is_admin)
                                    <div class="col-sm-6">
                                        <form id="earned" action="{{ route('checkedOrder', $order_id) }}">
                                            <div class="text-sm-right mt-2 mt-sm-0">
                                                <a onclick="earnedClick()" class="btn btn-success">
                                                    <i class="fas fa-dollar-sign"></i> Earned </a>
                                            </div>
                                        </form>
                                    </div> <!-- end col -->
                                @endif
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
                                            <td>Quantity :</td>
                                            <td>{{ $quantity }}</td>
                                        </tr>
                                        <tr>
                                            <td>Sub Total :</td>
                                            <td>$ {{ number_format($total) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping :</td>
                                            <td class="text text-success">Free</td>
                                        </tr>
                                        <tr>
                                            <th>Total :</th>
                                            <th>$ {{ number_format($total) }}</th>
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
    <script>
        function earnedClick(id, name) {
            let text = "Did you earned ?";
            if (confirm(text) == true) {
                document.getElementById("earned").submit();
            }
        }
    </script>
@endsection
