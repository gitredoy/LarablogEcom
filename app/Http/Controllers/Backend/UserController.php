<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function userview(){
        $this->data['allData'] = User::all();
     return view('backend.user.viewUser',$this->data);
    }

    public function add(){
        return view('backend.user.addUser');
    }
    public function store(Request  $request){
        $this->validate($request,[
            'name' => 'required',
            'usertype' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);
        $user = new User();
        $user->usertype = $request->usertype;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $add = $user->save();
        if ($add) {
            Session::flash('message','Data added Successfully');
        }
        return redirect()->route('users.view');
    }
    public function edit($id){
        $this->data['user'] = User::findOrFail($id);
       return view('backend.user.edit',$this->data);
    }
    public function update(Request $request,$id){
        $user = User::find($id);
        $user->usertype = $request->usertype;
        $user->name = $request->name;
        $user->email = $request->email;
        $update =  $user->save();
        if ($update) {
            Session::flash('message','Data Updated Successfully');
        }
        return redirect()->route('users.view');
    }
    public function delete($id){
        $user = User::find($id);
        if (file_exists('public/upload/users_image/'.$user->image) AND !empty($user->image)) {
            unlink('public/upload/users_image/'.$user->image);
        }
        $delete =  $user->delete();
        if ($delete) {
            Session::flash('message','Data Deleted Successfully');
        }
        return redirect()->route('users.view');
    }
}
