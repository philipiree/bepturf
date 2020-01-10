@extends('layouts.master')


@section('title')
    Create Product
@endsection


@section('content')
 <div class="container-fluid">
     <div class="row">
         <div class="col-md-10 mx-auto">
             <div class="card">
                 <div class="card-header text-center">
                     <h1>Create Category</h1>
                 </div>

                 <div class="card-body">
                     <div class="row justify-content-center">
                        <div class="col-md-7">
                            {!! Form::open(['action' =>'CategoriesController@store', 'method' => 'POST']) !!}
                                <div class="form-group">
                                    {{ Form::label('name', 'Category Name') }}
                                    {{ Form::text('name', '', ['class'=> 'form-control']) }}
                                </div>
                                {{ Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
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

