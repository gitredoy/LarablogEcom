<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class LogoController extends Controller
{
  public function logoview(){
      $this->data['logos'] = Logo::all();
      return view('backend.logo.viewLogo',$this->data);
  }
  public function update(Request $request){
      $logo = Logo::find(1);
      $logo-> updated_by = Auth::user()->id;
      if ($request->file('image')) {
          @unlink(public_path('upload/logo/'.$logo-> image));
          $file = $request->file('image');
          $extension = $file->getClientOriginalExtension();
          $image = 'Logo'.rand().'.'.$extension;
          Image::make($file)->resize('220','57')->save(public_path('upload/logo/'.$image));
          $logo-> image = $image;

      }

      $save = $logo->save();
      if ($save) {
          Session::flash('message','Logo Updated Successfully');
          return redirect()->back();
      }

  }

}
