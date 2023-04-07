@extends('layouts.dashboard')
@section('title','Add product')
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
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Basic Information</h4>
                        <p class="card-title-desc">Fill all information below</p>

                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="productname">Product Name</label>
                                        <input id="productname" name="productname" type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="manufacturername">Manufacturer Name</label>
                                        <input id="manufacturername" name="manufacturername" type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="manufacturerbrand">Manufacturer Brand</label>
                                        <input id="manufacturerbrand" name="manufacturerbrand" type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input id="price" name="price" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Category</label>
                                        <select class="form-control select2">
                                            <option>Select</option>
                                            <option value="AK">Alaska</option>
                                            <option value="HI">Hawaii</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="productdesc">Product Description</label>
                                        <textarea class="form-control" id="productdesc" rows="5"></textarea>
                                    </div>

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Save Changes</button>
                            <button type="submit" class="btn btn-secondary waves-effect">Cancel</button>
                        </form>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Product Images</h4>

                        <form action="/" method="post" class="dropzone">
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>

                            <div class="dz-message needsclick">
                                <div class="mb-3">
                                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                </div>

                                <h4>Choose files to upload.</h4>
                            </div>
                        </form>
                    </div>

                </div> <!-- end card-->
            </div>
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
