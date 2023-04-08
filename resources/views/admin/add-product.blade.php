@extends('layouts.dashboard')
@section('title', 'Add product')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Add Product</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Add Product</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    @if (session('createProductStatus'))
                        <div class="alert alert-success" role="alert">
                            Create product successfully
                        </div>
                    @endif
                    @if (session('createProductFail'))
                        <div class="alert alert-danger" role="alert">
                            Create product failed
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('store-product') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productName">Product Name</label>
                                            <input required value="{{ old('productName') }}" id="productName" name="productName"
                                                type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="manufacturerName">Manufacturer Name</label>
                                            <input required value="{{ old('manufacturerName') }}" id="manufacturerName"
                                                name="manufacturerName" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input required min="0" value="{{ old('price') }}" id="price" name="price" type="number"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input required min="1" value="{{ old('stock') }}" id="stock" name="stock" type="number"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Category</label>
                                            <select required name="category" class="form-control select2">
                                                <option value="">Select</option>
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Size</label>
                                            <select required name="size" class="form-control select2">
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
                                            <input required value="{{ old('color') }}" id="color" name="color" type="text"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="file">File Image</label>
                                            <input required id="file" name="file" type="file" class="form-control">
                                        </div>
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
                                    Submit
                                </button>
                                <a href="{{ route('product-list') }}" type="submit"
                                    class="btn btn-secondary waves-effect">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
