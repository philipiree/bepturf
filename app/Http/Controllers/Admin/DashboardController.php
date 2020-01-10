<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    public function registered(){
        $users = User::all();
        return view('admin.registered')->with('users', $users);
    }

    public function edit(Request $request, $id){
        $users = User::findOrFail($id);
        return view('admin.register-edit')->with('users',$users);
        //return view('admin.register-edit')->with('users', $users);
    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'username' => 'required',
            'usertype' => 'required'
        ]);

        $users = User::find($id);
        $users->name = $request->input('username');
        $users->usertype = $request->input('usertype');
        $users->update();

        return redirect('/role-register')->with('update','Successfully Updated');
    }

    public function delete($id){
        $users = User::findOrFail($id);
        $users->delete();

        return redirect('/role-register')->with('delete','Successfully Deleted');

    }
}
