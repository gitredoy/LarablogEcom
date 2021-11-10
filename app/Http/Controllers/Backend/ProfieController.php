<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ProfieController extends Controller
{
    public function profileview(){
        $userId = Auth::user()->id;
        $this->data['user'] = User::find($userId);
       return view('backend.profile.viewProfile',$this->data);
    }
    public function profileedit(){
        $userId = Auth::user()->id;
        $this->data['user'] = User::find($userId);
        return view('backend.profile.editProfile',$this->data);
    }
    public function  profileupdate(Request $request){
        $user = User::find(Auth::user()->id);
        $user -> name = $request->name;
        $user -> mobile = $request->mobile;
        $user -> gender = $request->gender;
        $user -> address = $request->address;
        if ($request->file('image')) {
            @unlink(public_path('upload/users_image/'.$user-> image));
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = $request->name.rand().'.'.$extension;
            Image::make($file)->resize('220','230')->save(public_path('upload/users_image/'.$image));
            $user-> image = $image;
        }
        if (empty($request->current_pass)) {
            $user->password = Auth::user()->password;
        }elseif (Auth::attempt(['id'=>Auth::user()->id,'password'=>$request->current_pass])){
            $user->password = bcrypt($request->new_pass);
        }else{
            Session::flash('message','Password Does Not Match');
            return redirect()->back();
        }
        $data = $user -> save();
        if ($data){
            Session::flash('message','Profile Updated Successfully');
        }
        return redirect()->route('profile.view');
    }
}
