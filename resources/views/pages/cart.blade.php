@extends('layouts.nav')

<script src="https://use.fontawesome.com/c560c025cf.js"></script>
@section('content')
<div class="px-4 px-lg-0">
    <!-- End -->

    <div class="pb-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

            <!-- Shopping cart table -->
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col" class="border-0 bg-light">
                      <div class="p-2 px-3 text-uppercase">Product</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Price</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Quantity</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Remove</div>
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach (Cart::content() as $item)
                  <tr>
                    <th scope="row" class="border-0">
                      <div class="p-2">
                        <img src="/storage/display_images/{{ $item->options->image }}" alt="" width="70" class="img-fluid rounded shadow-sm">
                        {{-- <a href="{{ route('pages.display', $item->id) }}"><img src="{{ asset('/storage/display_images'.$item->display_image) }}" alt=""></a> --}}
                        <div class="ml-3 d-inline-block align-middle">
                          <h5 class="mb-0"> <a href="{{ route('pages.display', $item->id) }}" class="text-dark d-inline-block align-middle">{{ $item->name }}</a></h5><span class="text-muted font-weight-normal font-italic d-block">Nicotine Strength: {{ $item->options->strength }}</span>
                        </div>
                      </div>
                    </th>
                    <td class="border-0 align-middle"><strong>₱{{ $item->subtotal }}</strong></td>
                    <td class="border-0 align-middle">
                        <select class="quantity" data-id="{{ $item->rowId }}">
                            @for($i = 1; $i < 5 + 1; $i++)
                                <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                            {{-- <option {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                            <option {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                            <option {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                            <option {{ $item->qty == 4 ? 'selected' : '' }}>4</option> --}}
                        </select>
                    </td>
                    {{-- <td class="border-0 align-middle"><strong>{{ $item->qty }}</strong></td> --}}
                    {{-- <td class="border-0 align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a></td> --}}
                    <td class="border-0 align-middle">
                        <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="text-dark"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>

              </table>
            </div>
            <!-- End -->
            <a href="{{ route('pages.collections') }}">Continue Shopping</a>
          </div>
        </div>

        <div class="row py-5 p-4 bg-white rounded shadow-sm">
          <div class="col-lg-6">
            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions for seller</div>
            <div class="p-4">
              <p class="font-italic mb-4">If you have some information for the seller you can leave them in the box below</p>
              <textarea name="" cols="30" rows="2" class="form-control"></textarea>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
            <div class="p-4">
              <p class="font-italic mb-4">Shipping is free because we are awesome like that ;)</p>
              <ul class="list-unstyled mb-4">
                <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Order Subtotal </strong><strong>₱{{ Cart::subtotal() }}</strong></li>
                <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>FREE</strong></li>
                <li class="d-flex justify-content-between py-3 border-bottom">
                  <strong class="text-muted">Total</strong>
                  <h5 class="font-weight-bold">₱{{ Cart::total()}}</h5>
                </li>
              </ul><a href="#" class="btn btn-dark rounded-pill py-2 btn-block">Procceed to checkout</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  @endsection

@section('script')
<script src="{{ asset('js/app.js') }}" ></script>
<script>
    (function(){
        const classname = document.querySelectorAll('.quantity')

        Array.from(classname).forEach(function(element){
            element.addEventListener('change', function(){
                const id = element.getAttribute('data-id')
            axios.patch(`/cart/${id}`, {
                    quantity: this.value
                })
                .then(function (response) {
                    //console.log(response);
                   window.location.href = '{{ route('cart.index') }}'
                })
                .catch(function (error) {
                    console.log(error);
                   window.location.href = '{{ route('cart.index') }}'
                });
            })
        })
    })();
</script>

@endsection







