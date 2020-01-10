@extends('layouts.app')


@section('title')
    Products Preview
@endsection

@section('styles')
<link href="../assets/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
@endsection

@section('content')

    <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
        <div class="row">
            <div class="preview col-md-6">

                <div class="preview-pic tab-content">
                    <div class="tab-pane active" id="pic-1"><img src="/storage/display_images/{{ $product->display_image }}"/>
                    </div>
                    <div class="text-center"><h6 style="color: green;">Available Stocks: {{ $product->quantity }}</h6></div>
                </div>
            </div>
            <div class="details col-md-6">
                <h2 class="product-title">{{ $product->name }}</h2>
                <div class="rating">
                    <h3><span class="review-no">{{ $product->flavor }}</span></h3>
                </div>
                <p class="product-description">{!! $product->description !!}</p>
                <h4 class="price"><span>P{{ $product->price }}</span></h4>
                    <div class="row">
                        <div class="col-sm-4" id="form-size">
                        <form>
                        <h6>Size</h6>
                            <select name="cars" class="custom-select">
                            <option selected>60ML</option>
                            </select>
                        </form>
                        </div>
                        <div class="col-sm-4" id="form-size">
                        <form>
                        <h6>Strength</h6>
                            <select name="cars" class="custom-select">
                            <option selected>3MG</option>
                            <option value="volvo">6MG</option>
                            <option value="fiat">9MG</option>
                            <option value="audi">12MG</option>
                            </select>
                        </form>
                        </div>
                        <div class="col-sm-3" id="form-size">
                        <h6>Quantity</h6>
                        <select name="cars" class="custom-select">
                            <option selected>1</option>
                            <option value="volvo">2</option>
                            <option value="fiat">3</option>
                            <option value="audi">4</option>
                            </select>
                        </div>
                    </div>
                    <div>
            </div>
        </div>
    </div>
    </div>
            </div>
        </div>
    </div>
@endsection

@section('script')


@endsection
