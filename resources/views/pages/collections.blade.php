@extends('layouts.nav')

@section('title')
    Products Preview
@endsection

@section('styles')
<link href="css/shop-homepage.css" rel="stylesheet">
@endsection

@section('content')

<div style="margin-top:50px"></div>

<div class="row">

      <!-- /.col-lg-3 -->

      <div class="col-lg-12">

         <div id="carouselExampleIndicators" style="" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          </ol>

          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid mx-auto" src="itemspic/itemc1.png" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid mx-auto" src="itemspic/itemc2.png" alt="Second slide">
            </div>

          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>


        <hr>
        <div class="row">

        <h6 class="my-auto mx-3">Sort By:</h6>



        <div class="form-group my-auto">
            <select onchange="location = this.value;" class="form-control" id="cat-select">
                <option value="{{ route('pages.collections', ['category' => request()->category, 'sort' =>'low_high']) }}">Price, High to Low</option>
                <option value="{{ route('pages.collections', ['category' => request()->category, 'sort' =>'high_low']) }}">Price, Low to High</option>
                <option value="{{ route('pages.collections', ['category' => request()->category, 'sort' =>'a_z']) }}">Alphabeticallly, A-Z </option>
                <option value="{{ route('pages.collections', ['category' => request()->category, 'sort' =>'z_a']) }}">Alphabeticallly, Z-A </option>
                <option value="{{ route('pages.collections', ['category' => request()->category, 'sort' =>'o_n']) }}">Date, Old-New</option>
                <option value="{{ route('pages.collections', ['category' => request()->category, 'sort' =>'n-o']) }}">Date, New-Old</option>
            </select>
        </div>

        <p style="font-style: italic; margin-left:700px "class="my-auto">{{ $products->total() }} Product(s)</p>

    </div>
    <hr>


        <div class="row">
        @forelse ($products as $product)
            <div class="col-lg-3 col-md-6 mb-3">
            <div class="card h-100">
              <a href="/collections/{{ $product->id }}"><img class="card-img-top" src="/storage/display_images/{{ $product->display_image }}" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a class="product_display"href="/collections/{{ $product->id}}">{{ $product->name }}</a>
                  <p class="descp">{{ $product->flavor }}</p>
                  <p class="makerdesc">{{ $product->maker }}</p>
                  <h5 class="pricetag">₱{{ $product->price }}</h5>
                </h4>
              </div>
            </div>
          </div>
        @empty

        <div style="text-align:left">No Items Found</div>

        @endforelse

        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->
      <div class="center-align">
         {{-- {{ $products->links() }} --}}
         {{ $products->appends(request()->input())->links() }}
    </div>
    </div>

</div>

<div style="margin-top: 100px;"></div>


    <!-- /.row -->
@endsection



@section('script')
    <script>

    window.onload = function() {
        var selItem = sessionStorage.getItem("SelItem");
        $('#cat-select').val(selItem);
        }
        $('#cat-select').change(function() {
            var selVal = $(this).val();
            sessionStorage.setItem("SelItem", selVal);
        });
    </script>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
@endsection


