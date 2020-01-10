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
                        <td class="col-1"><a href="/edit-product/{{ $product->id}}" class="btn btn-success">EDIT</a></td>
                        <td class="col-1">
                            <form action="/delete-product/{{ $product->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
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
        </div>
@endsection

@section('script')

@endsection
