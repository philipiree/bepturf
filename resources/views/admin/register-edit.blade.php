@extends('layouts.master')


@section('title')
    Edit Page
@endsection


@section('content')
 <div class="container-fluid">
     <div class="row">
         <div class="col-md-8 mx-auto">
             <div class="card">
                 <div class="card-header text-center">
                     <h1>Role Assignment</h1>
                 </div>
                 <hr>
                 <div class="card-body">
                     <div class="row justify-content-center">
                        <div class="col-md-7">
                            <form action="/role-register-update/{{ $users->id }}" method="POST">
                                {{-- need these both for updating --}}
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                        <div class="form-group text-center">
                            <label class><h6>ID: {{ $users->id}}</h6></label>
                        </div>
                        <div class="form-group text-center">
                            <label class>Name</label>
                            <input type="text" name="username" value="{{ $users->name }}" class="form-control text-center">
                        </div>
                        <div class="form-group text-center">
                            <label for="">Give Role</label>
                            <select name="usertype" id="" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="">User</option>
                            </select>
                        </div>
                    </div>
                  </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="/role-register" class="btn btn-danger">Cancel</a>
                    </div>
                        <div class="my-5"></div>
                    </form>
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
