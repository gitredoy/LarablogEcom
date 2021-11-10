<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class SlidersController extends Controller
{
    public function sliderview(){
        $this->data['sliders'] = Slider::orderBy('id','DESC')->get();
        return view("backend.slider.viewslide",$this->data);
    }

    public function add(){
        return view("backend.slider.addslide");
    }

    public function store(Request $request){
        $slider = new Slider();
        $slider-> shorttext = $request->shorttext;
        $slider-> longtext = $request->longtext;

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $image = 'slider'.rand().'.'.$extension;
        Image::make($file)->resize('1920','900')->save(public_path('upload/sliders/'.$image));
        $slider-> image = $image;

        $save = $slider->save();
        if ($save) {
            Session::flash('message','Slider Added Successfully');
            return redirect()->route('sliders.view');
        }

    }
    public function edit($id){
        $this->data['slider'] = Slider::findOrFail($id);
        return view("backend.slider.editslide",$this->data);
    }
    public function update(Request $request,$id){
        $slider = Slider::find($id);
        $slider-> shorttext = $request->shorttext;
        $slider-> longtext = $request->longtext;
        if ($request->file('image')) {
            @unlink(public_path('upload/sliders/'.$slider-> image));
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = 'slider'.rand().'.'.$extension;
            Image::make($file)->resize('1920','900')->save(public_path('upload/sliders/'.$image));
            $slider-> image = $image;
        }
        $update = $slider->save();
        if ($update) {
            Session::flash('message','Slider Updated Successfully');
            return redirect()->route('sliders.view');
        }

    }
    public function delete($id){
        $slider = Slider::find($id);
        @unlink(public_path('upload/sliders/'.$slider-> image));
        $delete = $slider->delete();
        if ($delete) {
            Session::flash('message','Slider Deleted Successfully');
            return redirect()->route('sliders.view');
        }

    }
}
