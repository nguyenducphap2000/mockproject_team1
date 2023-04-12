@extends('layouts.master')
@section('title', 'Products')
@section('content')

    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>List Of Products</h2>
                        <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->


    <!-- ***** Products Area Starts ***** -->
    <section class="section" id="products">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('filterProduct') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input name="textSearch" value="{{ old('textSearch') }}" type="text" class="form-control"
                                    placeholder="Search by name..." aria-label="Recipient's username"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="exampleFormControlSelect1">Category</label>
                                    <select name="category" class="form-control" id="exampleFormControlSelect1">
                                        <option value="">Select</option>
                                        @foreach ($categories as $item)
                                            @if (old('category') == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="exampleFormControlSelect1">Size</label>
                                    <select name="size" class="form-control" id="exampleFormControlSelect1">
                                        <option value="">Select</option>
                                        @foreach ($sizes as $item)
                                            @if (old('size') == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($products as $item)
                    <div class="col-lg-4">
                        <div class="item">
                            <div class="thumb">
                                <div class="hover-content">
                                    <ul>
                                        <li>
                                            <a href="{{ route('singleProduct', $item->id) }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </li>
                                        @if ($item->stock > 0)
                                            <li>
                                                <a onclick="addToCart({{ $item->id }})">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <img style="height: 300px;" src="{{ asset('storage/' . $item->image) }}" alt="">
                            </div>
                            <div class="down-content">
                                <h4>{{ $item->name }}</h4>
                                <span>$ <?php echo number_format($item->price, 0); ?></span>
                                <ul class="stars">
                                    <li>
                                        <h5>{{ $item->size->name }}</h5>
                                    </li>
                                </ul>
                                <span
                                    class="{{ $item->stock <= 0 ? 'text text-danger' : 'text text-success' }}">{{ $item->stock <= 0 ? 'Sold out' : 'Stock: ' . $item->stock }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <form id="addToCart" action="{{ route('cartStore') }}" method="POST">
                @csrf
                <input type="hidden" name="productId" id="productId">
            </form>
        </div>
        {{ $products->links() }}
    </section>
    <!-- ***** Products Area Ends ***** -->
    <script>
        function addToCart(id) {
            $("#productId").val(id);
            document.getElementById("addToCart").submit();
        }
    </script>
@endsection
