@extends('layouts.master')
@section('title','Category')
<link rel="stylesheet" href="{{URL::asset('/assets/css/category.css')}}">
@section('content')
    <div class="heading">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <h3 class="filter-title text-capitalize">Category filter</h3>
                    <form action="">
                        <div class="input-group row">
                            <input type="text" class="form-control col-9" name="search-box" placeholder="Search">
                            <input type="submit" class="search-btn btn btn-primary col-3" value="Search" name="search-btn">
                        </div>
                        {{--Filter part category--}}
                        <div class="check-group">
                            <h4>Category</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Default checkbox
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Checked checkbox
                                </label>
                            </div>
                        </div>
                        {{--Filter part color--}}
                        <div class="check-group">
                            <h4>color</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="red" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Red
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="blue" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                    blue
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-8"></div>
            </div>
        </div>
    </div>
@endsection
