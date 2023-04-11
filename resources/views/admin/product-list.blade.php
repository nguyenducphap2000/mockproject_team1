@extends('layouts.dashboard')
@section('title', 'List of products')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Products</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    @if (session('disableNotify'))
                        <div class="alert alert-success" role="alert">
                            Delete product successfully
                        </div>
                    @endif
                    @if (session('disableFail'))
                        <div class="alert alert-danger" role="alert">
                            Delete product failed
                        </div>
                    @endif
                    @if (session('updateProductStatus'))
                        <div class="alert alert-success" role="alert">
                            Update product successfully
                        </div>
                    @endif
                    @if (session('updateProductFail'))
                        <div class="alert alert-danger" role="alert">
                            Update product failed
                        </div>
                    @endif
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <div class="search-box mr-2 mb-2 d-inline-block">
                                        <form action="{{ route('search-product') }}" method="GET">
                                            <div class="position-relative">
                                                <input value="{{ old('txtSearch') }}" name="txtSearch" type="text"
                                                    class="form-control" placeholder="Search by name and producer...">
                                                <i class="bx bx-search-alt search-icon"></i>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="text-sm-right">
                                        <a href="{{ route('add-product') }}"
                                            class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i
                                                class="mdi mdi-plus mr-1"></i> Add New Product</a>
                                    </div>
                                </div><!-- end col-->
                            </div>

                            <div class="table-responsive">
                                @php
                                    $index = $products->firstItem();
                                @endphp
                                <table class="table table-centered table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Producer</th>
                                            <th>Category</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Stock</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <td><a href="javascript: void(0);"
                                                        class="text-body font-weight-bold">{{ $index++ }}</a> </td>
                                                <td>{{ $product->name }}</td>
                                                <td class="price">
                                                    {{ $product->price }}
                                                </td>
                                                <td>
                                                    {{ $product->producer }}
                                                </td>
                                                <td>
                                                    {{ $product->category->name }}
                                                </td>
                                                <td>
                                                    {{ $product->color }}
                                                </td>
                                                <td>{{ $product->size->name }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>
                                                    @if ($product->product_status)
                                                        <span class="badge badge-pill badge-soft-danger font-size-12">
                                                            Sold out
                                                        </span>
                                                    @else
                                                        <span class="badge badge-pill badge-soft-success font-size-12">
                                                            Available
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt=""
                                                        class="avatar-lg">
                                                </td>
                                                <td>
                                                    <a onclick="updateProduct({{ $product }})" data-toggle="modal"
                                                        data-target=".bs-example-modal-xl" href="javascript:void(0);"
                                                        class="mr-3 text-primary" data-toggle="tooltip" data-placement="top"
                                                        title="" data-original-title="Edit"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a onclick="deleteProduct('{{ $product->id }}', '{{ $product->name }}')"
                                                        class="text-danger" data-toggle="tooltip" data-placement="top"
                                                        title="" data-original-title="Delete"><i
                                                            class="mdi mdi-close font-size-18"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <!--  Modal content for the above example -->
    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Update Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('update-product') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="productId" id="productId">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="productName">Product Name</label>
                                                    <input value="{{ old('productName') }}" id="productName"
                                                        name="productName" type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="manufacturerName">Manufacturer Name</label>
                                                    <input value="{{ old('manufacturerName') }}" id="manufacturerName"
                                                        name="manufacturerName" type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="price">Price</label>
                                                    <input min="0" value="{{ old('price') }}" id="price"
                                                        name="price" type="number" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="stock">Stock</label>
                                                    <input min="1" value="{{ old('stock') }}" id="stock"
                                                        name="stock" type="number" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Category</label>
                                                    <select id="category" name="category" class="form-control select2">
                                                        <option value="">Select</option>
                                                        @foreach ($categories as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Size</label>
                                                    <select id="size" name="size" class="form-control select2">
                                                        <option value="">Select</option>
                                                        @foreach ($sizes as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="color">Color</label>
                                                    <input id="color" value="{{ old('color') }}" id="color"
                                                        name="color" type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="file">File Image</label>
                                                    <input id="file" name="file" type="file"
                                                        class="form-control">
                                                </div>
                                                {{-- <img src="{{ asset('storage/1680975716_Jean.jpg') }}" alt=""
                                                    class="avatar-lg"> --}}
                                            </div>
                                        </div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">
                                            Save changes
                                        </button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        function deleteProduct(id, name) {
            let url = "{{ route('delete-product', ':id') }}";
            url = url.replace(':id', id);
            let text = "Do you want to delete " + name + " ?";
            if (confirm(text) == true) {
                document.location.href = url;
            }
        }

        function updateProduct(data) {
            console.log(data);
            $("#productName").val(data.name);
            $("#manufacturerName").val(data.producer);
            $("#price").val(data.price);
            $("#stock").val(data.stock);
            $("#category").val(data.category_id).change();
            $("#size").val(data.size_id).change();
            $("#color").val(data.color);
            $("#productId").val(data.id);
        }
        var price = document.getElementsByClassName("price");
        price = Array.prototype.slice.call(price, 0);
        price.forEach((item, index) => {
            item.innerHTML = parseInt(item.innerHTML.trim()).toLocaleString('en-US', {style : 'currency', currency : 'USD'});;
        })
    </script>
@endsection
