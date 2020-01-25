@extends('layouts.master')


@section('title')
    Dashboard
@endsection


@section('content')

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title text-center">Listed Products</h4>
                <hr>
                <a href="/create-product" class="btn btn-block btn-primary col-md-6 mx-auto">ADD PRODUCT</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-borderless">
                    <thead class="text-primary text-center">
                        <tr class="d-flex">
                            <th class="col-2">ID</th>
                            <th class="col-2">Name</th>

                            <th class="col-2">Date</th>
                            <th class="col-1"></th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    @if(count($products)>0)
                    @foreach ($products as $product)
                      <tr class="d-flex">
                        <td class="col-2">{{ $product->id }}</td>
                        <td class="col-2"><a href="/listedproducts/{{ $product->id}}"> {{ $product->name }}</a></td>
                        <td class="col-2">{{ $product->created_at }}</td>
                        <td class="col-1">
                            <div class="row">
                                <div>
                            <a  style="padding:5px;" href="/edit-product/{{ $product->id}}" class="btn btn-success">EDIT</a>
                                </div>
                             {{-- <form action="/delete-product/{{ $product->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form> --}}
                            <div>
                            <a style="padding:5px;"href="javascript:;" data-toggle="modal" onclick="deleteData({{$product->id}})"
                                data-target="#DeleteModal" class="btn btn-danger btn-mini">DELETE </a>
                            </div>
                            </div>
                        </td>
                      </tr>
                    @endforeach
                        {{ $products->links() }}
                      @else
                        <div class="alert alert-success" role="alert">
                            <h6>No Product Listed</h6>
                        </div>
                    @endif
                    </tbody>
                  </table>

                </div>
              </div>
            </div>
          </div>
          <!--Modal Window-->
          <div id="DeleteModal" class="modal fade">
            <div class="modal-dialog modal-confirm">

                <form action="{{route('product.destroy', $product->id)}}" id="deleteForm" method="POST">
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

            </div>
        </div>
        @include('sweetalert::alert')
        <script type="text/javascript">
            function deleteData(id)
            {
                var id = id;
                var url = '{{ route("product.destroy", ":id") }}';
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

@endsection
