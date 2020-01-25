@extends('layouts.nav')

@section('title')
    Products Preview
@endsection

@section('styles')
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link href="{{ asset('css/itemdisplay.css') }}" rel="stylesheet">
<link href="css/shop-homepage.css" rel="stylesheet">
@endsection

@section('content')

    <div class="row">

        <div style="margin-top: 60px;"class="col-md-12">
            <div class="col-lg-6">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            @if (session('errors'))
                <div class="alert alert-danger" role="alert">
                    {{ session('errors') }}
                </div>
            @endif
            @if (session('update'))
                <div class="alert alert-info" role="alert">
                    {{ session('update') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="preview col-md-6">
                <div class="row">
                    </div>

                <div class="preview-pic tab-content">
                    <div class="tab-pane active" id="pic-1"><img src="/storage/display_images/{{ $product->display_image }}"/>
                    </div>
                    <div class="text-center"><h6 style="color: green;">Available Stocks: {{ $product->quantity }}</h6></div>
                </div>
            </div>
            <div style="margin-top: 100px" class="details col-md-6">
                <p class="product-title">{{ $product->name }}</p>
                <div class="rating">
                    <p class="flavor"><span class="review-no">{{ $product->flavor }}</span></p>
                </div>
                <p class="description">{!! $product->description !!}</p>
                <p class="price"><span>₱{{ $product->price }}</span></p>
                    <div class="row">
                        <div class="col-sm-4" id="form-size">
                            <form action="{{ route('cart.store') }}" method="POST">
                                {{ csrf_field() }}
                        <h6 class="colorsize">Size</h6>
                            <select name="size" class="custom-select">
                            <option selected>60ML</option>
                            </select>

                        </div>
                        <div class="col-sm-4" id="form-size">

                        <h6 class="colorsize">Strength</h6>
                            <select name="strength" class="custom-select">
                            <option selected>3MG</option>
                            <option value="6MG">6MG</option>
                            <option value="9MG">9MG</option>
                            <option value="12MG">12MG</option>
                            </select>

                        </div>
                        <div class="col-sm-3" id="form-size">
                            <h6 class="colorsize">Quantity</h6>
                            <input type="number" class="form-control" id="lastName" name="quantity" required>
                        </div>

                        <input type="hidden" name="id" value="{{ $product->id }}">

                        <button type="submit" class="btn btn-cart">ADD TO CART</button>
                        </form>
                    </div>


            </div>

        </div>
            </div>

        </div>
        @include('pages.might-like')

    <div style="margin-bottom: 100px;"></div>
@endsection


@section('script')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>

@endsection
