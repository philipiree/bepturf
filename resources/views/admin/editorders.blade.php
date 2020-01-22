@extends('layouts.master')


@section('title')
    Edit Product
@endsection


@section('content')
 <div class="container-fluid">
     <div class="row">
         <div class="col-md-10 mx-auto">
             <div class="card">
                 <div class="card-header text-center">
                     <h4 class="card-title text-center">Edit Product</h4>
                 </div>
                 <hr>
                 <div class="card-body">
                     <div class="row justify-content-center">
                        <div class="col-md-7">
                            {!! Form::open(['action' =>['OrdersController@update', $order->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                {{ csrf_field() }}

                                <div class="form-group">
                                    {{ Form::hidden('_method','PUT') }}
                                    {{ Form::label('name', 'Name') }}
                                    {{ Form::text('name', $product->name, ['class'=> 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('flavor', 'Flavor') }}
                                    {{ Form::text('flavor', $product->flavor, ['class'=> 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('maker', 'Maker') }}
                                    {{ Form::text('maker', $product->name, ['class'=> 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('description', 'Description') }}
                                    {{ Form::textarea('description', $product->description, ['id' => 'editor', 'class'=> 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('category', 'Category') }}
                                    {{ Form::select('category_id', $categories, null, ['class' =>'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('price', 'Price') }}
                                    {{ Form::text('price', $product->price, ['class'=> 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('size', 'Size') }}
                                    {{ Form::text('size', $product->size, ['class'=> 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('strength', 'Strength') }}
                                    {{ Form::text('strength', $product->strength, ['class'=> 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('quantity', 'Quantity') }}
                                    {{ Form::text('quantity', $product->quantity, ['class'=> 'form-control']) }}
                                </div>
                                {{ Form::file('display_image') }}
                                <div class="text-center">
                                {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
                                </div>
                            {!! Form::close() !!}
                        </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
@endsection

@section('scripts')

@endsection
