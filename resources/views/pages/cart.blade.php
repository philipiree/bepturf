@extends('layouts.nav')

@section('styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://kit.fontawesome.com/81abfe277e.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


@endsection

@section('content')
<div class="px-4 px-lg-0">
   <div class="container">
        <div class="row">
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
        </div>
    </div>
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
                      <div class="p-2 px-3 text-uppercase ">Product</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase ">Price</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase text-center">Quantity | Update</div>
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
                        <form action="{{ route('cart.update', $item->rowId) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input type="hidden" name="proId" value="{{$item->id}}">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <input type="number" class="text"  id="lastName" value="{{ $item->qty }}" name="quantity" required>
                                </div>
                                {{-- <div class="div-qty">
                                    <input  type="number" class="form-control input-qty"  id="lastName" value="{{ $item->qty }}"name="quantity" required>
                                </div> --}}
                                <div class="col div-submit">
                                <button type="submit" class="btn-update"><i class="fas fa-sync"></i></button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </td>
                    <td class="border-0 align-middle">
                    {{-- <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn-delete" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i></button>
                    </form> --}}
                    {{-- <button type="submit" data-catid={{$item->rowId}} class="btn-delete" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i></button> --}}
                    <a style="color:black;"href="javascript:;" data-toggle="modal" onclick="deleteData({{$item->rowId}})"
                        data-target="#DeleteModal" class="btn-delete"><i class="fa fa-trash"></i> </a>
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

        <div class="row bg-white rounded shadow-sm">
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
            </ul>
            @if (Cart::instance('default')->count() == 0)

            @else
                <a href="{{route('checkout.index')}}" class="btn btn-dark rounded-pill py-2 btn-block">Checkout</a>
            @endif
            </div>
          </div>
        </div>

        <!--Modal Window -->

        <div id="DeleteModal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                @foreach (Cart::content() as $item)
                <form action="{{route('cart.destroy', $item->rowId)}}" id="deleteForm" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">
                            <i class="material-icons">&#xE5CD;</i>
                        </div>


                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <p>Are you sure you want to delete this item?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Yes, Delete</button>
                    </div>
                </div>
                </form>
                @endforeach
            </div>
        </div>
      </div>
    </div>
    @include('sweetalert::alert')
    <script type="text/javascript">
        function deleteData(rowId)
        {
            var id = rowId;
            var url = '{{ route("cart.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
     </script>
  </div>
@endsection

@section('script')
{{-- <script>
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
                   window.location.href = '{{ route('cart.index') }}'
                });
            })
        })
    })();
</script> --}}




@endsection







