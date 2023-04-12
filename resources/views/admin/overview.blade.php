@extends('layouts.dashboard')
@section('title', 'Overview')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                {{-- <div class="col-xl-4">
                    <div class="card overflow-hidden">
                        <div class="bg-soft-primary">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-3">
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p>Skote Dashboard</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{asset('assets/dashboard/images/profile-img.png')}}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <img src="{{asset('assets/dashboard/images/users/avatar-1.jpg')}}" alt=""
                                            class="img-thumbnail rounded-circle">
                                    </div>
                                    <h5 class="font-size-15 text-truncate">Henry Price</h5>
                                    <p class="text-muted mb-0 text-truncate">UI/UX Designer</p>
                                </div>

                                <div class="col-sm-8">
                                    <div class="pt-4">

                                        <div class="row">
                                            <div class="col-6">
                                                <h5 class="font-size-15">125</h5>
                                                <p class="text-muted mb-0">Projects</p>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="font-size-15">$1245</h5>
                                                <p class="text-muted mb-0">Revenue</p>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <a href="" class="btn btn-primary waves-effect waves-light btn-sm">View
                                                Profile <i class="mdi mdi-arrow-right ml-1"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted font-weight-medium">Orders</p>
                                            <h4 class="mb-0">{{ $numberOfOrder }}</h4>
                                        </div>

                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                            <span class="avatar-title">
                                                <i class="bx bx-copy-alt font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted font-weight-medium">Collected Moeny</p>
                                            <h4 class="mb-0">$ {{ number_format($total, 2) }}</h4>
                                        </div>

                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-archive-in font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted font-weight-medium">Average Price</p>
                                            <h4 class="mb-0">$ {{ number_format($average, 2) }}</h4>
                                        </div>

                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Latest Order</h4>
                            <div class="table-responsive">
                                @php
                                    $i = 1;
                                @endphp
                                <table class="table table-centered table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Billing Name</th>
                                            <th>Purchased Date</th>
                                            <th>Estimated Delivery Date</th>
                                            <th>Total</th>
                                            <th>Payment Status</th>
                                            <th>Payment Method</th>
                                            <th>Order Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                            <tr>
                                                <td><a href="javascript: void(0);"
                                                        class="text-body font-weight-bold">{{ $i++ }}</a> </td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>
                                                    {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->purchased_date)->format('d-m-Y') }}
                                                </td>
                                                <td>
                                                    {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->estimated_delivery_date)->format('d-m-Y') }}
                                                </td>
                                                <td>
                                                    $ {{ number_format($item->total, 0) }}
                                                </td>
                                                <td>
                                                    @if ($item->payment_status)
                                                        <span class="badge badge-pill badge-soft-success font-size-12">
                                                            Paid
                                                        </span>
                                                    @else
                                                        <span class="badge badge-pill badge-soft-danger font-size-12">
                                                            Not yet
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <i class="fab fa-cc-mastercard mr-1"></i>
                                                    {{ $item->payment_methods->name }}
                                                </td>
                                                <td>
                                                    @if ($item->order_status)
                                                        <span class="badge badge-pill badge-soft-success font-size-12">
                                                            Accepted
                                                        </span>
                                                    @else
                                                        <span class="badge badge-pill badge-soft-danger font-size-12">
                                                            Waiting Accept
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row mt-4">
                <div class="col-sm-6">
                    <a href="{{route('order')}}" class="btn btn-primary">
                        <i class="mdi mdi-arrow-right mr-1"></i> Go To Orders </a>
                </div> <!-- end col -->
            </div> <!-- end row-->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
