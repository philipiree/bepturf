<link href="{{ asset('css/shop-homepage.css') }}" rel="stylesheet">
<hr>
<div class="might-like">
    <h5>You might also like...</h5>
    <br>
    <div class="row">

        @forelse ($mightAlsoLike as $product)
            <div class="col-lg-3 col-md-6 mb-3">
            <div class="card h-100">
              <a href="/collections/{{ $product->id }}"><img class="card-img-top" src="/storage/display_images/{{ $product->display_image }}" alt=""></a>
              <div class="card-body">
                <h6 class="card-title">
                  <a class="product_display"href="/collections/{{ $product->id}}">{{ $product->name }}</a>
                  <p class="descp">{{ $product->flavor }}</p>
                  <p class="makerdesc">{{ $product->maker }}</p>
                  <h5 class="pricetag">₱{{ $product->price }}</h5>
                </h6>
              </div>
            </div>
          </div>
        @empty

        <div style="text-align:left">No Items Found</div>

        @endforelse

        <!-- /.row -->

      </div>

</div>
