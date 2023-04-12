@extends('layouts.dashboard')
@section('title', 'Order')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Orders</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Orders</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    @if (session('acceptSuccess'))
                        <div class="alert alert-success" role="alert">
                            Accepted order successfully
                        </div>
                    @endif
                    @if (session('checkedSuccess'))
                        <div class="alert alert-success" role="alert">
                            Checked order successfully
                        </div>
                    @endif
                    @if (session('deleteSuccess'))
                        <div class="alert alert-success" role="alert">
                            Deleted order successfully
                        </div>
                    @endif
                    @if (session('checkoutSuccess'))
                        <div class="alert alert-success" role="alert">
                            Order added successfully
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <div class="search-box mr-2 mb-2 d-inline-block">
                                        <div class="position-relative">
                                            @if (Auth::user()->is_admin)
                                                <form action="{{ route('orderSearch') }}" method="GET">
                                                    <input value="{{ old('billingName') }}" name="billingName"
                                                        type="text" class="form-control"
                                                        placeholder="Search by billing name...">
                                                    <i class="bx bx-search-alt search-icon"></i>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                            <th>View Details</th>
                                            @if (Auth::user()->is_admin)
                                                <th>Action</th>
                                            @endif
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
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <a href="{{ route('orderShow', $item->id) }}"
                                                        class="btn btn-primary btn-sm btn-rounded">
                                                        View Details
                                                    </a>
                                                </td>
                                                @if (Auth::user()->is_admin)
                                                    <td>
                                                        <a href="{{ route('orderAccept', $item->id) }}"
                                                            class="mr-3 text-primary" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="Accept"><i
                                                                class="bx bx-check font-size-18"></i></a>
                                                        @if (!$item->payment_status)
                                                            <a onclick="deleteOrder('{{ $item->id }}', '{{ $item->user->name }}')"
                                                                class="text-danger" data-toggle="tooltip"
                                                                data-placement="top" title=""
                                                                data-original-title="Delete"><i
                                                                    class="bx bx-x font-size-18"></i></a>
                                                        @endif
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <form id="deleteOrder" action="{{ route('deleteOrder') }}" method="POST">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="order_id" id="order_id">
                            </form>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <script>
        function deleteOrder(id, name) {
            let text = "Do you want to delete Billing Name: " + name + " ?";
            if (confirm(text) == true) {
                $("#order_id").val(id);
                document.getElementById("deleteOrder").submit();
            }
        }
    </script>
@endsection
